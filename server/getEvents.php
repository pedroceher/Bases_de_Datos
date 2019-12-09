<?php
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {

  $con = new ConectorBD('localhost','agenda_general','123456');

  if ($con->initConexion('agenda_db')=='OK') {

    $user_result = $con->consultar(['usuarios'], ['id', 'email'], "WHERE email ='".$_SESSION['username']."'");
    $fila_user = $user_result->fetch_assoc();

    $resultado = $con->consultar(['eventos'], ['id', 'titulo', 'fecha_inicio', 'hora_inicio', 'fecha_fin', 'hora_fin', 'dia_completo', 'fk_user'], "WHERE fk_user ='".$fila_user['id']."'");
    $i=0;
    while ($fila = $resultado->fetch_assoc()) {
      $response['eventos'][$i]['id'] = $fila['id'];
      $response['eventos'][$i]['title'] = $fila['titulo'];
      $response['eventos'][$i]['start'] = $fila['fecha_inicio']." ".$fila['hora_inicio'];
      $response['eventos'][$i]['end'] = $fila['fecha_fin']." ".$fila['hora_fin'];
      if($fila['dia_completo'] == 1){
      $response['eventos'][$i]['allDay'] = true;
      }else{
      $response['eventos'][$i]['allDay'] = false;
      }
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
