<?php
class AdminLoginController extends Controller
{
   private $model;
   public function __construct()
   {
      $this->controller_type = 'admin';
      parent::__construct();
      $this->layout = 'login';
   }
   public function index()
   {
      if (Tools::getValue('_uid')) {
         $this->redirect('dashboard');
      } else {
         $this->render('access/index');
      }
   }
   public function logout()
   {
      Session::destroy();
      Tools::redirectAdmin('?controller=AdminLogin');
   }

   public function auth()
   {
      if (Tools::isAjaxRequest()) {
         if (Auth::authenticate(true)) {
            Tools::ajaxRedirect('AdminDashboard');
         }
         // $this->ajaxRedirect('AdminDashboard');
         // Tools::ajaxRedirect('AdminDashboard');
      }
      // if ($this->isAjaxRequest()) {
      //    $res = Auth::checkUser(1);
      //    if ($res) {
      //       $res = Auth::authenticate(1);
      //       if ($res == true) {
      // $this->ajaxRedirect('AdminDashboard');
      //       } else {
      //          $this->ajaxResponse(array(
      //             'response' => array(
      //                'type' => 'error',
      //                'message' => 'contraseña no valida.'
      //             )
      //          ));
      //       }
      //    } else {
      //       $this->ajaxResponse(array(
      //          'response' => array(
      //             'type' => 'error',
      //             'message' => 'El usuario ingresado no existe.'
      //          )
      //       ));
      //    }
      // }
   }
}
