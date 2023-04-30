{* <form class="form-ajax" method="post"
   target="{Tools::baseUrl()}?controller=AdminWarehouse&action=warehouse&id={Tools::getValue('id')}&token={Tools::getValue('token')}">
   <div class="card">
      <div class="card-body">
         <div class="row">
            <div class="col-6 form-group">
               <label for="">EMPRESA</label>
               <select name="company" id="company" class="form-control select2" required>
                  <option value="{if isset($warehouse.id_company)}{$warehouse.id_company}{else}-1{/if}" selected>
                     {if isset($warehouse.company)}{$warehouse.company}{else}Seleccione una empresa{/if}</option>
                  {foreach from=$companies item=$c}
                     <option value="{$c.id_company}">{$c.name}</option>
                  {/foreach}
               </select>
            </div>
            <div class="col-6 form-group">
               <label for="">NOMBRE</label>
               <input type="text" name="name" id="name"
                  value="{if isset($warehouse.warehouse)}{$warehouse.warehouse}{/if}" class="form-control" required>
            </div>
         </div>
         <div class="row">
            <div class="col-6 form-group">
               <label for="">DIRECCION</label>
               <input type="text" name="address" id="address"
                  value="{if isset($warehouse.address_1)}{$warehouse.address_1}{/if}" class="form-control">
            </div>
            <div class="col-6 form-group">
               <label for="">DIRECCION 2</label>
               <input type="text" name="address2" id="address2"
                  value="{if isset($warehouse.address_2)}{$warehouse.address_2}{/if}" class="form-control">
            </div>
         </div>
         <div class="row d-flex justify-content-end">
            <div class="col-2">
               <button type="submit" class="btn btn-block btn-primary"><span
                     class="fas fa-save mr-1"></span>Guardar</button>
            </div>
         </div>
      </div>
   </div>
</form>

<script>
   $(document).ready(function() {
      $(".select2").select2({
         // placeholder: {
         //    id: '-1', // the value of the option
         //    text: 'Seleccione una opción'
         // },
         theme: "classic",
         allowClear: true
      });
   });
</script> *}
{$form}