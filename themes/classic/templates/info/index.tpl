<div class="card card-navy card-outline">
  <div class="card-header"><b>INFORMACIÓN</b></div>
  <div class="card-body">
    <div class="row">
      <div class="form-group col-4">
        <label>CÓDIGO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['code']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>DIRECCIÓN</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['address']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>DNI/RIF</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['dni']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>TELÉFONO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['phone']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>CONTACTO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['contact_person']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>ESTADO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['status']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>DÍAS DE CREDITO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['credit_time']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>DESCUENTO COMERCIAL</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['trade_discount']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>LIMITE DE CREDITO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['credit_limit']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>CORREO</label>
        <input type="text" class="form-control form-control-sm" value="{$clientData['email']}" disabled>
      </div>
    </div>
  </div>
</div>
<div class="card card-navy card-outline">
  <div class="card-header"><b>DROVAZ</b></div>
  <div class="card-body">
    <div class="row">
      <div class="form-group col-4">
        <label>NOMBRE</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['description']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>DNI/RIF</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['dni']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>DIRECCIÓN</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['address']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>LOCALIDAD</label>
        <input type="text" class="form-control form-control-sm" value="MARACAIBO-ZULIA" disabled>
      </div>
      <div class="form-group col-4">
        <label>CONTACTO</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['owner']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>TELÉFONO</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['phone']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>CORREO CONTACTO</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['email_contact']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>CORREO VENTAS Y COBRANZAS</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['email_sale']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>CORREO RELCAMOS Y DEVOLUCIONES</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['email_claim']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>FACEBOOK</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['facebook']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>INSTAGRAM</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['instagram']}" disabled>
      </div>
      <div class="form-group col-4">
        <label>TWITTER</label>
        <input type="text" class="form-control form-control-sm" value="{$companyData['twitter']}" disabled>
      </div>
    </div>
  </div>
</div>
<div class="card card-navy card-outline">
  <div class="card-header"><b>CUENTAS BANCARIAS</b></div>
  <div class="card-body">
    <table class="table table-bordered table-sm table-striped dataTaSimple">
      <thead class="bg-navy">
        <th>BANCO</th>
        <th>CUENTA</th>
        <th>MONEDA</th>
      </thead>
      <tbody>
        {foreach from=$banksData item=$b}
          <tr>
            <td>{$b['name']}</td>
            <td>{$b['num_account']}</td>
            <td>{$b['currency']}</td>
          </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>