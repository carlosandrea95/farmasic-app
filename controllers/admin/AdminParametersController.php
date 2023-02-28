<?php
class AdminParametersController extends Controller
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
   public function companies()
   {
      $this->title = 'Empresas';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminParameters&action=company&token=' . Tools::getValue('token'),
            'action' => 'Nueva Empresa',
            'icon' => 'fas fa-square-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-3'],
         ['label' => 'PROPIETARIO', 'class' => 'text-center'],
         ['label' => 'DESCRIPCIÓN', 'class' => 'text-center'],
         ['label' => 'INDUSTRIA', 'class' => 'text-center'],
         ['label' => 'CORREO ELECTRÓNICO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_company', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'owner',],
         ['field' => 'description',],
         ['field' => 'op_industry', 'class' => 'text-center'],
         ['field' => 'email_contact'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_company', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminParameters&action=company'],
               ['id' => 'id_company', 'icon' => 'fas fa-trash', 'href' => 'AdminParameters&action=companyDel']
            ]
         ]
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Parameters::getCompanies())]);
   }
   public function company()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Empresas',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'PROPIETARIO',
               'name' => 'coupon_code',
               'col' => 5,
               'required' => true,
            ],
            [
               'type' => 'textarea',
               'label' => 'DESCRIPCIÓN',
               'name' => 'description',
            ],
            [
               'type' => 'text',
               'label' => 'DIRECCIÓN',
               'name' => 'address',
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
               'type' => 'email',
               'label' => 'CORREO',
               'name' => 'email',
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'CÓDIGO ZIP',
               'name' => 'zip_code',
            ],
            [
               'type' => 'text',
               'label' => 'NÚMERO TELEFÓNICO',
               'name' => 'phone',
               'required' => true,
            ],
            [
               'type' => 'select',
               'label' => 'INDUSTRIA',
               'name' => 'op_industry',
               'options' => [
                  ['value' => 'A', 'label' => 'ACTIVO'],
                  ['value' => 'I', 'label' => 'INACTIVO'],
               ],
            ],
            [
               'type' => 'text',
               'label' => 'SITIO WEB',
               'name' => 'website'
            ]
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminParameters&action=company';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Empresa';
      } else {
         $vals = Parameters::getCompanyById();
         $fields_value = [
            'name' => $vals['name'],
            'website' => $vals['website'],
            'owner' => $vals['owner'],
            'description' => $vals['description'],
            'address' => $vals['address'],
            'zip_code' => $vals['zip_code'],
            'email' => $vals['email_contact'],
            'phone' => $vals['phone'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Empresa';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Catalog::newDiscount();
         } else {
            Catalog::saveDiscount();
         }
         $this->ajaxRedirect('AdminParameters&action=companies');
      } else {
         $this->render('catalog/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function Users()
   {
      $this->title = 'Usuarios';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminParameters&action=user&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Usuario',
            'icon' => 'fas fa-square-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-3'],
         ['label' => 'FECHA CREACIÓN', 'class' => 'text-center'],
         ['label' => 'ROL', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'date_creation', 'class' => 'text-center'],
         ['field' => 'role', 'class' => 'text-center'],
         ['field' => 'op_status', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_entity', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminParameters&action=user'],
               ['id' => 'id_entity', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('removeAJAX')) {
            Users::removeUser();
         }
      } else {
         $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Users::getUsers())]);
      }
   }
   public function User()
   {
      $helper = new HelperForm();
      $roles = [];
      foreach (Parameters::getRoles() as $role) {

         $line['value'] = $role['id_role'];
         $line['label'] = $role['name'];
         $roles[] = $line;
      }
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Usuarios',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'firstname',
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'APELLIDO',
               'name' => 'lastname',
               'required' => true
            ],
            [
               'type' => 'text',
               'label' => 'CORREO ELECTRÓNICO',
               'name' => 'email',
               'required' => true
            ],
            [
               'type' => 'select',
               'label' => 'ROL',
               'name' => 'role',
               'required' => true,
               'options' => $roles
            ],
            [
               'type' => 'text',
               'label' => 'USUARIO',
               'name' => 'username',
               'required' => true,
            ],
            [
               'type' => 'password',
               'label' => 'CONTRASEÑA',
               'name' => 'password',
               'passGenerator' => true,
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
               'type' => 'text',
               'label' => 'NÚMERO TELEFÓNICO',
               'name' => 'phone',
            ],
            [
               'type' => 'textarea',
               'label' => 'DIRECCIÓN',
               'name' => 'address',
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminParameters&action=user';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Usuario';
      } else {
         $vals = Users::getUserById();
         $fields_value = [
            'firstname' => $vals['firstname'],
            'lastname' => $vals['lastname'],
            'username' => $vals['username'],
            'op_city' => $vals['op_city'],
            'op_state' => $vals['op_state'],
            'op_country' => $vals['op_country'],
            'address' => $vals['address'],
            'role' => $vals['id_role'],
            'email' => $vals['email'],
            'phone' => $vals['phone'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Usuario';
      }
      if ($this->isAjaxRequest()) {
         Users::setUser();
      } else {
         $this->render('_partials/form', ['form' => $helper->generateForm($form_fields)]);
      }
   }
   public function roles()
   {
      $this->title = 'Roles';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminParameters&action=role&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Rol',
            'icon' => 'fas fa-square-plus',
         ),
         array(
            'url' => Tools::baseUrl() . '?controller=AdminParameters&action=permissions&token=' . Tools::getValue('token'),
            'action' => 'Permisos',
            'icon' => 'fas fa-user-lock',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-3'],
         ['label' => 'ACTIVO', 'class' => 'text-center'],
         ['label' => 'TIPO DE ROL', 'class' => 'text-center'],
         ['label' => 'DEFECTO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['type' => 'switchJS', 'field' => 'is_active', 'class' => 'text-center', 'id' => 'id_role', 'actionJS' => 'changeStatusWithAJAX', 'target' => ''],
         ['field' => 'role_type', 'class' => 'text-center'],
         ['field' => '_default', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               [
                  'id' => 'id_role', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminParameters&action=role',
                  'conditional' => ['operator' => '=', 'one' => 'is_default', 'two' => '1']
               ],
               [
                  'id' => 'id_role', 'icon' => 'fas fa-trash', 'class' => 'pr-1',
                  'actionJS' => 'removeAJAX',
                  'conditional' => ['operator' => '=', 'one' => 'is_default', 'two' => '1']
               ]
            ]
         ]
      ];

      if ($this->isAjaxRequest()) {
         if (Tools::getValue('changeStatusAJAX')) {
            Parameters::changeRoleStatus();
         }
         if (Tools::getValue('removeAJAX')) {
            Parameters::removeRole();
         }
      } else {
         $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Parameters::getRoles())]);
      }
   }
   public function role()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Roles',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'switch',
               'label' => 'ACTIVO',
               'name' => 'is_active',
               'required' => true
            ],
            [
               'type' => 'select',
               'label' => 'TIPO DE ROL',
               'name' => 'role',
               'required' => true,
               'options' => [
                  [
                     'value' => 'A',
                     'label' => 'ADMINISTRATIVO'
                  ],
                  //  [
                  //    'value' => 'C',
                  //    'label' => 'CLIENTE'
                  // ], [
                  //    'value' => 'P',
                  //    'label' => 'PROVEEDOR'
                  // ],
                  [
                     'value' => 'S',
                     'label' => 'SOPORTE TÉCNICO'
                  ],
               ]
            ]
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminParameters&action=role';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Rol';
      } else {
         $vals = Parameters::getRoleById();
         $fields_value = [
            'name' => $vals['name'],
            'is_active' => $vals['is_active'],
            'role' => $vals['role_type'],

         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Rol';
      }
      if ($this->isAjaxRequest()) {
         Parameters::generatePermissions();
         Parameters::generatePermissionsRoles();
         Parameters::setRole();
      } else {
         $this->render('_partials/form', ['form' => $helper->generateForm($form_fields)]);
      }
   }
   public function permissions()
   {
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('changePermissionAJAX')) {
            Parameters::SetPermissionRole();
         }
      } else {
         $this->render('parameters/permissions', ['roles' => Parameters::getRoles()]);
      }
   }
   public function notify()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Correos',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'email',
               'label' => 'CORREO ELECTRÓNICO PRINCIPAL',
               'name' => 'emailMain',
               'required' => true,
            ],
            [
               'type' => 'email',
               'label' => 'CORREO ELECTRÓNICO SECUNDARIO',
               'name' => 'emailSecond',
            ],
            [
               'type' => 'email',
               'label' => 'CORREO ELECTRÓNICO COBRANZAS',
               'name' => 'emailDebt',
            ],
            [
               'type' => 'email',
               'label' => 'CORREO ELECTRÓNICO SOPORTE',
               'name' => 'emailSupport',
            ],

            [
               'type' => 'switch',
               'label' => 'ENVIAR CORREO A LOS CLIENTES DESPUÉS DE REALIZAR UN PEDIDO',
               'name' => 'sendAfterPlaceOrder',
            ],
            [
               'type' => 'hidden',
               'label' => '',
               'name' => 'send',
               'value' => 1
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminParameters&action=notify';
      $this->title = 'Notificaciones Por Correo Electrónico';
      $fields_value = [
         'emailMain' => Configuration::get('emailMain'),
         'emailSecond' => Configuration::get('emailSecond'),
         'emailDebt' => Configuration::get('emailDebt'),
         'emailSupport' => Configuration::get('emailSupport'),
         'sendAfterPlaceOrder' => Configuration::get('sendAfterPlaceOrder'),

      ];
      $helper->field_vals = $fields_value;
      if ($this->isAjaxRequest() && Tools::getValue('send') == 1) {
         Configuration::set('emailMain', Tools::getValue('emailMain'));
         Configuration::set('emailSecond', Tools::getValue('emailSecond'));
         Configuration::set('emailDebt', Tools::getValue('emailDebt'));
         Configuration::set('emailSupport', Tools::getValue('emailSupport'));
         // Configuration::set('sendAfterPlaceOrder', Tools::getValue('sendAfterPlaceOrder'));
         // $this->ajaxRedirect('AdminParameters&action=notify');
         // print_r($_POST);
         Tools::ajaxResponse(['response' => ['type' => 'success', 'message' => 'Datos Guardados.',]]);
      } else {
         $this->render('_partials/form', ['form' => $helper->generateForm($form_fields)]);
      }
   }
   public function bcv()
   {

      $this->title = 'Histórico BCV';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center', 'class' => 'col-1'],
         ['label' => 'FECHA', 'class' => 'text-center col-2'],
         ['label' => 'TASA', 'class' => 'text-center'],
         // ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_exchange_rate', 'class' => 'text-center'],
         ['field' => 'inserted_at'],
         ['field' => 'rate_amount', 'class' => 'text-right'],
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, ExchangeRates::getRates())]);
   }
   public function define()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Configuraciones',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'ID CUENTA POR DEFECTO POR PAGAR',
               'name' => 'DEFAULT_ACCOUNTING_PAYABLE',
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'ID CUENTA POR DEFECTO POR COBRAR',
               'name' => 'DEFAULT_ACCOUNTING_RECEIVABLE',
               'required' => true,
            ],
            [
               'type' => 'hidden',
               'label' => '',
               'name' => 'send',
               'value' => 1
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminParameters&action=define';
      $this->title = 'Definición de Configuraciones';
      $fields_value = [
         'DEFAULT_ACCOUNTING_PAYABLE' => Configuration::get('DEFAULT_ACCOUNTING_PAYABLE'),
         'DEFAULT_ACCOUNTING_RECEIVABLE' => Configuration::get('DEFAULT_ACCOUNTING_RECEIVABLE'),
      ];
      $helper->field_vals = $fields_value;
      if ($this->isAjaxRequest() && Tools::getValue('send') == 1) {
         Configuration::set('DEFAULT_ACCOUNTING_PAYABLE', Tools::getValue('DEFAULT_ACCOUNTING_PAYABLE'));
         Configuration::set('DEFAULT_ACCOUNTING_RECEIVABLE', Tools::getValue('DEFAULT_ACCOUNTING_RECEIVABLE'));
         Tools::ajaxResponse(['response' => ['type' => 'success', 'message' => 'Datos Guardados.',]]);
      } else {
         $this->render('_partials/form', ['form' => $helper->generateForm($form_fields)]);
      }
   }
}
