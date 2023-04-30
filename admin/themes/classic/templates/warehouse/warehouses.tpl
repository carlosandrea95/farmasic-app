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
                     <th class="text-center">EMPRESA</th>
                     <th class="text-center">NOMBRE</th>
                     <th class="text-center col-1">OPCIONES</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$warehouses item=$w}
                     <tr>
                        <td class="text-right">{$w.id_warehouse}</td>
                        <td>{$w.company}</td>
                        <td class="text-center">
                           {$w.warehouse}
                        </td>
                        <td class="text-center col-1">
                           <a href="{Tools::baseUrl()}?controller=AdminWarehouse&action=warehouse&id={$w.id_warehouse}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fas fa-pencil"></i>
                           </a>
                           <a href="{Tools::baseUrl()}?controller=AdminWarehouse&action=del_warehouse&id={$w.id_warehouse}&token={Tools::getValue('token')}"
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