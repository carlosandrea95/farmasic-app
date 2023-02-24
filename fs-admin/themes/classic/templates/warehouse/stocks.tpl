<div class="row">
   <div class="card col-12">
      <div class="card-header">
         <h3 class="card-title"><span class="fas fa-cogs"></span> Solicitud de Actualización de Existencia</h3>
      </div>
      <div class="card-body">
         <form target="{$target}" id="addNewStockRequestLine">
            <div class="row">
               <div class="col-8 form-group">
                  <label for="">ALMACEN</label>
                  <select name="warehouse" class="form-control select2" id="warehouse" tabindex="-1" aria-hidden="true"
                     data-select2-id="warehouse">
                     {foreach from=$warehouses item=$w}
                        <option value="{$w['id_warehouse']}">{$w['warehouse']}</option>
                     {/foreach}
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-8 form-group">
                  <label for="">PRDUCTO</label>
                  <select name="product" class="form-control select2" id="product" tabindex="-1" aria-hidden="true"
                     data-select2-id="product">
                     {foreach from=$products item=$p}
                        <option value="{$p['id_product']}">#{$p['id_product']} - {$p['name']}</option>
                     {/foreach}
                  </select>
               </div>
               <div class="col-3 form-group">
                  <label for="">Cantidad</label>
                  <input id="stockQuantity" name="quantity" type="text" class="form-control">
               </div>
               <div class="col-1 form-group d-flex justify-content-end align-items-end">
                  <input type="hidden" name="id" value="{Tools::getValue('id')}">
                  <button onclick="addNewStockRequestLine()" class="btn btn-primary">AGREGAR</button>
               </div>
            </div>
         </form>
         <div class="row">
            <div class="col-12">
               <table id="StockRequestLines" target="{$target}"
                  class="table table-bordered table-sm table-striped dtr-inline no-footer dataTable">
                  <thead class="bg-gray">
                     <tr class="text-center">
                        <th class="">#</th>
                        <th class="col-4">UBICACIÓN</th>
                        <th class="col-4">PRODUCTO</th>
                        <th class="col-4">CANTIDAD</th>
                        <th class="">OPCIONES</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="row d-flex justify-content-end">
         <div class="col-2 form-group">
            <button onclick="sendStockRequest({Tools::getValue('id')})"
               class="btn btn-block btn-primary">GUARDAR</button>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="card">
   </div>
</div>