<form id="ProductForm" method="POST" enctype="multipart/form-data">
   <form class="form-ajax"
      target="{Tools::baseUrl()}?controller=AdminCatalog&action=product&id={Tools::getValue('id')}&token={Tools::getValue('token')}"
      method="POST" enctype="multipart/form-data">
      <div class="row mb-3 mt-0">
         <div class="col-8">
            <input id="productNameField" onfocusout="CallProductNameField({Tools::getValue('id')})"
               style="text-transform:uppercase" type="text" class="form-control form-control-lg"
               placeholder="Nombre del Producto" value="{if isset($data['name'])}{$data['name']}{/if}" name="name">
         </div>
         <div class="col-2 pr-0 d-flex justify-content-end">
            <div class="row">
               <div class="d-flex align-items-center mr-1">
                  <label for="">ACTIVO</label>
               </div>
               <div class="d-flex align-items-center mr-1">
                  <div class="custom-control custom-switch custom-switch-lg">
                     <input name="is_active" onchange="changeStatusWithAJAX(this,{Tools::getValue('id')})"
                        {if isset($data['is_active']) && $data['is_active']=='1'} checked='' {/if}" type="checkbox"
                        class="custom-control-input" id="customSwitch8">
                     <label class="custom-control-label" for="customSwitch8"></label>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-2 d-flex justify-content-end">
            <a type="button" onclick="history.back()" class="btn btn-default mr-2"><span class="fas fa-times"></span>
               Cancelar</a>
            <button type="submit" onclick="saveProduct()" class="btn btn-primary"><span class="fas fa-save"></span>
               Guardar</button>
         </div>
      </div>
      <div class="card card-navy card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#basica-tab"
                     role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">BÁSICA</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                     href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                     aria-selected="false">EXISTENCIAS</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                     href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                     aria-selected="false">PRECIOS</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                     href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings"
                     aria-selected="false">ADICIONAL</a>
               </li>
            </ul>
         </div>
         <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
               <div class="tab-pane fade active show" id="basica-tab" role="tabpanel">
                  <div class="row">
                     <div class="col-4">
                        <div class="row">
                           <a href="{(!empty($data['img_name'])) ?
                                 Storage::get('products',Tools::getValue('id'),$data['img_name']):
                                 '#'}" {(!empty($data['img_name'])) ? 'target="_blank"' :''} id=ProductDisplayLINK">
                              <img id="ProductDisplayIMG" src="{(!empty($data['img_name'])) ?
                                 Storage::get('products',Tools::getValue('id'),$data['img_name']):
                                 Storage::empty()}" class="figure-img img-thumbnail img img-fluid">
                           </a>

                        </div>
                        <div class="row">
                           <input id="ProductInputIMG" type="file" class="form-control-file form-control-sm p-0 mt-3"
                              name="img" placeholder="" accept="images/*">
                        </div>
                        <div class="row mt-1">
                           <button type="button" id="removeIMGButton" onclick="removeProductIMG()"
                              class="btn btn-sm btn-danger mr-1" {if !empty($data['img_name'])}style="diplay:block"
                              {else}style="display:none" 
                              {/if}><span class="fas fa-trash"></span></button>
                           <button type="submit" onclick="uploadProductIMG()" class="btn btn-sm btn-primary">Cargar
                              Imagen</button>
                        </div>
                     </div>
                     <div class="col-7">
                        <div class="row">
                           <div class="form-group col-3">
                              <label for="id">ID</label>
                              <input type="text" id="id" class="form-control form-control-sm" name="id"
                                 value="{Tools::getValue('id')}" readonly>
                           </div>
                           <div class="form-group col-3">
                              <label for="code">CÓDIGO</label>
                              <input type="text" id="code" class="form-control form-control-sm" name="code"
                                 value="{if isset($data['code'])}{$data['code']}{/if}">
                           </div>
                           <div class="form-group col-3">
                              <label for="code">CÓDIGO DE BARRAS</label>
                              <input type="text" id="code" class="form-control form-control-sm" name="barcode"
                                 value="{if isset($data['bar_code'])}{$data['bar_code']}{/if}">
                           </div>
                           <div class="form-group col-3">
                              <label for="code">REFERENCIA</label>
                              <input type="text" id="code" class="form-control form-control-sm" name="reference"
                                 value="{if isset($data['ref'])}{$data['ref']}{/if}">
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-6">
                              <label for="code">DESTACAR</label>
                              <select name="is_featured" class="form-control form-control-sm select2" id="featured">
                                 <option value="-1"></option>
                                 {if Isset($data['is_featured']) && $data['is_featured']==0}
                                    <option value="0" selected="selected">No</option>
                                    <option value="1">Si</option>
                                 {elseif Isset($data['is_featured']) && $data['is_featured']==1}
                                    <option value="1" selected="selected">Si</option>
                                    <option value="0">No</option>
                                 {else}
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                 {/if}
                              </select>
                           </div>
                           <div class="form-group col-6">
                              <label for="code">REGULADO</label>
                              <select name="is_regulated" class="form-control form-control-sm select2" id="regulated">
                                 <option value="-1"></option>
                                 {if Isset($data['is_regulated']) && $data['is_regulated']==0}
                                    <option value="0" selected="selected">No</option>
                                    <option value="1">Si</option>
                                 {elseif Isset($data['is_regulated']) && $data['is_regulated']==1}
                                    <option value="1" selected="selected">Si</option>
                                    <option value="0">No</option>
                                 {else}
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                 {/if}
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="code">PRINCIPIO ACTIVO</label>
                           <select name="active" class="form-control form-control-sm select2" id="active">
                              {foreach from=$actives item=$a}
                                 <option value="-1"></option>
                                 {if Isset($data['id_active_compound']) && $data['id_active_compound']==$a['id_active_compound']}
                                    <option value="{$a['id_active_compound']}" selected="selected">{$a['name']}</option>
                                 {else}
                                    <option value="{$a['id_active_compound']}">{$a['name']}</option>
                                 {/if}
                              {/foreach}
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="code">ORIGEN</label>
                           <select name="origin" class="form-control form-control-sm select2" id="origin">
                              <option value="-1"></option>
                              {if Isset($data['origin']) && $data['origin']=='NACIONAL'}
                                 <option value="NACIONAL" selected="selected">NACIONAL</option>
                                 <option value="IMPORTADO">IMPORTADO</option>
                              {elseif Isset($data['origin']) && $data['origin']=='IMPORTADO'}
                                 <option value="IMPORTADO" selected="selected">IMPORTADO</option>
                                 <option value="NACIONAL">NACIONAL</option>
                              {else}
                                 <option value="NACIONAL">NACIONAL</option>
                                 <option value="IMPORTADO">IMPORTADO</option>
                              {/if}
                           </select>
                        </div>
                        <div class="row">
                           <div class="form-group col-6">
                              <label for="code">CATEGORIA</label>
                              <select name="category" class="form-control form-control-sm select2" id="category">
                                 {foreach from=$categories item=$c}
                                    <option value="-1"></option>
                                    {if Isset($data['id_category']) && $data['id_category']==$c['id_category']}
                                       <option value="{$c['id_category']}" selected="selected">{$c['name']}</option>
                                    {else}
                                       <option value="{$c['id_category']}">{$c['name']}</option>
                                    {/if}
                                 {/foreach}
                              </select>
                           </div>
                           <div class="form-group col-6">
                              <label for="code">MARCA</label>
                              <select name="brand" class="form-control form-control-sm select2" id="brand">
                                 {foreach from=$brands item=$b}
                                    <option value="-1"></option>
                                    {if Isset($data['id_brand']) && $data['id_brand']==$b['id_brand']}
                                       <option value="{$b['id_brand']}" selected="selected">{$b['name']}</option>
                                    {else}
                                       <option value="{$b['id_brand']}">{$b['name']}</option>
                                    {/if}
                                 {/foreach}
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="description">DESCRICIÓN</label>
                           <textarea name="description" id="description" class="form-control form-control-sm" cols="30"
                              rows="2" style="resize: none;"
                              value="{if isset($data['description'])}{$data['description']}{/if}"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                  </div>
               </div>
               <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                  aria-labelledby="custom-tabs-four-profile-tab">
                  <div class="row">
                     <h4>Existencias</h4>
                  </div>
                  <div class="row">
                     <div class="col-3 form-group"><label for="">CANTIDAD</label><input id="quantity" name="quantity"
                           type="text" class="form-control form-control-sm">
                     </div>
                     <div class="col-7 form-group">
                        <label for="">UBICACIÓN</label>
                        <select name="warehouse" class="form-control form-control-sm select2" style="width: 100%;"
                           id="warehouse">
                           {foreach from=$locations item=$l}
                              <option value="-1"></option>
                              {if Isset($data['id_warehouse']) && $data['id_warehouse']==$l['id_warehouse']}
                                 <option value="{$l['id_warehouse']}" selected="selected">{$l['warehouse']}</option>
                              {else}
                                 <option value="{$l['id_warehouse']}">{$l['warehouse']}</option>
                              {/if}
                           {/foreach}
                        </select>
                     </div>
                     <div class="col-2 d-flex align-items-center mt-1">
                        <button type="button" onclick="updateProductStock()" class="btn btn-primary">ACTUALIZAR</button>
                     </div>
                  </div>
                  <table id="fetchProductStock" class="table table-bordered table-sm table-striped dtr-inline"">
                     <thead  class=" bg-gray">
                     <tr>
                        <th class="text-center">#</th>
                        <th class="text-center col-6">UBICACIÓN</th>
                        <th class="text-center col-6">CANTIDAD</th>
                        <th class="text-center col-1">OPCIONES</th>
                     </tr>
                     </thead>
                     <tbody>
                        {foreach from=$stocks item=$s}
                        <tr>
                           <td>{$s['num_row']}</td>
                           <td>{$s['warehouse']}</td>
                           <td>{$s['current_stock']}</td>
                           <td class="col-1"><a class="btn btn-xs btn-default"
                                 onclick="prepareUpdateProductStock({$s['id_warehouse']},{$s['current_stock']},{$s['id_stock']})"><span
                                    class="fas fa-pencil"></span></a></td>
                        </tr>
                        {/foreach}
                     </tbody>
                  </table>
               </div>
               <div class=" tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                  aria-labelledby="custom-tabs-four-messages-tab">
                  <div class="row">
                     <h4>Precio de Venta</h4>
                  </div>
                  <div class="row">
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO DIVISA</label><input
                           name="price_usd" type="text" class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_usd'])}{$data['price_usd']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO</label><input readonly name="price"
                           type="text" class="form-control form-control-sm mt-0 money-bs"
                           value="{if isset($data['price'])}{str_replace('.',',',$data['price'])}{/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO SUGERIDO DIVISA</label><input
                           readonly name="price_suggested_usd" type="text"
                           class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_suggested_usd'])}{$data['price_suggested_usd']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO SUGERIDO</label><input readonly
                           name="price_suggested" type="text" class="form-control form-control-sm mt-0 money-bs" value="{if isset($data['price_suggested'])}
                                         {str_replace('.',',',$data['price_suggested'])}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO NETO DIVISA</label><input readonly
                           name="net_price_usd" type="text" class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_unit'])}{$data['net_price_usd']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO NETO</label><input name="net_price"
                           readonly type="text" class="form-control form-control-sm mt-0 money-bs" value="{if isset($data['price_suggested'])}
                                         {str_replace('.',',',$data['net_price'])}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO UNITARIO DIVISA</label><input
                           readonly name="price_unit" type="text" class="form-control form-control-sm mt-0 money-usd"
                           value="{if isset($data['price_unit'])}{$data['price_unit']}
                                      {/if}">
                     </div>
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO UNITARIO</label><input readonly
                           name="price_unit_usd" type="text" class="form-control form-control-sm mt-0 money-bs" value="{if isset($data['price_unit_usd'])}
                                         {str_replace('.',',',$data['price_unit_usd'])}
                                      {/if}">
                     </div>
                  </div>
                  <div class="row">
                     <h4>Precio de Coste</h4>
                  </div>
                  <div class="row">
                     <div class="col-3 form-group"><label class="mb-1" for="">PRECIO DIVISA</label><input
                           name="price_cost" type="text" class="form-control form-control-sm mt-0 money-usd" value="{if isset($data['price_cost'])}{$data['price_cost']}
                                      {/if}">
                     </div>
                     <div class="col-2 form-group"><label class="mb-1" for="">FACTOR DE BENEFICIO</label><input
                           name="profit_margin" type="text" class="form-control form-control-sm mt-0 percentage" value="{if isset($data['profit_margin'])}
                                         {str_replace('.',',',$data['profit_margin'])}
                                      {/if}">
                        </div>
                        <div class="col-4 form-group">
                           <label class="mb-1" for="">DESCUENTO APLICABLE</label>
                           <select name="discount" class="form-control mt-0 select2 form-control-sm" style="width: 100%;"
                              id="discont">










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
                              id="tax">










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
                        <h4>Facturación</h4>
                     </div>
                     <div class="row">
                        <div class="col-4 form-group"><label class="mb-1" for="">UNIDADES MINIMAS DE
                              FACTURACIÓN</label><input name="min_sell" type="text"
                              class="form-control form-control-sm mt-0" value="
                                                                    {if isset($data['min_sell'])}{$data['min_sell']}
                                                                    {/if}">
                     </div>
                     <div class="col-4 form-group"><label class="mb-1" for="">UNIDADES MAXIMAS DE
                           FACTURACIÓN</label><input name="max_sell" type="text"
                           class="form-control form-control-sm mt-0" value="
                                                                    {if isset($data['max_sell'])}{$data['max_sell']}
                                                                    {/if}">
                     </div>
                     <div class="col-4 form-group"><label class="mb-1" for="">UNIDAD MULTIPLO DE
                           FACTURACIÓN</label><input name="multiple_sell" type="text"
                           class="form-control form-control-sm mt-0" value="
                                                                    {if isset($data['multiple_sell'])}{$data['multiple_sell']}
                                                                                               {/if}">
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                           aria-labelledby="custom-tabs-four-settings-tab">
                           <div class="row">
                              <h4>Adicional</h4>
                           </div>
                           <div class="row">
                              <div class="form-group col-5">
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
                              <div class="col-3 form-group"><label for="">NUMERO DE LOTE</label><input type="text" name="lot"
                                    class="form-control form-control-sm"
                                    value="
                                                                                                                          {if isset($data['lot'])}{$data['lot']}
                                                                                                                          {/if}">
                     </div>
                     <div class="col-2 form-group"><label for="">CODISB</label><input type="text" name="codisb"
                           class="form-control form-control-sm"
                           value="
                                                                                                                          {if isset($data['codisb'])}{$data['codisb']}
                                                                                                                          {/if}">
                     </div>
                     <div class="col-2 form-group"><label for="">UNIDADES POR EMPAQUE</label><input name="per_pack"
                           type="text" class="form-control form-control-sm"
                           value="
                                                                                                                          {if isset($data['units_per_pack'])}{$data['units_per_pack']}
                                                                                                                          {/if}">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-6 form-group"><label for="">DESCRIPCIÓN CORTA</label><input name="short_desc"
                           type="text" class="form-control form-control-sm"
                           value="
                                                                                                                          {if isset($data['short_description'])}{$data['short_description']}
                                                                                                                          {/if}">
                     </div>
                     <div class="col-3 form-group"><label for="">FECHA CREACIÓN</label><input type="text" readonly
                           name="date" class="form-control form-control-sm"
                           value="
                                                                                                                          {if isset($data['created_at'])}{$data['created_at']}
                                                                                                                          {/if}">
                     </div>
                     <div class="col-3 form-group"><label for="">VENCIMIENTO</label><input name="expire" type="date"
                           class="form-control form-control-sm"
                           value="
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
                     <div class="col-3 form-group"><label for="">Peso</label><input type="text" class="form-control">
                     </div>
                     <div class="col-3 form-group"><label for="">Anchura</label><input type="text" class="form-control">
                     </div>
                     <div class="col-3 form-group"><label for="">Altura</label><input type="text" class="form-control">
                     </div>
                     <div class="col-3 form-group"><label for="">Profundidad</label><input type="text"
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