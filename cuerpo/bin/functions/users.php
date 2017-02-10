<?php

function Users(){
  $db = new Conexion();

  $query = $db->query("SELECT timer FROM config WHERE id='1' LIMIT 1;");
  $timer = $db->recorrer($query)[0];//Ponemos el 0 apuntando al timer y esto nos devuelve un array
  $db->liberar($query);

  $sql = $db->query("SELECT * FROM users;");//seleccionamos toodo de los usuarios
  $usuarios_actuales = $db->rows($sql);//guardamos en esta variable la cantidad de usuarios hay en el sistema

  if(!isset($_SESSION['cantidad_usuarios'])){//si no esta definida esta variable de sesion pues la creamos
    //cuando no existe la variable de sesion que va a ser ssolamente cuando un usuario entre por primera vez a la pagina, cuando haya pasado mucho tiempo sin entrar o cuando haga un logout esa variable de session no existe
    $_SESSION['cantidad_usuarios'] = $usuarios_actuales;//esto nos duvuelve la cantidad de usuarios que hay en el sistema en el momento de la creacion de la variable de session
  }


  if($_SESSION['cantidad_usuarios'] != $usuarios_actuales or (time() - 60) <= $timer){//cuando el numero de susuarios actuales de distinto con respecto al numero que tenemos en la variable de session entramos dentro del if y se recorre el bucle y rellenamos el array y si la comprobación del if da como resultado que son iguales pues entonces significa que no ha habido cambios de usuarios en el sistema por lo que pasa directamente al else de que si no existe la variable de session user por lo que entonces esta entrando por primera vez entonces hay que hacer un primer bucle que el de recorrer la consulta, cuando no esta entrando por primera vez nosotros sabemos que no hay ni un usuario mas ni uno menos asi que mantenemos la misma cantida de usuarios que teniamos, entonces al final del todo nosotros le ponemos lel valor que sea que ha tomado users en la logica del algoritmo que hemos realizado con las comprobaciones. El tiempo actual con un retraso de un minuto sea menor o igual que el timepo que existe en la base de dato y si eso es asi el $timer ha sido actualizaco en un rango de 0 a 60s, en ese periodo de tiempo hubo alguna acrtualizacion que nosotros no tenemos todavia en nuestra variable de session $_SESSION['users'] que se declara al final dependiendo de lo que devuelva $users
      while($d = $db->recorrer($sql)){
        $users[$d['id']] = $d;
      }
  }else{
    if(!isset($_SESSION['users'])){
      while($d = $db->recorrer($sql)){
        $users[$d['id']] = $d;
      }
    } else{
      $users = $_SESSION['users'];
    }

  }

  $_SESSION['users'] = $users;

  $db->liberar($sql);//liberamos sql
  $db->close();

  return $_SESSION['users'];
}

 ?>
