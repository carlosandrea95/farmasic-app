<?php

class AdminBulkController extends Controller
{

   public function __construct()
   {
      $this->controller_type = 'admin';
      $this->layout = 'dashboard';
      parent::__construct();
   }
   public function import()
   {
      $this->title = 'Importar';
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('import_type') != -1) {
            CSVImport::Execute(
               Tools::getValue('import_type'),
               Tools::getValue('field_separator'),
               Tools::getValue('separator'),
               Tools::getValue('forceId')
            );
         } else {
            Tools::ajaxResponse(['response' => ['type' => 'error', 'message' => 'Error al procesar la solicitud.']]);
         }
      } else {
         $this->render('dev/import');
      }
   }
   public function importing()
   {
      exit;
   }
}
