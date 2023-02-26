<?php
class AdminOrdersController extends Controller
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
   public function orders()
   {
      $this->title = 'Pedidos';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NUMERO DE PEDIDO', 'class' => 'text-center'],
         ['label' => 'CLIENTE', 'class' => 'text-center'],
         ['label' => 'TOTAL', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center'],
         ['label' => 'FECHA', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'order', 'class' => 'text-center col-2'],
         ['field' => 'name', 'class' => 'col-3'],
         [
            'type' => 'two-lines',
            'class' => 'text-right col-1',
            'one' => ['field' => 'amount'],
            'two' => ['field' => 'amount_usd', 'class' => 'text-success'],
         ],
         ['field' => 'status', 'class' => 'text-center col-2', 'bg' => 'op_status_color'],
         ['field' => 'created_at', 'class' => 'text-center col-2'],
         [
            'type' => 'link',
            'class' => 'text-center col-2',
            'links' => [
               ['id' => 'id_order', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminOrders&action=order'],
               ['id' => 'id_order', 'icon' => 'fas fa-print', 'class' => 'pr-1', 'href' => 'AdminOrders&action=print'],
               ['id' => 'id_order', 'icon' => 'fas fa-sticky-note', 'class' => 'pr-1', 'href' => 'AdminOrders&action=printNote'],
               ['id' => 'id_order', 'icon' => 'fas fa-truck', 'class' => 'pr-1', 'href' => 'AdminOrders&action=printDelivery'],
            ]
         ]
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Orders::getOrders())]);
   }
   public function Order()
   {
      $data = Orders::getOrderById();
      switch ($data['op_status']) {
         case "A":
            $status = 'EN ESPERA DEL PAGO';
            $statusColor = 'default bg-indigo';
            break;
         case "C":
            $status = 'COMPLETADO';
            $statusColor = 'btn-success';
            break;
         case "X":
            $status = 'CANCELADO';
            $statusColor = 'default bg-navy';
            break;
         case "R":
            $status = 'PAGO RECHAZADO';
            $statusColor = 'btn-danger';
            break;
      }
      $client = Orders::getClientByOrderId($data['id_customer']);
      $payments = Orders::getPaymentsByOrderId();
      $items = Orders::getItemsByOrderId();
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('processOrder')) {
            Orders::processOrder();
         }
         if (Tools::getValue('printInvoice')) {
            Orders::genInvoice();
            $this->ajaxRedirect('AdminOrders&action=printInvoice&id=' . Tools::getValue('id'));
         }
      } else {
         $this->render('orders/order', ['data' => $data, 'status' => $status, 'validToPrint' => Orders::validPaymentsInOrder(), 'statusColor' => $statusColor, 'client' => $client, 'methods' => Payments::getMethods(true), 'totals' => Payments::getTotalPaymentPerOrder(), 'payments' => !empty($payments) ? $payments : [], 'products' => Catalog::getProducts(), 'items' => $items]);
      }
   }
   public function printInvoice()
   {
      $pdf = new PDF_Invoices();
      $pdf->print();
   }
   public function payments()
   {
      $this->title = 'Pagos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminOrders&action=report&token=' . Tools::getValue('token'),
            'action' => 'Reportar Pago',
            'icon' => 'fa fa-plus-circle',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'MÉTODO', 'class' => 'text-center'],
         ['label' => 'BANCO/CUENTA', 'class' => 'text-center'],
         ['label' => 'ENVIADO', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center'],
         ['label' => 'TOTAL', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center']
      ];
      $rows = [
         ['field' => 'id_payment', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'bank', 'class' => 'text-center'],
         ['field' => 'created_at', 'class' => 'text-center'],
         ['field' => 'op_status', 'class' => 'text-center', 'bg' => 'op_status_color'],
         ['field' => 'amount', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_payment', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminOrders&action=payment'],
               // ['id' => 'id_payment', 'icon' => 'fas fa-trash', 'class' => 'pr-1', 'actionJS' => 'removeAJAX'],
            ]
         ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Payments::getPayments());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function payment()
   {
      $this->render('orders/payment', ['paymentData' => Payments::getPaymentsById()]);
   }
   public function approve_payment()
   {
      Orders::repayCXC();
      Orders::setPaymentStatus('A');
      $this->redirect('?controller=AdminOrders&action=payments&token=' . Tools::getValue('token'));
   }
   public function decline_payment()
   {
      Orders::setPaymentStatus('R');
      $this->redirect('?controller=AdminOrders&action=payments&token=' . Tools::getValue('token'));
   }
   public function report()
   {
      $orders = [];
      foreach (Orders::getOrdersOpenByCustomers() as $order) {
         $line['value'] = $order['id_order'];
         $line['label'] = 'PEDIDO #' . $order['id_order'];
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
      foreach (Payments::getMethods(true) as $data) {
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
                  ['value' => '2', 'label' => 'DÓLARES'],
               ],
               'required' => true,
            ],
            [
               'type' => 'select',
               'label' => 'MÉTODO DE PAGO',
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
      $helper->submit_action = 'AdminOrders&action=report';
      $this->title = 'Reportar Pago';
      if ($this->isAjaxRequest()) {
         Payments::report();
         Tools::ajaxResponse([
            'response' => [
               'type' => 'success',
               'message' => 'Pago reportado exitosamente.',
               'redirect' => Tools::ajaxRedirectTo('payments')
            ]
         ]);
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
         ]);
      }
   }
   public function invoices()
   {
      $this->title = 'Facturas';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'TIPO', 'class' => 'text-center col-3'],
         ['label' => 'CÓDIGO', 'class' => 'text-center col-1'],
         ['label' => 'CLIENTE', 'class' => 'text-center col-3'],
         ['label' => 'TOTAL', 'class' => 'text-center'],
         ['label' => 'FECHA', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'invoice_type', 'class' => 'text-center col-3'],
         ['field' => 'corelative', 'class' => 'text-center col-1'],
         ['field' => 'name', 'class' => 'col-4'],
         [
            'type' => 'two-lines',
            'class' => 'text-right col-2',
            'one' => ['field' => 'amount'],
            'two' => ['field' => 'amount_usd', 'class' => 'text-success'],
         ],
         ['field' => 'created_at', 'class' => 'text-center col-2'],
         [
            'type' => 'link',
            'class' => 'text-center col-1',
            'links' => [
               ['id' => 'id_order', 'icon' => 'fas fa-print', 'class' => 'pr-1', 'href' => 'AdminOrders&action=printInvoice'],
            ]
         ]
      ];
      $this->render('catalog/grid', ['grid' => $dt->generateGrid($head, $rows, Orders::getInvoices())]);
   }
}
