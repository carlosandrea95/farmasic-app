<?php
class AdminAccountingController extends Controller
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
   public function accounts()
   {
      $this->title = 'Cuentas Contables';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminAccounting&action=account&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Cuenta Contable',
            'icon' => 'fa fa-circle-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'CÓDIGO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_accounting_account', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'code', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_accounting_account', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminAccounting&action=account'],
               ['id' => 'id_accounting_account', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      if (Tools::isAjaxRequest()) {
         if (Tools::getValue('removeAJAX')) {
            Accounting::removeAccount();
            $this->redirect('?controller=AdminAccounting&action=accounts&token=' . Tools::getValue('token'));
         }
      } else {
         $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getAccounts())]);
      }
   }
   public function account()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Cuentas Contables',
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
               'label' => 'CÓDIGO',
               'name' => 'code',
               'class' => 'text-uppercase',
               'col' => 5,
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminAccounting&action=account';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Cuenta Contable';
      } else {
         $vals = Accounting::getAccountById();
         $fields_value = [
            'name' => $vals['name'],
            'code' => $vals['code'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Cuenta Contable';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Accounting::newAccount();
         } else {
            Accounting::updateAccount();
         }
         $this->ajaxRedirect('AdminAccounting&action=accounts');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function types()
   {
      $this->title = 'Tipos de Asientos Contables';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminAccounting&action=type&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Cuenta Contable',
            'icon' => 'fa fa-circle-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'CÓDIGO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_accounting_entry_type', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'code', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_accounting_entry_type', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminAccounting&action=type'],
               ['id' => 'id_accounting_entry_type', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      if (Tools::isAjaxRequest()) {
         if (Tools::getValue('removeAJAX')) {
            Accounting::removeAccount();
            $this->redirect('?controller=AdminAccounting&action=types&token=' . Tools::getValue('token'));
         }
      } else {
         $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getTypes())]);
      }
   }
   public function type()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Cuentas Contables',
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
               'label' => 'CÓDIGO',
               'name' => 'code',
               'class' => 'text-uppercase',
               'col' => 5,
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminAccounting&action=type';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Tipo de Asiento Contable';
      } else {
         $vals = Accounting::getTypeById();
         $fields_value = [
            'name' => $vals['name'],
            'code' => $vals['code'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Tipo de Asiento Contable';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Accounting::newType();
         } else {
            Accounting::updateType();
         }
         $this->ajaxRedirect('AdminAccounting&action=types');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function entries()
   {
      $this->title = 'Asientos Contables';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminAccounting&action=entry&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Asiento Contable',
            'icon' => 'fa fa-circle-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'FECHA', 'class' => 'text-center'],
         ['label' => 'TIPO DE ASIENTO', 'class' => 'text-center'],
         ['label' => 'NUMERO DE ASIENTO', 'class' => 'text-center'],
         ['label' => 'TERCERO', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-2'],
      ];
      $rows = [
         ['field' => 'id', 'class' => 'text-center'],
         ['field' => 'created_at', 'class' => 'text-center col-2'],
         ['field' => 'type', 'class' => 'text-center col-2'],
         ['field' => 'corelative', 'class' => 'text-center col-2'],
         ['field' => 'entity', 'class' => 'col-4'],
         ['field' => 'status', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center col-2',
            'links' => [
               ['id' => 'id', 'icon' => 'fas fa-eye', 'href' => 'AdminAccounting&action=entry&preview=true'],
               [
                  'id' => 'id', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminAccounting&action=entry',
                  'conditional' => ['operator' => '=', 'one' => 'op_status', 'two' => 'F']
               ],
               ['id' => 'id', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      if (Tools::getValue('removeAJAX')) {
         Accounting::removeAccountingEntry();
         $this->redirect('?controller=AdminAccounting&action=entries&token=' . Tools::getValue('token'));
      } else {
         $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getJournalEntries())]);
      }
   }
   public function entry()
   {
      if (!Tools::getValue('id')) {
         $id = Accounting::newAccountingEntry();
         $this->redirect('?controller=AdminAccounting&action=entry&id=' .
            $id . '&token=' . Tools::getValue('token'));
      }
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('frozeType')) {
            Tools::ajaxResponse(Accounting::frozeType());
         }
         if (Tools::getValue('frozeEntity')) {
            Accounting::frozeEntity();
         }
         if (Tools::getValue('fetchEntryDetails')) {
            $rtn['lines'] = Accounting::getJournalEntryDetails();
            $rtn['amounts'] = Accounting::getTotals();
            Tools::ajaxResponse($rtn);
         }
         if (Tools::getValue('addNewEntryDetail')) {
            Accounting::addNewEntryDetail();
         }
         if (Tools::getValue('removeEntryLine')) {
            Accounting::removeEntryLine();
         }
         if (Tools::getValue('saveAccountingEntry')) {
            Accounting::saveAccountingEntry();
         }
         if (Tools::getValue('')) {
         }
      } else {
         $this->render('accounting/entries', ['data' => Accounting::getJournalEntryById(), 'types' => Accounting::getEntryTypes(), 'accounts' => Accounting::getAccounts(), 'entities' => Accounting::getEntities(), 'lines' => Accounting::getJournalEntryDetails(), 'totals' => Accounting::getTotals(), 'preview' => Tools::getValue('preview')]);
      }
   }
   public function cxc()
   {
      $this->title = 'Cuentas Por Cobrar';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'DOCUMENTO', 'class' => 'text-center col-1'],
         ['label' => 'DETALLE', 'class' => 'text-center col-3'],
         ['label' => 'EMISIÓN', 'class' => 'text-center col-2'],
         ['label' => 'SALDO', 'class' => 'text-center col-2'],
         ['label' => 'TASA', 'class' => 'text-center cl-1'],
         ['label' => 'DESCRIPCIÓN', 'class' => 'text-center col-3'],
      ];
      $rows = [
         ['field' => 'id_cxc', 'class' => 'text-center'],
         ['field' => 'code', 'class' => 'text-center'],
         [
            'type' => 'custom',
            'class' => 'text-center',
            'field' => 'FACTURA DE VENTA No. [@code]',
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
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getCXCEntries())]);
   }
   public function cxp()
   {
      $this->title = 'Cuentas Por Pagar';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'DOCUMENTO', 'class' => 'text-center col-1'],
         ['label' => 'DETALLE', 'class' => 'text-center col-3'],
         ['label' => 'EMISIÓN', 'class' => 'text-center col-2'],
         ['label' => 'SALDO', 'class' => 'text-center col-2'],
         ['label' => 'TASA', 'class' => 'text-center cl-1'],
         ['label' => 'DESCRIPCIÓN', 'class' => 'text-center col-3'],
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
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getCXPEntries())]);
   }
}
   // public function voucherTypes()
   // {
   //    $this->title = 'Tipos de Asientos Contables';
   //    $this->calls = array(
   //       array(
   //          'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=product&token=' . Tools::getValue('token'),
   //          'action' => 'Nuevo Tipo de Asiento',
   //          'icon' => 'fa fa-circle-plus',
   //       ),
   //       array(
   //          'url' => $this->import,
   //          'type' => 'default',
   //          'icon' => 'fas fa-file-import',
   //          'action' => 'Importar',
   //       ),
   //       array(
   //          'url' => $this->export,
   //          'type' => 'default',
   //          'icon' => 'fas fa-file-export',
   //          'action' => 'Exportar',
   //       ),
   //    );
   //    $dt = new DataGrid();
   //    $head = [
   //       ['label' => '#', 'class' => 'text-center'],
   //       ['label' => 'NOMBRE', 'class' => 'text-center'],
   //       ['label' => 'CODIGO', 'class' => 'text-center'],
   //       ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
   //    ];
   //    $rows = [
   //       ['field' => 'id_account', 'class' => 'text-center'],
   //       ['field' => 'name'],
   //       ['field' => 'code', 'class' => 'text-center'],
   //       [
   //          'type' => 'link',
   //          'class' => 'text-center',
   //          'links' => [
   //             ['id' => 'id_account', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=category'],
   //             ['id' => 'id_account', 'icon' => 'fas fa-trash', 'href' => 'AdminCatalog&action=categoryDel']
   //          ]
   //       ]
   //    ];
   //    $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Accounting::getAccounts())]);
   // }
   // public function vouchersAlss()
   // {
   //    $this->title = 'Asientos contables';
   //    $this->calls = array(
   //       array(
   //          'url' => Tools::baseUrl() . '?controller=AdminAccounting&action=voucher&token=' . Tools::getValue('token'),
   //          'action' => 'Nuevo Asiento',
   //          'icon' => 'fa fa-circle-plus',
   //       ),
   //    );
   //    $this->render('accounting/vouchers', ['vouchers' => Vouchers::getVouchers()]);
   // }
   // public function voucher()
   // {
   //    $nuevo = false;
   //    if (!Tools::getValue('id')) {
   //       $nuevo = true;
   //       $this->title = 'Nuevo Asiento';
   //       $id = Vouchers::new();
   //       Audit::trail('create', 'Creó un nuevo asiento', 'fs_accounting_vouchers', $id);
   //       $data = $_POST;
   //    } else {
   //       $this->title = 'Editar Asiento';
   //       $id = Tools::getValue('id');
   //       Audit::trail('update', 'Editó un asiento', 'fs_accounting_vouchers', $id);
   //       $data = Vouchers::getById($id);
   //    }
   //    if ($this->isAjaxRequest()) {
   //       if ($this->methodPost('save_voucher')) {
   //          $res = Vouchers::saveVoucher(
   //             $id,
   //             $this->methodPost('serie'),
   //             $this->methodPost('date'),
   //             $this->methodPost('observations'),
   //             0
   //          );
   //          $this->ajaxRedirect('AdminAccounting&action=vouchers');
   //       } elseif ($this->methodPost('add_line')) {
   //          $res = Vouchers::newLine(
   //             $id,
   //             $this->methodPost('account'),
   //             $this->methodPost('debit'),
   //             $this->methodPost('credit'),
   //             $this->methodPost('desc')
   //          );
   //          if (!$res) {
   //             $this->ajaxResponse(array(
   //                'response' => array(
   //                   'type' => 'error',
   //                   'message' => 'No se pudo agregar la línea.'
   //                )
   //             ));
   //          } else {
   //             $this->ajaxResponse(array(
   //                'response' => array(
   //                   'type' => 'success',
   //                   'message' => 'Línea agregada.'
   //                )
   //             ));
   //          }
   //       } else {
   //          $response['lines'] = Vouchers::getLines($id);
   //          $response['totals'] = Vouchers::getTotals($id);
   //          $this->ajaxResponse($response);
   //       }
   //    } else {
   //       $this->render('accounting/entries', array(
   //          'form' => '',
   //          'id' => $id,
   //          'data' => $data,
   //          'accounts' => Vouchers::getAccounts(),
   //          'types' => Vouchers::getVoucherTypes(),
   //       ));
   //    }
   // }