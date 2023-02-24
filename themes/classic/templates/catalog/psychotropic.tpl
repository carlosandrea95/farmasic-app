{* <PRE>
{print_r($products)}
</PRE> *}
<div class="row">
   <div class="col-2">
      <a href="{Tools::baseUrl()}catalog" class="btn btn-block btn-primary">Catálogo</a>
   </div>
   <div class="col-2">
      <a href="{Tools::baseUrl()}catalog/featured" class="btn btn-block btn-primary">Destacados</a>
   </div>
   <div class="col-2">
      <a href="{Tools::baseUrl()}catalog/psychotropic" class="btn btn-block btn-primary disabled">Psicotrópicos</a>
   </div>
</div>
<div class="row mt-2">
   <div class="col-sm-12">
      <div class="card card-navy card-outline">
         <div class="card-body p-2">
            <table id="example1" class="table table-responsive table-sm table-striped dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead class="bg-navy">
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center">IMAGEN</th>
                     <th class="text-center">PEDIR</th>
                     <th class="text-center">DESCRIPCION</th>
                     <th class="text-center">CODIGO</th>
                     <th class="text-center">EXISTENCIA</th>
                     <th class="text-center">PRECIO</th>
                     <th class="text-center">IVA</th>
                     <th class="text-center">DC</th>
                     <th class="text-center">NETO</th>
                     <th class="text-center">BARRA</th>
                     <th class="text-center">MARCA</th>
                     <th class="text-center">COMPONENTE</th>
                  </tr>
               </thead>
               <tbody>
                  {if !empty($products)}
                     {foreach from=$products item=$p}
                        <tr class="text-xs">
                           <td>{$p['num_row']}</td>
                           <td><img src="{IMG_URI}p/{$p['img_name']}" style="width: 70px;height: 70px;object-fit:contain">
                           </td>
                           <td class="col-4">
                              <div class="input-group input-group-sm" style="margin-top: 1rem;">
                                 <form class="formCart d-flex" method="post" target="{Tools::baseUrl()}cart/add">
                                    <input type="hidden" name="product" value="{$p['id_product']}">
                                    <input type="number" id="cls" name="quantity" class="form-control rounded-0">
                                    <button type="submit" class="btn btn-sm btn-default btn-flat"
                                       style="margin-left: .25rem;padding-left: 0.65rem;padding-right: .75rem;padding-top: .375rem;padding-bottom: .375rem;"><span
                                          class="fas fa-shopping-cart"></span></button>
                                 </form>

                              </div>
                           </td>
                           <td class="col-4 text-left">{$p['name']}</td>
                           <td class="text-center">{$p['code']}</td>
                           <td class="text-center">{round($p['current_stock'])}</td>
                           <td class="text-right">
                              {Tools::moneyFormat($p['price'],'BS',false)}
                              <span class="text-success">{Tools::moneyFormat($p['price_usd'],'USD',false)}</span>
                           </td>
                           <td class="text-center">{$p['rate']}</td>
                           <td class="text-danger text-center">
                              {$p['percentage']}%
                           </td>
                           <td class="text-right">
                              {Tools::moneyFormat($p['net_price'],'BS',false)}
                              <span class="text-success">{Tools::moneyFormat($p['net_price_usd'],'USD',false)}</span>
                           <td class="text-center">{$p['bar_code']}</td>
                           <td class="text-center">{$p['brand']}</td>
                           <td class="text-center">{$p['active']}</td>
                        </tr>
                     {/foreach}
                  {/if}
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>