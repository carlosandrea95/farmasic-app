<?php
class OrdersController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Pedidos';
      $dt = new DataGrid();
      $head = [
         ['label' => 'PEDIDO', 'class' => 'text-center'],
         ['label' => 'ENVIDO', 'class' => 'text-center'],
         ['label' => 'PROCESADO', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center'],
         ['label' => 'TIPO', 'class' => 'text-center'],
         ['label' => 'TOTAL', 'class' => 'text-center'],
         ['label' => 'FACTOR', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'order', 'class' => 'text-center'],
         ['field' => 'created_at', 'class' => 'text-center'],
         ['field' => 'updated_at', 'class' => 'text-center'],
         ['field' => 'status', 'class' => 'text-center', 'bg' => 'op_status_color'],
         ['field' => 'order_type', 'class' => 'text-center'],
         [
            'type' => 'two-lines',
            'class' => 'text-right',
            'one' => [
               'field' => 'amount',
               'format' => 'BS',
            ],
            'two' => [
               'field' => 'amount_usd',
               'class' => 'text-success',
               'format' => 'USD',
            ]
         ],
         ['field' => 'exchange_rate', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_order', 'icon' => 'fas fa-eye', 'class' => 'ml-1 btn btn-xs btn-default', 'href' => 'orders/preview'],
            ]
         ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Orders::getOrderByCustomers());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function preview()
   {
      // $items = [];
      // foreach (Orders::getItemsByOrderId() as $item) {
      //    $itemsRow = [];
      //    $itemsRow[]['num_row'] = $item['num_row'];
      //    $itemsRow[]['name'] = $item['name'];
      //    $itemsRow[]['code'] = $item['code'];
      //    $itemsRow[]['quantity'] = $item['quantity'];
      //    $itemsRow[]['price'] = $item['price'];
      //    $itemsRow[]['price_usd'] = $item['price_usd'];
      //    $itemsRow[]['tax_rate'] = $item['tax_rate'];
      //    $itemsRow[]['discount_percentage'] = $item['discount_percentage'];
      //    $itemsRow[]['net_price'] = ($item['amount'] - ($item['discount_percentage'] * $item['amount']));
      //    $itemsRow[]['amount'] = $item['amount'];
      //    $itemsRow[]['tax_rate'] = $item['tax_rate'];
      // }
      // $items[] = $itemsRow;
      // echo '<pre>';
      // print_r(Orders::getItemsByOrderId());
      // exit;
      $this->render('orders/preview', ['data' => Orders::getOrderById(), 'items' => Orders::getItemsByOrderId()]);
   }
   public function download()
   {
      # code...
   }
}
