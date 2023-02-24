<?php
class ComplaintsController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Reclamos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . 'complaints/new',
            'action' => 'Nuevo Reclamo',
            'icon' => 'fa fa-plus-circle',
         ),

      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'DEPARTAMENTO', 'class' => 'text-center col-2'],
         ['label' => 'ASUNTO', 'class' => 'text-center col-4'],
         ['label' => 'ESTADO', 'class' => 'text-center col-2'],
         ['label' => 'ÚLTIMA ACTUALIZACIÓN', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'op_department', 'class' => 'text-center'],
         ['field' => 'subject', 'class' => 'text-center'],
         ['field' => 'op_status', 'class' => 'text-center'],
         ['field' => 'last_update', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_complaint', 'icon' => 'fas fa-eye', 'class' => 'ml-1 btn btn-xs btn-default', 'href' => 'complaints/view'],
            ]
         ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Complaints::getComplaintsByCustomer());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function new()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formularia de Gestión de Reclamos',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'value' => 'CARLOS SANDREA',
               'col' => 4,
               'disabled' => true
            ],
            [
               'type' => 'text',
               'label' => 'DIRECCIÓN DE CORREO',
               'name' => 'email',
               'value' => 'CARLOS SANDREA',
               'col' => 4,
               'disabled' => true
            ],
            [
               'type' => 'select',
               'label' => 'DEPARTAMENTO',
               'name' => 'department',
               'options' => [
                  ['value' => 'SOPORTE TÉCNICO', 'label' => 'SOPORTE TÉCNICO'],
                  ['value' => 'COBRANZAS', 'label' => 'COBRANZAS']
               ],
               'required' => true,
               'col' => 5
            ],
            [
               'type' => 'select',
               'label' => 'PRIORIDAD',
               'name' => 'priority',
               'options' => [
                  ['value' => '1', 'label' => 'MEDIA'],
                  ['value' => '2', 'label' => 'ALTA'],
                  ['value' => '2', 'label' => 'BAJA'],
               ],
            ],
            [
               'type' => 'text',
               'label' => 'ASUNTO',
               'name' => 'subject',
               'required' => true,
               'col' => 5
            ],
            [
               'type' => 'textarea',
               'label' => 'MENSAJE',
               'name' => 'msg',
               'col' => 6,
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'NUMERO DE CONTACTO',
               'name' => 'contact',
               'col' => 3,
               'required' => true,
            ],
            [
               'type' => 'file',
               'label' => 'ADJUNTOS',
               'name' => 'img',
               'col' => 5,
               'save_path' => IMG_URI . 'cpp/' . Session::get('_uid') . '/',
               'ext' => ['.jpg', '.png', '.jpeg'],
            ],
         ],
         'submit' => [
            'title' => 'Generar Reclamo',
         ]
      ];
      $helper->submit_action = 'complaints/new';
      $this->title = 'Nuevo Reclamo';
      if ($this->isAjaxRequest()) {
         Payments::report();
         Tools::ajaxResponse([
            'response' => [
               'type' => 'success',
               'message' => 'Reclamo reportado exitosamente.',
               'redirect' => Tools::ajaxRedirectTo('complaints')
            ]
         ]);
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
         ]);
      }
   }
   public function view()
   {
      $this->render('complaints/view', ['data' => Complaints::getComplaintInfo(), 'messages' => Complaints::getMessages()]);
   }
   public function send()
   {
      if ($this->isAjaxRequest()) {
         Complaints::response();
         $this->ajaxRedirect('complaints/view&id=' . Tools::getValue('id'));
      }
   }
   public function report()
   {
      if ($this->isAjaxRequest()) {
         Complaints::report();
         $this->ajaxRedirect('complaints');
      }
   }
   public function close()
   {
      if ($this->isAjaxRequest()) {
         Complaints::close();
         $this->ajaxRedirect('complaints');
      }
   }
}
