<?php
class loginController extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'login';
   }
   public function index()
   {
      // $m = $this->loadModel('login');
      // if ($this->isSubmit()) {
      //    $res = $m->verify_user_account($this->methodPost('username'), $this->methodPost('password'));
      //    if ($res == true) {
      //       $this->redirect('dashboard');
      //    }
      //    $this->render('access/index', array('form' => $this->returnVars()));
      // } else {
      // }
      if (Tools::getValue('USERID')) {
         $this->redirect('dashboard');
      }
      $this->render('access/index');
   }
   public function Auth()
   {
      if ($this->isAjaxRequest()) {
         if (Auth::authenticate()) {
            Tools::ajaxRedirect('dashboard');
         }
         // $res = Auth::checkUser();
         // if ($res) {
         //    $res = Auth::authenticate();
         //    if ($res == true) {
         //       $user = Customers::getCustomersBySession();
         //       Session::set('USER_NAME', $user['name']);
         //       $this->ajaxRedirect('dashboard');
         //    } else {
         //       $this->ajaxResponse(array(
         //          'alert' => array(
         //             'type' => 'error',
         //             'message' => 'contraseña no valida.'
         //          )
         //       ));
         //    }
         // } else {
         //    $this->ajaxResponse(array(
         //       'response' => array(
         //          'type' => 'danger',
         //          'message' => 'El usuario ingresado no existe.'
         //       )
         //    ));
         // }
      }
   }
   public function logout()
   {
      Session::destroy();
      $this->redirect();
   }
}
