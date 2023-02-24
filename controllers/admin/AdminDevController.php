<?php
class AdminDevController extends Controller
{
   public function __construct()
   {
      parent::__construct();
   }
   public function options()
   {
      $this->title = 'Tipos de Opciones';
      $options = Db::getInstance()->ExecuteS('SELECT id_option_group as id, name FROM `' . _DB_PREFIX_ . 'option_groups`');
      $this->render('dev/options', ['options' => $options]);
   }
   public function edit_options()
   {
      $this->title = 'Editar Opciones';
      $id = (int) Tools::getValue('id');
      $option = Db::getInstance()->ExecuteS('SELECT id_option as id, name FROM `' . _DB_PREFIX_ . 'options` WHERE id_option_group = ' . $id);
      $this->render('dev/option', ['options' => $option]);
   }
   public function permissions()
   {

      $this->title = 'Permisos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminDev&action=permission&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Permiso',
            'icon' => 'fas fa-square-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center col-1'],
         ['label' => 'TIPO', 'class' => 'text-center col-1'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'PERMISO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_permission', 'class' => 'text-center'],
         ['field' => 'type', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         ['field' => 'code', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_permission', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminDev&action=permission'],
               ['id' => 'id_permission', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Dev::getPermissions())]);
   }
   public function permission()
   {
      # code...
   }
   public function menus()
   {
      $this->title = 'Menu';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminDev&action=menu&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Elemento de Menu',
            'icon' => 'fas fa-square-plus',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'TIPO', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center col-2'],
         ['label' => 'ICONO', 'class' => 'text-center'],
         ['label' => 'PERMISO', 'class' => 'text-center'],
         ['label' => 'PADRE', 'class' => 'text-center'],
         ['label' => 'ORDEN', 'class' => 'text-center'],
         ['label' => 'ESTATUS', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_menu_item', 'class' => 'text-center'],
         ['field' => 'type', 'class' => 'text-center'],
         ['field' => 'name', 'class' => 'text-center'],
         [
            'type' => 'custom',
            'field' => '<span class="fas fa-[@icon]"></span>',
            'keys' => ['icon'],
            'class' => 'text-center'
         ],
         ['field' => 'permission_name', 'class' => 'text-center'],
         ['field' => 'parent', 'class' => 'text-center'],
         ['field' => 'num_order', 'class' => 'text-center'],
         ['field' => 'is_active', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_menu_item', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminDev&action=menu'],
               ['id' => 'id_menu_item', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Dev::getMenuItems())]);
   }
   public function menu()
   {
      # code...
   }
}
