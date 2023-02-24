<?php
/* Smarty version 4.3.0, created on 2023-02-24 06:09:16
  from 'C:\xampp\htdocs\drovazca\app\fs-admin\themes\classic\templates\orders\order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63f88ccce2fc45_90741345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '824c937c8c65eef0a44ff76e7e9c56c7f95b4a3f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\drovazca\\app\\fs-admin\\themes\\classic\\templates\\orders\\order.tpl',
      1 => 1677230955,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f88ccce2fc45_90741345 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
   <div class="col-12">
      <h4><span class="text-gray text-bold">PEDIDO #<?php echo str_pad($_smarty_tpl->tpl_vars['data']->value['id_order'],6,'0',STR_PAD_LEFT);?>
</span> - <span
            class="text-dark text-bold"></span>
         <small>de <span class="text-bold"><?php echo $_smarty_tpl->tpl_vars['client']->value['name'];?>
</span></small>
                  <small><?php echo $_smarty_tpl->tpl_vars['data']->value['created_at'];?>
</small>
      </h4>
   </div>
</div>
<div class="row mb-3">
   <div class="col-3">
      <div class="dropdown" id="changeStatus">
         <button class="btn <?php echo $_smarty_tpl->tpl_vars['statusColor']->value;?>
 btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
            aria-expanded="false" <?php if (!$_smarty_tpl->tpl_vars['validToPrint']->value) {?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['data']->value['op_status'] != 'A') {?>disabled<?php } else {
}?>>
            <?php echo $_smarty_tpl->tpl_vars['status']->value;?>

         </button>
         <ul class="dropdown-menu" style="width: 250px;">
            <li><a class="dropdown-item" href="#" value="A">EN ESPERA DEL PAGO</a></li>
            <li><a class="dropdown-item" href="#" value="C">COMPLETADO</a></li>
            <li><a class="dropdown-item" href="#" value="X">CANCELADO</a></li>
            <li><a class="dropdown-item" href="#" value="R">PAGO RECHAZADO</a></li>
         </ul>
      </div>
   </div>
   <div class="col-2">
      <button class="btn btn-default btn-block printBtn" type="button"
         onclick="_printInvoice(<?php echo Tools::getValue('id');?>
,'F')" <?php if (Orders::getInvoiceType() == 'F') {
} else { ?>disabled<?php }?>>
         <span class="fas fa-print mr-1"></span>IMPRIMIR FACTURA
      </button>
   </div>
   <div class="col-3">
      <button class="btn btn-default btn-block printBtn" type="button"
         onclick="_printInvoice(<?php echo Tools::getValue('id');?>
,'N')" <?php if (Orders::getInvoiceType() == 'N') {
} else { ?>disabled<?php }?>>
         <span class="fas fa-sticky-note mr-1"></span>IMPRIMIR NOTA DE ENTREGA
      </button>
   </div>
   <div class="col-3">
      <button class="btn btn-default printBtn" type="button" onclick="_printDelivery(<?php echo Tools::getValue('id');?>
)"
         <?php if (!Orders::getInvoiceType()) {?>disabled<?php }?>>
         <span class="fas fa-truck mr-1"></span>IMPRIMIR ORDEN DE ENTREGA
      </button>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title text-bold">CLIENTE</h3>
         </div>
         <div class="card-body p-3">
            <div class="row">
               <div class="form-group col-4">
                  <label>CLIENTE</label>
                  <input type="text" class="form-control form-control-sm" value="<?php echo $_smarty_tpl->tpl_vars['client']->value['name'];?>
" disabled>
               </div>
               <div class="form-group col-4">
                  <label>CORREO ELÉCTRONICO</label>
                  <input type="text" class="form-control form-control-sm" value="<?php echo $_smarty_tpl->tpl_vars['client']->value['email'];?>
" disabled>
               </div>
               <div class="form-group col-4">
                  <label>CUENTA REGISTRADA</label>
                  <input type="text" class="form-control form-control-sm" value="<?php echo $_smarty_tpl->tpl_vars['client']->value['date_creation'];?>
" disabled>
               </div>
               <div class="form-group col-4">
                  <label>PEDIDOS COMPLETADOS</label>
                  <input type="text" class="form-control form-control-sm" value="" disabled>
               </div>
               <div class="form-group col-4">
                  <label>PEDIDOS PENDIENTES</label>
                  <input type="text" class="form-control form-control-sm" value="" disabled>
               </div>
               <div class="form-group col-4">
                  <label>PEDIDOS RECHZADOS</label>
                  <input type="text" class="form-control form-control-sm" value="" disabled>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="row">
               <div class="col-4">
                  <h4>TASA BCV: 24.20</h4>
               </div>
               <div class="text-right col-4">
                  <h4>TOTAL VENTA: <?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['data']->value['amount'],'BS',true);?>
 <br> <span
                        class="text-success"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['data']->value['amount_usd'],'USD',true);?>
</span></h4>
               </div>
               <div class="text-right col-4">
                  <h4>TOTAL PAGO: <?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['data']->value['amount'],'BS',true);?>
 <br> <span
                        class="text-success"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['data']->value['amount_usd'],'USD',true);?>
</span></h4>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title text-bold">PAGOS</h3>
         </div>
         <div class="card-body p-2">
            <table class="table table-bordered table-sm table-striped dateTableSimple dtr-inline no-footer">
               <thead class="bg-navy text-center">
                  <th class="col-1">FECHA</th>
                  <th class="col-2">METODO DE PAGO</th>
                  <th class="col-1">MONEDA</th>
                  <th class="col-3">BANCO/CUENTA</th>
                  <th class="col-2">ID TRANSACCIÓN</th>
                  <th class="col-2">MONTO</th>
                  <th class="col-2">ESTADO</th>
               </thead>
               <tbody>
                  <?php if (!empty($_smarty_tpl->tpl_vars['payments']->value)) {?>
                     <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payments']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
                        <tr>
                           <td><?php echo $_smarty_tpl->tpl_vars['p']->value['created_at'];?>
</td>
                           <td><?php echo $_smarty_tpl->tpl_vars['p']->value['method'];?>
</td>
                           <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['p']->value['currency'];?>
</td>
                           <td><?php echo $_smarty_tpl->tpl_vars['p']->value['bank'];?>
</td>
                           <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['p']->value['reference'];?>
</td>
                           <td class="text-right"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['p']->value['amount'],'BS',true);?>

                              <br>
                              <span class="text-success"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['p']->value['amount_usd'],'USD',true);?>
</span>
                           </td>
                           <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['p']->value['status'];?>
</td>
                        </tr>
                     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  <?php } else { ?>
                  <?php }?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-header">
            <h3 class="card-title text-bold">PRODUCTOS</h3>
         </div>
         <div class="card-body p-2">
            <form class="form-inline col-12 mb-2">
               <div class="col-6 form-group row d-flex justify-content-between">
                  <label class="mr-1" for="">PRODUCTO</label>
                  <select name="product" class="form-control form-control-sm select2" id="product" style="width: 85%;">
                     <option value="-1"></option>
                     <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['id_product'];?>
">#<?php echo $_smarty_tpl->tpl_vars['p']->value['id_product'];?>
 - <?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
</option>
                     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
               </div>
               <div class="col-3 form-group row">
                  <label class="mr-1 ml-1" for="">PRECIO</label>
                  <input type="text" class="form-control form-control-sm text-right money-usd" value=""
                     style="width: 75%;">
               </div>
               <div class="col-2 form-group row">
                  <label class="mr-1 ml-1" for="">CANTIDAD</label>
                  <input type="text" class="form-control form-control-sm text-right" value="" style="width: 50%;">
               </div>
               <div class="col-1 form-group row d-flex justify-content-end">
                  <button type="submit" onclick="addNewShoppingOrderLine()"
                     class="btn btn-primary btn-sm">AGREGAR</button>
               </div>
            </form>
            <table class="table table-bordered table-sm table-striped dtr-inline no-footer">
               <thead class="bg-navy">
                  <th class="col-4 text-center">DESCRIPCIÓN</th>
                  <th class="col-1 text-center">CANTIDAD</th>
                  <th class="col-1 text-center">DISPONIBLE</th>
                  <th class="col-2 text-center">PRECIO</th>
                  <th class="col-2 text-center">TOTAL</th>
                  <th class="col-1 text-center">OPCIONES</th>
               </thead>
               <tbody>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['items']->value)) {?>
                     <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'i');
$_smarty_tpl->tpl_vars['i']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->do_else = false;
?>
                        <tr>
                           <td><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</td>
                           <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['i']->value['quantity'];?>
</td>
                           <td class="text-center"><?php echo Round($_smarty_tpl->tpl_vars['i']->value['current_stock'],0);?>
</td>
                           <td class="text-right"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['i']->value['net_price'],'BS',false);?>
<br><span
                                 class="text-success"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['i']->value['net_price_usd'],'USD',false);?>
</span></td>
                           <td class="text-right"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['i']->value['total'],'BS',false);?>
<br><span
                                 class="text-success"><?php echo Tools::moneyFormat($_smarty_tpl->tpl_vars['i']->value['total_usd'],'USD',false);?>
</span></td>
                           <td></td>
                        </tr>
                     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  <?php }?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div><?php }
}
