<?php

if($_POST){/*solamente puede entrar un usuario si se ha enviado una peticion post sino lo redireccionamos a index.php*/

  require('cuerpo/cuerpo.php');

  switch (isset($_GET['mode']) ? $_GET['mode'] : null) {/*verificamos que exista la variable mode, si existe vamos a darle su valor de lo contrario diremos que es null*/
    case 'login':
      require('cuerpo/bin/ajax/goLogin.php');
      break;
    case 'reg':
      require('cuerpo/bin/ajax/goReg.php');
      break;
      case 'lostpass':
        require('cuerpo/bin/ajax/goLostpass.php');
        break;
    default:
      header('location: index.php');
      break;
  }
}else{
  header('location: index.php');
}

?>
