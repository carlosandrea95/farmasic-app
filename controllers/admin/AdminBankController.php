<?php
class AdminBankController extends Controller
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
   public function banks()
   {
      $this->title = 'Entidades Bancarias';
      $this->calls = [
         [
            'url' => Tools::baseUrl() . '?controller=AdminBank&action=bank&token=' . Tools::getValue('token'),
            'action' => 'Nueva Entidad Bancaria',
            'icon' => 'fa fa-circle-plus',
         ]
      ];
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'BANCO', 'class' => 'text-center col-4'],
         ['label' => 'NUMERO DE CUENTA', 'class' => 'text-center col-4'],
         ['label' => 'MONEDA', 'class' => 'text-center col-2'],
         ['label' => 'ESTADO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'num_account', 'class' => 'text-center'],
         ['field' => 'currency', 'class' => 'text-center'],
         ['field' => 'status', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_bank', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminBank&action=bank'],
               ['id' => 'id_bank', 'icon' => 'fas fa-trash', 'class' => 'pr-1', 'actionJS' => 'removeAJAX'],
            ]
         ]
      ];
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('removeAJAX')) {
            Banks::removeBank();
         }
      } else {
         $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Banks::getBanks())]);
      }
   }
   public function bank()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Entidades Bancarias',
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
               'label' => 'NUMERO DE CUENTA',
               'name' => 'num_account',
               'col' => 6,
               'required' => true,
            ],
            [
               'type' => 'select',
               'label' => 'MONEDA',
               'name' => 'op_currency',
               'options' => [
                  ['value' => 'B', 'label' => 'BOLIVARES'],
                  ['value' => 'D', 'label' => 'DÓLARES'],
               ],
            ],
            [
               'type' => 'select',
               'label' => 'ESTADO',
               'name' => 'op_status',
               'options' => [
                  ['value' => 'A', 'label' => 'ACTIVO'],
                  ['value' => 'I', 'label' => 'INACTIVO'],
               ],
            ]
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminBank&action=bank';
      if (!Tools::getValue('id')) {
         $this->title = 'Nueva Entidad Bancaria';
      } else {
         $vals = Banks::getBankById();
         $fields_value = [
            'name' => $vals['name'],
            'num_account' => $vals['num_account'],
            'op_status' => $vals['op_status'],
            'op_currency' => $vals['op_currency'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Entidad Bancaria';
      }
      if ($this->isAjaxRequest()) {
         Banks::saveBank();
         $this->ajaxRedirect('AdminBank&action=Banks');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
         ]);
      }
   }
   public function accounts()
   {
      $this->title = 'Cuentas Bancarias';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'DOCUMENTO', 'class' => 'text-center col-1'],
         ['label' => 'DETALLE', 'class' => 'text-center col-3'],
         ['label' => 'EMISIÓN', 'class' => 'text-center col-2'],
         ['label' => 'SALDO', 'class' => 'text-center col-2'],
         ['label' => 'TASA', 'class' => 'text-center cl-1'],
         ['label' => 'DESCRIPCIÓN', 'class' => 'text-center col-3'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'code', 'class' => 'text-center'],
         [
            'type' => 'custom',
            'class' => 'text-center',
            'field' => 'ORDEN DE COMPRA No. [@code]',
            'keys' => ['code']
         ],
         ['field' => 'created_at', 'class' => 'text-center'],
         [
            'type' => 'custom',
            'class' => 'text-right',
            'field' => '[@balance]<br><span class="text-success">[@balance_usd]</span>',
            'keys' => ['balance', 'balance_usd']
         ],
         ['field' => 'exchange_rate', 'class' => 'text-center'],
         ['field' => 'entity', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_cxp', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminAccounting&action=type'],
            ]
         ]
      ];
      if ($this->isAjaxRequest()) {
      } else {
         $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getCXPEntries())]);
      }
   }
}
