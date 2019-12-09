<?php
require('conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost','agenda_general','123456');
  if ($con->initConexion('agenda_db')=='OK') {

    $resultado = $con->consultar(['usuarios'],['id'], "WHERE email ='" .$_SESSION['username']."'");
    $fila = $resultado->fetch_assoc();
    $data['fk_user']= $fila['id'];
    $data['titulo'] = "'".$_POST['titulo']."'";
    $data['fecha_inicio'] = "'".$_POST['start_date']."'";
    $data['hora_inicio'] = "'".$_POST['start_hour']."'";
    $data['fecha_fin'] = "'".$_POST['end_date']."'";
    $data['hora_fin'] = "'".$_POST['end_hour']."'";
    if ($_POST['allDay']== 'true') {
      $data['dia_completo']=1;
    }else {
      $data['dia_completo']=0;
    }

    if ($con->insertData('eventos', $data)) {
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
