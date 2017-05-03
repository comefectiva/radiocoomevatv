<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>App SOAP</title>
  </head>
  <body>
    <?php
      $response = null;
      $data = null;
      $errors = false;
        if(isset($_POST['user'])){
          try{
            $data = $_POST;
            $client = new SoapClient('http://profile.coomeva.com.co/profileWs/services/Caas?wsdl');
            $params = array('userName'=>$data['user'], 'password'=>$data['pass'], 'directory'=>1);
            $response = $client->validateUser($params);
          }catch(Exception $e){
              $response = $e->getMessage();
              $errors = true;
          }
        }
     ?>

     <form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <div class="error">
         <?php
             if($response!==null && $errors === true){
                 print_r($response.'<br/>');
             }elseif($response!==null && $errors === false){
                 echo '<h3>Información Valida, login exitoso</h3>';
             }else{
                 echo 'Introduce la Información a evaluar:';
             }
         ?>
          <input placeholder="Ingresa El usuario" type="text" name="user" value="">
          <input placeholder="Ingresa La Contraseña" type="text" name="pass" value="">
          <input type="submit" name="enviar" value="Enviar">
       </div>
     </form>
  </body>
</html>
