<?php
class AdminCustomersController extends Controller
{
   private $export, $import;
   public function __construct()
   {
      $this->controller_type = 'admin';
      $this->layout = 'dashboard';
      parent::__construct();
      $this->export = Tools::baseUrl() . '?controller=AdminBulkData&action=export&token=' . Tools::getValue('token');
      $this->import = Tools::baseUrl() . '?controller=AdminBulkData&action=import&token=' . Tools::getValue('token');
   }
   public function customers()
   {
      $this->title = 'Clientes';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCustomers&action=customer&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Cliente',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'CÓDIGO', 'class' => 'text-center col-2'],
         ['label' => 'RIF', 'class' => 'text-center col-2'],
         ['label' => 'RAZÓN SOCIAL', 'class' => 'text-center col-6'],
         ['label' => 'ESTADO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'code', 'class' => 'text-center'],
         ['field' => 'dni', 'class' => 'text-center'],
         ['field' => 'company_name', 'class' => 'text-center'],
         ['field' => 'status', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_entity', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCustomers&action=customer'],
               ['id' => 'id_entity', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Customers::getCustomers())]);
   }
   public function customer()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Clientes',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'CÓDIGO',
               'name' => 'code',
               'col' => 2,
               'class' => 'text-uppercase'
            ],
            [
               'type' => 'text',
               'label' => 'DNI/RIF',
               'name' => 'dni',
               'required' => true,
               'col' => 2,
               'class' => 'text-uppercase'
            ],
            [
               'type' => 'text',
               'label' => 'RAZÓN SOCIAL',
               'name' => 'company_name',
               'col' => 6,
               'required' => true,
               'class' => 'text-uppercase'
            ],
            [
               'type' => 'text',
               'label' => 'PERSONA DE CONTACTO',
               'name' => 'contact_person',
            ],
            [
               'type' => 'text',
               'label' => 'TELÉFONO',
               'name' => 'phone',
               'col' => 2,
            ],
            [
               'type' => 'text',
               'label' => 'CORREO ELECTRÓNICO',
               'name' => 'email',
               'col' => 5,
            ],
            [
               'type' => 'select',
               'label' => 'CIUDAD',
               'name' => 'op_city',
               'options' => Tools::genOptions(Options::getAll(2)),
            ],
            [
               'type' => 'select',
               'label' => 'ESTADO / PROVINCIA',
               'name' => 'op_state',
               'options' => Tools::genOptions(Options::getAll(3)),
            ],
            [
               'type' => 'select',
               'label' => 'PAÍS',
               'name' => 'op_country',
               'options' => Tools::genOptions(Options::getAll(4)),
            ],
            [
               'type' => 'textarea',
               'label' => 'DIRECCIÓN',
               'name' => 'address',
               'col' => 6,
            ],
            [
               'type' => 'text',
               'label' => 'DESCUENTO COMERCIAL',
               'name' => 'trade_discount',
               'class' => 'percentage',
               'col' => 1,
            ],
            [
               'type' => 'text',
               'label' => 'LIMITE DE CRÉDITO',
               'name' => 'credit_limit',
               'class' => 'money-usd',
               'col' => 2,
            ],
            [
               'type' => 'number',
               'label' => 'DÍAS DE CRÉDITO',
               'name' => 'credit_time',
               'col' => 1,
            ],
            [
               'type' => 'text',
               'label' => 'USUARIO',
               'name' => 'username',
               'col' => 3,
            ],
            [
               'type' => 'password',
               'label' => 'CONTRASEÑA',
               'name' => 'password',
               'col' => 3,
            ],
            [
               'type' => 'select',
               'label' => 'ESTADO',
               'name' => 'op_status',
               'options' => [
                  ['value' => 'A', 'label' => 'ACTIVO'],
                  ['value' => 'I', 'label' => 'INACTIVO'],
               ],
               'col' => 3,
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminCustomers&action=customer';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Cliente';
      } else {
         $vals = Customers::getCustomersById(Tools::getValue('id'));
         $fields_value = [
            'dni' => $vals['dni'],
            'code' => $vals['code'],
            'username' => $vals['username'],
            'op_status' => $vals['op_status'],
            'credit_time' => $vals['credit_time'],
            'credit_limit' => $vals['credit_limit'],
            'trade_discount' => $vals['trade_discount'],
            'company_name' => $vals['company_name'],
            'address' => $vals['address'],
            'email' => $vals['email'],
            'phone' => $vals['phone'],
            'contact_person' => $vals['contact_person'],
            'op_city' => $vals['op_city'],
            'op_state' => $vals['op_state'],
            'op_country' => $vals['op_country'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Cliente';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Customers::newCustomer();
            $this->ajaxResponse([
               'response' => [
                  'type' => 'info',
                  'message' => 'Datos Guardados.',
               ]
            ]);
         } else {
            Customers::saveCustomer();
            $this->ajaxResponse([
               'response' => [
                  'type' => 'info',
                  'message' => 'Datos Actualizados.',
               ]
            ]);
         }
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function addresses()
   {
      $this->title = 'Direcciones';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCustomers&action=address&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Dirección',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center col-1'],
         ['label' => 'IMAGEN', 'class' => 'text-center col-1'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_entity', 'class' => 'text-right'],
         ['field' => 'username'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_entity', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCustomers&action=address'],
               ['id' => 'id_entity', 'icon' => 'fas fa-trash', 'href' => 'AdminCustomers&action=addressDel']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Customers::getCustomers())]);
   }
   public function requests()
   {
      $this->title = 'Reclamos';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'CLIENTE', 'class' => 'text-center col-3'],
         ['label' => 'DEPARTAMENTO', 'class' => 'text-center col-1'],
         ['label' => 'ASUNTO', 'class' => 'text-center col-3'],
         ['label' => 'PRIORIDAD', 'class' => 'text-center col-1'],
         ['label' => 'ESTADO', 'class' => 'text-center col-2'],
         ['label' => 'ÚLTIMA ACTUALIZACIÓN', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'id_complaint', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'op_department', 'class' => 'text-center'],
         ['field' => 'subject', 'class' => 'text-center'],
         ['field' => 'op_priority', 'class' => 'text-center', 'bg' => 'op_priority_color'],
         ['field' => 'op_status', 'class' => 'text-center', 'bg' => 'op_status_color'],
         ['field' => 'last_update', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_complaint', 'icon' => 'fas fa-eye', 'class' => 'ml-1 btn btn-xs btn-default', 'href' => 'AdminCustomers&action=view'],
            ]
         ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Complaints::getComplaints());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function view()
   {
      $this->render('customers/view', ['data' => Complaints::getComplaintInfo(), 'messages' => Complaints::getMessages()]);
   }
   public function send()
   {
      if ($this->isAjaxRequest()) {
         Complaints::response(true);
         $this->ajaxRedirect('AdminCustomers&action=view&id=' . Tools::getValue('id'));
      }
   }
   public function close()
   {
      if ($this->isAjaxRequest()) {
         Complaints::close();
         $this->ajaxRedirect('AdminCustomers&action=requests');
      }
   }
}
