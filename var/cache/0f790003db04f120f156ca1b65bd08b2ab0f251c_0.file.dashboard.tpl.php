<?php
/* Smarty version 4.3.0, created on 2023-02-28 04:33:00
  from 'C:\xampp\htdocs\drovazca\app\fs-admin\themes\classic\templates\dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_63fdbc3c1cfd87_83297440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f790003db04f120f156ca1b65bd08b2ab0f251c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\drovazca\\app\\fs-admin\\themes\\classic\\templates\\dashboard.tpl',
      1 => 1676412566,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63fdbc3c1cfd87_83297440 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>

<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>FARMASIC<?php if ((isset($_smarty_tpl->tpl_vars['template']->value['title']))) {?> | <?php echo $_smarty_tpl->tpl_vars['template']->value['title'];?>
 <?php }?></title>
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="preload" as="style" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/fontawesome-free/css/all.min.css">

   <link rel="preload" as="style" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
css/adminlte.min.css?v=3.2.0">
   <link rel="preload" as="style" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
css/custom.dash.css">
   <link rel="preload" as="style" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
css/adminlte.min.css?v=3.2.0">
   <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
css/custom.dash.css">
   <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/select2/css/select2.min.css">
   <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
         
   <link rel="icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
/img/favicon_drovaz.png">
   <link rel="preload" as="style"
      href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
   <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
   <?php if ((isset($_smarty_tpl->tpl_vars['template']->value['meta']))) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['template']->value['meta'], 'meta');
$_smarty_tpl->tpl_vars['meta']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['meta']->value) {
$_smarty_tpl->tpl_vars['meta']->do_else = false;
?>
         <meta <?php echo $_smarty_tpl->tpl_vars['meta']->value['key'];?>
="<?php echo $_smarty_tpl->tpl_vars['meta']->value['value'];?>
" />
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
   <?php }?>
   
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/jquery/jquery.min.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/bootstrap/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
js/adminlte.min.js?v=3.2.0"><?php echo '</script'; ?>
>


   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/datatables/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/bs-custom-file-input/bs-custom-file-input.min.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/select2/js/select2.full.min.js"><?php echo '</script'; ?>
>

      <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/inputmask/jquery.inputmask.min.js"><?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/moment/moment.min.js"><?php echo '</script'; ?>
>

   <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
plugins/bs-custom-file-input/bs-custom-file-input.min.js"><?php echo '</script'; ?>
>
      
   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['js']->value, 'uri');
$_smarty_tpl->tpl_vars['uri']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['uri']->value) {
$_smarty_tpl->tpl_vars['uri']->do_else = false;
?>
      <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['uri']->value;?>
"><?php echo '</script'; ?>
>
   <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
   
   <style>
      .spinner {
         width: 24px;
         height: 80px;
         display: block;
         margin: 35px auto 0;
         border: 1px solid #FFF;
         border-radius: 0 0 50px 50px;
         position: relative;
         box-shadow: 0px 0px #0b9b9d inset;
         background-image: linear-gradient(#0b9b9d 100px, transparent 0);
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
            box-shadow: 4px -60px rgba(255, 255, 255, 0.5), 6px -50px rgba(255, 255, 255, 0.4), 10px -90px rgba(255, 255,
                  255,
                  0.5), 15px -25px rgba(255, 255, 255, 0.5);
         }

         80% {
            box-shadow: 2px -80px rgba(255, 255, 255, 0.5), 4px -70px rgba(255, 255, 255, 0.4), 8px -120px rgba(255, 255,
                  255,
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
                  <p><b class="pr-1">ACTUALIZADO:</b><?php echo ExchangeRates::getLastDate();?>
 <b>TASA BCV:</b>
                     $<?php echo ExchangeRates::getCurrentRate();?>

                  </p>
               </a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link d-flex" data-toggle="dropdown" href="#">
                  <img src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
/img/user-profile.jpg" alt="User Avatar" style="margin: -8px 5px 0px 0px !important;
height: 35px;" class="mr-3 img-circle">
                  <p><?php echo Session::get('_uname');?>
</p>
                                 </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right card-widget widget-user-2 shadow"
                  style="margin-top: 10px;">

                  <div class="bg-navy widget-user-header" style="background: #343a40; color: #fff;">
                     <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
/img/user-profile.jpg" alt="User Avatar">
                     </div>

                     <h3 class="widget-user-username"><?php echo Session::get('_uname');?>
</h3>
                                       </div>
                  <div class="card-footer p-2">
                     <ul class="nav flex-column">
                                                <li class="dropdown-divider"></li>
                        <li class="nav-item">
                           <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
?controller=AdminLogin&action=logout&token=<?php echo Tools::getValue('token');?>
"
                              class="nav-link bg-danger text-center" style="border-radius: .75em;">
                              <i class="fas fa-power-off"></i> Cerrar Sesión
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
                           </li>
         </ul>
      </nav>


      <aside class="main-sidebar sidebar-dark-primary bg-navy elevation-4">

         <a href="<?php echo Tools::baseUrl();?>
?controller=AdminDashboard" class="brand-link bg-navy">
            <img src="<?php echo $_smarty_tpl->tpl_vars['urls']->value['assets'];?>
/img/favicon_drovaz.png" alt="AdminLTE Logo" class="brand-image img-circle"
               style="opacity: .8">
            <h2 class="brand-text text-bg font-weight-bold text-white " style="font-size:16px">FARMASIC</h2>
         </a>

         <div class="sidebar">
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                  data-accordion="false">

                  <?php echo $_smarty_tpl->tpl_vars['menuBack']->value;?>

                  
               </ul>
            </nav>

         </div>

      </aside>

      <div class="content-wrapper">
         <div class="loader">
            <span class="spinner"></span>
         </div>

         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0"><?php if ((isset($_smarty_tpl->tpl_vars['template']->value['title']))) {
echo $_smarty_tpl->tpl_vars['template']->value['title'];
}?></h1>
                  </div>
                  <div class="col-sm-6 text-right">
                     <?php if ((isset($_smarty_tpl->tpl_vars['template']->value['callActions']))) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['template']->value['callActions'], 'call');
$_smarty_tpl->tpl_vars['call']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['call']->value) {
$_smarty_tpl->tpl_vars['call']->do_else = false;
?>
                           <a href="<?php echo $_smarty_tpl->tpl_vars['call']->value['url'];?>
" class="ml-2 btn btn-<?php echo (($tmp = $_smarty_tpl->tpl_vars['call']->value['type'] ?? null)===null||$tmp==='' ? 'primary' ?? null : $tmp);?>
">
                              <i class="<?php if (((isset($_smarty_tpl->tpl_vars['call']->value['icon'])))) {
echo $_smarty_tpl->tpl_vars['call']->value['icon'];
}?> mr-1"></i><?php echo $_smarty_tpl->tpl_vars['call']->value['action'];?>
</a>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                     <?php }?>
                                       </div>
               </div>
            </div>
         </div>


         <div class="content">
            <div class="container-fluid">
               <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
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
            V 1.0.0
         </div>

         <strong>Copyright &copy; 2022</strong> Todos los derechos reservados.
      </footer>
   </div>




   <?php echo '<script'; ?>
>

   <?php echo '</script'; ?>
>

</body>

</html><?php }
}
