<?php

function Encrypt($string){/*aqui entra cualquier string*/
  $long = strlen($string); /*obtenemos su longitud*/
  $str = '';/*variable vacía*/
  for($x = 0; $x < $long; $x++){ /*recorremos cada posicion del string desde 0 hasta su longitud*/
    $str .= ($x % 2) != 0 ? md5($string[$x]) : $x; /* si es impar encriptar md5 ese caracter y si no lo dejamos cmo estaba*/
  }
  return md5($str);/*asi tenemos un monton de encriptado*/
}

 ?>
