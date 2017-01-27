<?php

class Conexion extends mysqli {

  public function __construct(){
    parent::__construct(DB_HOST,DB_USER,DB_PASS,DB_NAME);/*pasamos por el contructor de la clase padre unas cuantas constantes que las definimos en cuerpo.php*/
    $this->connect_error ? die('Error en la conexión a la base de datos') : null;
    $this->set_charset("utf8");/*asi evitamos que se genere una query cada vez que se instancie la conexión*/
  }

  public function rows($query){
    return mysqli_num_rows($query);
  }

  public function liberar($query){
    return mysqli_free_result($query);
  }

  public function recorrer($query){
    return mysqli_fetch_array($query);
  }
}

 ?>
