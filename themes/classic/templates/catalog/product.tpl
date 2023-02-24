<form
   action="{Tools::baseUrl()}{ADMIN_PATH}/?controller=AdminCatalog&action=product&id={$id}&token={Tools::getValue('token')}">

   <div class="row mb-3 mt-0">
      <div class="col-8">
         <input disabled type="text" class="form-control form-control-md" placeholder="Nombre del Producto"
            value="{if isset($data['name'])}{$data['name']}{/if}" name="name" disabled>
      </div>
      <div class="col-4 text-right">
         <a type="button"
            href="{Tools::baseUrl()}{ADMIN_PATH}/?controller=AdminCatalog&action=products&token={Tools::getValue('token')}"
            class="btn btn-default mr-2"><span class="fas fa-times"></span> Cancelar</a>
         <button type="button" onclick="save_product()" class="btn btn-primary"><span class="fas fa-save"></span>
            Guardar</button>
      </div>
   </div>
   <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-header p-0 border-bottom-0">
         <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#basica-tab"
                  role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">BÁSICA</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile"
                  role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">EXISTENCIAS</a>
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
            {* <li class="nav-item">
               <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                  href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-five-aditionals"
                  aria-selected="false">ADICIONAL</a>
            </li> *}
         </ul>
      </div>
      <div class="card-body">
         <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="basica-tab" role="tabpanel">
               <div class="row">
                  <div class="col-5">
                     <div class="row ">
                        {if empty($data['img_name'])}
                           <img src="{IMG_URI}empty.png" class="figure-img img-thumbnail img img-fluid">
                        {else}
                           <img src="{IMG_URI}p/{$data['img_name']}" class="figure-img img-thumbnail img img-fluid">
                        {/if}
                     </div>
                     <div class="row d-flex justify-content-between align-items-center">
                        <input disabled type="file" name="img" id="">
                        <button type="button" onclick="upload_img()" class="btn btn-primary">Cargar
                           Imagen</button>
                     </div>
                  </div>
                  <div class="col-7">
                     <div class="row">
                        <div class="form-group col-3">
                           <label for="id">ID</label>
                           <input disabled type="text" id="id" class="form-control" name="id"
                              value="{if isset($data['id_product'])}{$data['id_product']}{/if}" disabled>

                        </div>
                        <div class="form-group col-3">
                           <label for="code">Código</label>
                           <input disabled type="text" id="code" class="form-control" name="code"
                              value="{if isset($data['code'])}{$data['code']}{/if}">
                        </div>
                        <div class="form-group col-3">
                           <label for="code">Código de Barras</label>
                           <input disabled type="text" id="code" class="form-control" name="barcode"
                              value="{if isset($data['bar_code'])}{$data['bar_code']}{/if}">
                        </div>
                        <div class="form-group col-3">
                           <label for="code">Referencia</label>
                           <input disabled type="text" id="code" class="form-control" name="reference"
                              value="{if isset($data['ref'])}{$data['ref']}{/if}">
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-6">
                           <label for="code">Destacar</label>
                           <select name="type" class="form-control select2" id="featured">
                              <option value="0">No</option>
                              <option value="1">Si</option>
                           </select>
                        </div>
                        <div class="form-group col-6">
                           <label for="code">Regulado</label>
                           <select name="type" class="form-control select2" id="regulated">
                              <option value="0">No</option>
                              <option value="1">Si</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="code">Principio Activo</label>
                        <select name="type" class="form-control select2" id="active">
                           {foreach from=$actives item=$a}
                              <option value="{$a['id_active_compound']}">{$a['name']}</option>
                           {/foreach}
                        </select>
                     </div>
                     <div class="row">
                        <div class="form-group col-6">
                           <label for="code">Categoria</label>
                           <select name="type" class="form-control select2" id="category">
                              {foreach from=$categories item=$c}
                                 <option value="{$c['id_category']}">{$c['name']}</option>
                              {/foreach}
                           </select>
                        </div>
                        <div class="form-group col-6">
                           <label for="code">Marca</label>
                           <select name="type" class="form-control select2" id="brand">
                              {foreach from=$brands item=$b}
                                 <option value="{$b['id_brand']}">{$b['name']}</option>
                              {/foreach}
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="description">Descripcion</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="2"
                           style="resize: none;"
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
                  <h3>Existencias</h3>
               </div>
               <div class="row">
                  <div class="col-5 form-group"><label for="">Cantidad</label><input disabled name="quantity"
                        type="text" class="form-control">
                  </div>
                  <div class="col-4 form-group">
                     <label for="">Ubicacion</label>
                     <select name="warehouse" class="form-control select2" style="width: 100%;" id="ubiaction">
                        {foreach from=$locations item=$l}
                           <option value="{$l['id_warehouse']}">{$l['warehouse']}</option>
                        {/foreach}
                     </select>
                  </div>
                  <div class="col-3">
                     <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                     </div>
                  </div>
               </div>
               <div class="row table-responsive">
                  <table id="example1" class="table table-bordered table-sm table-striped dataTable dtr-inline"">
                     <thead  class=" bg-gray">
                     <tr>
                        <th>Almacen</th>
                        <th>Cantidad</th>
                     </tr>
                     </thead>
                     <tbody>

                        <tr>
                           <td>General</td>
                           <td>64</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class=" tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
               aria-labelledby="custom-tabs-four-messages-tab">
               <div class="row">
                  <h3>Precio de Venta</h3>
               </div>
               <div class="row">
                  <div class="col-4 form-group"><label for="">Precio</label><input disabled name="price" type="text"
                        class="form-control" value="{if isset($data['price'])}{$data['price']}{/if}">
                  </div>
                  <div class="col-4 form-group"><label for="">Precio Sugerido</label><input disabled
                        name="price_suggested" type="text" class="form-control"
                        value="{if isset($data['price_suggested'])}{$data['price_suggested']}{/if}">
                  </div>
                  <div class="col-4 form-group"><label for="">Precio Unitario</label><input disabled name="price_unit"
                        type="text" class="form-control"
                        value="{if isset($data['price_unit'])}{$data['price_unit']}{/if}">
                  </div>
                  <div class="form-group col-4">
                     <label for="">Descuento</label>
                     <select name="discount" class="form-control select2" style="width: 100%;" id="discont">
                        {foreach from=$discounts item=$d}
                        <option value="{$d['id_discount']}">{$d['name']}</option>
                        {/foreach}
                     </select>
                  </div>
               </div>
               <div class="row">
                  <h3>Precio de Coste</h3>
               </div>
               <div class="row">
                  <div class="col-4 form-group"><label for="">Precio Preempaque</label><input disabled name="price_cost"
                        type="text" class="form-control"
                        value="{if isset($data['price_cost'])}{$data['price_cost']}{/if}">
                  </div>
               </div>
               <div class="row">
                  <h3>Facturación</h3>
               </div>
               <div class="row">
                  <div class="col-4 form-group"><label for="">Unidad Minima Facturación</label><input disabled
                        name="min_sell" type="text" class="form-control"
                        value="{if isset($data['min_sell'])}{$data['min_sell']}{/if}">
                  </div>
                  <div class="col-4 form-group"><label for="">Unidad Maxima Facturación</label><input disabled
                        name="max_sell" type="text" class="form-control"
                        value="{if isset($data['max_sell'])}{$data['max_sell']}{/if}">
                  </div>
                  <div class="col-4 form-group"><label for="">Unidad Multiplo Facturación</label><input
                        name="miltiple_sell" type="text" class="form-control"
                        value="{if isset($data['multiple_sell'])}{$data['multiple_sell']}{/if}">
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
               aria-labelledby="custom-tabs-four-settings-tab">
               <div class="row">
                  <h3>ADICIONAL</h3>
               </div>
               <div class="row">
                  <div class="form-group col-6">
                     <label for="">Proveedor</label>
                     <select name="type" class="form-control select2" style="width: 100%;" name="supplier"
                        id="supplier">
                        {foreach from=$discounts item=$d}
                        <option value="{$d['id_discount']}">{$d['name']}</option>
                        {/foreach}
                     </select>
                  </div>
                  <div class="col-3 form-group"><label for="">Codisb</label><input disabled type="text" name="codisb"
                        class="form-control" value="{if isset($data['codisb'])}{$data['codisb']}{/if}">
                  </div>
                  <div class="col-3 form-group"><label for="">Unidades por Empaque</label><input disabled
                        name="per_pack" type="text" class="form-control"
                        value="{if isset($data['units_per_pack'])}{$data['units_per_pack']}{/if}">
                  </div>
               </div>
               <div class="row">
                  <div class="col-6 form-group"><label for="">Descripción Corta</label><input disabled name="short_desc"
                        type="text" class="form-control"
                        value="{if isset($data['short_description'])}{$data['short_description']}{/if}">
                  </div>
                  <div class="col-3 form-group"><label for="">Fecha Creacion</label><input disabled type="date" disabled
                        name="date" class="form-control"
                        value="{if isset($data['created_at'])}{$data['created_at']}{/if}">
                  </div>
                  <div class="col-3 form-group"><label for="">Vencimiento</label><input disabled name="expire"
                        type="text" class="form-control"
                        value="{if isset($data['expire_at'])}{$data['expire_at']}{/if}">
                  </div>
               </div>
               {* <div class="row">
                  <div class="col-3 form-group"><label for="">Vencimiento</label><input disabled type="text"
                        class="form-control">
                  </div>
                  <div class="col-3 form-group"><label for="">Descripción Corta</label><input disabled type="text"
                        class="form-control">
                  </div>
                  <div class="col-3 form-group"><label for="">Codisb</label><input disabled type="text" class="form-control">
                  </div>
                  <div class="col-3 form-group"><label for="">Unidades por Empaque</label><input disabled type="text"
                        class="form-control">
                  </div> *}
               {* </div> *}
            </div>
         </div>
      </div>

   </div>
</form>