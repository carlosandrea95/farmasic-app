<div class="row">
   <div class="card col-12">
      <div class="card-header">
         <h3 class="card-title"><span class="fas fa-file-alt mr-1"></span>Gestión de Orden de Compra</h3>
         <div class="card-tools">
            <span
               style="font-size: 1rem;{if isset($data['amount']) && !empty($data['amount'])}display:block{else}display:none{/if}"
               id="ShoppingOrderTotals" class="ml-1 badge badge-dark">{Tools::moneyFormat($data['amount'],'BS')}
               {Tools::moneyFormat($data['amount_usd'],'USD')}</span>
         </div>
      </div>
      <div class="card-body m-0">
         <div class="row">
            <div class="col-2 form-group">
               <label for="">NUMERO DE ORDEN</label>
               <input {if Tools::getValue('preview')==true}disabled="disabled" {/if} type="text"
                  class="form-control form-control-sm" disabled value="{Tools::getValue('id')}">
            </div>
            <div class="col-6 form-group">
               <label for="">PROVEEDOR</label>
               <select name="supplier" class="form-control form-control-sm select2" onchange="validOrder()"
                  id="supplier" tabindex="-1" aria-hidden="true" data-select2-id="supplier"
                  {if Tools::getValue('preview')==true}disabled="disabled" {/if}>
                  {foreach from=$suppliers item=$s}
                     <option value="-1"></option>
                     {if Isset($data['id_supplier']) && $data['id_supplier']==$s['id_entity']}
                        <option value="{$s['id_entity']}" selected="selected">{$s['company_name']}</option>
                     {else}
                        <option value="{$s['id_entity']}">{$s['company_name']}</option>
                     {/if}
                  {/foreach}
               </select>
            </div>
            <div class="col-2 form-group">
               <label for="">TASA DE CAMBIO</label>
               <input {if Tools::getValue('preview')==true}disabled="disabled" {/if} type="text" name="rate"
                  id="exchangeRate" onfocusout="UpdateRate()" class="form-control form-control-sm money-bs"
                  value="{if isset($data['exchange_rate'])}{str_replace('.',',',$data['exchange_rate'])}{/if}">
            </div>
            <div class="col-2 form-group">
               <label for="">FECHA</label>
               <input {if Tools::getValue('preview')==true}disabled="disabled" {/if} type="date"
                  class="form-control form-control-sm" readonly value="{$date}">
            </div>
         </div>
         <form id="ShoppingOrderForm">
            <div class="row">
               <div class="col-4 form-group">
                  <label for="">ALMACEN</label>
                  <select name="warehouse" class="form-control form-control-sm select2" id="warehouse" tabindex="-1"
                     aria-hidden="true" data-select2-id="warehouse"
                     {if Tools::getValue('preview')==true}disabled="disabled" {/if}>
                     {foreach from=$warehouses item=$w}
                        <option value="-1"></option>
                        <option value="{$w['id_warehouse']}">{$w['warehouse']}</option>
                     {/foreach}
                  </select>
               </div>
               <div class="col-5 form-group">
                  <label for="">PRODUCTO</label>
                  <select name="product" class="form-control form-control-sm select2" id="product" tabindex="-1"
                     aria-hidden="true" data-select2-id="product"
                     {if Tools::getValue('preview')==true}disabled="disabled" {/if}>
                     {foreach from=$products item=$p}
                        <option value="-1"></option>
                        <option value="{$p['id_product']}">#{$p['id_product']} - {$p['name']}</option>
                     {/foreach}
                  </select>
               </div>
               <div class="col-1 form-group">
                  <label for="">BENEFICIO</label>
                  <input {if Tools::getValue('preview')==true}disabled="disabled" {/if} id="profit" name="profit"
                     type="text" min="1" max="100" class="form-control form-control-sm percentage">
               </div>
               <div class="col-1 form-group">
                  <label for="">CANTIDAD</label>
                  <input {if Tools::getValue('preview')==true}disabled="disabled" {/if} id="stockQuantity"
                     name="quantity" type="text" class="form-control form-control-sm">
               </div>
               <div class="col-1 form-group d-flex justify-content-end align-items-end">
                  <button {if Tools::getValue('preview')==true}disabled="disabled" {/if} type="submit"
                     onclick="addNewShoppingOrderLine()" class="btn btn-primary">AGREGAR</button>
               </div>
            </div>
         </form>
         <div class="row">
            <div class="col-12">
               <table id="ShoppingDetails" class="table table-bordered table-sm table-striped dtr-inline no-footer">
                  <thead class="bg-gray">
                     <tr class="text-center">
                        <th class="">#</th>
                        <th class="col-4">UBICACIÓN</th>
                        <th class="col-4">PRODUCTO</th>
                        <th class="col-1">BENEFICIO</th>
                        <th class="col-1">CANTIDAD</th>
                        <th class="text-center col-2">SUBTOTAL</th>
                        <th class="">OPCIONES</th>
                     </tr>
                  </thead>
                  <tbody>
                     {foreach from=$details item=$d}
                        <tr>
                           <td class="text-center">{$d['num_row']}</td>
                           <td>{$d['warehouse']}</td>
                           <td>{$d['product']}</td>
                           <td class="text-center">{$d['profit_margin']}%</td>
                           <td class="text-center">{$d['quantity']}</td>
                           <td class="text-right">{Tools::moneyFormat($d['sub_bs'],'BS',false)}<br><span
                                 class="text-success">{Tools::moneyFormat($d['sub_usd'],'USD',false)}</span>
                           </td>
                           <td class="text-center">
                              <a class="btn btn-xs btn-default {if Tools::getValue('preview')==true}disabled
{/if}" onclick="removeShoppingOrderLine({$d['id']})">
                                 <span class="fas fa-trash"></span>
                              </a>
                           </td>
                        </tr>
                     {/foreach}
                  </tbody>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="col-12 form-group">
               <label for="">COMENTARIOS</label>
               <textarea {if Tools::getValue('preview')==true}disabled="disabled" {/if} name="comments"
                  class="form-control form-control-sm" id="comments" style="resize:none"
                  rows="3">{if isset($data['comments'])}{$data['comments']}{/if}</textarea>
            </div>
         </div>
      </div>
      <div class="row d-flex justify-content-end">
         <div class="col-2 form-group">
            <button {if Tools::getValue('preview')==true}disabled="disabled" {/if} type="button"
               onclick="sendShoppingOrder()" class="btn btn-block btn-primary">GUARDAR</button>
         </div>
      </div>
   </div>
</div>