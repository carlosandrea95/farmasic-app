<?php
class AdminSupportController extends Controller
{
   public function __construct()
   {
      $this->controller_type = 'admin';
      $this->layout = 'dashboard';
      parent::__construct();
   }
   public function index()
   {
      $this->title = 'Tickets de Soporte';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'FECHA', 'class' => 'text-center col-2'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-2'],
         ['label' => 'REMITENTE', 'class' => 'text-center'],
         ['label' => 'ASUNTO', 'class' => 'text-center col-3'],
         ['label' => 'MENSAJE', 'class' => 'text-center col-4'],
         // ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'created_at', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'sender', 'class' => 'text-center'],
         ['field' => 'subject', 'class' => 'text-left'],
         ['field' => 'message', 'class' => 'text-left'],
         // [
         //    'type' => 'link',
         //    'class' => 'text-center',
         //    'links' => [
         //       ['id' => 'id_role', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminParameters&action=role'],
         //       ['id' => 'id_role', 'icon' => 'fas fa-trash', 'href' => 'AdminParameters&action=roleDel']
         //    ]
         // ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Support::getTickets())]);
   }
}
