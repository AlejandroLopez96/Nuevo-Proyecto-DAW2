<?php include(HTML_DIR . 'general/header.php'); ?>
<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . 'general/topnav.php'); ?>

<?php
 if(isset($_GET['success'])) {
   echo '<section class="mbr-section mbr-after-navbar" id="content1-10">
   <div class="mbr-section__container container mbr-section__container--isolated">
   <div class="alert alert-dismissible alert-success">
     <strong>Activado!</strong> tu usuario ha sido activado correctamente.
   </div>
   </div>
   </section>';
 }
 ?>

 <?php
 if(isset($_GET['error'])) {
   echo '<section class="mbr-section mbr-after-navbar" id="content1-10">
   <div class="mbr-section__container container mbr-section__container--isolated">
   <div class="alert alert-dismissible alert-danger">
     <strong>Error!</strong></strong> no se ha podido activar tu usuario.
   </div>
   </div>
   </section>';
 }
 ?>

  <section class="mbr-section mbr-after-navbar" id="content1-10">
      <div class="mbr-section__container container mbr-section__container--isolated">
          <div class="row">
             <div class="mbr-article mbr-article--wysiwyg col-sm-8 col-sm-offset-2">
             <p>
               Texto de relleno
             </p>
           </div>
         </div>
     </div>
 </section>

 <section class="mbr-section mbr-after-navbar" id="content1-10">
     <div class="mbr-section__container container mbr-section__container--isolated">
         <div class="row">
             <div class="mbr-article mbr-article--wysiwyg col-sm-8 col-sm-offset-2">
             <p>
               Texto de relleno
             </p>
           </div>
         </div>
     </div>
 </section>

 <section class="mbr-section mbr-after-navbar" id="content1-10">
     <div class="mbr-section__container container mbr-section__container--isolated">
         <div class="row">
             <div class="mbr-article mbr-article--wysiwyg col-sm-8 col-sm-offset-2">
             <p>
               Texto de relleno
             </p>
           </div>
         </div>
     </div>
 </section>
<?php include(HTML_DIR . 'general/footer.php'); ?>

</body>
</html>
