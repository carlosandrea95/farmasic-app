<?php
class AdminDashboardController extends Controller
{
   public function __construct()
   {
      $this->controller_type = 'admin';
      $this->layout = 'dashboard';
      parent::__construct();
   }
   public function index()
   {
      $this->title = 'Inicio';
      $salesDate = [];
      // echo '<pre>';
      foreach (Db::getInstance()->ExecuteS('SELECT DATE_FORMAT(created_at, "%d") as date FROM fs_payments WHERE MONTH(created_at) = MONTH(now()) AND op_status="A"   GROUP BY date ORDER BY date ASC LIMIT 0,30') as $d) {
         $salesDate[] = $d['date'];
      }
      $salesAmount = [];
      foreach (Db::getInstance()->ExecuteS('SELECT DATE_FORMAT(created_at, "%d") as date, SUM(amount) as amount FROM fs_payments WHERE MONTH(created_at) = MONTH(now()) AND op_status="A" GROUP BY date ORDER BY date ASC LIMIT 0,30') as $d) {
         $salesAmount[] = $d['amount'];
      }
      $costsDate = [];
      // echo '<pre>';
      foreach (Db::getInstance()->ExecuteS('SELECT DATE_FORMAT(created_at, "%d") as date FROM fs_shopping_orders WHERE MONTH(created_at) = MONTH(now()) GROUP BY date ORDER BY date ASC  LIMIT 0,30') as $d) {
         $costsDate[] = $d['date'];
      }
      $costsAmount = [];
      foreach (Db::getInstance()->ExecuteS('SELECT DATE_FORMAT(created_at, "%d") as date, SUM(amount) as amount FROM fs_shopping_orders WHERE MONTH(created_at) = MONTH(now()) GROUP BY date ORDER BY date ASC LIMIT 0,30') as $d) {
         $costsAmount[] = $d['amount'];
      }
      // print_r($salesDate);
      // exit;
      $output =
         [
            'relations' => [
               'sales' => [
                  'labels' => $salesDate,
                  'data' => $salesAmount
               ],
               'costs' => [
                  'labels' => $costsDate,
                  'data' => $costsAmount
               ],

            ],
            'common' => [
               // 1, 4, 2, 6
               Db::getInstance()->Execute('SELECT COUNT(id_order) as res FROM fs_orders WHERE MONTH(created_at) = MONTH(now())')['res'],
               Db::getInstance()->Execute('SELECT COUNT(id_payment) as res FROM fs_payments WHERE MONTH(created_at) = MONTH(now()) AND op_status="A" ')['res'],
               Db::getInstance()->Execute('SELECT COUNT(id_complaint) as res FROM fs_complaints WHERE MONTH(created_at) = MONTH(now())')['res'],
               Db::getInstance()->Execute('SELECT COUNT(id_support_ticket) as res FROM fs_support_tickets WHERE MONTH(created_at) = MONTH(now())')['res']
            ]
         ];

      $totals = [
         'sales' => Db::getInstance()->Execute('SELECT SUM(amount) as amount FROM fs_payments WHERE MONTH(created_at) = MONTH(now()) AND op_status="A"')['amount'],
         'sales_usd' => Db::getInstance()->Execute('SELECT SUM(amount) as amount_usd FROM fs_payments WHERE MONTH(created_at) = MONTH(now()) AND op_status="A"')['amount_usd'],
         'costs' => Db::getInstance()->Execute('SELECT SUM(amount) as amount FROM fs_shopping_orders WHERE MONTH(created_at) = MONTH(now())')['amount'],
         'costs_usd' => Db::getInstance()->Execute('SELECT SUM(amount) as amount_usd FROM fs_shopping_orders WHERE MONTH(created_at) = MONTH(now())')['amount_usd'],
      ];
      if ($this->isAjaxRequest() && Tools::getValue('request') == true) {
         Tools::ajaxResponse($output);
      } else {
         $this->render('dashboard/index', ['totals' => $totals]);
      }
   }
}
