<div class="row">
   <div class="col-12">
      <h4><span class="text-gray text-bold">PEDIDO #{str_pad($data['id_order'],6,'0',STR_PAD_LEFT)}</span> - <span
            class="text-dark text-bold"></span>
         <small>de <span class="text-bold">{$client['name']}</span></small>
         {* <span style="font-size: 1.25rem;" class="badge badge-dark">Bs.
            {number_format($data['amount'],2,',','.')} ${number_format($data['amount_usd'],2,'.',',')}</span> *}
         <small>{$data['created_at']}</small>
      </h4>
   </div>
</div>
<div class="row mb-3">
   <div class="col-3">
      <div class="dropdown" id="changeStatus">
         <button class="btn {$statusColor} btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
            aria-expanded="false" {if !$validToPrint}disabled{/if} {if $data['op_status']!='A'}disabled{else}{/if}>
            {$status}
         </button>
         <ul class="dropdown-menu" style="width: 250px;">
            <li><a class="dropdown-item" href="#" value="A">EN ESPERA DEL PAGO</a></li>
            <li><a class="dropdown-item" href="#" value="C">COMPLETADO</a></li>
            <li><a class="dropdown-item" href="#" value="X">CANCELADO</a></li>
            <li><a class="dropdown-item" href="#" value="R">PAGO RECHAZADO</a></li>
         </ul>
      </div>
   </div>
   <div class="col-2">
      <button class="btn btn-default btn-block printBtn" type="button"
         onclick="_printInvoice({Tools::getValue('id')},'F')" {if Orders::getInvoiceType()=='F'}{else}disabled{/if}>
         <span class="fas fa-print mr-1"></span>IMPRIMIR FACTURA
      </button>
   </div>
   <div class="col-3">
      <button class="btn btn-default btn-block printBtn" type="button"
         onclick="_printInvoice({Tools::getValue('id')},'N')" {if Orders::getInvoiceType()=='N'}{else}disabled{/if}>
         <span class="fas fa-sticky-note mr-1"></span>IMPRIMIR NOTA DE ENTREGA
      </button>
   </div>
   <div class="col-3">
      <button class="btn btn-default printBtn" type="button" onclick="_printDelivery({Tools::getValue('id')})"
         {if !Orders::getInvoiceType()}disabled{/if}>
         <span class="fas fa-truck mr-1"></span>IMPRIMIR ORDEN DE ENTREGA
      </button>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title text-bold">CLIENTE</h3>
         </div>
         <div class="card-body p-3">
            <div class="row">
               <div class="form-group col-4">
                  <label>CLIENTE</label>
                  <input type="text" class="form-control form-control-sm" value="{$client['name']}" disabled>
               </div>
               <div class="form-group col-4">
                  <label>CORREO ELÉCTRONICO</label>
                  <input type="text" class="form-control form-control-sm" value="{$client['email']}" disabled>
               </div>
               <div class="form-group col-4">
                  <label>CUENTA REGISTRADA</label>
                  <input type="text" class="form-control form-control-sm" value="{$client['date_creation']}" disabled>
               </div>
               <div class="form-group col-4">
                  <label>PEDIDOS COMPLETADOS</label>
                  <input type="text" class="form-control form-control-sm" value="" disabled>
               </div>
               <div class="form-group col-4">
                  <label>PEDIDOS PENDIENTES</label>
                  <input type="text" class="form-control form-control-sm" value="" disabled>
               </div>
               <div class="form-group col-4">
                  <label>PEDIDOS RECHZADOS</label>
                  <input type="text" class="form-control form-control-sm" value="" disabled>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="row">
               <div class="col-4">
                  <h4>TASA BCV: 24.20</h4>
               </div>
               <div class="text-right col-4">
                  <h4>TOTAL VENTA: {Tools::moneyFormat($data['amount'],'BS',true)} <br> <span
                        class="text-success">{Tools::moneyFormat($data['amount_usd'],'USD',true)}</span></h4>
               </div>
               <div class="text-right col-4">
                  <h4>TOTAL PAGO: {Tools::moneyFormat($data['amount'],'BS',true)} <br> <span
                        class="text-success">{Tools::moneyFormat($data['amount_usd'],'USD',true)}</span></h4>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title text-bold">PAGOS</h3>
         </div>
         <div class="card-body p-2">
            <table class="table table-bordered table-sm table-striped dateTableSimple dtr-inline no-footer">
               <thead class="bg-navy text-center">
                  <th class="col-1">FECHA</th>
                  <th class="col-2">METODO DE PAGO</th>
                  <th class="col-1">MONEDA</th>
                  <th class="col-3">BANCO/CUENTA</th>
                  <th class="col-2">ID TRANSACCIÓN</th>
                  <th class="col-2">MONTO</th>
                  <th class="col-2">ESTADO</th>
               </thead>
               <tbody>
                  {if !empty($payments)}
                     {foreach from=$payments item=$p}
                        <tr>
                           <td>{$p['created_at']}</td>
                           <td>{$p['method']}</td>
                           <td class="text-center">{$p['currency']}</td>
                           <td>{$p['bank']}</td>
                           <td class="text-center">{$p['reference']}</td>
                           <td class="text-right">{Tools::moneyFormat($p['amount'],'BS',true)}
                              <br>
                              <span class="text-success">{Tools::moneyFormat($p['amount_usd'],'USD',true)}</span>
                           </td>
                           <td class="text-center">{$p['status']}</td>
                        </tr>
                     {/foreach}
                  {else}
                  {/if}
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title text-bold">PRODUCTOS</h3>
         </div>
         <div class="card-body p-2">
            <form class="form-inline col-12 mb-2">
               <div class="col-6 form-group row d-flex justify-content-between">
                  <label class="mr-1" for="">PRODUCTO</label>
                  <select name="product" class="form-control form-control-sm select2" id="product" style="width: 85%;">
                     <option value="-1"></option>
                     {foreach from=$products item=$p}
                        <option value="{$p['id_product']}">#{$p['id_product']} - {$p['name']}</option>
                     {/foreach}
                  </select>
               </div>
               <div class="col-3 form-group row">
                  <label class="mr-1 ml-1" for="">PRECIO</label>
                  <input type="text" class="form-control form-control-sm text-right money-usd" value=""
                     style="width: 75%;">
               </div>
               <div class="col-2 form-group row">
                  <label class="mr-1 ml-1" for="">CANTIDAD</label>
                  <input type="text" class="form-control form-control-sm text-right" value="" style="width: 50%;">
               </div>
               <div class="col-1 form-group row d-flex justify-content-end">
                  <button type="submit" onclick="addNewShoppingOrderLine()"
                     class="btn btn-primary btn-sm">AGREGAR</button>
               </div>
            </form>
            <table class="table table-bordered table-sm table-striped dtr-inline no-footer">
               <thead class="bg-navy">
                  <th class="col-4 text-center">DESCRIPCIÓN</th>
                  <th class="col-1 text-center">CANTIDAD</th>
                  <th class="col-1 text-center">DISPONIBLE</th>
                  <th class="col-2 text-center">PRECIO</th>
                  <th class="col-2 text-center">TOTAL</th>
                  <th class="col-1 text-center">OPCIONES</th>
               </thead>
               <tbody>
                  {* {print_r($items)} *}
                  {if !empty($items)}
                     {foreach from=$items item=$i}
                        <tr>
                           <td>{$i['name']}</td>
                           <td class="text-center">{$i['quantity']}</td>
                           <td class="text-center">{Round($i['current_stock'],0)}</td>
                           <td class="text-right">{Tools::moneyFormat($i['net_price'],'BS',false)}<br><span
                                 class="text-success">{Tools::moneyFormat($i['net_price_usd'],'USD',false)}</span></td>
                           <td class="text-right">{Tools::moneyFormat($i['total'],'BS',false)}<br><span
                                 class="text-success">{Tools::moneyFormat($i['total_usd'],'USD',false)}</span></td>
                           <td></td>
                        </tr>
                     {/foreach}
                  {/if}
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>