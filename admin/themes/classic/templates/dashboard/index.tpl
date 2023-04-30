<div class="row">
   <div class="col-lg-3 col-6">

      <div class="small-box bg-info">
         <div class="inner">
            <h3>{Orders::countOrders()}</h3>
            <p>Nuevos Pedidos</p>
         </div>
         <div class="icon">
            <i class="fas fa-shopping-cart"></i>
         </div>
         <a href="{Tools::baseUrl()}?controller=AdminOrders&action=orders&token={Tools::getValue('token')}"
            class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
   </div>

   <div class="col-lg-3 col-6">

      <div class="small-box bg-success">
         <div class="inner">
            <h3>{Payments::countPayments()}<sup style="font-size: 20px"></sup></h3>
            <p>Nuevos Pagos</p>
         </div>
         <div class="icon">
            <i class="fas fa-money-bill-alt"></i>
         </div>
         <a href="{Tools::baseUrl()}?controller=AdminOrders&action=payments&token={Tools::getValue('token')}"
            class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
   </div>

   <div class="col-lg-3 col-6">

      <div class="small-box bg-warning">
         <div class="inner text-white">
            <h3>{Complaints::countComplaints()}</h3>
            <p>Nuevos Reclamos</p>
         </div>
         <div class="icon">
            <i class="fas fa-phone"></i>
         </div>
         <a href="{Tools::baseUrl()}?controller=AdminCustomers&action=requests&token={Tools::getValue('token')}"
            class="small-box-footer" style="color: #fff!important;">Más Información <i
               class="fas fa-arrow-circle-right"></i></a>
      </div>
   </div>

   <div class="col-lg-3 col-6">

      <div class="small-box bg-danger">
         <div class="inner">
            <h3>{Support::countSupportTickets()}</h3>
            <p>Tickets de Soporte</p>
         </div>
         <div class="icon">
            <i class="fas fa-headset"></i>
         </div>
         <a href="{Tools::baseUrl()}?controller=AdminSupport&token={Tools::getValue('token')}"
            class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
      </div>
   </div>

</div>

<div class="row">
   <div class="col-md-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title">Resumen General</h3>
            <div class="card-tools">
               {* <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
               </button> *}
               <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                     <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                     <a href="#" class="dropdown-item">Action</a>
                     <a href="#" class="dropdown-item">Another action</a>
                     <a href="#" class="dropdown-item">Something else here</a>
                     <a class="dropdown-divider"></a>
                     <a href="#" class="dropdown-item">Separated link</a>
                  </div>
               </div>
               <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
               </button>
            </div>
         </div>

         <div class="card-body">
            <div class="row" style="margin-bottom: -3em;">
               <div class="col-md-7">
                  <p class="text-center">
                     <strong>Relación Gastos - Ingresos Este Mes</strong>
                  </p>
                  <div class="chart">
                     <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                           <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                           <div class=""></div>
                        </div>
                     </div>

                     <canvas id="salesLineChart" height="180" style="height: 380px; display: block; width: 680px;"
                        width="680"></canvas>
                     <canvas id="costsLineChart" height="180" style="height: 380px; display: block; width: 680px;"
                        width="680"></canvas>
                  </div>

               </div>

               <div class="col-md-5">
                  <div class="text-center">
                     <strong>Solicitudes Este Mes</strong>
                  </div>
                  <canvas id="salesDoughnutChart" height="180" style="height: 180px; display: block; width: 680px;"
                     width="680"></canvas>
                  {* <p class="text-center">
                     <strong>Filtrado:</strong>
                  </p>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="far fa-calendar-alt"></i>
                        </span>
                     </div>
                     <input type="text" class="form-control float-right" id="reservation">
                  </div> *}
               </div>

            </div>

         </div>

         <div class="card-footer">
            <div class="row">
               <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                     {* <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> *}
                     <h5 class="description-header text-success">{Tools::moneyFormat($totals.sales,'BS')}</h5>
                     <span class="description-text">TOTAL INGRESOS</span>
                  </div>

               </div>

               <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                     {* <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> *}
                     <h5 class="description-header text-danger">{Tools::moneyFormat($totals.costs,'BS')}</h5>
                     <span class="description-text">TOTAL GASTOS</span>
                  </div>

               </div>

               <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                     {* <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> *}
                     <h5 class="description-header text-success">{Tools::moneyFormat($totals.sales_usd,'USD')}</h5>
                     <span class="description-text">TOTAL INGRESOS USD</span>
                  </div>

               </div>

               <div class="col-sm-3 col-6">
                  <div class="description-block">
                     {* <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> *}
                     <h5 class="description-header text-danger">{Tools::moneyFormat($totals.costs_usd,'USD')}</h5>
                     <span class="description-text">TOTAL GASTOS USD</span>
                  </div>

               </div>
            </div>

         </div>

      </div>

   </div>
</div>
<script>
   chartRequest();
</script>