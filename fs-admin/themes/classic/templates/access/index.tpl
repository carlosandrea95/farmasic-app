  <!-- /.login-logo -->
  <div class="card" style="border-radius: 30px;">
     <div class="card-body login-card-body">
        <p class="login-box-msg">Introduce tus credenciales de acceso</p>

        <form method="post" class="form-ajax" target="{Tools::ajaxRequest('AdminLogin&action=auth')}">
           <div class="row">
              <label for="username">USUARIO:</label>
              <input id="username" name="username" type="text" class="form-control"
                 value="{if (isset($form.username))}{$form.username}{/if}" style="min-width: 21.5em;" required>
           </div>
           <div class="row">
              <label for="password">CONTRASEÑA:</label>
              <input type="password" name="password" class="form-control" value="" required>
           </div>
           <div class="row mt-3 justify-content-end">
              <!-- /.col -->
              <div class="col-4">
                 <button type="submit" value="1" class="btn btn-primary btn-block"><i
                       class="fas fa-sign-in-alt mr-1"></i>Acceder</button>
              </div>
              <!-- /.col -->
           </div>
        </form>
     </div>
     <!-- /.login-card-body -->
</div>