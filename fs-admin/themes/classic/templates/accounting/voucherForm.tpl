<form method="post" class="form-custom"
   target="{Tools::baseUrl()}?controller=AdminAccounting&action=voucher&id={$id}&token={Tools::getValue('token')}">
   <div class="card">
      <card class="card-header bg-light-gray text-primary no-borders">
         <span class="badge badge-primary text-md mr-1">ASIENTO CONTABLE NRO: </span> <span
            class="text-bold text-md">{if isset($data.code)&&isset($data.number)}{$data.code}-{$data.number}
            {else}PENDIENTE
            {/if}</span>
         <div class="card-tools">
            <div id="diferencia"></div>

         </div>
      </card>
      <div class="card-body">
         <div class="row">
            <div class="col-10 form-group">
               <label for="">SERIE</label>
               <select name="serie" id="serie" class="form-control select2">
                  <option value="-1" selected>Seleccione una serie</option>
                  {foreach from=$types item=$t}
                     <option value="{$t.id_voucher_type}">{$t.serie}-{$t.name}</option>
                  {/foreach}
               </select>
            </div>
            <div class="col-2 form-group">
               <label for="">FECHA</label>
               <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                  <input type="text" name="date" class="form-control datetimepicker-input" id="date"
                     data-target="#datetimepicker1" />
                  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                     <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-4 form-group">
               <label for="">CUENTA CONTABLE</label>
               <select name="account" class="form-control select2" id="accounts">
                  <option value="-1" selected>Seleccione una cuenta</option>
                  {foreach from=$accounts item=$a}
                     <option value="{$a.id_account}">{$a.code}-{$a.name}</option>
                  {/foreach}
               </select>
            </div>
            <div class="col-3 form-group">
               <label for="">DETALLES</label>
               <input type="text" class="form-control" name="desc" id="details">
            </div>
            <div class="col-2 form-group">
               <label for="">DEBITO</label>
               <input type="text" class="form-control money-format" onkeyup="check_index()" name="debit" id="debit">
            </div>
            <div class="col-2 form-group">
               <label for="">CREDITO</label>
               <input type="text" class="form-control money-format" onkeyup="check_index()" name="credit" id="credit">
            </div>
            <div class="col-1 form-group d-flex justify-content-end align-items-end">
               <button type="submit" name="newLine" onclick="addNewLine()" value="1" href=""
                  class="btn btn-primary">AGREGAR</button>
            </div>
         </div>
         <table id="LinesTable" class="table table-bordered table-sm">
            <thead class="text-center bg-light-gray text-primary">
               <tr>
                  <th class="col-4">Cuenta Contable</th>
                  <th class="col-4">Detalle</th>
                  <th class="col-2">Debito</th>
                  <th class="col-2">Credito</th>
                  <th class=""></th>
               </tr>
            </thead>
            <tbody id="lines">
               {* <tr>
               <td class="">C-11 CAJA</td>
               <td class="">Pago de Sistema Contable</td>
               <td class="text-right">461</td>
               <td class="text-right">-461</td>
               <td><a href=""><span class="fas fa-trash"></span></a></td>
               </tr> *}
            </tbody>
            <tfoot class=" text-primary text-right">
               <tr>
                  <td style="
    border: none !important;
"></td>

                  <th>TOTALES</th>
                  <th id="total_left">0.0</th>
                  <th id="total_right">0.0</th>
               </tr>
               <tr>
                  <td style="
    border: none !important;
    "></td>

                  <th>DESCUADRE</th>
                  <td style="
    border: none !important;
    "></td>
                  <th style="
border-left: none;
" id="descuadre">0.0</th>
               </tr>

            </tfoot>
         </table>
         <div class="row">
            <div class="col-12 mt-4 form-group">
               <label for="">OBSERVACIONES</label>
               <textarea name="observations" class="form-control" id="" cols="10" rows="5"></textarea>
            </div>
         </div>
         <div class="row d-flex justify-content-end">
            <div class="col-2 form-group">
               <button type="submit" name="save" value="1" onclick="saveVoucher()"
                  class="btn btn-block btn-primary">GUARDAR</button>
            </div>
         </div>
      </div>
   </div>
</form>
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
            $('#total_left').text('Bs. ' + data.totals.t_debito);
            $('#total_right').text('Bs. ' + data.totals.t_credito);
            $('#descuadre').text('Bs. ' + data.totals.diferencia);
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