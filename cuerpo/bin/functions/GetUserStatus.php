<?php

function GetUserStatus($time){//pasamos como parametrro el tiempo de la ultima conexion que tenemos en la base de datos
  if ($time >= (time() - (60*5))) {//si se cumple significa que hace 5 mins o entre ese rango se ha actualizado alguna vez ultima_conexion por lo tanto se considera que el usuario esta online de lo contrario no esta online
    return 'icon_online.gif';
  }else{
    return 'icon_offline.gif';
  }
}

 ?>
