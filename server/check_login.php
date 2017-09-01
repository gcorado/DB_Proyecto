<?php
  require('connector.php');
  $con = new ConectorBD($host, $user, $password);
  $response['conexion'] = $con->initConexion('agenda');
  if ($response['conexion']=='OK') {
    $resultado_consulta = $con->consultar(['usuarios'],
    ['email_us', 'pass_us'], 'WHERE email_us="'.$_POST['username'].'"');

    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      if (password_verify($_POST['password'], $fila['pass_us'])) {
        $response['acceso'] = 'concedido';
        session_start();
        $_SESSION['username']=$fila['email_us'];
      }else {
        $response['motivo'] = 'Contraseña incorrecta';
        $response['acceso'] = 'rechazado';
      }
    }else{
      $response['motivo'] = 'Usuario incorrecto';
      $response['acceso'] = 'rechazado';
    }
  }
  echo json_encode($response);
  $con->cerrarConexion();
 ?>
