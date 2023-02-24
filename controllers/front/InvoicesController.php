<?php
class InvoicesController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Facturas';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'CÓDIGO', 'class' => 'text-center col-2'],
         ['label' => 'FECHA PROCESADO', 'class' => 'text-center col-3'],
         ['label' => 'TIPO', 'class' => 'text-center col-2'],
         ['label' => 'MONTO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-2'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'corelative', 'class' => 'text-center'],
         ['field' => 'created_at', 'class' => 'text-center'],
         ['field' => 'invoice_type', 'class' => 'text-center'],
         ['field' => 'amount', 'class' => 'text-center money-bs'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_order', 'icon' => 'fas fa-print', 'class' => 'pr-1', 'href' => 'invoices/print'],
            ]
         ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Orders::getInvoicesByCustomer());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function print()
   {

      $pdf = new PDF_Invoices();
      $pdf->OrderId = Tools::getValue('id');
      $pdf->print();
   }
}
