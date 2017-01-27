<?php include(HTML_DIR . 'general/header.php'); ?>

  <body>
  <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

  <?php include(HTML_DIR . 'general/topnav.php'); ?>

  <section class="mbr-section mbr-after-navbar">
  <div class="mbr-section__container container mbr-section__container--isolated">

    <?php
    if(isset($_GET['success'])) {
      echo '<div class="alert alert-dismissible alert-success">
        <strong>Realizado!</strong> el foro se ha borrado correctamente.
      </div>';
    }
    ?>

  <div class="row container">
     <div class="pull-right">
       <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger active" href="?view=configforos">GESTIONAR FOROS</a>
        </li></ul></div>
        <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos&mode=add">CREAR FORO</a>
        </li></ul></div>
         <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
             <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
         </li></ul></div>
       </div>

      <ol class="breadcrumb">
        <li><a href="?view=index"><i class="fa fa-comments"></i> Foros</a></li>
      </ol>
  </div>

  <div class="row categorias_con_foros">
    <div class="col-sm-12">
        <div class="row titulo_categoria">Gestión de Foros</div>

        <div class="row cajas">
          <div class="col-md-12">
            <?php

            if($db->rows($sql) > 0) {
             $HTML = '<table class="table"><thead><tr>
             <th style="width: 10%">Id</th>
             <th>Foro</th>
             <th>Mensajes</th>
             <th>Temas</th>
             <th>Categría</th>
             <th>Estado</th>
             <th style="width: 20%">Acciones</th>
             </tr></thead>
             <tbody>';

              while($data = $db->recorrer($sql)) {
                $estado = $data['estado'] == 1 ? 'Abierto' : 'Cerrado';

                  $HTML .= '<tr id="foro_'.$data['id'].'">
                    <td>'.$data['id'].'</td>
                    <td>'.$data['nombre'].'</td>
                    <td>'.$data['cantidad_mensajes'].'</td>
                    <td>'.$data['cantidad_temas'].'</td>
                    <td>'.$categorias[$data['id_categorias']]['nombre'].'</td>
                    <td>'.$estado.'</td>
                    <td>
                      <div class="btn-group">
                       <a href="#" class="btn btn-primary">Acciones</a>
                       <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                       <ul class="dropdown-menu">
                         <li><a href="?view=configforos&mode=edit&id='.$data['id'].'">Editar</a></li>
                         <li><a class="btn-eliminar" data-id="'.$data['id'].'">Eliminar</a></li>
                       </ul>
                     </div>
                    </td>
                  </tr>';
              }
              $HTML .= '</tbody></table>';
            } else {
              $HTML = '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Todavía no existe ningun foro.</div>';
            }

            echo $HTML;
            ?>
          </div>
        </div>
    </div>
  </div>

  </div>
  </section>

  <?php include(HTML_DIR . 'general/footer.php'); ?>

  <div id="dialogoborrar" title="Eliminar Producto">
      <p>¿Esta seguro que desea eliminar el producto?</p>
    </div>

  <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
              var id;
            //Crea el diálogo con dos botones, Borrar y Cancelar.
            //-----------Borrado--------------
            $( "#dialogoborrar" ).dialog({
              autoOpen: false,
              resizable: false,
              modal: true,
              buttons: {
                //BOTON DE BORRAR
                "Borrar": function() {
                  //Ajax con get
                  $.get("",{
                    "mode":"delete",
                    "id":id
                  },function(){
                    $("#foro_" + id).fadeOut(500);
                  });//get
                  //Cerrar la ventana de dialogo
                  $(this).dialog("close");
                },
                "Cancelar": function() {
                    //Cerrar la ventana de dialogo
                    $(this).dialog("close");
                }
              }//buttons
            });
            $(document).on("click",".btn-eliminar",function(){
              id = $(this).attr("data-id");
              $( "#dialogoborrar" ).dialog("open");
          });
          });
  </script>
  </body>
  </html>
