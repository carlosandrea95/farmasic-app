<?php
class DocumentsController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Documentación';
      $disabled = '';
      if (Customers::bloqDocuments()) {
         $disabled = 'disabled';
      }
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . 'documents/upload' . Tools::getValue('token'),
            'action' => 'Agregar Documentación',
            'icon' => 'fa fa-plus-circle',
            'class' => $disabled
         ),

      );
      $dt = new DataGrid();
      $head = [
         ['label' => 'TIPO DE DOCUMENTO', 'class' => 'text-center'],
         ['label' => 'VENCIMIENTO', 'class' => 'text-center'],
         ['label' => 'ESTADO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'type'],
         ['field' => 'expire_date', 'class' => 'text-center'],
         ['field' => 'status', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_document', 'icon' => 'fas fa-edit', 'class' => 'pr-1', 'href' => 'documents/upload'],
               ['id' => 'id_document', 'icon' => 'fas fa-trash', 'href' => 'documents/del']
            ]
         ]
      ];
      $data = [
         [
            'type' => 'CÉDULA DE IDENTIDAD DEL REGENTE',
            'expire' => Customers::getDocumentStatus(1),
            'id_account' => 1
         ],
         [
            'type' => 'COPIA DEL PERMISO DE FUNCIONAMIENTO ACTUALIZADO',
            'expire' => Customers::getDocumentStatus(2),
            'id_account' => 1
         ],
         [
            'type' => 'CÉDULA DE IDENTIDAD DEL REGENTE',
            'expire' => Customers::getDocumentStatus(3),
            'id_account' => 1
         ]
      ];
      $dataGrid = $dt->generateGrid($head, $rows, Customers::getDocuments());
      $this->render('_partials/grid', ['grid' => $dataGrid]);
   }
   public function upload()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Documentación',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'select',
               'label' => 'TIPO DE DOCUMENTO',
               'name' => 'type',
               'options' => [
                  ['value' => '1', 'label' => 'CÉDULA DE IDENTIDAD DEL REGENTE'],
                  ['value' => '2', 'label' => 'COPIA DEL PERMISO DE FUNCIONAMIENTO ACTUALIZADO'],
                  ['value' => '3', 'label' => 'COPIA DEL TITULO COMO PROFESIONAL FARMACÉUTICO'],
               ],
               'required' => true,
            ],
            [
               'type' => 'date',
               'label' => 'VENCIMIENTO',
               'name' => 'expire_date',
               'required' => true,
            ],
            [
               'type' => 'file',
               'label' => 'IMAGEN DE SOPORTE',
               'name' => 'img',
               'col' => 5,
               'save_path' => IMG_URI . 'd/' . Session::get('_uid') . '/',
               'ext' => ['.jpg', '.png', '.jpeg'],
               'required' => true,
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'documents/upload';
      if (!Tools::getValue('id')) {
         $this->title = 'Añadir Documentación';
      } else {
         $vals = Customers::getDocumentsById(Tools::getValue('id'));
         $fields_value = [
            'type' => $vals['op_document_type'],
            'expire_date' => $vals['expire_date'],
            'img' => $vals['img_support'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Documentación';
      }
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('reloadIMG')) {
         } else {
            Customers::uploadDocuments();
         }
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
}
