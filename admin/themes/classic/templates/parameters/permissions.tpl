<div class="card card-navy card-outline">
   <div class="card-header">
      <h3 class="card-title"><i class="mr-1 fas fa-gears"></i> Gestión de Permisos</h3>
   </div>
   <div class="card-body p-2">
      <div class="row">
         <div class="col-5 col-sm-3">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
               {foreach from=$roles item=role}
                  <a class="nav-link" id="vert-tabs-{$role['name']}-tab" data-toggle="pill"
                     href="#vert-tabs-{$role['name']}" role="tab" aria-controls="vert-tabs-{$role['name']}"
                     aria-selected="true">{$role['name']}</a>
               {/foreach}
               {* <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab"
                  aria-controls="vert-tabs-profile" aria-selected="false">Profile</a>
               <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab"
                  aria-controls="vert-tabs-messages" aria-selected="false">Messages</a>
               <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab"
                  aria-controls="vert-tabs-settings" aria-selected="false">Settings</a> *}
            </div>
         </div>
         <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
               {foreach from=$roles item=role}
                  <div class="tab-pane text-left fade" id="vert-tabs-{$role['name']}" role="tabpanel"
                     aria-labelledby="vert-tabs-{$role['name']}-tab">
                     <table class="table table-xs">
                        <thead class="bg-navy">
                           <th></th>
                           <th class="text-center" style="width: 40px;">Ver</th>
                           <th class="text-center" style="width: 40px;">Añadir</th>
                           <th class="text-center" style="width: 40px;">Editar</th>
                           <th class="text-center" style="width: 40px;">Eliminar</th>
                        </thead>
                        <tbody>
                           {Parameters::buildPermissionsGrid($role['id_role'])}
                        </tbody>
                     </table>
                  </div>
               {/foreach}
               {* <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                  aria-labelledby="vert-tabs-profile-tab">
                  Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula
                  tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas
                  sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus.
                  Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
               </div> *}
               {* <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                  aria-labelledby="vert-tabs-messages-tab">
                  Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi
                  placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique
                  nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis
                  urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non
                  luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla
                  lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus.
                  Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
               </div> *}
               {* <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                  aria-labelledby="vert-tabs-settings-tab">
                  Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac,
                  ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod
                  molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna
                  nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut
                  nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet
                  facilisis.
               </div> *}
            </div>
         </div>
      </div>

   </div>
</div>