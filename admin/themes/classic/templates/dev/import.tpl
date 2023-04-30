<div class="row">
   <div class="col-8">
      <form class="ajaxRequest" enctype="multipart/form-data">
         <div class="card col-12 card-navy card-outline">
            <div class="card-header">
               <h3 class="card-title"><i class="mr-1 fas fa-exchange-alt"></i> Importar</h3>
            </div>
            <div class="card-body">
               <div class="row form-group">
                  <label class="col-6 col-form-label float-end text-right" for="import_type"><span
                        class="text-danger">*</span> ¿QUE QUIERES IMPORTAR?</label>
                  <div class="col-6">
                     <select class="select2 form-control form-control-sm" id="import_type" name="import_type"
                        required="">
                        <option value="-1"></option>
                        <option value="P">PRODUCTOS</option>
                        <option value="CAT">CATEGORÍAS</option>
                        <option value="B">MARCAS</option>
                        <option value="CL">CLIENTES</option>
                        <option value="S">PROVEEDORES</option>
                        <option value="PC">COMPARADOR DE PRECIOS</option>
                     </select>
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-6 col-form-label float-end text-right" for="field">
                     <span class="text-danger">*</span> SEPARADOR DE CAMPO</label>
                  <div class="col-2">
                     <input type="text" class="form-control form-control-sm " id="field_separator"
                        name="field_separator" value=";" placeholder="" required="">
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-6 col-form-label float-end text-right" for="separator"><span
                        class="text-danger">*</span> SEPARADOR DE VALOR MULTIPLE</label>
                  <div class="col-2">
                     <input type="text" class="form-control form-control-sm " id="separator" name="separator" value=","
                        placeholder="" required="">
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-6 col-form-label float-end text-right" for="op_currency"><span
                        class="text-danger">*</span> ARCHIVO</label>
                  <div class="col-6">
                     <input type="file" class="form-control-file form-control-sm " id="fileAttach" name="fileAttach"
                        value="" placeholder="" required="" accept=".csv,">
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-6 col-form-label float-end text-right" for="op_status"><span
                        class="text-danger">*</span> FORZAR TODOS LOS NÚMEROS ID</label>
                  <div class="col-4 d-flex align-items-center">
                     <div class="custom-control custom-switch"><input name="forceId" value="0" type="checkbox"
                           class="custom-control-input" id="customSwitch1"><label class="custom-control-label"
                           for="customSwitch1"></label></div>
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-6 col-form-label float-end text-right" for="op_status"><span
                        class="text-danger">*</span> ENVIAR NOTIFICACIÓN POR CORREO</label>
                  <div class="col-4 d-flex align-items-center">
                     <div class="custom-control custom-switch"><input name="emailNotify" value="1" type="checkbox"
                           class="custom-control-input" id="customSwitch2"><label class="custom-control-label"
                           for="customSwitch2"></label></div>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <div class="row">
                  <div class="col-12 d-flex justify-content-between">
                     <button type="button" onclick="history.back()" class="btn btn-default"><i
                           class="fas fa-times"></i><br>Volver</button>
                     <button type="submit" class="btn float-end btn-primary"><i
                           class="fas fa-file-import mb-1"></i><br>Importar</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="col-4">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title"><span class="fas fa-download mr-1"></span>Descargar archivos csv de ejemplo</h3>
         </div>
         <div class="card-body">
            <ul class="list-group">
               <li class="list-group-item">
                  <a href="{ROOT_URI}src/products.csv">Archivo ejemplo de Productos</a>
               </li>
               <li class="list-group-item">
                  <a href="{ROOT_URI}src/categories.csv">Archivo ejemplo de Categorias</a>
               </li>
               <li class="list-group-item">
                  <a href="{ROOT_URI}src/brands.csv">Archivo ejemplo de Marcas</a>
               </li>
               <li class="list-group-item">
                  <a href="{ROOT_URI}src/clients.csv">Archivo ejemplo de Clientes</a>
               </li>
               <li class="list-group-item">
                  <a href="{ROOT_URI}src/suppliers.csv">Archivo ejemplo de Proveedores</a>
               </li>
               <li class="list-group-item">
                  <a href="{ROOT_URI}src/comparator.csv">Archivo ejemplo de Comparador de Productos</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<script>
   sendAjaxRequest();
</script>