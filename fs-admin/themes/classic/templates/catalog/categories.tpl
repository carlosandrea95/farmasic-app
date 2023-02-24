<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body p-1">
            <table id="example1" class="table table-bordered table-sm table-striped dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead class="bg-gray">
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center col-1">IMAGEN</th>
                     <th>NOMBRE</th>
                     <th class="text-center col-1">OPCIONES</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$categories item=$cat}
                     <tr>
                        <td class="text-right">{$cat.id_categories}</td>
                        <td class="text-center"><img src="{$urls.categories}{$cat.img}" style="width: 70px;height: 70px;">
                        </td>
                        <td>{$cat.name}</td>
                        <td class="text-center ">
                           <a href="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={$cat.id_categories}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fas fa-edit text-primary"></i>
                           </a><a
                              href="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={$cat.id_categories}&token={Tools::getValue('token')}"
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