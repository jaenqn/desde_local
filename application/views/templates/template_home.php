<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">

    <?php echo isset($datatpl['css']) ? $datatpl['css'] : ''; ?>
</head>
<body>
    <?php echo isset($datatpl['contenido']) ? $datatpl['contenido'] : '' ; ?>
    <?php echo isset($datatpl['script']) ? $datatpl['script'] : '' ; ?>
</body>
</html>