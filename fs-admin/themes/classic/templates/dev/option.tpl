<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body table-responsive p-1">
            <table id="example1" class="table table-bordered table-sm table-striped dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead class="bg-gray">
                  <tr>
                     <th class="col-sm-1 text-right">
                        ID</th>
                     <th>NOMBRE</th>
                     <th class="col-sm-1">OPCIONES</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$options item=$op}
                     <tr>
                        <td class="text-right">{$op.id}</td>
                        <td class="text-center">
                           {$op.name}
                        </td>
                        <td class="text-center">
                           <a href="{Tools::baseUrl()}?controller=AdminDev&action=edit_options&id={$op.id}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fa fa-pencil"></i>
                           </a>
                           <a href="{Tools::baseUrl()}?controller=AdminDev&action=del_options&id={$op.id}&token={Tools::getValue('token')}"
                              class="btn btn-xs">
                              <i class="fas fa-trash"></i>
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

<script>
   $(document).ready(function() {
      $('#example1').DataTable({
         "language": {
            "url": "{$urls.assets}/plugins/datatables/lang/es.json",
         },
         responsive: true

      });
   });
</script>