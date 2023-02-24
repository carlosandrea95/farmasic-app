<div class="card">
   <div class="card-header">
      <h3 class="card-title mt-1"><span class="fas fa-file-alt"></span> Solicitud # {$request['id_stock_request']}</h3>
      <div class="card-tools">
         <button id="StockRequestApprove" onclick="approve_request()"
            target="{Tools::baseUrl()}?controller=AdminWarehouse&action=view_request&id={Tools::getValue('id')}&token={Tools::getValue('token')}"
            class="btn btn-sm btn-primary" {if ($request['op_status']!='P')}disabled{/if}><span
               class="fas fa-check-circle"></span>
            APROBAR</button>

         <button id="StockRequestDecline" onclick="decline_request()"
            target="{Tools::baseUrl()}?controller=AdminWarehouse&action=view_request&id={Tools::getValue('id')}&token={Tools::getValue('token')}"
            class="btn btn-sm btn-danger" {if ($request['op_status']!='P')}disabled{/if}><span
               class="fas fa-times-circle"></span>
            RECHAZAR</button>
      </div>
   </div>
   <div class="card-body">
      <table class="table table-bordered table-sm table-striped dtr-inline no-footer dataTable">
         <thead class="bg-gray">
            <tr class="text-center">
               <th>#</th>
               <th>UBICACIÓN</th>
               <th>PRODUCTO</th>
               <th>CANTIDAD</th>
            </tr>
         </thead>
         <tbody>
            {foreach from=$details item=$d}
               <tr>
                  <td>{$d['num_row']}</td>
                  <td>{$d['warehouse']}</td>
                  <td>{$d['product']}</td>
                  <td>{$d['quantity']}</td>
               </tr>
            {/foreach}
         </tbody>
      </table>
   </div>
</div>