<?php
  require('./connector.php');

  session_start();

  if (isset($_SESSION['username'])) {
    $con = new ConectorBD($host, $user, $password);
    if ($con->initConexion('agenda')=='OK') {
      $data['fecinicio_ev'] = "'".$_POST['start_date']."'";
      $data['horainicio_ev'] = "'".$_POST['start_hour']."'";
      $data['fecfin_ev'] = "'".$_POST['end_date']."'";
      $data['horafin_ev'] = "'".$_POST['end_hour']."'";
      if ($con->actualizarRegistro('eventos', $data,"id_ev ='" .$_POST['id']."'")) {
        $response['msg']= 'OK';
      }else {
        $response['msg']= 'No se pudo realizar la inserción de los datos';
      }
    }else {
      $response['msg']= 'No se pudo conectar a la base de datos';
    }
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }

  echo json_encode($response);

 ?>
