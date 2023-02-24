<?php
class AdminWarehouseController extends Controller
{
   private $export, $import;
   public function __construct()
   {
      parent::__construct();
      $this->export = Tools::baseUrl() . '?controller=AdminBulkData&action=export&token=' . Tools::getValue('token');
      $this->import = Tools::baseUrl() . '?controller=AdminBulkData&action=import&token=' . Tools::getValue('token');
   }
   public function index()
   {
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminWarehouse&action=warehouse&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Almacen',
            'icon' => 'fas fa-plus-circle'
         ),
      );
      $this->title = 'Almacenes';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'EMPRESA', 'class' => 'text-center col-3'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-3'],
         ['label' => 'DIRECCIÓN', 'class' => 'text-center col-6'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'company', 'class' => 'text-center'],
         ['field' => 'warehouse'],
         ['field' => 'address_1'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_warehouse', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminWarehouse&action=warehouse'],
               ['id' => 'id_warehouse', 'icon' => 'fas fa-trash', 'class' => 'pr-1', 'actionJS' => 'removeAJAX'],
            ]
         ]
      ];
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('removeAJAX')) {
            Db::getInstance()->Execute("UPDATE `" . _DB_PREFIX_ . "warehouses` SET op_status='E' WHERE id_warehouse='" . Tools::getValue('id') . "'");
            Audit::trail('delete', 'Eliminó un almacen', 'fs_warehouses', Tools::getValue('id'));
            $this->redirect('?controller=AdminWarehouse&token=' . Tools::getValue('token'));
         }
      } else {
         $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Warehouses::getWarehouses())]);
      }
   }
   public function warehouse()
   {
      // $options = Warehouses::getWarehouseById(Tools::getValue('id'));
      $options = array();
      foreach (Companies::getCompanies() as $opt) {
         $arr = array();
         $arr['value'] = $opt['id_company'];
         $arr['label'] = $opt['name'];
         $options[] = $arr;
      }
      $form_fields = [
         'legend' => [
            'title' => 'Formulario de Gestion de Almacenes',
            'icon' => 'fas fa-gears'
         ],
         'input' =>
         [
            [
               'type' => 'select',
               'label' => 'EMPRESA',
               'name' => 'company',
               'options' => $options
            ],
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
            ],
            [
               'type' => 'textarea',
               'label' => 'DIRECCION',
               'name' => 'address',
            ],
            // [
            //    'type' => 'text',
            //    'label' => 'DIRECCION 2',
            //    'name' => 'address2',
            // ],
         ],
         'submit' => [
            'title' => 'Guardar'
         ]
      ];
      $helper = new HelperForm();

      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Almacen';
      } else {
         $this->title = 'Editar Almacen';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Audit::trail('create', 'Creó un nuevo almacen', 'fs_warehouses');
            Warehouses::new();
         } else {
            $id = Tools::getValue('id');
            Audit::trail('update', 'Editó un almacen', 'fs_warehouses', $id);
            Warehouses::save($id, Tools::getValue('company'), Tools::getValue('address'), Tools::getValue('address2'), Tools::getValue('name'));
         }
         $this->ajaxRedirect('AdminWarehouse');
      } else {
         $this->render(
            'warehouse/form',
            [
               'form' => $helper->generateForm($form_fields)
            ]
         );
      }
   }
   public function stock()
   {
      $this->title = 'Existencias';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminWarehouse&action=updateStock&token=' . Tools::getValue('token'),
            'type' => 'primary',
            'icon' => 'fas fa-dolly',
            'action' => 'Añadir Existencias',
         ),
         array(
            'url' => Tools::baseUrl() . '?controller=AdminWarehouse&action=requests&token=' . Tools::getValue('token'),
            'type' => 'default',
            'icon' => 'fas fa-file-alt',
            'action' => 'Solicitudes',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center col-1'],
         ['label' => 'ALMACEN', 'class' => 'text-center col-3'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-3'],
         ['label' => 'DESCRIPCION', 'class' => 'text-center col-3'],
         ['label' => 'EXISTENCIAS', 'class' => 'text-center col-1'],
         // ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'num_row', 'class' => 'text-center'],
         ['field' => 'warehouse', 'class' => 'text-center'],
         ['field' => 'product'],
         ['field' => 'desc',],
         ['field' => 'stock', 'class' => 'text-center'],
         // [
         //    'type' => 'link',
         //    'class' => 'text-center',
         //    'links' => [
         //       ['id' => 'id_stock', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=category'],
         //    ]
         // ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Warehouses::getStock())]);
   }
   public function updateStock()
   {
      $this->title = 'Actualizar Existencias';
      if (!Tools::getValue('id')) {
         $id = Warehouses::newRequest();
         $this->redirect('?controller=AdminWarehouse&action=updateStock&id=' .
            $id . '&token=' . Tools::getValue('token'));
      }
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('fetchStockRequestLines')) {
            Tools::ajaxResponse(Warehouses::getRequestDetails());
         }
         if (Tools::getValue('addNewStockRequestLine')) {
            Warehouses::addNewStockRequestLine();
         }
         if (Tools::getValue('removeStockRequestLine')) {
            Warehouses::removeStockRequestLine();
         }
         if (Tools::getValue('sendStockRequest')) {
            Warehouses::sendStockRequest();
            Tools::ajaxResponse([
               'response' => [
                  'type' => 'success',
                  'message' => 'Solicitud Realizada Exitosamente.',
                  'redirect' => Tools::ajaxRedirectTo('AdminWarehouse&action=stock')
               ]
            ]);
         }
      } else {
         $target = Tools::baseUrl() . '?controller=AdminWarehouse&action=updateStock&id=' . Tools::getValue('id') . '&token=' . Tools::getValue('token');
         $this->render('warehouse/stocks', ['products' => Catalog::getProducts(), 'warehouses' => Warehouses::getWarehouses(), 'target' => $target]);
      }
   }
   public function requestDetails()
   {
      # code...
   }
   public function requests()
   {
      $this->title = 'Solicitudes';
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'SOLICITANTE', 'class' => 'text-center col-4'],
         ['label' => 'APROBADO POR', 'class' => 'text-center col-4'],
         ['label' => 'FECHA', 'class' => 'text-center col-2'],
         ['label' => 'ESTADO', 'class' => 'text-center col-2'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'id_stock_request', 'class' => 'text-center'],
         ['field' => 'requestor', 'class' => 'text-center'],
         ['field' => 'approver'],
         ['field' => 'date',],
         ['field' => 'status', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_stock_request', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminWarehouse&action=view_request'],
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Warehouses::getRequests())]);
   }
   public function view_request()
   {
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('approve')) {
            Warehouses::approve_request();
            Tools::ajaxResponse([
               'response' => [
                  'type' => 'success',
                  'message' => 'Solicitud Aprobada Exitosamente.',
                  'redirect' => Tools::ajaxRedirectTo('AdminWarehouse&action=requests')
               ]
            ]);
         } elseif (Tools::getValue('decline')) {
            Warehouses::decline_request();
            Tools::ajaxResponse([
               'response' => [
                  'type' => 'success',
                  'message' => 'Solicitud Rechazada Exitosamente.',
                  'redirect' => Tools::ajaxRedirectTo('AdminWarehouse&action=requests')
               ]
            ]);
         }
      } else {
         $target = Tools::baseUrl() . '?controller=AdminWarehouse&action=view_request&id=' . Tools::getValue('id') . '&token=' . Tools::getValue('token');
         $this->render('warehouse/request', ['details' => Warehouses::getRequestDetails(), 'request' => Warehouses::getRequestById(), 'target' => $target]);
      }
   }
}
