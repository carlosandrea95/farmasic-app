<?php
class SupportController extends Controller
{
   public function __construct()
   {
      parent::__construct();
   }
   public function send()
   {
      if (Tools::isAjaxRequest()) {

         Support::sendTicket();
      }
   }
}
