<?php
class dashboardController  extends Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->layout = 'dashboard';
   }
   public function index()
   {
      $this->title = 'Inicio';
      $this->render('dashboard/index', ['clientData' => Customers::getCustomersBySession()]);
   }
   public function users()
   {
      $this->render('users');
   }
}
