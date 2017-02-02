<?php

function OnlineUsers(){
  if(isset($_SESSION['app_id'])){//si el usuario que esta visualizando la pagina esta conectado y con esto refrescamos en la base de datos el tiempo online del usuario actual
    $id_usuario = $_SESSION['app_id'];
    if(time() >= ($_SESSION['time_online'] + (60*5))){//si el tiempo actual es mayor a la ultima vez que se le actualizo la sesion mas 5 mins, eso quiere decir que el usuario sigue activo porque ha pasado al menos 5 mins conectado, cuando esto se cumpla la sesion se va a recargar con ese mismo tiempo que era mayor que el que tenía, cuando vuelvan a recargar la pagina esa condicion ya no se cumple
      $time = time();
      $_SESSION['time_online'] = $time;
      $_SESSION['users'][$id_usuario]['ultima_conexion'] = $time;//esto lo necesitamos porque esa variable de sesion de ese usuario le dictamos la ultima conexion y la igualamos a $time ademas de hacerlo en la base de datos
      $db = new Conexion();
      $query = "UPDATE users SET ultima_conexion='$time' WHERE id='$id_usuario' LIMIT 1;";
      $query .= "UPDATE config SET timer='$time' WHERE id='1' LIMIT 1;";
      $db->multi_query($query);
      $db->close();
    }
  }
}

 ?>
