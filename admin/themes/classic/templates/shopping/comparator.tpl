<div class="row mt-2">
   <div class="col-sm-12 col-12">
      <div class="card card-navy card-outline">
         <div class="card-body p-2 col-12">
            <table class="table table-sm table-striped dataTable">
               <thead class="bg-navy">
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center">DESCRIPCIÓN</th>
                     <th class="text-center">PROVEEDOR</th>
                     <th class="text-center">PRECIO</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$data item=$d}
                     <tr>
                        <td class="text-center">{$d['id_comparator_entry']}</td>
                        <td class="text-left">{$d['product_name']}</td>
                        <td class="text-center">{$d['provider']}</td>
                        <td class="text-right">{$d['price']}<br><small class="text-success">{$d['price_usd']}</small></td>
                     </tr>
                  {/foreach}
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>