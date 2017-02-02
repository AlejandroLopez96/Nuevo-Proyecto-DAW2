<?php include(HTML_DIR . 'general/header.php'); ?>

 <body>
 <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

 <?php include(HTML_DIR . 'general/topnav.php'); ?>

 <section class="mbr-section mbr-after-navbar">
 <div class="mbr-section__container container mbr-section__container--isolated">

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

  $boton = '<div class="pull-right">
    <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
      <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=add&id_foro='.$id_foro.'">NUEVO TEMA</a>
    </li></ul></div>
  </div>';

  if(isset($_SESSION['app_id'])){
    if($foros[$id_foro]['estado'] == 1 or $users[$_SESSION['app_id']]['rol'] == 2){//si el estado del foro es 1 y ya cualquier usuario que tenga la sesion iniciada podra crear un nuevo tema, pero si el estado nos da 0 nos queda todavia comprobar la otra condicion, si el usuario que esta visualizando el foro es un admi entonces la sentencia da true y mostraremos el boton, o si el usuario que esta visualizando el foro no es admin sino que es 0 o 1 pues entonces no se les mostraría el boton.
      echo $boton;
    }
  }

 ?>

     <ol class="breadcrumb">
       <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
       <li><a href="?view=index"><i class="fa fa-comments"></i> <?php echo $foros[$id_foro]['nombre'] ?></a></li>
     </ol>

     <div class="row categorias_con_foros">
       <div class="col-sm-12 col-xs-12">
           <div class="row titulo_categoria">Anuncios</div>

           <?php

           if($db->rows($sql_anuncios) > 0) {
             while($anuncio = $db->recorrer($sql_anuncios)) {

               if($anuncio['estado'] == 1) {
                 $extension = '.png';
               } else {
                 $extension = '_bloqueado.png';
               }

               echo '<div class="row foros">
                 <div class="col-md-1 col-sm-1 col-xs-1" style="height:50px;line-height: 37px;">
                   <img src="cuerpo/vista/app/images/images/foros/anuncio_leido'.$extension.'" />
                 </div>
                 <div class="col-md-7 col-sm-5 col-xs-3 puntitos" style="padding-left: 30px;line-height: 37px;">
                   <a href="temas/'.UrlAmigable($anuncio['id'],$anuncio['titulo'],$id_foro).'">'.$anuncio['titulo'].'</a>
                 </div>
                 <div class="col-md-2 col-sm-4 col-xs-5 left_border" style="text-align: center;font-weight: bold;">
                   './*Con esto colocamos un formato de salida, osea tiene 0 decimales, cada vez que haya decimal que se pongs una coma y que cuando es miles se ponga un punto*/number_format($anuncio['visitas'],0,',','.').' Visitas<br />
                   '.number_format($anuncio['respuestas'],0,',','.').' Respuestas
                 </div>
                 <div class="col-md-2 col-sm-2 col-xs-2 left_border puntitos" style="">
                   Por <a href="?view=perfil&id='.$anuncio['id_ultimo'].'">'.$users[$anuncio['id_ultimo']]['user'].'</a><br />
                   '.$anuncio['fecha_ultimo'].'
                 </div>
               </div>';
             }
           } else {
             echo '<div class="row foros">
               <div class="col-md-12 col-sm-12 col-xs-12" style="height:50px;line-height: 37px;">
                 No existe ningún tema.
               </div>
             </div>';
           }

           ?>

         </div>
     </div>

     <div class="row categorias_con_foros">
       <div class="col-sm-12">
           <div class="row titulo_categoria">Foros</div>
           <?php

           if($db->rows($sql_no_anuncios) > 0) {
             while($tema = $db->recorrer($sql_no_anuncios)) {

               if($tema['estado'] == 1) {
                 $extension = '.png';
               } else {
                 $extension = '_bloqueado.png';
               }

               echo '<div class="row foros">
                 <div class="col-md-1 col-sm-1 col-xs-1" style="height:50px;line-height: 37px;">
                   <img src="cuerpo/vista/app/images/images/foros/foro_leido'.$extension.'" />
                 </div>
                 <div class="col-md-7 col-sm-5 col-xs-3 puntitos" style="padding-left: 30px;line-height: 37px;">
                   <a href="temas/'.UrlAmigable($tema['id'],$tema['titulo'],$id_foro).'">'.$tema['titulo'].'</a>
                 </div>
                 <div class="col-md-2 col-sm-4 col-xs-5 left_border" style="text-align: center;font-weight: bold;">
                   '.number_format($tema['visitas'],0,',','.').' Visitas<br />
                   '.number_format($tema['respuestas'],0,',','.').' Respuestas
                 </div>
                 <div class="col-md-2 col-sm-2 col-xs-2 left_border puntitos" style="">
                   Por <a href="?view=perfil&id='.$tema['id_ultimo'].'">'.$users[$tema['id_ultimo']]['user'].'</a><br />
                   '.$tema['fecha_ultimo'].'
                 </div>
               </div>';
             }
           } else {
             echo '<div class="row foros">
               <div class="col-md-12" style="height:50px;line-height: 37px;">
                 No existe ningún tema.
               </div>
             </div>';
           }

           ?>
         </div>
     </div>

 </div>

 </div>
 </section>


 <?php include(HTML_DIR . 'general/footer.php'); ?>

 </body>
 </html>
