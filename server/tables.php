<?php
  //Este archivo es para crear las tablas y relaciones en la base de datos de la agenda, se ejecuta solo una vez
  require('conector.php');

  $tableUsers = 'usuarios';
  $user['id']= 'INT PRIMARY KEY';
  $user['nombre']= 'VARCHAR(45)';
  $user['psw']= 'VARCHAR(45)';
  $user['email']= 'VARCHAR(10)';
  $user['fecha_nacimiento']= 'DATE';

  $tableEventos = 'eventos';
  $evento['id']= 'INT PRIMARY KEY';
  $evento['titulo']= 'VARCHAR(45)';
  $evento['fecha_inicio']= 'DATE NOT NULL ';
  $evento['hora_inicio']= 'TIME';
  $evento['fecha_fin']= 'DATE';
  $evento['hora_fin']= 'TIME';
  $evento['dia_completo']= 'TINYINT(1)';
  $evento['fk_user']= 'INT';


  $conector = new ConectorBD('localhost','agenda_general','123456');

  if ($conector->initConexion('agenda_db')=='OK') {
    //Creacion de tabla usuarios
    $query = $conector->newTable($tableUsers, $user);
    if ($conector->ejecutarQuery($query)) {
      echo "La tabla usuarios se creó exitosamente";
    }else {
      echo "Se produjo un error al crear la tabla usuarios";
    }
    //Creacion de tabla eventos
    $query = $conector->newTable($tableEventos, $evento);
    if ($conector->ejecutarQuery($query)) {
      echo "La tabla eventos se creó exitosamente";
      //Creacion de relacion entre eventos y usuarios
      if($conector->nuevaRelacion('eventos','fk_user','usuarios','id')){
        echo "La relacion eventos y usuarios se creo correctamente";
      }else {
        echo "Se presento un error al crear la relación";
      }
    }else {
      echo "Se produjo un error al crear la tabla eventos";
    }
    $conector->cerrarConexion();
  }else {
    echo $conector->initConexion();
  }


 ?>
