<?php
class InfoController extends Controller
{
  public function index()
  {
    $company = Customers::getCustomersInfoById();
    $this->title = $company['name'];
    $this->render('info/index', ['clientData' => Customers::getCustomersInfoById(), 'banksData' => Banks::getBanks(), 'companyData' => Companies::getCompaniesInfoById()]);
  }
}
