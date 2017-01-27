<?php

class Categorias{

    private $db;
    private $id;
    private $nombre;


    //al tener en el constructor solo la conexion a la base de datos y en el destruct el cierre podemos tener nuevas funciones entre medio sin tener que iniiar la conexion y cerrarla en cada función
    public function __construct(){//esto se ejecuta nada mas se instancia la categoria
        $this->db = new Conexion();//se inicia la conexion
    }


    private function Errors($url){
        try{
            if(empty($_POST['nombre'])){//si esta vacio vamos a mostrar un eerror ue nos redirecciona a una url que vamos a pasar con dicho mensaje de error

                //Cuando una excepción es lanzada PHP tratará de encontrar un bloque catch{} capaz de capturarla, si no encuentra ninguno, entonces, se interrumpirá la ejecución y se emitirá un error fatal de PHP
               throw new Exception(1);
            }else{
                $this->nombre = $this->db->real_escape_string($_POST['nombre']);//asi tendremos automaticamente en agregar y editar definido la propiedad this->nombre con el caracter escapado ya que estamos llamando al metodo $this->Errors('?view=categorias&mode=add&error='); y siempre se ejecuta primero el constructor y por eso es totalmente valido y $_POST['nombre'] nunca va a ser nulo porque solo existe en agregar y editar asi que a partir de aqui podemos utilizar this->nombre en agregar y editar
            }
        }catch(Exception $error){
           header('location: ' . $url .$error->getMessage());
            exit;
        }
    }

    public function Add() {
        $this->Errors('?view=categorias&mode=add&error=');
        $this->db->query("INSERT INTO categorias (nombre) VALUES ('$this->nombre');");
        header('location: ?view=categorias&mode=add&success=true');
    }


   public function Edit() {
       $this->id = intval($_GET['id']);
       $this->Errors('?view=categorias&mode=add&id='.$this->id.'&error=');
        $this->db->query("UPDATE categorias SET nombre='$this->nombre' WHERE id='$this->id';");
       header('location: ?view=categorias&mode=edit&id='.$this->id.'&success=true');
   }

    public function Delete(){
        $this->id = intval($_GET['id']);//recoge un valor entero de la variable
        $q = "DELETE FROM categorias WHERE id='$this->id';";
        $q .= "DELETE FROM foros WHERE id_categoria='$this->id';";//aqui en esta consulta ponemos .= porque tenemos que concatenar
        $this->db->multi_query($q);//haceos una multi_query porque al borrar la categoría tenemos que borrar todos los foros que haya dentro de la categoria
        header('location: ?view=categorias');
    }


    public function __destruct(){//esto se ejecuta nada mas que deja funcionar la clase cuando php termina de ejecutarse en una pagina llama a la funcion destruct
        $this->db->close();//se cierra la conexion
    }
}

?>
