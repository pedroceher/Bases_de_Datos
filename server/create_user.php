<?php
//Este archivo es para dar de alta tres usuarios en la base de datos
require('conector.php');
$tabla = 'usuarios';
$campos =['nombre','psw','email','fecha_nacimiento'];
$data =array(
  array("'Jose Nieves'", "'".password_hash("12345", PASSWORD_DEFAULT)."'", "'josen@mail.com'","'1980/12/8'"),
  array("'Pablo Puerta'", "'".password_hash("67890", PASSWORD_DEFAULT)."'", "'pablop@mail.com'", "'1986/05/30'"),
  array("'Maria Fuerte'", "'".password_hash("456789", PASSWORD_DEFAULT)."'", "'mariaf@mail.com'", "'1996/08/21'")
);


$conector = new ConectorBD('localhost','agenda_general','123456');

if ($conector->initConexion('agenda_db')=='OK') {
  if($conector->insertMultiData($tabla, $campos, $data)){
    $response['msg']="exito en la inserción";
  }else {
    $response['msg']= "Hubo un error y los datos no han sido cargados";
  }
}
else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }
cerrarConexion();

echo $response;
?>
