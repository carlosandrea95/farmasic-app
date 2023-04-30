<form id="ProductForm" method="POST" enctype="multipart/form-data">
   <form class="form-ajax"
      target="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={Tools::getValue('id')}&token={Tools::getValue('token')}"
      method="POST" enctype="multipart/form-data">
      <div class="row mb-3 mt-0">
         <div class="col-9">
            <input readonly style="text-transform:uppercase" type="text" class="form-control form-control-lg" readonly
               value="{if isset($data['name'])}{$data['name']}{/if}" name="name">
         </div>
         <div class="col-2 pr-0 d-flex justify-content-end">
            <div class="row">

            </div>
         </div>
         <div class="col-1 d-flex justify-content-end">
            <a type="button" onclick="history.back()" class="btn btn-default mr-2"><span class="fas fa-times"></span>
               Cancelar</a>
            {* <button type="submit" onclick="saveProduct()" class="btn btn-primary"><span class="fas fa-save"></span>
               Guardar</button> *}
         </div>
      </div>
      <div class="card card-navy card-outline">
         <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
               <div class="tab-pane fade active show" id="basica-tab" role="tabpanel">
                  <div class="row">
                     <div class="col-4 pr-3">
                        <div class="row">
                           <a href="{IMG_URI}{if isset($data['img_name'])}p/{$data['img_name']}{else}empty.png{/if}"
                              target="_blank">
                              <img id="ProductDisplayIMG" baseUrl="{IMG_URI}"
                                 src="{IMG_URI}{if isset($data['img_name'])}p/{$data['img_name']}{else}empty.png{/if}"
                                 class="figure-img img-thumbnail img img-fluid">
                           </a>
                        </div>
                     </div>
                     <div class="col-7">
                        <div class="row">
                           <h4>Información General</h4>
                        </div>
                        <div class="row">
                           <div class="form-group col-3">
                              <label for="id">ID</label>
                              <input readonly type="text" id="id" class="form-control form-control-sm" name="id"
                                 value="{Tools::getValue('id')}">
                           </div>
                           <div class="form-group col-3">
                              <label for="code">CÓDIGO</label>
                              <input readonly type="text" id="code" class="form-control form-control-sm" name="code"
                                 value="{if isset($data['code'])}{$data['code']}{/if}">
                           </div>
                           <div class="form-group col-3">
                              <label for="code">CÓDIGO DE BARRAS</label>
                              <input readonly type="text" id="code" class="form-control form-control-sm" name="barcode"
                                 value="{if isset($data['bar_code'])}{$data['bar_code']}{/if}">
                           </div>
                           <div class="form-group col-3">
                              <label for="code">REFERENCIA</label>
                              <input readonly type="text" id="code" class="form-control form-control-sm"
                                 name="reference" value="{if isset($data['ref'])}{$data['ref']}{/if}">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-6">
                              <label for="code">DESTACAR</label>
                              <input readonly type="text" id="code" class="form-control form-control-sm"
                                 value="{if $data['is_featured']==1}SI{else}NO{/if}">

                           </div>
                           <div class="form-group col-6">
                              <label for="code">REGULADO</label>
                              <input readonly type="text" id="code" class="form-control form-control-sm"
                                 value="{if $data['is_regulated']==1}SI{else}NO{/if}">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-6">
                              <label for="code">PRINCIPIO ACTIVO</label>
                              {* <pre>
                              {print_r($actives)}
                              </pre> *}
                              {foreach from=$actives item=$a}
                                 {if Isset($data['id_active_compound']) && $data['id_active_compound']==$a['id_active_compound']}
                                    <input readonly type="text" id="code" class="form-control form-control-sm"
                                       value="{$a['name']}">
                                 {else}
                                    <input readonly type="text" id="code" class="form-control form-control-sm">
                                 {/if}
                              {/foreach}
                           </div>
                           <div class="form-group col-6">
                              <label for="code">ORIGEN</label>
                              {foreach from=$actives item=$a}
                                 {if Isset($data['id_active_compound']) && $data['id_active_compound']==$a['id_active_compound']}
                                    <input readonly type="text" id="code" class="form-control form-control-sm"
                                       value="{$a['name']}">
                                 {/if}
                              {/foreach}
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-6">
                              <label for="code">CATEGORIA</label>
                              {foreach from=$categories item=$c}
                                 {if Isset($data['id_category']) && $data['id_category']==$c['id_category']}
                                    <input readonly type="text" id="code" class="form-control form-control-sm"
                                       value="{$c['name']}">
                                 {/if}
                              {/foreach}
                           </div>
                           <div class="form-group col-6">
                              <label for="code">MARCA</label>
                              {foreach from=$brands item=$b}
                                 {if Isset($data['id_brand']) && $data['id_brand']==$b['id_brand']}
                                    <input readonly type="text" id="code" class="form-control form-control-sm"
                                       value="{$b['name']}">
                                 {/if}
                              {/foreach}
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="description">DESCRICIÓN</label>
                           <textarea readonly name="description" id="description" class="form-control form-control-sm"
                              cols="30" rows="2" style="resize: none;"
                              value="{if isset($data['description'])}{$data['description']}{/if}"></textarea>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="row">
                           <h4>Precio de Venta</h4>
                        </div>
                        <div class="row">
                           <div class="col-3 form-group"><label class="mb-1" for="">PRECIO DIVISA</label><input readonly
                                 name="price_usd" type="text" class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_usd'])}{$data['price_usd']}
                                      {/if}">
                           </div>
                           <div class="col-3 form-group"><label class="mb-1" for="">PRECIO</label><input readonly
                                 name="price" type="text" class="form-control form-control-sm mt-0 money-bs"
                                 value="{if isset($data['price'])}{str_replace('.',',',$data['price'])}{/if}">
                           </div>
                           <div class="col-3 form-group"><label class="mb-1" for="">PRECIO SUGERIDO DIVISA</label><input
                                 readonly name="price_suggested_usd" type="text"
                                 class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_suggested_usd'])}{$data['price_suggested_usd']}
                                      {/if}">
                           </div>
                           <div class="col-3 form-group"><label class="mb-1" for="">PRECIO SUGERIDO</label><input
                                 readonly name="price_suggested" type="text"
                                 class="form-control form-control-sm mt-0 money-bs" value="{if isset($data['price_suggested'])}
                                         {str_replace('.',',',$data['price_suggested'])}
                                      {/if}">
                           </div>
                        </div>
                        <div class="row">
                           <h4>Precio de Coste</h4>
                        </div>
                        <div class="row">
                           <div class="col-3 form-group"><label class="mb-1" for="">PRECIO DIVISA</label><input readonly
                                 name="price_cost" type="text" class="form-control form-control-sm mt-0 money-usd"
                                 value="{if isset($data['price_cost'])}{$data['price_cost']}
                                      {/if}">
                           </div>
                           <div class="col-2 form-group"><label class="mb-1" for="">FACTOR DE BENEFICIO</label><input
                                 readonly name="profit_margin" type="text"
                                 class="form-control form-control-sm mt-0 percentage" value="{if isset($data['profit_margin'])}
                                         {str_replace('.',',',$data['profit_margin'])}
                                      {/if}">
                           </div>
                           <div class="col-4 form-group">
                              <label class="mb-1" for="">DESCUENTO APLICABLE</label>
                              <select name="discount" class="form-control mt-0 select2 form-control-sm"
                                 disabled="disabled" style="width: 100%;" id="discont">
                                 {foreach from=$discounts item=$d}
                                    <option value="-1"></option>
                                    {if Isset($data['id_discount']) && $data['id_discount']==$d['id_discount']}
                                       <option value="{$d['id_discount']}" selected="selected">{$d['name']}</option>
                                    {else}
                                       <option value="{$d['id_discount']}">{$d['name']}</option>
                                    {/if}
                                 {/foreach}
                              </select>
                           </div>
                           <div class="col-3 form-group">
                              <label class="mb-1" for="">IMPUESTO</label>
                              <select name="tax" class="form-control mt-0 select2 form-control-sm" style="width: 100%;"
                                 disabled="disabled" id="tax">
                                 {foreach from=$taxes item=$t}
                                    <option value="-1"></option>
                                    {if Isset($data['id_tax']) && $data['id_tax']==$t['id_tax']}
                                       <option value="{$t['id_tax']}" selected="selected">{$t['name']}</option>
                                    {else}
                                       <option value="{$t['id_tax']}">{$t['name']}</option>
                                    {/if}
                                 {/foreach}
                              </select>
                           </div>
                        </div>
                        <div class="row">
                           <h4>Existencias</h4>
                        </div>
                        <div class="row">
                           <table class="table table-bordered table-sm table-striped dtr-inline"">
                              <thead  class=" bg-gray">
                              <tr>
                                 <th class="text-center">#</th>
                                 <th class="text-center col-6">UBICACIÓN</th>
                                 <th class="text-center col-6">CANTIDAD</th>
                              </tr>
                              </thead>
                              <tbody>                              
                                 {foreach from=$stocks item=$s}
                                 <tr>
                                    <td class="text-center">{$s['num_row']}</td>
                                    <td class="text-left">{$s['warehouse']}</td>
                                    <td class="text-right">{$s['current_stock']}</td>
                                 </tr>
                                 {/foreach}
                                 {(empty($stocks)) ? '<tr><td colspan="3" class="text-center">No hay datos</td></tr>' : ''}
                              </tbody>
                           </table>
                        </div>
                        <div class="row">
                           <h4>Movimientos</h4>
                        </div>
                        <div class="row">
                           <div class="col-3 form-group"><label class="mb-1" for="">ULTIMA COMPRA FECHA</label><input
                                 readonly name="price_usd" type="text"
                                 class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_usd'])}{$data['price_usd']}
                                      {/if}">
                           </div>
                           <div class="col-3 form-group"><label class="mb-1" for="">ULTIMA COMPRA CANTIDAD</label><input
                                 readonly name="price" type="text" class="form-control form-control-sm mt-0 money-bs"
                                 value="{if isset($data['price'])}{str_replace('.',',',$data['price'])}{/if}">
                           </div>
                           <div class="col-3 form-group"><label class="mb-1" for="">ULTIMA VENTA FECHA</label><input
                                 readonly name="price_usd" type="text"
                                 class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_usd'])}{$data['price_usd']}
                                      {/if}">
                           </div>
                           <div class="col-3 form-group"><label class="mb-1" for="">ULTIMA VENTA CANTIDAD</label><input
                                 readonly name="price" type="text" class="form-control form-control-sm mt-0 money-bs"
                                 value="{if isset($data['price'])}{str_replace('.',',',$data['price'])}{/if}">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class=" tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                  aria-labelledby="custom-tabs-four-messages-tab">
                  <div class="row">
                     <h4>Precio de Venta</h4>
                  </div>
                  <div class="row">
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO DIVISA</label><input readonly
                           name="price_usd" type="text" class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_usd'])}{$data['price_usd']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO</label><input readonly readonly
                           name="price" type="text" class="form-control form-control-sm mt-0 money-bs"
                           value="{if isset($data['price'])}{str_replace('.',',',$data['price'])}{/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO SUGERIDO DIVISA</label><input
                           readonly readonly name="price_suggested_usd" type="text"
                           class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_suggested_usd'])}{$data['price_suggested_usd']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO SUGERIDO</label><input readonly
                           readonly name="price_suggested" type="text"
                           class="form-control form-control-sm mt-0 money-bs" value="{if isset($data['price_suggested'])}
                                         {str_replace('.',',',$data['price_suggested'])}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO NETO DIVISA</label><input readonly
                           readonly name="net_price_usd" type="text" class="form-control form-control-sm mt-0 money-usd"
                           value="{if isset($data['price_unit'])}{$data['net_price_usd']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO NETO</label><input readonly
                           name="net_price" readonly type="text" class="form-control form-control-sm mt-0 money-bs"
                           value="{if isset($data['price_suggested'])}
                                         {str_replace('.',',',$data['net_price'])}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO UNITARIO DIVISA</label><input
                           readonly readonly name="price_unit" type="text"
                           class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_unit'])}{$data['price_unit']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO UNITARIO</label><input readonly
                           readonly name="price_unit_usd" type="text" class="form-control form-control-sm mt-0 money-bs"
                           value="{if isset($data['price_unit_usd'])}
                                         {str_replace('.',',',$data['price_unit_usd'])}
                                      {/if}">
                     </div>
                  </div>
                  <div class="row">
                     <h4>Precio de Coste</h4>
                  </div>

                  <div class="row">
                     <h4>Facturación</h4>
                  </div>
                  <div class="row">
                     <div class="col-4 form-group"><label class="mb-1" for="">UNIDADES MINIMAS DE
                           FACTURACIÓN</label><input readonly name="min_sell" type="text"
                           class="form-control form-control-sm mt-0"
                           value="{if isset($data['min_sell'])}{$data['min_sell']}{/if}">
                     </div>
                     <div class="col-4 form-group"><label class="mb-1" for="">UNIDADES MAXIMAS DE
                           FACTURACIÓN</label><input readonly name="max_sell" type="text"
                           class="form-control form-control-sm mt-0"
                           value="{if isset($data['max_sell'])}{$data['max_sell']}{/if}">
                     </div>
                     <div class="col-4 form-group"><label class="mb-1" for="">UNIDAD MULTIPLO DE
                           FACTURACIÓN</label><input readonly name="multiple_sell" type="text"
                           class="form-control form-control-sm mt-0"
                           value={if isset($data['multiple_sell'])}{$data['multiple_sell']}{/if}">
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                  aria-labelledby="custom-tabs-four-settings-tab">
                  <div class="row">
                     <h4>Adicional</h4>
                  </div>
                  <div class="row">
                     <div class="form-group col-7">
                        <label for="">PROVEEDOR</label>
                        <select class="form-control form-control-sm select2" style="width: 100%;" name="supplier"
                           id="supplier">








                           {foreach from=$suppliers item=$s}
                              <option value="-1"></option>








                              {if Isset($data['id_entity']) && $data['id_entity']==$s['id_entity']}
                                 <option value="{$s['id_entity']}" selected="selected">{$s['company_name']}</option>








                              {else}
                                 <option value="{$s['id_entity']}">{$s['company_name']}</option>








                              {/if}








                           {/foreach}
                        </select>
                     </div>
                     <div class="col-3 form-group"><label for="">CODISB</label><input readonly type="text" name="codisb"
                           class="form-control form-control-sm" value="
                                                                                                        {if isset($data['codisb'])}{$data['codisb']}
                                                                                                        {/if}">
                     </div>
                     <div class="col-2 form-group"><label for="">UNIDADES POR EMPAQUE</label><input readonly
                           name="per_pack" type="text" class="form-control form-control-sm" value="
                                                                                                        {if isset($data['units_per_pack'])}{$data['units_per_pack']}
                                                                                                        {/if}">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-6 form-group"><label for="">DESCRIPCIÓN CORTA</label><input readonly
                           name="short_desc" type="text" class="form-control form-control-sm" value="
                                                                                                        {if isset($data['short_description'])}{$data['short_description']}
                                                                                                        {/if}">
                     </div>
                     <div class="col-3 form-group"><label for="">FECHA CREACIÓN</label><input readonly type="text"
                           readonly name="date" class="form-control form-control-sm" value="
                                                                                                        {if isset($data['created_at'])}{$data['created_at']}
                                                                                                        {/if}">
                     </div>
                     <div class="col-3 form-group"><label for="">VENCIMIENTO</label><input readonly name="expire"
                           type="date" class="form-control form-control-sm" value="
                                                                                                        {if isset($data['expire_at'])}{$data['expire_at']}
                                                                                                        {/if}">
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="custom-tabs-five-aditionals" role="tabpanel"
                  aria-labelledby="custom-tabs-four-settings-tab">
                  <div class="row">
                     <h4>Dimenciones</h4>
                  </div>
                  <div class="row">
                     <div class="col-3 form-group"><label for="">Peso</label><input readonly type="text"
                           class="form-control">
                     </div>
                     <div class="col-3 form-group"><label for="">Anchura</label><input readonly type="text"
                           class="form-control">
                     </div>
                     <div class="col-3 form-group"><label for="">Altura</label><input readonly type="text"
                           class="form-control">
                     </div>
                     <div class="col-3 form-group"><label for="">Profundidad</label><input readonly type="text"
                           class="form-control">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
   <script>
      $(document).ready(function() {
         fetchProductStock();
      });
</script>