<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Documentos Factura Electrónica CHASA</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="<?=base_url('public/app/img/favicon.png')?>" />
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('public/sources/'); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('public/sources/'); ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('public/sources/'); ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('public/sources/'); ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url('public/sources/'); ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('public/sources/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url('public/sources/'); ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url('public/sources/'); ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('public/sources/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php echo isset($datatpl['css']) ? $datatpl['css'] : ''; ?>

  </head>
  <body class="" style="">
    <div class="wrapper ">
        <?php echo isset($datatpl['contenido']) ? $datatpl['contenido'] : '' ; ?>


    </div>
<script>
var BASE_URL = "<?=base_url()?>"

        function base_url($ruta = false){
            $b = '<?=base_url()?>';
            return $ruta ? ($b + $ruta) : $b;
        }
</script>

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('public/sources/'); ?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('public/sources/'); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
  <!--   <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url('public/sources/'); ?>plugins/morris/morris.min.js" type="text/javascript"></script> -->
    <!-- Sparkline -->
    <!-- <script src="<?php echo base_url('public/sources/'); ?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script> -->
    <!-- jvectormap -->
    <!-- <script src="<?php echo base_url('public/sources/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('public/sources/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="<?php echo base_url('public/sources/'); ?>plugins/knob/jquery.knob.js" type="text/javascript"></script> -->
    <!-- daterangepicker -->
  <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('public/sources/'); ?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <!-- <script src="<?php echo base_url('public/sources/'); ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script> -->
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('public/sources/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('public/sources/'); ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('public/sources/'); ?>plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('public/sources/'); ?>dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?php echo base_url('public/sources/'); ?>dist/js/pages/dashboard.js" type="text/javascript"></script> -->

    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url('public/sources/'); ?>dist/js/demo.js" type="text/javascript"></script> -->

    <?php echo isset($datatpl['script']) ? $datatpl['script'] : '' ; ?>

  </body>
</html>


