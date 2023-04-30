<div class="row">
   <div class="col-2">
      <a href="{Tools::baseUrl()}catalog" class="btn btn-block btn-primary">Catálogo</a>
   </div>
   <div class="col-2">
      <a href="{Tools::baseUrl()}catalog/featured" class="btn btn-block btn-primary disabled">Destacados</a>
   </div>
   <div class="col-2">
      <a href="{Tools::baseUrl()}catalog/psychotropic" class="btn btn-block btn-primary">Psicotrópicos</a>
   </div>
</div>
<div class="row mt-2">
   {foreach from=$products item=$p}

      <div class="col-3">
         <form class="formCart" method="post" target="{Tools::baseUrl()}cart/add">
            <div class="card card-navy card-outline">
               <img src="{Storage::get('products',$p['id_product'],$p['img_name'])}" class="card-img-top">
               <div class="card-body" style="padding: 1em .5em;">
                  <h7 style="font-size: .9em;"><b>{$p['name']}</b></h7><br>
                  <h7 class="text-bold">{Tools::moneyFormat($p['price'])}</h7>
                  <h7 class="text-success text-bold">{Tools::moneyFormat($p['price_usd'],'USD')}</h7>
                  {* <script>
                     updateStock()
                  </script>
                  <p id="updateStock" type="L" target="{Tools::baseUrl()}cart/stock" product="{$p['id_product']}"></p> *}
                  <p class="text-xs">Existencia: {round($p['current_stock'])}</p>
                  <div class="row d-flex justify-content-center">
                     <div class="col-8 mb-2">
                        <input type="number" id="cls" name="quantity" class="form-control form-control-sm">
                     </div>
                  </div>
                  <div class="row d-flex justify-content-center">
                     <input type="hidden" name="product" value="{$p['id_product']}"">
                     <button type=" submit" class="btn btn-primary btn-sm">
                  <span class="fas fa-shopping-cart mr-1"></span>Añadir al
                     Carrito
                     </button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   {/foreach}
</div>