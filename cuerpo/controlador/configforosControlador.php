<?php

if(isset($_SESSION['app_id']) and $users[$_SESSION['app_id']]['rol'] >= 2) {
  
   $isset_id = isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;//esto no es un if simplemente nos devuelve un valor de true o false, y lo guardo en una variable  poruqe lo voy a poner en dos sitios y asi no lo tengo que escribir dos veces todo lo de isset..... y asi controlamos que dicho id exista , que sea numerico y que sea mayor  o igual a 1;

   require('cuerpo/modelo/class.ConfigForos.php');
   $config_foros = new ConfigForos();

   switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
     case 'add':
       if($_POST) {
         $config_foros->Add();
       } else {
         include(HTML_DIR . 'foros/add_foro.php');
       }
     break;
     case 'edit':
       if($isset_id and array_key_exists($_GET['id'],$foros)) {
         if($_POST) {
           $config_foros->Edit();
         } else {
           include(HTML_DIR . 'foros/edit_foro.php');
         }
       } else {
         header('location: ?view=configforos');
       }
     break;
     case 'delete':
       if($isset_id) {
         $config_foros->Delete();
       } else {
         header('location: ?view=configforos');
       }
     break;
     default:
       $db = new Conexion();
       $sql = $db->query("SELECT * FROM foros;");
       include(HTML_DIR . 'foros/all_foros.php');
       $db->liberar($sql);
       $db->close();
     break;
   }

}else{
  header('location: ?view=index');
}

?>
