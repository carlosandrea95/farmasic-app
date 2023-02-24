<?php
class PayableController extends Controller
{
   public function __construct()
   {
      parent::__construct();
   }
   public function index()
   {
      $this->title = 'Cuentas por Pagar';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'DOCUMENTO', 'class' => 'text-center col-1'],
         ['label' => 'DETALLE', 'class' => 'text-center col-3'],
         ['label' => 'EMISION', 'class' => 'text-center col-2'],
         ['label' => 'SALDO', 'class' => 'text-center col-2'],
         ['label' => 'TASA', 'class' => 'text-center cl-1'],
         ['label' => 'DESCRIPCIÓN', 'class' => 'text-center col-3'],
         // ['label' => 'OPCIONES', 'class' => 'text-center'],
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
         // [
         //    'type' => 'link',
         //    'class' => 'text-center',
         //    'links' => [
         //       ['id' => 'id_cxc', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminAccounting&action=genCXC'],
         //    ]
         // ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Accounting::getCXCEntriesByCustomerId());
      $this->render('_partials/grid', ['grid' => $dataGrid,]);
   }
}
