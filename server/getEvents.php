<?php
  require('./connector.php');
  session_start();
  if (isset($_SESSION['username'])) {
    $con = new ConectorBD($host, $user, $password);
    if ($con->initConexion('agenda')=='OK') {

      $resultado = $con->consultar(['usuarios'],['id_us'], "WHERE email_us ='" .$_SESSION['username']."'");
      $fila = $resultado->fetch_assoc();
      $resultado = $con->consultar(['eventos'], ['id_ev', 'titulo_ev','fecinicio_ev','horainicio_ev','fecfin_ev','horafin_ev', 'diacompleto_ev'], "WHERE fk_id_us ='".$fila['id_us']."'");
      $i=0;
      while ($fila = $resultado->fetch_assoc()) {
        //$response['eventos'][$i] = $fila['id_evento']." (".$fila['titulo_evento']." ".$fila['fecini_evento']." ".$fila['horaini_evento']." ".$fila['fecfin_evento']." ".$fila['horafin_evento']." ".$fila['diacom_evento'].")";
        if($fila['diacompleto_ev']==1){
          $todoElDia=true;
        }else {
          $todoElDia=false;
        }
        $response['eventos'][$i] = array(
            "id" => $fila['id_ev'],
            "title" => $fila['titulo_ev'],
            "start" => $fila['fecinicio_ev']."T".$fila['horainicio_ev'],
            "allDay" => $todoElDia,
            "end" => $fila['fecfin_ev']."T".$fila['horafin_ev']
        );
        $i++;
      }
      $response['msg']= 'OK';
    }else {
      $response['msg']= 'No se pudo conectar a la base de datos';
    }
  }else {
    $response['msg']= 'No se ha iniciado una sesión';
  }
  echo json_encode($response);
 ?>
