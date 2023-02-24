{$form}
{if isset($permissionsGrid) && $permissionsGrid==true}
   <div class="card card-navy card-outline">
      <div class="card-header">
         <h3 class="card-title"><i class="mr-1 fas fa-gears"></i> Gestión de Permisos</h3>
      </div>
      <div class="card-body p-2">
         <table class="table table-xs">
            <thead class="bg-navy">
               <th></th>
               <th class="text-center" style="width: 40px;">Ver</th>
               <th class="text-center" style="width: 40px;">Añadir</th>
               <th class="text-center" style="width: 40px;">Editar</th>
               <th class="text-center" style="width: 40px;">Eliminar</th>
            </thead>
            <tbody>
               {Parameters::buildPermissionsGrid()}
            </tbody>
         </table>
      </div>
   </div>
{/if}
<script>
   $(document).ready(function() {
      $('.chk').change(function() {
         if (this.checked)
            changeState(this.value, this.target);
         else
            changeState(this.value, this.target);
      });

      function changeState(value, target) {
         $.ajax({
            type: 'POST',
            url: target,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
               credit.attr('readonly', false);
               debit.attr('readonly', false);
               form.trigger('reset');
               $('#accounts').prop('selectedIndex', -1).trigger("change");
               fetch_lines();
            }
         });
      }
   });
</script>