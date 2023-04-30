<div class="row">
   <div class="col-12 text-center">
      <h3>{Tools::valid($clientData['company_name'])}</h3>
   </div>
</div>
<div class="row">
   <div class="col-md-6">
      <div class="card">
         <div class="card-header bg-navy">
            <h3 class="card-title"><span class="fas fa-user mb-1"></span> Datos del Cliente</h3>
         </div>

         <div class="card-body p-2">
            <table class="table table-md">
               <tbody>
                  <tr>
                     <td>Código:</td>
                     <td class="text-right">{Tools::valid($clientData['code'])}</td>
                  </tr>
                  <tr>
                     <td>Rif:</td>
                     <td class="text-right">{Tools::valid($clientData['dni'])}</td>
                  </tr>
                  <tr>
                     <td>Contacto:</td>
                     <td class="text-right">{Tools::valid($clientData['phone'])} -
                        {Tools::valid($clientData['contact_person'])}</td>
                  </tr>
                  <tr>
                     <td>Vendedor:</td>
                     <td class="text-right">{Tools::valid($clientData['contact_person'])}</td>
                  </tr>
               </tbody>
            </table>
         </div>

      </div>
   </div>
   <div class="col-md-6">
      <div class="card">
         <div class="card-header bg-navy">
            <h3 class="card-title"><span class="fas fa-th-list mb-1"></span> Condiciones Comerciales</h3>
         </div>

         <div class="card-body p-2">
            <table class="table table-md">
               <tbody>
                  <tr>
                     <td>Limite de Crédito:</td>
                     <td class="text-right">{Customers::getAvailableCreditTime()}</td>
                  </tr>
                  <tr>
                     <td>Saldo Actual:</td>
                     <td class="text-right">{Tools::moneyFormat(Orders::getAvailableBalance(),'USD')}</td>
                  </tr>
                  <tr>
                     <td>Credito Disponible:</td>
                     <td class="text-right">{Tools::valid(Tools::moneyFormat($clientData['credit_limit'],'USD'))}</td>
                  </tr>
                  <tr>
                     <td>Descuento Comercial:</td>
                     <td class="text-right">{Tools::valid($clientData['trade_discount'])}%</td>
                  </tr>
               </tbody>
            </table>
         </div>

      </div>
   </div>
</div>

<div class="row">
   <div class="col-lg-3 col-6">

      <div class="small-box bg-info">
         <div class="inner">
            <h3>{Catalog::countProductsInCatalog()}</h3>
            <p>Catálogo</p>
         </div>
         <div class="icon">
            <i class="fas fa-cubes"></i>
         </div>
         <a href="{Tools::baseUrl()}Catalog/featured" class="small-box-footer">
            Más Información <i class="fas fa-arrow-circle-right"></i>
         </a>
      </div>
   </div>

   <div class="col-lg-3 col-6">

      <div class="small-box bg-success">
         <div class="inner">
            <h3>{Orders::countOrdersByCustomer()}</h3>
            <p>Pedidos</p>
         </div>
         <div class="icon">
            <i class="fas fa-shopping-cart"></i>
         </div>
         <a href="{Tools::baseUrl()}Orders" class="small-box-footer">
            Más Información <i class="fas fa-arrow-circle-right"></i>
         </a>
      </div>
   </div>

   <div class="col-lg-3 col-6">

      <div class="small-box bg-danger">
         <div class="inner">
            <h3>{Complaints::countComplaintsByCustomer()}</h3>
            <p>Reclamos</p>
         </div>
         <div class="icon">
            <i class="fas fa-phone"></i>
         </div>
         <a href="{Tools::baseUrl()}complaints" class="small-box-footer">
            Más Información <i class="fas fa-arrow-circle-right"></i>
         </a>
      </div>
   </div>

   <div class="col-lg-3 col-6">

      <div class="small-box bg-warning ">
         <div class="inner text-white">
            <h3>{Payments::countPaymentsByCustomer()}</h3>
            <p>Pagos</p>
         </div>
         <div class="icon">
            {* <i class="fas fa-money-check-dollar-pen"></i> *}
            <i class="fas fa-money-bill-alt"></i>
         </div>
         <a href="{Tools::baseUrl()}payments" class="small-box-footer text-white" style="color: #fff!important;">
            Más Información <i class="fas fa-arrow-circle-right"></i>
         </a>
      </div>
   </div>

</div>