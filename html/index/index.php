<?php include(HTML_DIR . 'general/header.php'); ?>

 <body>
 <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

 <?php include(HTML_DIR . 'general/topnav.php'); ?>

 <section class="mbr-section mbr-after-navbar">
 <div class="mbr-section__container container mbr-section__container--isolated">
   <div class="banner">
   </div>
   <?php
   if(isset($_GET['success'])) {
     echo '<div class="alert alert-dismissible alert-success">
       <strong>Activado!</strong> tu usuario ha sido activado correctamente.
     </div>';
   }

   if(isset($_GET['error'])) {
     echo '<div class="alert alert-dismissible alert-danger">
       <strong>Error!</strong></strong> no se ha podido activar tu usuario.
     </div>';
   }
    ?>

  <div class="row container">

     <?php
         if(isset($_SESSION['app_id']) && $users[$_SESSION['app_id']]['rol'] >= 2) {//utilizamos la variable $users que tenemos inicializada en el archivo cuerpo.php
           echo '
           <div class="pull-right">
             <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
               <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">GESTIONAR FOROS</a>
             </li></ul></div>
             <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
               <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
             </li></ul></div>
           </div>
           ';
         }
     ?>
      <ol class="breadcrumb">
        <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
 </div>

<?php

if(false != $categorias){
  $prepare_sql = $db->prepare("SELECT id FROM foros WHERE id_categorias = ?");//aqui seleccionamos el id del foro cuando el id_categorias sea igual a la categoía y lo limitamos a 1 porque por cada repeticion solo vamos a extraer uno
  //la sentencia de sql preparada es basicamente una query que solo se ejecuta una vez pero obtenemos muchas respuestas de una sola query
  $prepare_sql->bind_param('i',$id_categorias);//Agrega variables a una sentencia preparada como parámetros
  foreach ($categorias as $id_categorias => $value) {
    $prepare_sql->execute();//Con esto ejecutamos la consulta
    $prepare_sql->store_result(); //despues de ejecutarlo podemos obtener respuesta de cuanta cantidad de datos que hemos obtenido pero para poder obtener esa respuesta hay que almacenarlos en una pequeña caché y esta caché no afecta en nada en el rendimiento
    echo '<div class="row categorias_con_foros">
      <div class="col-sm-12">
          <div class="row titulo_categoria">'.$categorias[$id_categorias]['nombre'].'</div>';
    if($prepare_sql->num_rows > 0){
        $prepare_sql->bind_result($id_del_foro);//Recuperamos los datos de la consulta, en este caso la id del foro
        while($prepare_sql->fetch()){//la cantidad de veces tanto foros como haya mostraremos el echo siguiente
          if($foros[$id_del_foro]['estado'] == 1){
            $extension= '.png';
          }else{
            $extension= '_bloqueado.png';
          }
          if($foros[$id_del_foro]['ultimo_tema'] == ''){
            $ultimo_tema = '<a href="#">No hay temas creados</a>';
          }else{
            $ultimo_tema = '<a href="temas/'.UrlAmigable($foros[$id_del_foro]['id_ultimo_tema'],$foros[$id_del_foro]['ultimo_tema'],$id_foro).'">'.$foros[$id_del_foro]['ultimo_tema'].'</a>';
          }
          echo '<div class="row foros">
            <div class="col-md-1" style="height:50px;line-height: 37px;">
              <img src="cuerpo/vista/app/images/images/foros/foro_leido'.$extension.'" />
            </div>
            <div class="col-md-7 puntitos" style="padding-left: 0px;">
              <a href="foros/'.UrlAmigable($id_del_foro,$foros[$id_del_foro]['nombre']).'">'.$foros[$id_del_foro]['nombre'].'</a><br />
              '.$foros[$id_del_foro]['descrip'].'
            </div>
            <div class="col-md-2 left_border" style="text-align: center;font-weight: bold;">
              '.number_format($foros[$id_del_foro]['cantidad_temas'],0,',','.').'Temas<br />
              '.number_format($foros[$id_del_foro]['cantidad_mensajes'],0,',','.').' Mensajes
            </div>
            <div class="col-md-2 left_border puntitos" style="line-height: 37px;">
              '.$ultimo_tema.'
            </div>
          </div>';
        }
    }else{
      echo '<div class="row foros">
        <div class="col-md-12" style="height:50px;line-height: 37px;">
          No existe ningun foro.
        </div>
      </div>';
    }
    echo'</div>
  </div>';
  }
$prepare_sql->close();
}else{
  echo '<div class="row categorias_con_foros">
    <div class="col-sm-12">
        <div class="row titulo_categoria">'. APP_TITLE .' </div>
    </div>
  </div>';
}

?>

 </div>
 </section>


 <?php include(HTML_DIR . 'general/footer.php'); ?>

 </body>
 </html>
