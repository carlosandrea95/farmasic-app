<div class="row">
   <div class="col-4">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title"><i class="fas fa-clipboard-list mr-1"></i>Información del Reclamo</h3>
         </div>
         <div class="card-body">
            <div class="row">
               <label for="">REALIZADO POR:</label>
            </div>
            <div class="row mb-0">
               <p>{$data['name']}<span class="badge badge-success ml-1">PROPIETARIO</span></p>
            </div>
            <div class="row">
               <label for="">DEPARTAMENTO:</label>
            </div>
            <div class="row mb-1">
               {$data['op_departament']}
            </div>
            <div class="row">
               <label for="">CREACIÓN:</label>
            </div>
            <div class="row mb-1">
               {$data['created_at']}
            </div>
            <div class="row">
               <label for="">ULTIMA ACTUALIZACIÓN:</label>
            </div>
            <div class="row mb-1">
               {$data['last_update']}
            </div>
            <div class="row">
               <label for="">ESTADO / PRIORIDAD:</label>
            </div>
            <div class="row">
               <p><span class="badge bg-{$data['op_status_color']} mr-1">{$data['op_status']}</span>/
                  {$data['op_priority']}
               </p>
            </div>
         </div>
         {* <div class="card-footer">
            <div class="col-12">
               <form class="form-ajax" method="post" target="{Tools::baseUrl()}complaints/close">
                  <input type="hidden" value="{$data['id_complaint']}" name="id">
                  <button type="submit" class="btn btn-danger btn-block" {if $data['status']=='C'} disabled {/if}><i
                        class="fa fa-times mr-1"></i>Cerrar
                     Reclamo</button>
               </form>
            </div>
         </div> *}
      </div>
   </div>
   <div class="col-8">
      <div class="card direct-chat direct-chat-primary">
         <div class="card-header">
            <div class="row">
               <div class="col-6">
                  <h4>Reclamo #{$data['id_complaint']}</h4>
                  <h6>Asunto: {$data['subject']}</h6>
               </div>
               <div class="col-6 text-right">
                  <span class="badge bg-{$data['op_status_color']}" style="font-size: 1rem;">{$data['op_status']}</span>
               </div>
            </div>
         </div>

         <div class="card-body">

            <div class="direct-chat-messages" style="height: 60vh;">
               {foreach from=$messages item=$m}
                  <div class="direct-chat-msg {if !$m['is_operator']}right{/if}">
                     <div class="direct-chat-infos clearfix">
                        <span
                           class="direct-chat-name {if $m['is_operator']}float-left{else}float-right{/if}">{if !$m['is_operator']}<span
                              class="badge badge-success mr-1">PROPIETARIO</span>{/if}{$m['name']}{if $m['is_operator']}<span
                           class="badge badge-info ml-1">OPERADOR</span>{/if}</span>
                     <span
                        class="direct-chat-timestamp {if $m['is_operator']}float-right{else}float-left{/if}">{$m['send_at']}</span>
                  </div>

                  <img class="direct-chat-img" src="{IMG_URI}tools/profile.jpg" alt="message user image">

                  <div class="direct-chat-text">
                     {if !empty($m['img'])}
                        <div style="display: flex;">
                           <div>
                              <a href="{Tools::baseUrl()}img/m/{$m['img']}" target="_blank">
                                 <img src="{Tools::baseUrl()}img/m/{$m['img']}" style="width: 8rem; height: auto;">
                              </a>
                           </div>
                           <div style="margin-left: .25rem;">
                              {$m['message']}
                           </div>
                        </div>
                     {else}
                        {$m['message']}
                     {/if}
                  </div>

               </div>
               {/foreach}

            </div>
         </div>
         <div class="card-footer">
            <form class="form-ajax" method="post" target="{Tools::baseUrl()}complaints/send">
               <div class="input-group">
                  <input type="text" name="msg" placeholder="Escribir un mensaje..." class="form-control" required
                     {if $data['status']=='C'} disabled {/if}>
                  <span class="input-group-append">
                     <input type="file" class="form-control" id="inputGroupFile02" {if $data['status']=='C'} disabled
                        {/if} name='img' style="display: none;">
                     <label class="input-group-text force-hover-default" for="inputGroupFile02"><i
                           class="fas fa-paperclip" {if $data['status']=='C'} disabled {/if}></i></label>
                     {* <button type="button" class="btn btn-default"></button> *}
                     <input type="hidden" value="{$data['id_complaint']}" name="id">
                     <button type="submit" class="btn btn-primary" {if $data['status']=='C'} disabled
                        {/if}>Enviar</button>
                  </span>
               </div>
            </form>
         </div>

      </div>
   </div>
</div>