<?php

class ConfigForos {

  private $id;
  private $db;
  private $nombre;
  private $descrip;
  private $categoria;
  private $estado;

  public function __construct(){
    $this->db = new Conexion();//se inicia la conexion
  }

  private function Errors($url,$add_mode=false){

    global $categorias;

    try{
        if(empty($_POST['nombre']) or empty($_POST['descrip']) or !isset($_POST['estado'])){//Aqui comprobamos que no esten vacios los campos y que si desmarcan el estado de alguna manera les salga el error
           throw new Exception(1);
        }else{
          $this->nombre = $this->db->real_escape_string($_POST['nombre']);      $this->descrip = $this->db->real_escape_string($_POST['descrip']);
          $this->descrip = str_replace(
            array('<script>','</script>','<script src','<script type='),
            '',
            $this->descrip
          );//Esto lo hago para que cuando el usuario meta en la descripcion scripts se lo ttransformo en espacios en blanco
          if($_POST['estado'] == 1) {//Ponemos 1 poruqe quiere decir que esta abierto
            $this->estado = 1;
          } else {
            $this->estado = 0;
          }
          }
          if(!array_key_exists($_POST['categoria'],$categorias)) {//Aqui comprobamos is no existe la key en el array de las categorias
         throw new Exception(2);
       } else {
        $this->categoria = intval($_POST['categoria']);
       }
     } catch(Exception $error) {
       header('location: ' . $url . $error->getMessage());
       exit;
     }
  }

  public function Add() {
     $this->Errors('?view=configforos&mode=add&error=',true);
     $this->db->query("INSERT INTO foros (nombre,descrip,id_categorias,estado)
     VALUES ('$this->nombre','$this->descrip','$this->categoria','$this->estado');");
     header('location: ?view=configforos&mode=add&success=true');
   }


 public function Edit() {
   $this->id = intval($_GET['id']);
     $this->Errors('?view=configforos&mode=edit&id='.$this->id.'&error=');
     $this->db->query("UPDATE foros SET nombre='$this->nombre', descrip='$this->descrip',
     id_categorias='$this->categoria', estado='$this->estado' WHERE id='$this->id';");
     header('location: ?view=configforos&mode=edit&id='.$this->id.'&success=true');
   }

  public function Delete(){
    $this->id = intval($_GET['id']);//recoge un valor entero de la variable
    $q = "DELETE FROM foros WHERE id='$this->id';";
    $q .= "DELETE FROM temas WHERE id_foro='$this->id';";//aqui en esta consulta ponemos .= porque tenemos que concatenar
    $this->db->multi_query($q);//haceos una multi_query porque al borrar el foro tenemos que borrar todos los temas que haya dentro del foro
    header('location: ?view=configforos&success=true');
  }



  public function __destruct(){
    $this->db->close();
  }
}

 ?>
