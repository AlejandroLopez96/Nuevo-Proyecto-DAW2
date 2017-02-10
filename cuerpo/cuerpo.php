<?php
/*Núcleo de la aplicación*/

session_start();

#Constantes de la conexión
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','studiumpro');

#Constantes de la APP
define('HTML_DIR','html/');//aqui vamos a englobar todos los includes de todos los archivos que queramos incluir, por lo tanto  va estar disponible en cualquien controlador y va a pasar a estar disponible en cualquier vista que nosotros llamemos y en cualquier modelo que nosotros llamemos.
define('APP_TITLE','StudiumPro');//esto es para el title de los archivos php
define('APP_COPY','Copyright &copy; ' . date('Y',time()) . ' Alejandro López Ortiz.');//con date(Y) ponemos el año actual y asi se ira actualizando automaticamente dependiendo del año que sea.
define('APP_URL','http://localhost/BBDDPhp/MVCProyectoForo/');


#Constantes de phpMailer
define('PHPMAILER_HOST', 'smtp.gmail.com');
define('PHPMAILER_USER', 'studiumprodaw2@gmail.com');
define('PHPMAILER_PASS', 'StuP123@#');
define('PHPMAILER_PORT', 465);

#Estructura
require('vendor/autoload.php');//Esto se va encargar de cargar todas las librerias automaticamente sin tener que ir colocandolo a mano
require('cuerpo/modelo/class.Conexion.php');
require('cuerpo/bin/functions/Encrypt.php');/*Para asi este disponible en cualquier sitio del codigo*/
require('cuerpo/bin/functions/users.php');
require('cuerpo/bin/functions/emailTemplate.php');
require('cuerpo/bin/functions/LostpassTemplate.php');

$users = Users();/*$user la utilizamos porque va a ser una variable global que vamos a utilizar muhco*/
 ?>
