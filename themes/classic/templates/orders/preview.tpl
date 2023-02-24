<div class="row">
   <div class="col-12">
      <h4><span class="text-gray text-bold">PEDIDO #{$data['id_order']}</span> - {strtoupper($data['status'])} <span
            style="font-size: 1rem;" class="ml-1 badge badge-dark">{Tools::moneyFormat($data['amount'],'BS')}
            {Tools::moneyFormat($data['amount_usd'],'USD')}</span>
         <small>{$data['created_at']}</small>
      </h4>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            {* <h3 class="card-title">Productos</h3> *}
            <form class="form-inline">
               <div class="form-group">
                  <label class="text-xs">PEDIDO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly
                     value="{$data['id_order']}-{$data['order_type']}">
               </div>
               <div class="form-group ml-2">
                  <label class="text-xs">ESTADO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly value="{$data['status']}">
               </div>
               <div class="form-group ml-2">
                  <label class="text-xs">ENVIADO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly value="{$data['created_at']}">
               </div>
               <div class="form-group ml-2">
                  <label class="text-xs">PROCESADO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly value="{$data['updated_at']}">
               </div>
            </form>
         </div>
         <div class="card-body p-2">
            <table class="table table-bordered table-sm table-striped dataTable dtr-inline">
               <thead class="bg-navy">
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center">DESCRIPCION</th>
                     <th class="text-center">CODIGO</th>
                     <th class="text-center">CANTIDAD</th>
                     <th class="text-center">PRECIO</th>
                     <th class="text-center">IVA</th>
                     <th class="text-center">DC</th>
                     <th class="text-center">NETO</th>
                     <th class="text-center">SUBTOTAL</th>
                  </tr>
               </thead>
               <tbody>
                  {if !empty($items)}
                     {foreach from=$items item=$i}
                        <tr class="text-xs">
                           <td>{$i['num_row']}</td>
                           <td class="col-4">{strtoupper($i['name'])}</td>
                           <td class="text-center">{$i['code']}</td>
                           <td class="text-center">{round($i['quantity'])}</td>
                           <td class="text-right">
                              {Tools::moneyFormat($i['price'],'BS',false)}<br>
                              <span class="text-success text-bold">{Tools::moneyFormat($i['price_usd'],'USD',false)}</span>
                           </td>
                           <td class="text-center">{$i['tax_rate']}%</td>
                           <td class="text-danger text-center">
                              {$i['discount_percentage']}%
                           </td>
                           <td class="text-right">
                              {Tools::moneyFormat($i['net_price'],'BS',false)}<br>
                              <span
                                 class="text-success text-bold">{Tools::moneyFormat($i['net_price_usd'],'USD',false)}</span>
                           </td>
                           <td class="text-right">
                              {Tools::moneyFormat($i['total'],'BS',false)}<br>
                              <span class="text-success text-bold">{Tools::moneyFormat($i['total_usd'],'USD',false)}</span>
                           </td>
                        </tr>
                     {/foreach}
                  {/if}
               </tbody>
            </table>
         </div>
         <div class="card-footer">
            <h4>TASA BCV: {$data['exchange_rate']}</h4>
         </div>
      </div>
   </div>
</div>