<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."access.php");
require_once(LIB_DIR."header-login.php");
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo MAIN_LINK; ?>dist/img/logo-login.png" />
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión</p>
    <form action="<?php echo MAIN_LINK; ?>controllers/loginController.php" method="post" id="loginprofessional">
    <div id="error"></div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="user" id="user" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required"/>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
        <input type="button" class="btn btn-primary btn-block btn-flat" id="login" value="Enviar"/>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php
require_once(LIB_DIR."footer-login.php");
?>