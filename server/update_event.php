<?php
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','agenda_general','123456');
  if ($con->initConexion('agenda_db')=='OK') {

    $data['id'] = "'".$_POST['id']."'";
    $data['fecha_inicio'] = "'".$_POST['start_date']."'";
    $data['hora_inicio'] = "'".$_POST['start_hour']."'";
    $data['fecha_fin'] = "'".$_POST['end_date']."'";
    $data['hora_fin'] = "'".$_POST['end_hour']."'";

    if ($con->actualizarRegistro('eventos', $data, "id = ".$_POST['id'])) {
      $response['msg'] = "OK";
    }else {
      $response['msg'] = "Hubo un problema y el evento no fue actualizado";
    }
  }else {
    $response['msg']= 'No se pudo conectar a la base de datos';
  }
}else {
  $response['msg']= 'No se ha iniciado una sesión';
}

echo json_encode($response);


 ?>
