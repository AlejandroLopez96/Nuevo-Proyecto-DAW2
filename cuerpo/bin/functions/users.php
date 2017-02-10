<?php

function Users(){
  $db = new Conexion();
  $sql = $db->query("SELECT * FROM users;");/*seleccionamos toodo de los usuarios*/
  if($db->rows($sql) > 0){/*si existen usuarios en el sistema*/
    while($d = $db->recorrer($sql)){/*asi recorremos cada resultado de la consulta*/
      /*Generamos un array para cada usuario recogiendo todos sus datos*/
      $users[$d['id']] = array(
        'id'=> $d['id'],
        'user'=> $d['user'],
        'pass'=> $d['pass'],
        'email'=> $d['email'],
        'rol'=> $d['rol']
      );
    }
  }else{
    $users = false;/*user no existe*/
  }

  $db->liberar($sql);/*liberamos sql*/
  $db->close();

  return $users;
}

 ?>
