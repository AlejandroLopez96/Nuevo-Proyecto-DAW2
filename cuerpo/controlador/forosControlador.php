<?php

if(isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1){
  $id_foro = intval($_GET['id']);
  if(array_key_exists($id_foro, $foros)){//hacemos esto porque asi comprobamos que exista $id_foro en el array de la variable que tenemos definida en cuerpo.php $foros
    $db = new Conexion();
    $sql_anuncios = $db->query("SELECT * FROM temas WHERE id_foro='$id_foro' AND tipo = '2' ORDER BY id DESC");
    $sql_no_anuncios = $db->query("SELECT * FROM temas WHERE id_foro='$id_foro' AND tipo = '1' ORDER BY id DESC");
    include(HTML_DIR . 'temas/temas.php');
    $db->liberar($sql_anuncios,$sql_no_anuncios);
    $db->close();
  }else{
    header('location: ../index.php?view=error');
  }
}else{
  header('location: ?view=index');
}

 ?>
