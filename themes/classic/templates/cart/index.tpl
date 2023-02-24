<div class="row">
   <div class="col-12">
      <div class="card card-navy card-outline">
         <div class="card-body">
            <form class="form-inline">
               <div class="form-group">
                  <label class="text-xs">PEDIDO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly
                     value="{$data['id_cart']}-{$data['cart_type']}">
               </div>
               <div class="form-group ml-2">
                  <label class="text-xs">ESTADO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly value="NUEVO">
               </div>
               <div class="form-group ml-2">
                  <label class="text-xs">ENVIADO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly value="{$data['created_at']}">
               </div>
               <div class="form-group ml-2">
                  <label class="text-xs">PROCESADO:</label>
                  <input type="text" class="form-control form-control-sm ml-2" readonly value="{$data['created_at']}">
               </div>
            </form>
            {* <p><b>Pedido:</b> 11654 <b>Fecha:</b> 16-09-2022 10:04:50 <b>Estado:</b> Nuevo</p> *}
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class=" {if !empty($items)}col-8{else}col-12{/if}">
      <div class="card card-navy card-outline">
         <div class="card-header">
            {* <h3 class="card-title" style="font-size: 1.7rem ;">CARRITO</h3> *}
            {if !empty($items)}
               <div class="card-tools">
                  <form class="form-ajax" method="post" target="{Tools::baseUrl()}cart/clean">
                     <button type="submit" class="btn btn-default btn-sm">Limpiar Carrito</button>
                  </form>
               </div>
            {/if}
         </div>
         <div class="card-body">
            <ul style="list-style:none;padding-left:0px">
               {if !empty($items)}
                  {foreach from=$items item=$i}
                     <li>
                        <div class="row">
                           <div class="col-2 d-flex justify-content-center">
                              <img src="{IMG_URI}p/{$i['img_name']}" style="width: 70px;height: 70px;object-fit: contain;">
                           </div>
                           <div class="col-5">
                              <div class="row">
                                 <a href="">
                                    <h6>{strtoupper($i['name'])}</h6>
                                 </a>
                              </div>
                              <div class="row">
                                 <div class="col-4">
                                    <h7>{Tools::moneyFormat($i['price_suggested'],'BS')}</h7>
                                    <h7 class="text-success">{Tools::moneyFormat($i['price_suggested_usd'],'USD')}</h7>
                                 </div>
                                 {* {if ($i['id_discount']!=0)}
                                    <div class="col">
                                    <span class="badge badge-info text-lg"> -20%</span>
                                    </div>
                                 {/if} *}
                              </div>
                           </div>
                           <div class="col-4">
                              <form method="post" target="{Tools::baseUrl()}cart/update" class="form-ajax">
                                 <div class="row text-center">
                                    <div class="col-6">
                                       <input type="number" name="quantity" class="form-control form-control-sm"
                                          value="{$i['quantity']}">
                                    </div>
                                    <div class="col-6">
                                       {foreach from=Cart::getItemTotals($i['id_cart_line']) item=t}
                                          <h7>{Tools::moneyFormat($t['total'],'BS')}</h7>
                                          <h7 class="text-success">{Tools::moneyFormat($t['total_usd'],'USD')}</h7>
                                       {/foreach}
                                    </div>
                                 </div>
                                 <div class="row text-center">
                                    <div class="col-1 mt-1">
                                       <input type="hidden" name="cart_line" value="{$i['id_cart_line']}">
                                       <input type="hidden" name="product" value="{$i['id_product']}">
                                       <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="col d-flex justify-content-center">
                              <form class="form-ajax" method="post" target="{Tools::baseUrl()}cart/remove">
                                 <input type="hidden" name="cart_line" value="{$i['id_cart_line']}">
                                 <button type="submit" class="btn"><i class="fas fa-trash text-dark"></i></button>
                              </form>
                           </div>
                        </div>
                        {if (count($items)>1)}
                           <hr>
                        {/if}
                     </li>
                  {/foreach}
               {else}
                  <li class="text-center">
                     <h2>Tu carrito esta actualmente vacío</h2>
                     <br>
                     <button onclick="history.back()" class="btn btn-primary">Volver</button>
                  </li>
               {/if}
            </ul>
         </div>
      </div>
   </div>
   {if !empty($items)}
      <div class="col-4">
         <div class="card card-navy card-outline">
            <div class="card-body">
               <div class="row">
                  <div class="col-6">
                     <h5 class="text-bold">{if $countItems <= 1 }{$countItems} Artículo {else}{$countItems} Artículos{/if}
                     </h5>
                  </div>
                  <div class="col-6 d-flex justify-content-end">
                     <h6 class="text-right">{Tools::moneyFormat($totals['total'],'BS')} <br> <span
                           class="text-success">{Tools::moneyFormat($totals['total_usd'],'USD')}</span></h6>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <h6 class="text-bold text-sm">Descuentos</h6>
                  </div>
                  <div class="col-6 d-flex justify-content-end">
                     <h6 class="text-sm text-right">{Tools::moneyFormat($totals['discount'],'BS')} <br> <span
                           class="text-success text-sm">{Tools::moneyFormat($totals['discount_usd'],'USD')}</span></h6>
                  </div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-6">
                     <h6 class="text-bold text-sm">Impuestos</h6>
                  </div>
                  <div class="col-6 d-flex justify-content-end">
                     <h6 class="text-sm text-right">{Tools::moneyFormat($totals['tax'],'BS')} <br> <span
                           class="text-success text-sm">{Tools::moneyFormat($totals['tax_usd'],'USD')}</span></h6>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <h5 class="text-bold">Total</h5>
                  </div>
                  <div class="col-6 d-flex justify-content-end">
                     <h6 class="text-right">
                        {Tools::moneyFormat(($totals['total']+$totals['tax']-$totals['discount']),'BS')} <br> <span
                           class="text-success">{Tools::moneyFormat(($totals['total_usd']+$totals['tax_usd']-$totals['discount_usd']),'USD')}</span>
                     </h6>
                  </div>
               </div>
               <hr>
               {if ($cart_type==true)}
                  <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">
                     Continuar
                  </button>
               {else}
                  <form class="form-ajax" method="post" target="{Tools::baseUrl()}cart/send">
                     <button type="submit" class="mt-3 btn btn-block btn-primary">Enviar Pedido</button>
                  </form>
               {/if}
            </div>
         </div>
      </div>
   {/if}
</div>
<div class="row">
   <div class="col-3">
      <a href="#" onclick="history.back()">
         < Continuar Comprando</a>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Solicitud de Productos Psicotropicos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <h6>Paso 1.</h6>
            <p>Para poder solicitar productos Psicotropicos tienes que tener la documentación vigente. pueden ingresar
               tu documentación con el siguiente enlace <a href="{Tools::baseUrl()}Documents" target="_blank">Gestión de
                  Documentación</a>
            </p>
            {if isset($documents)}
               <p>Documentación:</p>
               <ul>
                  <li>Copia de cedula de identidad del regente. {Customers::getDocumentStatus(1)}

                  </li>
                  <li>Copia del permiso de funcionamiento actualizado. {Customers::getDocumentStatus(2)}

                  </li>
                  <li>Copia de titulo como profesional farmacéutico. <small>(aplica para clientes de sede
                        gnas) </small> {Customers::getDocumentStatus(3)}

                  </li>
               </ul>
            {/if}
            <h6>Paso 2.</h6>
            <p>Adjuntar el archivo solicitado.</p>
            <form class="form-ajax" method="post" target="{Tools::baseUrl()}cart/sendPsychotropic">
               <div class="form-group">
                  <label for=""><span class="text-danger">*</span> Relacion Mensual de Psicotropicos <small>(Consignada
                        a
                        sanidad de su region dentro de
                        los 10 primeros dias del mes)</small></label>
                  <input type="file" id="fileInput" class="form-control-file form-control-sm " id="img" name="img"
                     value="" placeholder="" accept=".jpg,.png,.jpeg" required>
               </div>
               <h6>Paso 3.</h6>
               <p>Una vez enviada la solicituSd se te entregara el <b>Formato Compra-Venta de Psicotropicos.</b> el cual
                  debes firmar y sellar antes de enviarnoslo por correo o al momento de reportar el pago.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" onclick="sendFormAJAX()" class="btn btn-primary"
               {if Customers::validDocuments()}{else}disabled="disabled" {/if}>Enviar
               Pedido</button>
            </form>
         </div>
      </div>
   </div>
</div>