<div class="row justify-content-end mb-2">
  <div class="col-3">
    <a href="{Tools::baseUrl()}?controller=AdminOrders&action=approve_payment&id_order={$paymentData['id_order']}&id_payment={Tools::getValue('id')}&token={Tools::getValue('token')}"
      class="btn btn-success btn-block {if $paymentData['op_status']!='P'}disabled{/if}">APROBAR</a>
  </div>
  <div class="col-3">
    <a href="{Tools::baseUrl()}?controller=AdminOrders&action=decline_payment&id_order={$paymentData['id_order']}&id_payment={Tools::getValue('id')}&token={Tools::getValue('token')}"
      class="btn btn-danger btn-block {if $paymentData['op_status']!='P'}disabled{/if}">RECHAZAR</a>
  </div>
</div>
<div class="card card-navy card-outline">
  <div class="card-body">
    <div class="row">
      <div class="col-4 form-group"><label>PEDIDO</label><input type="text" class="form-control"
          value="{$paymentData['id_order']}" disabled>
      </div>
      <div class="col-4 form-group"><label>FECHA ENVIADO</label><input type="text" class="form-control"
          value="{$paymentData['created_at']}" disabled></div>
      <div class="col-4 form-group"><label>REFERENCIA</label><input type="text" class="form-control"
          value="{$paymentData['reference']}" disabled></div>
      <div class="col-4 form-group"><label>MONEDA</label><input type="text" class="form-control"
          value="{$paymentData['currency']}" disabled></div>
      <div class="col-4 form-group"><label>METODO DE PAGO</label><input type="text" class="form-control"
          value="{$paymentData['method']}" disabled></div>
      <div class="col-4 form-group"><label>BANCO</label><input type="text" class="form-control"
          value="{$paymentData['name_bank']}" disabled></div>
      <div class="col-4 form-group"><label>CUENTA</label><input type="text" class="form-control"
          value="{$paymentData['num_account']}" disabled>
      </div>
      <div class="col-4 form-group"><label>MONTO</label><input type="text" class="form-control"
          value="{$paymentData['amount']}" disabled></div>
    </div>
  </div>
</div>