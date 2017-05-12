<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ingreso de Usuario</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?=base_url('public/sources/')?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url('public/sources/')?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url('public/sources/')?>plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?=base_url('public/sources/')?>index2.html"><b>E-</b>Chasa</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese para iniciar gestión</p>
        <form action="<?=base_url('gestion/login')?>" method="post" id="frmaccesousuario">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Cuenta de Usuario" name="txtusuario" id="txtusuario"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Contraseña" name="txtpass" id="txtpass"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
             <!--  <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div> -->
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
          </div>
        </form>

       <!--  <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> --><!-- /.social-auth-links -->

      <!--   <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script type="text/javascript">
        function base_url($ruta = false){
            $b = '<?=base_url()?>';
            return $ruta ? ($b + $ruta) : $b;
        }
    </script>
    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url('public/sources/')?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url('public/sources/')?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?=base_url('public/sources/')?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="<?=base_url('public/app/acceso_usuario.js')?>" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>