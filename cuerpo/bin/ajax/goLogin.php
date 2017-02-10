<?php
/*Esto es para que no se envíen datos vacíos*/
if(!empty($_POST['user']) and !empty($_POST['pass'])){
  $db = new Conexion();
  $data = $db->real_escape_string($_POST['user']);/*datos que nos llegan*/
  $pass = Encrypt($_POST['pass']);/*crearemos una funcion de encriptado en la carpeta functions de la carpeta bin.*/
  $sql = $db->query("SELECT id FROM users WHERE (user='$data' OR email='$data') AND pass='$pass' LIMIT 1;");/*ponemos el parentesis ya que en el d¡formulario de inicio de sesión ses puede entrar con nombre de usuario o email asi hacemos la comprobacion de con que entra el usuario*/

  if($db->rows($sql) > 0){
    if($_POST['session']){
      ini_set('session.cookie_lifetime', time() + (60*60*24));/*Esta es la duración de la sesion que es de 1 dia osea 24 horas*/
    }
    $_SESSION['app_id'] = $db->recorrer($sql)[0];/*Aqui ahorramos codigo, porque db->recorrer($sql) devuelve un array y asi no creamos una variable solamente para el db->recorrer($sql) */
    $_SESSION['time_online'] = time() - (60*6);//cada vez que un usuario inicie sesion se va a crear  esta variable de sesion, le restamos 6 mins simulando que la ultima conexion fue hace 6 mins
    echo 1;
  }else{
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>ERROR:</strong> <a href="#" class="alert-link">Los datos introducidos son incorrectos.
  </div>';
  }
  $db->liberar($sql);
  $db->close();
}else{
  echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>ERROR:</strong> <a href="#" class="alert-link">Todos los datos deben estar rellenos.
</div>';
}

?>
