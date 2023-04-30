<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body p-1">
            <table class="table table-bordered table-sm table-striped dataTable dtr-inline">
               <thead class="bg-gray">
                  <tr>
                     <th class="text-center col-1">#</th>
                     <th class="text-center col-3">NOMBRE</th>
                     <th class="text-center col-2">CODIGO</th>
                     <th class="text-center col-2">VALOR</th>
                     <th class="text-center col-2">PORCENTAJE</th>
                     <th class="text-center col-1">CANTIDAD</th>
                     <th class=" text-center col-1">OPCIONES</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$discounts item=$d}
                     <tr>
                        <td class="text-right">{$d.id_discount}</td>
                        <td class="">{$d.name}</td>
                        <td class="text-center">{strtoupper($d.coupon_code)}</td>
                        <td class="text-right">{$d.amount}<br><span class="text-success">{$d.amount_usd} USD</span></td>
                        <td class="text-right">{if ($d.percentage>0.00)}{$d.percentage}%{else}0.00%{/if}</td>
                        <td class="">{$d.quantity}</td>
                        <td class="text-center">
                           <a href="{Tools::baseUrl()}?controller=AdminCatalog&action=discount&id={$d.id_discount}&token={Tools::getValue('token')}"
                              class="
                                 btn btn-xs">
                              <i class="fas fa-edit text-primary"></i>
                           </a><a
                              href="{Tools::baseUrl()}?controller=AdminCatalog&action=discountDel&id={$d.id_discount}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fas fa-trash text-primary"></i>
                           </a>
                        </td>
                     </tr>
                  {/foreach}
               </tbody>

            </table>
         </div>
      </div>
   </div>
</div>
{* <script>
   $(document).ready(function() {
      $('#example1').DataTable({
         "language": {
"url": "{$urls.assets}/plugins/datatables/lang/es.json"
         }
      });
   });
</script> *}