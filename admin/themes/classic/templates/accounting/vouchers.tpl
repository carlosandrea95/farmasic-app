<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body">
            <table id="example1" class="table table-bordered table-sm table-striped dataTable dtr-inline"
               aria-describedby="example1_info">
               <thead class="bg-gray">
                  <tr>
                     <th class="text-center">
                        ID</th>
                     <th class="text-center col-1">FECHA</th>
                     <th class="text-center col-3">TIPO</th>
                     <th class="text-center">NUMERO</th>
                     <th class="text-center col-3">OBSERVACIONES</th>
                     <th class="text-center">ESTADO</th>
                     <th class="text-center">Opciones</th>
                  </tr>
               </thead>
               <tbody>
                  {foreach from=$vouchers item=$v}
                     <tr>
                        <td class="text-center">{$v.id_voucher}</td>
                        <td class="text-center">{$v.date}</td>
                        <td class="text-left">{$v.name}</td>
                        <td class="text-center">{$v.code}-{$v.number}</td>
                        <td class="text-left">{$v.observations}</td>
                        <td class="text-center">{$v.state}</td>
                        <td class="text-center">
                           <a href="{Tools::baseUrl()}?controller=AdminAccounting&action=voucher&id={$v.id_voucher}&token={Tools::getValue('token')}"
                              class="
                              btn btn-xs">
                              <i class="fas fa-edit"></i>
                           </a>
                           <a href="{$urls.base}/product/delete/{$v.id_voucher}" class="btn btn-xs">
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