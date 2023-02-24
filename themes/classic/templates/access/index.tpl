  <!-- /.login-logo -->
  <div class="card" style="border-radius: 30px;">
     <div class="card-body login-card-body">
        <p class="login-box-msg">Introduce tus credenciales de acceso</p>

        <form method="post" class="form-ajax" target="login/auth">
           <div class="row">
              <label for="username">USUARIO:</label>
              <input id="username" name="username" type="text" class="form-control"
                 value="{if (isset($form.username))}{$form.username}{/if}" style="min-width: 21.5em;" required>
           </div>
           <div class="row">
              <label for="password">CONTRASEÑA:</label>
              <input type="password" name="password" class="form-control" value="" required>
           </div>
           <div class="row mt-3">
              <div class="col-8">
                 {* <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                       Recordar Datos
                    </label>
                 </div> *}
              </div>
              <!-- /.col -->
              <div class="col-4">
                 <button type="submit" value="1" class="btn btn-primary btn-block"><i
                       class="fas fa-sign-in-alt mr-1"></i>Acceder</button>
              </div>
              <!-- /.col -->
           </div>
        </form>
        {* <p class="mb-1">
           <a href="forgot-password.html">¿Has olvidado tu contraseña?</a>
        </p> *}

     </div>
     <!-- /.login-card-body -->
</div>