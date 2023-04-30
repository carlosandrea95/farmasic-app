<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DROVAZCA | Acceso</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{$urls.assets}plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{$urls.assets}/css/adminlte.min.css">
    <link rel="stylesheet" href="{$urls.assets}/css/custom.login.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="{$urls.assets}/css/fonts.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="{$urls.assets}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{$urls.assets}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{$urls.assets}plugins/sweetalert2/sweetalert2.all.min.js"></script>


    <link rel="icon" type="image/x-icon" href="{$urls.assets}/img/favicon_drovaz.png">
    {nocache}
    {foreach from=$js item=$uri}
        <script src="{$uri}"></script>
    {/foreach}
    {/nocache}
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="https://drovazca.com" class="text-center">
                <img class="img img-fluid" src="{$urls.assets}/img/logo_drovaz.png" alt=""><br>
                ADMINISTRATIVO
            </a>
        </div>
    </div>
    <!-- /.login-box -->
    {include file="$content"}

</body>

</html>