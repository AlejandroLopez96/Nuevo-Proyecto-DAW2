 function __(id) {
    return document.getElementById(id);
  }

 function DeleteItem(contenido,url) {
   var action = window.confirm(contenido);
   if (action) {
       window.location = url;
   }
 }

 /*function Borrar(){
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
                   $.get("categoriasControlador.php",{
                     "id":id,
                     "mode":"delete"
                   },function(data,status){
                     $("#" + id).fadeOut(500);
                   });//get
                   //Cerrar la ventana de dialogo
                   $(this).dialog("close");
                 },
                 "Cancelar": function() {
                     //Cerrar la ventana de dialogo
                     $(this).dialog("close");
                 }
               }//buttons
               $( "#dialogoborrar" ).dialog("open");
             });
           });
 }
*/
