<?php
require ('connector.php');

$con = new ConectorBD($host, $user, $password);
$response['conexion'] = $con->initConexion('');

///crea la base de datos
if ($response['conexion']=='OK') {
    if($con->ejecutarQuery('CREATE DATABASE agenda;')){
      $response['msg']="Base de datos creada exitosamente";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  $con->cerrarConexion();
  echo json_encode($response);

// crea la tabla usuarios
$response['conexion'] = $con->initConexion('agenda');
if ($response['conexion']=='OK') {
    $sql= "CREATE TABLE usuarios (
          id_us int(11) NOT NULL,
          email_us varchar(200) NOT NULL,
          pass_us varchar(255) NOT NULL,
          fecnac_us date NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    if($con->ejecutarQuery($sql)){
      $response['msg']="Tabla usuarios se creó exitosamente";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  echo json_encode($response);

  ///crea las primary keys
  if ($response['conexion']=='OK') {
      $sql= "ALTER TABLE usuarios ADD PRIMARY KEY (id_us), ADD UNIQUE KEY email_us (email_us);";
      if($con->ejecutarQuery($sql)){
        $response['msg']="Primary key agregada exitosamente";
      }else {
        $response['msg']= "Hubo un error y los datos no han sido cargados";
      }
    }else {
      $response['msg']= "No se pudo conectar a la base de datos";
    }
    echo json_encode($response);

    ///crea autoincrement
    if ($response['conexion']=='OK') {
        $sql= "ALTER TABLE usuarios MODIFY id_us int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13";
        if($con->ejecutarQuery($sql)){
          $response['msg']="autoincrement agregado exitosamente";
        }else {
          $response['msg']= "Hubo un error y los datos no han sido cargados";
        }
      }else {
        $response['msg']= "No se pudo conectar a la base de datos";
      }
      echo json_encode($response);
    ///crea la tabla eventos
    if ($response['conexion']=='OK') {
        $sql= "CREATE TABLE eventos (
              id_ev int(11) NOT NULL,
              titulo_ev varchar(200) NOT NULL,
              fecinicio_ev date NOT NULL,
              horainicio_ev time DEFAULT NULL,
              fecfin_ev date DEFAULT NULL,
              horafin_ev time DEFAULT NULL,
              diacompleto_ev boolean NOT NULL,
              fk_id_us int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
        if($con->ejecutarQuery($sql)){
          $response['msg']="Tabla eventos, creada exitosamente";
        }else {
          $response['msg']= "Hubo un error y los datos no han sido cargados";
        }
      }else {
        $response['msg']= "No se pudo conectar a la base de datos";
      }
      echo json_encode($response);
      ///crea las primary keys
      if ($response['conexion']=='OK') {
          $sql= "ALTER TABLE eventos ADD PRIMARY KEY (id_ev);";
          if($con->ejecutarQuery($sql)){
            $response['msg']="Primary key agregada correctamente";
          }else {
            $response['msg']= "Hubo un error y los datos no han sido cargados";
          }
        }else {
          $response['msg']= "No se pudo conectar a la base de datos";
        }
        ///crea las autoincereme
        echo json_encode($response);
        if ($response['conexion']=='OK') {
            $sql= "ALTER TABLE eventos MODIFY id_ev int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13";
            if($con->ejecutarQuery($sql)){
              $response['msg']="autoincrement creado exitosamente";
            }else {
              $response['msg']= "Hubo un error y los datos no han sido cargados";
            }
          }else {
            $response['msg']= "No se pudo conectar a la base de datos";
          }
          echo json_encode($response);
//CREA usuarios
$data['email_us'] = "'carlos@gmail.com'";
$data['pass_us'] = "'".password_hash('clave', PASSWORD_DEFAULT)."'";
$data['fecnac_us'] = "'1996-04-09'";
$data1['email_us'] = "'miguel@hotmail.com'";
$data1['pass_us'] = "'".password_hash('clave1', PASSWORD_DEFAULT)."'";
$data1['fecnac_us'] = "'1985-09-03'";
$data2['email_us'] = "'jorge@yahoo.es'";
$data2['pass_us'] = "'".password_hash('clave2', PASSWORD_DEFAULT)."'";
$data2['fecnac_us'] = "'1994-01-03'";

if ($response['conexion']=='OK') {
    if($con->insertData('usuarios', $data)){
      $response['msg']="Se insertaron datos correctamente";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

if ($response['conexion']=='OK') {
  if($con->insertData('usuarios', $data1)){
    $response['msg']="Se insertaron datos correctamente";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
  $response['msg']= "No se pudo conectar a la base de datos";
  }

if ($response['conexion']=='OK') {
  if($con->insertData('usuarios', $data2)){
    $response['msg']="Se insertaron datos correctamente";
  }else {
    $response['msg']= "Hubo un error y los datos no han sido cargados";
  }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
  echo json_encode($response);
?>
