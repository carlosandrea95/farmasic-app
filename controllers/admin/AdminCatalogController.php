<?php
class AdminCatalogController extends Controller
{
   private $model;
   private $export, $import;
   public function __construct()
   {
      $this->controller_type = 'admin';
      $this->layout = 'dashboard';
      parent::__construct();
      $this->export = Tools::baseUrl() . '?controller=AdminBulkData&action=export&token=' . Tools::getValue('token');
      $this->import = Tools::baseUrl() . '?controller=AdminBulkData&action=import&token=' . Tools::getValue('token');
   }
   public function products_old()
   {
      $this->title = 'Productos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=product&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Producto',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $res = $this->model->getProducts();
      if (!empty($res)) {
         $this->render('catalog/products', array('products' => $res));
      } else {
         $this->render('catalog/products');
      }
   }
   public function products()
   {

      $this->title = 'Productos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=product&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Producto',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'IMAGEN', 'class' => 'text-center col-1'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'COMPONENTE ACTIVO', 'class' => 'text-center'],
         ['label' => 'CÓDIGO', 'class' => 'text-center'],
         ['label' => 'PRECIO', 'class' => 'text-center'],
         ['label' => 'STOCK', 'class' => 'text-center'],
         ['label' => 'ACTIVO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center'],
      ];
      $rows = [
         ['field' => 'id_product', 'class' => 'text-center'],
         ['type' => 'img', 'source' => IMG_URI . '/p/', 'field' => 'img_name', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'active', 'class' => 'text-center'],
         ['field' => 'code', 'class' => 'text-center'],
         [
            'type' => 'two-lines',
            'class' => 'text-right',
            'one' => ['field' => 'price'],
            'two' => ['field' => 'price_usd', 'class' => 'text-success'],
         ],
         ['field' => 'current_stock', 'class' => 'text-center'],
         ['type' => 'switchJS', 'field' => 'is_active', 'class' => 'text-center', 'id' => 'id_product', 'actionJS' => 'changeStatusWithAJAX', 'target' => ''],
         [
            'type' => 'link',
            'class' => 'text-center ',
            'links' => [
               ['id' => 'id_product', 'icon' => 'fas fa-eye', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=product_preview'],
               ['id' => 'id_product', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=product'],
               ['id' => 'id_product', 'icon' => 'fas fa-trash', 'actionJS' => 'removeAJAX']
            ]
         ]
      ];
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('changeStatusAJAX')) {
            Catalog::changeProductStatus();
         }
         if (Tools::getValue('removeAJAX')) {
            Catalog::removeProduct();
            $this->ajaxRedirect('AdminCatalog&action=products');
         }
      } else {
         $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Catalog::getProductsMain())]);
      }
   }
   public function product()
   {
      if (!Tools::getValue('id')) {
         $id = Catalog::prepareProduct();
         $this->redirect('?controller=AdminCatalog&action=product&id=' .
            $id . '&token=' . Tools::getValue('token'));
      }
      if ($this->isAjaxRequest()) {
         if (Tools::getValue('newProduct')) {
            Catalog::newProduct();
         }
         if (Tools::getValue('uploadProductIMG')) {
            $res = Catalog::uploadProductIMG();
            if ($res) $this->ajaxResponse($res);
         }
         if (Tools::getValue('removeProductIMG')) {
            $this->ajaxResponse(Catalog::removeProductIMG());
         }
         if (Tools::getValue('fetchProductStock')) {
            Tools::ajaxResponse(Catalog::getProductStock());
         }
         if (Tools::getValue('updateProductStock')) {
            Catalog::updateProductStock();
         }
         if (Tools::getValue('changeStatusAJAX')) {
            Catalog::changeProductStatus();
         }
         if (Tools::getValue('saveProduct')) {
            Catalog::saveProduct();
            $this->ajaxResponse([
               'response' => [
                  'type' => 'info',
                  'message' => 'Datos Actualizados.',
               ]
            ]);
         }
      } else {
         $this->render('catalog/productForm', array(
            'date' => Catalog::getNewProductDate(),
            'data' => Catalog::getProductById(),
            'actives' => Catalog::getActiveCompound(),
            'categories' => Catalog::getCategories(),
            'brands' => Catalog::getBrands(),
            'discounts' => Catalog::getDiscounts(),
            'suppliers' => Shopping::getSuppliers(),
            'locations' => Warehouses::getWarehouses(),
            'taxes' => Catalog::getTaxes(),
            'stocks' => Catalog::getProductStock()
         ));
      }
   }
   public function product_preview()
   {
      $this->title = 'Vista Previa';
      $this->render('catalog/product_preview', [
         'date' => Catalog::getNewProductDate(),
         'data' => Catalog::getProductById(),
         'actives' => Catalog::getActiveCompound(),
         'categories' => Catalog::getCategories(),
         'brands' => Catalog::getBrands(),
         'discounts' => Catalog::getDiscounts(),
         'suppliers' => Shopping::getSuppliers(),
         'locations' => Warehouses::getWarehouses(),
         'taxes' => Catalog::getTaxes(),
         'stocks' => Catalog::getProductStock()
      ]);
   }
   public function categories()
   {
      $this->title = 'Categorías';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=category&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Descuento',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center col-1'],
         ['label' => 'IMAGEN', 'class' => 'text-center col-1'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_category', 'class' => 'text-right'],
         ['type' => 'img', 'source' => CAT_URI, 'field' => 'img', 'class' => 'text-center'],
         ['field' => 'name'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_category', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=category'],
               ['id' => 'id_category', 'icon' => 'fas fa-trash', 'href' => 'AdminCatalog&action=categoryDel']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Catalog::getCategories())]);
   }
   public function category()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Categorías',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'file',
               'label' => 'IMAGEN',
               'name' => 'img',
               'col' => 5,
               'save_path' => CAT_URI,
               'ext' => ['.jpg', '.png', '.jpeg'],
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminCatalog&action=category';
      if (!Tools::getValue('id')) {
         $this->title = 'Nueva Categoría';
      } else {
         $vals = Catalog::getCategoryById(Tools::getValue('id'));
         $fields_value = [
            'name' => $vals['name'],
            'img' => $vals['img'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Categoría';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Catalog::newCategory();
         } else {
            Catalog::saveCategory();
         }
         $this->ajaxRedirect('AdminCatalog&action=categories');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function categories2()
   {
      $this->title = 'Categorías';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=category&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Categoría',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $res = $this->model->getCategories();
      if (!empty($res)) {
         $this->render('catalog/categories', array('categories' => $res));
      } else {
         $this->render('catalog/categories');
      }
   }
   public function discounts()
   {
      $this->title = 'Descuentos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=discount&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Descuento',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'PORCENTAJE', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_discount', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'percentage', 'class' => 'text-right'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_discount', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=discount'],
               ['id' => 'id_discount', 'icon' => 'fas fa-trash', 'href' => 'AdminCatalog&action=discountDel']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Catalog::getDiscounts())]);
   }
   public function discount()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Descuento',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'PORCENTAJE',
               'name' => 'percentage',
               'class' => 'text-right',
            ],
            [
               'type' => 'select',
               'label' => 'ESTATUS',
               'name' => 'status',
               'options' => [
                  ['value' => 'A', 'label' => 'ACTIVO'],
                  ['value' => 'I', 'label' => 'INACTIVO'],
               ],
            ]
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminCatalog&action=discount';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Descuento';
      } else {
         $vals = Catalog::getDiscountById(Tools::getValue('id'));
         $fields_value = [
            'name' => $vals['name'],
            'amount' => $vals['amount'],
            'coupon_code' => strtoupper($vals['coupon_code']),
            'start_date' => $vals['start_date'],
            'end_date' => $vals['end_date'],
            'amount_usd' => $vals['amount_usd'],
            'quantity' => $vals['quantity'],
            'percentage' => $vals['percentage'] . '%',
            'min_order_value' => $vals['min_order_value'],
            'max_order_value' => $vals['max_order_value'],
            'status' => $vals['op_status']

         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Descuento';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Catalog::newDiscount();
         } else {
            Catalog::saveDiscount();
         }
         $this->ajaxRedirect('AdminCatalog&action=discounts');
      } else {
         $this->render('catalog/discountForm', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function discountDel()
   {
      Catalog::removeDiscount(Tools::getValue('id'));
      $this->redirect('?controller=AdminDiscounts&token=' . Tools::getValue('token'));
   }
   public function taxes()
   {
      $this->title = 'Impuestos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=tax&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Impuesto',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'PORCENTAJE', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_tax', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'rate'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_tax', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=tax'],
               ['id' => 'id_tax', 'icon' => 'fas fa-trash', 'href' => 'AdminCatalog&action=taxDel']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Catalog::getTaxes())]);
   }
   public function tax()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Impuestos',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'text',
               'label' => 'PORCENTAJE',
               'name' => 'rate',
               'col' => 5,
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminCatalog&action=tax';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Impuesto';
      } else {
         $vals = Catalog::getTaxById(Tools::getValue('id'));
         $fields_value = [
            'name' => $vals['name'],
            'rate' => $vals['rate'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Impuesto';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Catalog::newTax();
         } else {
            Catalog::saveTax();
         }
         $this->ajaxRedirect('AdminCatalog&action=taxes');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function brands()
   {
      $this->title = 'Marcas';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=brand&token=' . Tools::getValue('token'),
            'action' => 'Nueva Marca',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'IMAGEN', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_brand', 'class' => 'text-center col-1'],
         ['type' => 'img', 'source' => IMG_URI . 'b/', 'field' => 'img', 'class' => 'text-center col-1'],
         ['field' => 'name'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_brand', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=brand'],
               ['id' => 'id_brand', 'icon' => 'fas fa-trash', 'href' => 'AdminCatalog&action=brandDel']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Catalog::getBrands())]);
   }
   public function brand()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Marcas',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'file',
               'label' => 'IMAGEN',
               'name' => 'img',
               'col' => 5,
               'save_path' => IMG_URI . '/b',
               'ext' => ['.jpg', '.png', '.jpeg'],
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminCatalog&action=brand';
      if (!Tools::getValue('id')) {
         $this->title = 'Nueva Marca';
      } else {
         $vals = Catalog::getBrandById(Tools::getValue('id'));
         $fields_value = [
            'name' => $vals['name'],
            'img' => $vals['img'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Marca';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Catalog::newBrand();
         } else {
            Catalog::saveBrand();
         }
         $this->ajaxRedirect('AdminCatalog&action=brands');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
   public function actives()
   {
      $this->title = 'Compuestos Activos';
      $this->calls = array(
         array(
            'url' => Tools::baseUrl() . '?controller=AdminCatalog&action=active&token=' . Tools::getValue('token'),
            'action' => 'Nuevo Compuesto Activo',
            'icon' => 'fa fa-circle-plus',
         ),
         array(
            'url' => $this->import,
            'type' => 'default',
            'icon' => 'fas fa-file-import',
            'action' => 'Importar',
         ),
         array(
            'url' => $this->export,
            'type' => 'default',
            'icon' => 'fas fa-file-export',
            'action' => 'Exportar',
         ),
      );
      $dt = new DataGrid();
      $head = [
         ['label' => '#', 'class' => 'text-center'],
         ['label' => 'NOMBRE', 'class' => 'text-center'],
         ['label' => 'PSICOTRÓPICO', 'class' => 'text-center'],
         ['label' => 'OPCIONES', 'class' => 'text-center col-1'],
      ];
      $rows = [
         ['field' => 'id_active_compound', 'class' => 'text-center'],
         ['field' => 'name'],
         ['field' => 'is_psychotropic', 'class' => 'text-center'],
         [
            'type' => 'link',
            'class' => 'text-center',
            'links' => [
               ['id' => 'id_active_compound', 'icon' => 'fas fa-pencil', 'class' => 'pr-1', 'href' => 'AdminCatalog&action=active'],
               ['id' => 'id_active_compound', 'icon' => 'fas fa-trash', 'href' => 'AdminCatalog&action=activeDel']
            ]
         ]
      ];
      $this->render('_partials/grid', ['grid' => $dt->generateGrid($head, $rows, Catalog::getActiveCompound())]);
   }
   public function active()
   {
      $helper = new HelperForm();
      $form_fields = [
         'legend' =>
         [
            'title' => 'Formulario de Gestión de Compuestos Activos',
            'icon' => 'fas fa-gears',
         ],
         'input' => [
            [
               'type' => 'text',
               'label' => 'NOMBRE',
               'name' => 'name',
               'required' => true,
            ],
            [
               'type' => 'switch',
               'label' => '¿ES PSICOTRÓPICO?',
               'name' => 'psychotropic',
               'col' => 5,
            ],
         ],
         'submit' => [
            'title' => 'Guardar',
         ]
      ];
      $helper->submit_action = 'AdminCatalog&action=active';
      if (!Tools::getValue('id')) {
         $this->title = 'Nuevo Compuesto Activo';
      } else {
         $vals = Catalog::getActiveCompoundById(Tools::getValue('id'));
         $fields_value = [
            'name' => $vals['name'],
            'psychotropic' => $vals['is_psychotropic'],
         ];
         $helper->field_vals = $fields_value;
         $this->title = 'Editar Compuesto Activo';
      }
      if ($this->isAjaxRequest()) {
         if (!Tools::getValue('id')) {
            Catalog::newActiveCompound();
         } else {
            Catalog::saveActiveCompound();
         }
         $this->ajaxRedirect('AdminCatalog&action=actives');
      } else {
         $this->render('_partials/form', [
            'form' => $helper->generateForm($form_fields),
            'id' => Tools::getValue('id'),
         ]);
      }
   }
}
