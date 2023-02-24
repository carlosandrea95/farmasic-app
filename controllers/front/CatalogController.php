<?php
class CatalogController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Catálogo';
      $this->render('catalog/index', ['products' => Catalog::getProducts(false, false, true)]);
   }
   public function featured()
   {
      $this->title = 'Destacados';

      $this->render('catalog/featured', ['products' => Catalog::getProducts(false, true, true)]);
   }
   public function psychotropic()
   {
      $this->render('catalog/psychotropic', ['products' => Catalog::getProducts(true, false, true)]);
   }
}
