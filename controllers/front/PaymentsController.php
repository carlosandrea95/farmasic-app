<?php
class PaymentsController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Pagos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . 'payments/report',
            'action' => 'Reportar Pago',
            'icon' => 'fa fa-plus-circle',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'METODO', 'class' => 'text-center'],
         ['label' => 'ENVIADO', 'class' => 'text-center'],
         ['label' => 'PROCESADO', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center'],
         ['label' => 'TOTAL', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'id_payment', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'created_at', 'class' => 'text-center'],
         ['field' => 'updated_at', 'class' => 'text-center'],
         ['field' => 'op_status', 'class' => 'text-center', 'bg' => 'op_status_color'],
         [
            'type' => 'two-lines',
            'class' => 'text-right col-1',
            'one' => ['field' => 'amount'],
            'two' => ['field' => 'amount_usd', 'class' => 'text-success'],
         ],
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Payments::getPaymentsByCustomer());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function report()
   {
      $orders = [];
      foreach (Orders::getOrdersOpenByCustomers() as $order) {
         $line['value'] = $order['id_order'];
         $line['label'] = 'PEDIDO #' . $order['id_order'] . ' - ' . Tools::moneyFormat($order['amount'], 'BS', true, true) . ' ' . Tools::moneyFormat($order['amount_usd'], 'USD', true, true);
         $orders[] = $line;
      }
      $banks = [];
      foreach (Payments::getBanks() as $bank) {
         $line['value'] = $bank['id_bank'];
         $append = '';
         if (!empty($bank['num_account'])) {
            $append = ' (' . substr($bank['num_account'], -4) . ')';
         }
         $line['label'] = $bank['name'] . $append;
         $banks[] = $line;
      }
      $methods = [];
      foreach (Payments::getMethods() as $data) {
         $line['value'] = $data['id_payment_menthod'];
         $line['label'] = $data['name'];
         $methods[] = $line;
      }
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Reporte de Pagos',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'select',
               'label' => 'PEDIDO',
               'name' => 'order',
               'options' => $orders,
               'required' => true,
               'col' => 5
            ],
            [
               'type' => 'select',
               'label' => 'MONEDA',
               'name' => 'currency',
               'options' => [
                  ['value' => '1', 'label' => 'BOLIVARES'],
                  ['value' => '2', 'label' => 'DOLARES'],
               ],
               'required' => true,
            ],
            [
               'type' => 'select',
               'label' => 'METODO DE PAGO',
               'name' => 'method',
               'options' => $methods,
               'required' => true,
            ],
            [
               'type' => 'select',
               'label' => 'BANCO',
               'name' => 'bank',
               'options' => $banks,
               'required' => true,
            ],
            [
               'type' => 'date',
               'label' => 'FECHA DE PAGO',
               'name' => 'date',
               'required' => true,
               'col' => 2
            ],
            [
               'type' => 'text',
               'label' => 'REFERENCIA',
               'name' => 'ref',
               'col' => 3,
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'MONTO',
               'name' => 'amount',
               'col' => 3,
               'required' => true,
            ],
            [
               'type' => 'file',
               'label' => 'COMPROBANTE DE PAGO',
               'name' => 'img',
               'col' => 5,
               'save_path' => IMG_URI . 'cp/' . Session::get('_uid') . '/',
               'ext' => ['.jpg', '.png', '.jpeg'],
            ],
            [
               'type' => 'file',
               'label' => 'FORMATO COMPRA-VENTA PSICOTRÓPICOS',
               'name' => 'img_psicotropicos',
               'col' => 5,
               'save_path' => IMG_URI . 'cp/' . Session::get('_uid') . '/',
               'ext' => ['.jpg', '.png', '.jpeg'],
            ],
            [
               'type' => 'textarea',
               'label' => 'OBSERVACIONES',
               'name' => 'obs',
               'col' => 5,
            ],
         ],
         'submit' => [
            'title' => 'Reportar Pago',
         ]
      ];
      $helper->submit_action = 'payments/report';
      $this->title = 'Reportar Pago';
      if ($this->isAjaxRequest()) {
         Payments::reportPayment();
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
         ]);
      }
   }
}
