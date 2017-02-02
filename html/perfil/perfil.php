<?php include(HTML_DIR . 'general/header.php'); ?>

 <body>
 <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

 <?php include(HTML_DIR . 'general/topnav.php'); ?>

 <section class="mbr-section mbr-after-navbar">
 <div class="mbr-section__container container mbr-section__container--isolated">

 <div class="row container">
   <div class="pull-right">
     <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
          <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">EDITAR PERFIL</a>
      </li></ul></div>
     </div>

     <ol class="breadcrumb">
       <li><a href="?view=index"><i class="fa fa-user"></i> Usuarios </a></li>
     </ol>
 </div>

 <div class="row categorias_con_foros">
   <div class="col-sm-12">
       <div class="row titulo_categoria">Perfil de <?php echo $users[$id_usuario]['user']; ?></div>

       <div class="row cajas">
         <div class="col-md-2">
           <center>

             <img src="cuerpo/vista/app/images/images/users/<?php echo $users[$id_usuario]['img'];?>" class="thumbnail" height="120" />
             <strong><?php echo $users[$id_usuario]['user']; ?></strong>
             <img src="cuerpo/vista/app/images/images/<?php echo GetUserStatus($users[$id_usuario]['ultima_conexion']); ?>" /> <br />
             <b style="color:green;">**<?php echo $users[$id_usuario]['rango']; ?>**</b>
          <br /><br />
          </center>
          <ul style="list-style:none; padding-left: 4px;">
              <li><b><?php echo $db->recorrer($sql)[0]; ?></b> temas </li>
              <li><b>30</b> mensajes</li>
              <li><b><?php echo $users[$id_usuario]['edad']; ?></b> años</li>
              <li>Registrado el <b><?php echo $users[$id_usuario]['fecha_reg']; ?></b></li>
            </ul>

         </div>
         <div class="col-md-10">
           <blockquote>
             <?php echo $users[$id_usuario]['biografia']; ?>
           </blockquote>
           <hr />
           <p>
             <?php echo BBcode($users[$id_usuario]['firma']); ?>
           </p>
         </div>
       </div>
   </div>
 </div>

 </div>
 </section>

 <?php include(HTML_DIR . 'general/footer.php'); ?>

 </body>
 </html>
