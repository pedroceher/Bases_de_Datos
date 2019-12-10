<?php

require('conector.php');

session_start();

if (isset($_SESSION['username'])) {

  $con = new ConectorBD('localhost','agenda_general','123456');

  if ($con->initConexion('agenda_db')=='OK') {
    if ($con->eliminarRegistro('eventos', 'id ='.$_POST['id'])){
      $response['msg'] = 'OK';
    }else {
      $response['msg'] = 'Hubo un problema y el evento no fue eliminado';
    }
  }else {
    $response['msg']= 'No se pudo conectar a la base de datos';
  }
}else {
  $response['msg']= 'No se ha iniciado una sesión';
}

echo json_encode($response);


 ?>
