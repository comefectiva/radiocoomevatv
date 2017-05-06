<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ingreso Momentos Empresariales</title>
  </head>
  <style media="screen">
    body{
      background: url(http://radiocoomevatv-comefectiva.rhcloud.com/prototipo/img/background.jpg);
      background-size: 100%;
      background-repeat: no-repeat;
    }
    label{
      color: white;
      font-size: 16px;
    }
    .container{
      width: 30% !important;
      margin-top: 11.6%;
      padding: 2%;
      text-align: center !important;
    }
    .help-block{
      color: #f00 !important;
      color: 14px;
    }
  </style>
  <link rel="stylesheet" href="http://radiocoomevatv-comefectiva.rhcloud.com/lib/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  <script type="text/javascript" src="http://radiocoomevatv-comefectiva.rhcloud.com/lib/bootstrap/dist/js/bootstrap.min.js"></script>
  <body>
    <div class="container">
      <img src="http://radiocoomevatv-comefectiva.rhcloud.com/prototipo/img/cosito_momentos_empresariales.png" alt="" width="250" />
      <form action="http://radio.coomeva.com.co/live/methods/login_db_simple.php" method="post">
        <div class="form-group <?php echo $class ?>">
          <label class="control-label" for="inputSuccess1">Ingresa tu documento</label>
          <span class="help-block"> <?php echo (isset($_GET['error']) && $_GET['error']=="1")?"Registro no encontrado":""; ?> </span>
          <input name="document" type="text" class="form-control" aria-describedby="helpBlock2" required />
        </div>
        <input type="hidden" name="project" value="atletas-empresariales">
        <input type="hidden" name="return_false" value="http://radio.coomeva.com.co/live/programs/atletas_empresariales/login.php">
        <input type="hidden" name="return_true" value="http://radio.coomeva.com.co/live/programs/atletas_empresariales/index.php">
        <button type="submit" class="btn btn-default">Ingresar</button>
      </form>
    </div>
  </body>
</html>
