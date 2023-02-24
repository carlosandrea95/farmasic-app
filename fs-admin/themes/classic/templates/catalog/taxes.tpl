<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body p-1">
            <table id="example1" class="table table-bordered table-sm table-striped dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead class="bg-gray">
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center">NOMBRE</th>
                     <th class="text-center">PORCENTAJE</th>
                     <th class="text-center col-1">OPCIONES</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$taxes item=$t}
                     <tr>
                        <td class="text-right">{$t.id_tax}</td>
                        <td>{$t.name}</td>
                        <td>{$t.rate}</td>
                        <td class="text-center ">
                           <a href="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={$t.id_tax}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fas fa-edit text-primary"></i>
                           </a><a
                              href="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={$t.id_tax}&token={Tools::getValue('token')}"
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