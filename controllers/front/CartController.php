<?php
class CartController extends Controller
{
   private $currentCart;
   public function __construct()
   {
      parent::__construct();
   }
   public function index()
   {
      if (Cart::verifiqueEmptyCart()) {
         $this->redirect('dashboard');
      }
      $this->title = 'Carrito';
      $totals = Cart::getTotals();
      $this->render('cart/index', ['items' => Cart::getItems(), 'countItems' => Cart::countItemsInCart(), 'totals' => $totals, 'cart_type' => Cart::getCurrentCartIsPsychotropic(), 'documents' => Customers::getDocuments(), 'data' => Cart::getCartData()]);
   }
   public function data()
   {
      $data = [
         'count' => Cart::countItems(),
         'url' => Tools::baseUrl() . 'cart',
         'totalBs' => ' Bs. ' . number_format(Cart::getTotalsBS(), 2, ',', '.'),
         'totalUSD' => '$ ' . number_format(Cart::getTotalsUSD(), 2, ',', '.')
      ];
      $this->ajaxResponse($data);
   }
   public function stock()
   {
      if ($this->isAjaxRequest()) {
         // print_r($_POST);
         Tools::ajaxResponse(['currentStock' => Cart::getCurrentStock()]);
      }
   }
   public function add()
   {
      if ($this->isAjaxRequest()) {
         Cart::addItemToCart();
      }
   }
   public function send()
   {
      if ($this->isAjaxRequest()) {
         Orders::newOrder();
         Cart::checkout();
         $this->ajaxResponse(array(
            'response' => array(
               'type' => 'success',
               'message' => 'Tu pedido ha sido enviado exitosamente.',
               'redirect' => $this->ajaxRedirectTo('dashboard')
            )
         ));
      }
   }
   public function sendPsychotropic()
   {
      if ($this->isAjaxRequest()) {
         if (Tools::fileUpload('img', IMG_DIR . 'd/' . Session::get('_uid') . '/')) {
            Orders::newOrder('P');
            Cart::checkout();
            Tools::ajaxResponse([
               'response' => [
                  'type' => 'success',
                  'message' => 'Tu pedido ha sido enviado exitosamente.',
                  'redirect' => $this->ajaxRedirectTo('cart/download&id=' . Orders::getCurrentIdOrder())
               ]
            ]);
         } else {
            Tools::ajaxResponse([
               'response' => [
                  'type' => 'warning',
                  'message' => 'Error al procesar la solicitud.',
               ]
            ]);
         }
      }
   }
   public function download()
   {
      $pdf = new PDF_Psychotropic();
      $pdf->print();
   }
   public function update()
   {
      if ($this->isAjaxRequest()) {
         Cart::updateItem();
         $this->ajaxRedirect('cart');
      }
   }
   public function clean()
   {
      if ($this->isAjaxRequest()) {
         Cart::cleanCart();
         $this->ajaxRedirect('dashboard');
      }
   }
   public function remove()
   {
      if ($this->isAjaxRequest()) {
         Cart::removeItem();
         $this->ajaxRedirect('cart');
      }
   }
}
