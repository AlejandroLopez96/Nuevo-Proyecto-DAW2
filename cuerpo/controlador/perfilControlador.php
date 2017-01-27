<?php

if (isset($_GET['id']) and array_key_exists($_GET['id'],$users)) {//comprobamos que este definido get id y que se este intentando visualizar un usuario que realmente exista en el sistema
  $id_usuario = intval($_GET['id']);
  $db = new Conexion();
  $sql = $db->query("SELECT COUNT(id) FROM temas WHERE id_dueno='$id_usuario'");
  include(HTML_DIR . 'perfil/perfil.php');
  $db->liberar($sql);
  $db->close();
}else{
  header('location: ?view=index');
}

 ?>
