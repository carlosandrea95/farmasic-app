<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body table-responsive p-1">
            <table id="example1" class="table table-bordered table-sm table-striped dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead class="bg-gray">
                  <tr>
                     <th class="text-center">
                        ID</th>
                     <th class="text-center col-sm-1">IMAGEN</th>
                     <th class="col-sm-3">NOMBRE</th>
                     <th class="text-center">Codigo</th>
                     <th class="text-center">Categoria</th>
                     <th class="text-center">Precio</th>
                     <th class="text-center">Existencia</th>
                     <th class="text-center">Estado</th>
                     <th>Codigo</th>
                     <th class="text-center">Opciones</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$products item=$prod}
                     <tr>
                        <td class="text-right">{$prod.id_product}</td>
                        <td class="text-center"><img src="{$urls.products}{$prod.img_name}"
                              style="width: 70px;height: 70px;">
                        </td>
                        <td>{$prod.name}</td>
                        <td class="text-center">
                           {$prod.code}
                        </td>
                        <td class="text-center">{$prod.category}</td>
                        <td class="text-right">{$prod.price} Bs.<br> <span class="text-success">{$prod.price_usd}</span>
                           USD</td>
                        <td class="text-right">{$prod.current_stock}</td>
                        {* <td class="text-center">{$prod.is_active}</td> *}
                        <td>{$prod.code}</td>
                        <td class="text-center">
                           <a href="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={$prod.id_product}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fas fa-edit"></i>
                           </a>
                           <a href="{$urls.base}/product/delete/{$prod.id_product}" class="btn btn-xs">
                              <i class="fas fa-trash"></i>
                           </a>
                        </td>
                     </tr>
                  {/foreach}
                  {* <tr>
                     <td>
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                           <label class="form-check-label text-right" for="flexCheckDefault">
                              1
                           </label>
                        </div>
                     </td>
                  </tr> *}
                  {* {foreach from=$products item=$prod}
                     <tr>
                        <td class="text-right">{$cat.id_categories}</td>
                        <td><img src="{$urls.assets}/img/user3-128x128.jpg" style="width: 70px;height: 70px;"></td>
                        <td>{$cat.name}</td>
                        <td class="text-center ">
                           <a href="{$cat.id_categories}" class="btn btn-xs btn-default"><i class="fas fa-pencil"></i></a>
                           <a href="{$cat.id_categories}" class="btn btn-xs btn-default"><i class="fas fa-trash"></i></a>
                        </td>
                     </tr>
                  {/foreach} *}
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
"url": "{$urls.assets}/plugins/datatables/lang/es.json",
         },
         responsive: true

      });
   });
</script> *}