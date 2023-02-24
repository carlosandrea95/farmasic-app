<!DOCTYPE html>

<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>FARMASIC{if isset($template.title)} | {$template.title} {/if}</title>
   <link href="{$urls.assets}css/fonts.min.css" rel="stylesheet">
   <link rel="preload" as="style" href="{$urls.assets}plugins/fontawesome-free/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="{$urls.assets}img/favicon_drovaz.png">
   <link rel="stylesheet" href="{$urls.assets}css/adminlte.min.css?v=3.2.0">
   <link rel="stylesheet" href="{$urls.assets}css/custom.dash.min.css">
   <link rel="stylesheet" href="{$urls.assets}plugins/select2/css/select2.min.css">
   <link rel="stylesheet" href="{$urls.assets}css/select2-bootstrap-5-theme.min.css" />
   <link rel="stylesheet" href="{$urls.assets}plugins/fontawesome-free/css/all.min.css">

   <script src="{$urls.assets}plugins/jquery/jquery.min.js"></script>
   <script src="{$urls.assets}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="{$urls.assets}js/adminlte.min.js?v=3.2.0"></script>

   <script src="{$urls.assets}plugins/sweetalert2/sweetalert2.all.min.js"></script>
   <script src="{$urls.assets}plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="{$urls.assets}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="{$urls.assets}plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
   <script src="{$urls.assets}plugins/select2/js/select2.full.min.js"></script>

   <script src="{$urls.assets}plugins/daterangepicker/daterangepicker.js"></script>
   <script src="{$urls.assets}plugins/inputmask/jquery.inputmask.min.js"></script>
   <script src="{$urls.assets}plugins/moment/moment.min.js"></script>

   <script src="{$urls.assets}plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
   {nocache}
   {foreach from=$js item=$uri}
      <script src=" {$uri}"></script>
   {/foreach}
   {/nocache}
   <style>
      .spinner {
         width: 24px;
         height: 80px;
         display: block;
         margin: 35px auto 0;
         border: 1px solid #FFF;
         border-radius: 0 0 50px 50px;
         position: relative;
         box-shadow: 0px 0px #FF3D00 inset;
         background-image: linear-gradient(#FF3D00 100px, transparent 0);
         background-position: 0px 0px;
         background-size: 22px 80px;
         background-repeat: no-repeat;
         box-sizing: border-box;
         animation: animloader 6s linear infinite;
      }

      .spinner::after {
         content: '';
         box-sizing: border-box;
         top: -6px;
         left: 50%;
         transform: translateX(-50%);
         position: absolute;
         border: 1px solid #FFF;
         border-radius: 50%;
         width: 28px;
         height: 6px;
      }

      .spinner::before {
         content: '';
         box-sizing: border-box;
         left: 0;
         bottom: -4px;
         border-radius: 50%;
         position: absolute;
         width: 6px;
         height: 6px;
         animation: animloader1 6s linear infinite;
      }

      @keyframes animloader {
         0% {
            background-position: 0px 80px;
         }

         100% {
            background-position: 0px 0px;
         }
      }

      @keyframes animloader1 {
         0% {
            box-shadow: 4px -10px rgba(255, 255, 255, 0), 6px 0px rgba(255, 255, 255, 0), 8px -15px rgba(255, 255, 255, 0),
               12px 0px rgba(255, 255, 255, 0);
         }

         20% {
            box-shadow: 4px -20px rgba(255, 255, 255, 0), 8px -10px rgba(255, 255, 255, 0), 10px -30px rgba(255, 255, 255,
                  0.5), 15px -5px rgba(255, 255, 255, 0);
         }

         40% {
            box-shadow: 2px -40px rgba(255, 255, 255, 0.5), 8px -30px rgba(255, 255, 255, 0.4), 8px -60px rgba(255, 255, 255,
                  0.5), 12px -15px rgba(255, 255, 255, 0.5);
         }

         60% {
            box-shadow: 4px -60px rgba(255, 255, 255, 0.5), 6px -50px rgba(255, 255, 255, 0.4), 10px -90px rgba(255, 255, 255,
                  0.5), 15px -25px rgba(255, 255, 255, 0.5);
         }

         80% {
            box-shadow: 2px -80px rgba(255, 255, 255, 0.5), 4px -70px rgba(255, 255, 255, 0.4), 8px -120px rgba(255, 255, 255,
                  0), 12px -35px rgba(255, 255, 255, 0.5);
         }

         100% {
            box-shadow: 4px -100px rgba(255, 255, 255, 0), 8px -90px rgba(255, 255, 255, 0), 10px -120px rgba(255, 255, 255,
                  0), 15px -45px rgba(255, 255, 255, 0);
         }
      }

      .loader {
         position: fixed;
         display: flex;
         flex: 1;
         justify-content: center;
         align-items: center;
         height: 100%;
         width: 85%;
         z-index: 99999;
         background: rgba(52, 58, 64, .97);
      }
   </style>
</head>

<body class="hold-transition sidebar-mini text-sm">
   <div class="wrapper">

      <nav class="main-header navbar navbar-expand navbar-navy navbar-dark">

         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>

         <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
               <a class="nav-link text-sm">
                  <p><b class="pr-1">ACTUALIZADO:</b>{ExchangeRates::getLastDate()} <b>TASA BCV:</b>
                     ${ExchangeRates::getCurrentRate()}
                  </p>
               </a>
            </li>
            <div id="cart" target="{Tools::baseUrl()}cart/data">
               {if isset(Cart::countItems()) && Cart::countItems()!=0}
                  <li class="nav-item d-none d-sm-inline-block">
                     <a href="{Tools::baseUrl()}Cart" class="nav-link pl-0 text-sm">
                        <i class="fas fa-shopping-cart">
                           <span class="badge badge-danger">
                              {Cart::countItems()}
                           </span>
                        </i>
                        Bs. {number_format(Cart::getTotalsBS(), 2, ',', '.')} $
                        {number_format(Cart::getTotalsUSD(), 2, ',', '.')}
                     </a>
                  </li>
               {/if}
            </div>
            <li class="nav-item dropdown">
               <a class="nav-link d-flex" data-toggle="dropdown" href="#">
                  <img src="{$urls.assets}img/user-profile.jpg" alt="User Avatar" style="margin: -8px 5px 0px 0px !important;
height: 35px;" class="mr-3 img-circle">
                  <p>{Session::get('_uname')}</p>
                  {* <span class="badge badge-danger navbar-badge">3</span> *}
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right card-widget widget-user-2 shadow"
                  style="margin-top: 10px;">

                  <div class="bg-navy widget-user-header" style="background: #343a40; color: #fff;">
                     <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{$urls.assets}img/user-profile.jpg" alt="User Avatar">
                     </div>

                     <h3 class="widget-user-username">{Session::get('_uname')}</h3>
                     {* <h5 class="widget-user-desc">Lead Developer</h5>s *}
                  </div>
                  <div class="card-footer p-2">
                     <ul class="nav flex-column">
                        {* <li class="nav-item">
                           <a href="#" class="nav-link text-dark">
                              <i class="fas fa-user-circle mr-2"></i> Perfil
                           </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="nav-item">
                           <a href="#" class="nav-link text-dark">
                              <i class="fas fa-cogs mr-2"></i> Configuraciones
                           </a>
                        </li> *}
                        <li class="dropdown-divider"></li>
                        <li class="nav-item">
                           <a href="{$baseUrl}?controller=AdminLogin&action=logout&token={Tools::getValue('token')}"
                              class="nav-link bg-danger text-center" style="border-radius:.75em">
                              <i class="fas fa-power-off"></i> Cerrar Sesión
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               {* <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                     <i class="fas fa-user-circle mr-2"></i> Perfil
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                     <i class="fas fa-cogs mr-2"></i> Configuraciones
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer"><i class="fas fa-power-off"></i> Cerrar Sesión</a>
               </div> *}
            </li>
         </ul>
      </nav>


      <aside class="main-sidebar sidebar-dark-primary bg-navy elevation-4">

         <a href="{Tools::baseUrl()}dashboard" class="brand-link bg-navy">
            <img src="{$urls.assets}img/favicon_drovaz.png" alt="AdminLTE Logo" class="brand-image img-circle"
               style="opacity: .8">
            <h2 class="brand-text text-bg font-weight-bold text-white " style="font-size:16px">FARMASIC</h2>
         </a>

         <div class="sidebar">
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                  data-accordion="false">

                  {$menuFront}
                  {* <li class="nav-item menu-open">
                     <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                           Inicio
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Active Page</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Inactive Page</p>
                           </a>
                        </li>
                     </ul>
                  </li> *}

               </ul>
            </nav>

         </div>

      </aside>

      <div class="content-wrapper">
         <div class="loader">
            <span class="spinner"></span>
         </div>
         <div class="modal fade" id="modal-lg" aria-modal="true" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <form class="form-ajax" method="post" target="{Tools::baseUrl()}/support/send">
                     <div class="modal-header bg-navy">
                        <h4 class="modal-title">SOPORTE TÉCNICO</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">×</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="card card-navy card-outline">
                           <div class="card-body mb-0">
                              <div class="row">
                                 <div class="col-8">
                                    <div class="row">
                                       <input type="text" class="form-control form-control-sm mb-1"
                                          value="SEPORTE TÉCNICO" disabled>
                                    </div>
                                    <div class="row">
                                       <input type="text" class="form-control form-control-sm mb-1" value="0412-5899816"
                                          disabled>
                                    </div>
                                    <div class="row">
                                       <input type="text" class="form-control form-control-sm"
                                          value="soporte@drovazca.com" disabled>
                                    </div>
                                 </div>
                                 <div class="col-4 text-right">
                                    <img src="{IMG_URI}tools/support.png" class="img-fluid float-end"
                                       style="max-height: 7rem;">
                                 </div>
                              </div>
                              <div class="row">
                                 <label>Remitente (Correo):</label>
                                 <input type="text" name="sender" class="form-control form-control-sm">
                              </div>
                              <div class="row">
                                 <label>Asunto (Identificación del Cliente):</label>
                                 <input type="text" name="subject" class="form-control form-control-sm">
                              </div>
                              <div class="row">
                                 <label>Contenido (Descripción Detallada):</label>
                                 <textarea type="text" name="message" rows="4" class="form-control form-control-sm"
                                    style="resize: none;"></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" onclick="sendTicket()" class="btn btn-primary"><i
                              class="fas fa-paper-plane mr-1"></i>Enviar
                           Mensaje</button>
                     </div>
                  </form>
               </div>

            </div>

         </div>
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0">{if isset($template.title)}{$template.title}{/if}</h1>
                  </div>
                  <div class="col-sm-6 text-right">
                     {if isset($template.callActions)}
                        {foreach from=$template.callActions item=$call}
                           <a href="{$call.url}"
                              class="ml-2 btn btn-{$call.type|default:'primary'} {if (isset($call.class))}{$call.class}{/if}"
                              {if (isset($call.props))}{$call.props}{/if}>
                              <i class="{if (isset($call.icon))}{$call.icon}{/if} mr-1"></i>{$call.action}</a>
                        {/foreach}
                     {/if}
                     {* <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                     </ol> *}
                  </div>
               </div>
            </div>
         </div>


         <div class="content">
            <div class="container-fluid">
               {include $content}
            </div>
         </div>

      </div>


      <aside class="control-sidebar control-sidebar-dark">

         <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
         </div>
      </aside>


      <footer class="main-footer">

         <div class="float-right d-none d-sm-inline">
            V {APP_VERSION}
         </div>

         <strong>Copyright &copy; 2022</strong> Todos los derechos reservados.
      </footer>
   </div>
</body>

</html>