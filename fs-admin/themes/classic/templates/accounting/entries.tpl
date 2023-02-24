   <div class="card">
      <card class="card-header bg-light-gray text-primary no-borders">
         <span class="badge badge-primary text-md mr-1">ASIENTO CONTABLE NRO: </span><span class="text-bold text-md"
            id="corelative">
            {if isset($data.code) && !empty($data.code)}{$data.code}
            {else}PENDIENTE
            {/if}
         </span>
         <div class="card-tools">
            <div id="diferencia">
               {if isset($totals.diff) && Tools::clearBS($totals.diff) != 0}
                  <span class="badge badge-danger text-md mr-1">DIFERENCIA:</span><span class="text-bold text-md">
                     {$totals.diff}
                  </span>
               {/if}
            </div>
         </div>
      </card>
      <div class="card-body">
         <div class="row">
            <div class="col-4 form-group">
               <label for="">TIPO DE ASIENTO</label>
               <select name="type" id="type" onchange="frozeType()"
                  {if Isset($data['id_accounting_entry_type']) && !empty($data['id_accounting_entry_type'])}
                     disabled="disabled" {/if} class="form-control select2" {if $preview==true}disabled="disabled" {/if}>
                     {foreach from=$types item=$d}
                        <option value="-1"></option>
                        {if Isset($data['id_accounting_entry_type']) && $data['id_accounting_entry_type']==$d['id_accounting_entry_type']}
                           <option value="{$d['id_accounting_entry_type']}" selected="selected">{$d['name']}</option>
                        {else}
                           <option value="{$d['id_accounting_entry_type']}">{$d['name']}</option>
                        {/if}
                     {/foreach}
                  </select>
               </div>
               <div class="col-6 form-group">
                  <label for="">TERCERO</label>
                  <select name="entity" id="entity" onchange="frozeEntity()" class="form-control select2"
                     {if $preview==true}disabled="disabled" {/if}>
                     {foreach from=$entities item=$d}
                        <option value="-1"></option>
                        {if Isset($data['id_entity']) && $data['id_entity']==$d['id_entity']}
                           <option value="{$d['id_entity']}" selected="selected">{$d['name']}</option>
                        {else}
                           <option value="{$d['id_entity']}">{$d['name']}</option>
                        {/if}
                     {/foreach}
                  </select>
               </div>
               <div class="col-2 form-group">
                  <label for="">FECHA</label>
                  <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                     <input type="text" readonly name="date" class="form-control"
                        value="{if isset($data.created_at)}{$data.created_at}{/if}" />
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4 form-group">
                  <label for="">CUENTA CONTABLE</label>
                  <select name="account" class="form-control select2" id="account" {if $preview==true}disabled="disabled"
                     {/if}>
                     <option value="-1" selected>Seleccione una cuenta</option>
                     {foreach from=$accounts item=$d}
                        <option value="-1"></option>
                        {if Isset($data['id_accounting_account']) && $data['id_accounting_account']==$d['id_accounting_account']}
                           <option value="{$d['id_accounting_account']}" selected="selected">{$d['code']}-{$d['name']}</option>
                        {else}
                           <option value="{$d['id_accounting_account']}">{$d['code']}-{$d['name']}</option>
                        {/if}
                     {/foreach}
                  </select>
               </div>
               <div class="col-3 form-group">
                  <label for="">DETALLES</label>
                  <input type="text" class="form-control" name="desc" id="desc" style="text-transform:uppercase;"
                     {if $preview==true}readonly{/if}>
               </div>
               <div class="col-2 form-group">
                  <label for="">DEBITO</label>
                  <input type="text" class="form-control money-bs" onkeyup="check_index()" name="debit" id="debit"
                     {if $preview==true}readonly{/if}>
               </div>
               <div class="col-2 form-group">
                  <label for="">CREDITO</label>
                  <input type="text" class="form-control money-bs" onkeyup="check_index()" name="credit" id="credit"
                     {if $preview==true}readonly{/if}>
               </div>
               <div class="col-1 form-group d-flex justify-content-end align-items-end">
                  <button type="button" onclick="addNewEntryDetail()" href=""
                     class="btn btn-primary {if $preview==true}disabled{/if}">AGREGAR</button>
               </div>
            </div>
            <table id="fetchEntryDetails" class="table table-bordered table-sm" style="border: none;">
               <thead class="text-center bg-light-gray text-primary">
                  <tr>
                     <th class="col-4">CUENTA CONTABLE</th>
                     <th class="col-4">DETALLE</th>
                     <th class="col-2">DEBITO</th>
                     <th class="col-2">CREDITO</th>
                     <th class=""></th>
                  </tr>
               </thead>
               <tbody id="lines">
                  {if isset($lines)}
                     {foreach from=$lines item=$d}
                        <tr>
                           <td class="">{$d['code']}-{$d['name']}</td>
                           <td class="">{$d['desc']}</td>
                           <td class="text-right">{Tools::moneyFormat($d['debit'],'BS',false)}</td>
                           <td class="text-right">{Tools::moneyFormat($d['credit'],'BS',false)}</td>
                           <td style="border-left: none;"><button type="button" onclick="removeEntryLine({$d['id']})"
                                 style="border:none;background:none;" {if $preview==true}disabled="disabled" {/if}><span
                                    class="text-primary fas fa-trash"></span></button>
                           </td>
                        </tr>
                     {/foreach}
                  {/if}
               </tbody>
               <tfoot class=" text-primary text-right">
                  <tr>
                     <td style="
    border: none !important;
"></td>

                     <th class="bg-light-gray">TOTALES</th>
                     <th id="total_debit">{if isset($totals.debit) && !empty($totals.debit)}{$totals.debit}
                        {else}Bs.
                        0.0{/if}
                     </th>
                     <th id="total_credit">
                        {if isset($totals.credit) && !empty($totals.credit)}{$totals.credit}{else}Bs. 0.0{/if}
                     </th>
                  </tr>
                  <tr>
                     <td style="
    border: none !important;
    "></td>

                     <th class="bg-light-gray">DESCUADRE</th>
                     <th colspan="2" id="descuadre">
                        {if isset($totals.diff) && Tools::clearBS($totals.diff) != 0}{$totals.diff}{else}Bs. 0.0{/if}</th>
                  </tr>

               </tfoot>
            </table>
            <div class="row">
               <div class="col-12 mt-4 form-group">
                  <label for="">OBSERVACIONES</label>
                  <textarea name="observations" class="form-control {if $preview==true}disabled{/if}"
                     {if $preview==true}disabled="disabled" {/if} id="observations" cols="10" rows="3"
                     style="resize: none;">{if isset($data.observations)}{$data.observations}{/if}</textarea>
               </div>
            </div>
            <div class="row d-flex justify-content-end">
               <div class="col-2 form-group">
                  <button type="button" onclick="saveAccountingEntry()"
                     class="btn btn-block btn-primary {if $preview==true}disabled{/if}">GUARDAR</button>
               </div>
            </div>
         </div>
      </div>
   {* <script>
   $(document).ready(function() {
      fetch_lines();
      $('.form-custom').submit(function(e) {
         e.preventDefault();
      });
      bsCustomFileInput.init();
      $(".select2").select2({
         placeholder: {
            id: '-1', // the value of the option
            text: 'Seleccione una opción'
         },
         theme: "classic",
         allowClear: true
      });

   })

   function del_line(id) {
      console.log('delete line ' + id);
   }

   function check_index() {
      console.log('check_index');
      var debit = $('#debit');
      var credit = $('#credit');
      if (debit.val().length > 0) {
         credit.attr('readonly', true);
      } else {
         credit.attr('readonly', false);
      }
      if (credit.val().length > 0) {
         debit.attr('readonly', true);
      } else {
         debit.attr('readonly', false);
      }
   }

   function fetch_lines() {
      $('debit').removeAttr('readonly');
      $('credit').removeAttr('readonly');
      var target = $('.form-ajax').attr('target');
      var table = $("#LinesTable").DataTable({
         "language": {
"url": "{$urls.assets}/plugins/datatables/lang/es.json",
         },
         ordering: false,
         searching: false,
         paging: false,
         info: false,
         'columnDefs': [{
            "targets": [2, 3], // your case first column
            "className": "text-right",
         }],
         stateSave: true,
         "bDestroy": true
      });

      $.ajax({
         url: target,
         type: 'POST',
         dataType: 'json',
         data: {
            fetch_lines: 1
         },
         beforeSend: function() {
            loader();
         },
         success: function(data) {
            table.clear().draw();
            $.each(data.lines, function(index, value) {
               table.row.add([
                  value.name,
                  value.line_text,
                  value.left_index,
                  value.right_index,
                  '<a onclick="del_line(' + value.id +
                  ')"><span class="text-primary fas fa-trash"></span></a>'
               ]).draw();
            });
            $('#total_left').text(data.totals.t_debito);
            $('#total_right').text(data.totals.t_credito);
            $('#descuadre').text(data.totals.diferencia);
            $('#diferencia').html(
               '<span  class="badge badge-danger text-md mr-1">DIFERENCIA:</span><span class="text-bold text-md mr-5"> ' +
               data.totals.diferencia +
               '</span> <span class="badge badge-info text-md mr-1">TOTAL: </span> <span class="text-bold text-md"><b>' +
               data.totals.total + '</b></span>');
            hideLoader();

         }
      });
   }

   function addNewLine() {
      if ($('#accounts').val() == -1) {
         Swal.fire({
            toast: true,
            position: "top-end",
            icon: "info",
            title: "Por favor seleccione una cuenta contable",
            showConfirmButton: false,
            timer: 3000
         });
         return;
      }
      if ($('#details').val().length == 0) {
         Swal.fire({
            toast: true,
            position: "top-end",
            icon: "info",
            title: "Por favor ingrese un detalle",
            showConfirmButton: false,
            timer: 3000
         });
         return;
      }
      if ($('#accounts').val() != -1 && $('#details').val().length > 0) {
         var form = $('.form-custom');
         var metodo = form.attr('method');
         var target = form.attr('target');
         var formdata = new FormData(form[0]);
         formdata.append('add_line', 1);
         var debit = $('#debit');
         var credit = $('#credit');
         $.ajax({
            type: metodo,
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
         return false;
      }
   }

   function saveVoucher() {
      if ($('#serie').val() == -1) {
         Swal.fire({
            toast: true,
            position: "top-end",
            icon: "info",
            title: "Por favor seleccione una serie",
            showConfirmButton: false,
            timer: 3000
         });
         return;
      }
      if ($('#date').val().length == 0) {
         Swal.fire({
            toast: true,
            position: "top-end",
            icon: "info",
            title: "Por favor ingrese una fecha",
            showConfirmButton: false,
            timer: 3000
         });
         return;
      }
      if ($('#serie').val() != -1 && $('#date').val().length > 0) {
         var form = $('.form-custom');
         var metodo = form.attr('method');
         var target = form.attr('target');
         var formdata = new FormData(form[0]);
         formdata.append('save_voucher', 1);
         var debit = $('#debit');
         var credit = $('#credit');
         $.ajax({
            type: metodo,
            url: target,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
               window.location.href = data.redirect;
            }
         });
         return false;
      }
   }
</script> *}