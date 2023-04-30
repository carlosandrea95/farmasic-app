<?php
class AdminShoppingController extends Controller
{
   private $export, $import;
   public function __construct()
   {
      parent::__construct();
      $this->export = Tools::baseUrl() . '?controller=AdminBulkData&action=export&token=' . Tools::getValue('token');
      $this->import = Tools::baseUrl() . '?controller=AdminBulkData&action=import&token=' . Tools::getValue('token');
   }
   public function orders()
   {
      $this->title = 'Ordenes de Compra';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminShopping&action=newOrder&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Orden de Compra',
            'icon' => 'fa fa-circle-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NUMERO DE PEDIDO', 'class' => 'text-center'],
         ['label' => 'PROVEEDOR', 'class' => 'text-center'],
         ['label' => 'TOTAL', 'class' => 'text-center'],
         ['label' => 'FECHA', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'id_shopping_order', 'class' => 'text-center col-2'],
         ['field' => 'company_name', 'class' => 'col-4'],
         [
            'type' => 'two-lines',
            'class' => 'text-right col-2',
            'one' => ['field' => 'amount'],
            'two' => ['field' => 'amount_usd', 'class' => 'text-success'],
         ],
         ['field' => 'created_at', 'class' => 'text-center col-2'],
         [
            'type' => 'link',
            'class' => 'text-center col-2',
            'links' => [
               ['id' => 'id_shopping_order', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminShopping&action=newOrder&preview=true'],
               ['id' => 'id_shopping_order', 'icon' => 'fas fa-trash', 'class' => 'pr-1', 'actionJS' => 'removeAJAX'],
            ]
         ]
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Shopping::getOrders())]);
   }
   public function newOrder()
   {
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('preview')) {
            if (Tools::getValue('fetchShoppingDetails')) {
               Tools::ajaxResponse(Shopping::fetchShoppingDetails());
            }
            if (Tools::getValue('validOrder')) {
               Shopping::validOrder();
            }
            if (Tools::getValue('UpdateRate')) {
               Shopping::UpdateRate();
            }
            if (Tools::getValue('UpdateAmounts')) {
               Shopping::UpdateAmounts();
            }
            if (Tools::getValue('addNewShoppingOrderLine')) {
               Shopping::addNewShoppingOrderLine();
            }
            if (Tools::getValue('sendShoppingOrder')) {
               Shopping::updateShoppingOrder();
               $this->ajaxResponse(array(
                  'response' => array(
                     'type' => 'success',
                     'message' => 'La orden se ha generado exitosamente.',
                     'redirect' => $this->ajaxRedirectTo('AdminShopping&action=download')
                  )
               ));
            }
            if (Tools::getValue('removeShoppingOrderLine')) {
               Shopping::removeShoppingOrderLine();
            }
         }
      } else {
         if (!Tools::getValue('id')) {
            $id = Shopping::newOrder();
            $this->redirect('?controller=AdminShopping&action=newOrder&id=' .
               $id . '&token=' . Tools::getValue('token'));
         }
         $this->render('shopping/newOrder', ['date' => Shopping::getOrderDate(), 'details' => Shopping::fetchShoppingDetails(), 'data' => Shopping::getOrderById(), 'suppliers' => Shopping::getSuppliers(), 'products' => Catalog::getProducts(), 'warehouses' => Warehouses::getWarehouses()]);
      }
   }
   public function download()
   {
      $pdf = new PDF_Purchase_Orders();
      $pdf->preview();
   }
   public function suppliers()
   {
      $this->title = 'Proveedores';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminShoppin&action=supplier&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Proveedor',
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
               ['id' => 'id_entity', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminShopping&action=supplier'],
               ['id' => 'id_entity', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Shopping::getSuppliers())]);
   }
   public function supplier()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Proveedores',
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
               'label' => 'CORREO ELECTRONICO',
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
               'label' => 'PAIS',
               'name' => 'op_country',
               'options' => Tools::genOptions(Options::getAll(4)),
            ],
            [
               'type' => 'textarea',
               'label' => 'DIRECCIÓN',
               'name' => 'address',
               'col' => 6,
            ],
            // [
            //    'type' => 'text',
            //    'label' => 'DESCUENTO COMERCIAL',
            //    'name' => 'trade_discount',
            //    'class' => 'percentage',
            //    'col' => 1,
            // ],
            // [
            //    'type' => 'text',
            //    'label' => 'LIMITE DE CREDITO',
            //    'name' => 'credit_limit',
            //    'class' => 'money-usd',
            //    'col' => 2,
            // ],
            // [
            //    'type' => 'number',
            //    'label' => 'DÍAS DE CREDITO',
            //    'name' => 'credit_time',
            //    'col' => 1,
            // ],
            // [
            //    'type' => 'text',
            //    'label' => 'USUARIO',
            //    'name' => 'username',
            //    'col' => 3,
            // ],
            // [
            //    'type' => 'password',
            //    'label' => 'CONTRASEÑA',
            //    'name' => 'password',
            //    'col' => 3,
            // ],
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
         $this->title = 'Nuevo Proveedor';
      } else {
         $vals = Shopping::getSupplierById();
         $fields_value = [
            'dni' => $vals['dni'],
            'code' => $vals['code'],
            // 'username' => $vals['username'],
            'op_status' => $vals['op_status'],
            // 'credit_time' => $vals['credit_time'],
            // 'credit_limit' => $vals['credit_limit'],
            // 'trade_discount' => $vals['trade_discount'],
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
         $this->title = 'Editar Proveedor';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Shopping::newSupplier();
            $this->ajaxResponse([
               'response' => [
                  'type' => 'info',
                  'message' => 'Datos Guardados.',
               ]
            ]);
         } else {
            Shopping::saveSupplier();
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
   public function comparator()
   {
      $this->title = 'Comparador de Precios';
      $data = Db::getInstance()->ExecuteS('SELECT * FROM fs_comparator');
      // CSVExport::generate($data);
      $this->render('shopping/comparator', ['data' => $data]);
   }
}
