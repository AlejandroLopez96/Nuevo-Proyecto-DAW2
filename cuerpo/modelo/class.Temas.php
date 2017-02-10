<?php

class Temas {

  private $db;
  private $id;
  private $titulo;
  private $content;
  private $id_foro;
  private $id_dueno;
  private $anuncio;

  public function __construct(){
    $this->db = new Conexion();
    $this->id = isset($_GET['id']) ? intval($_GET['id']) : null;
    $this->id_foro = intval($_GET['id_foro']);
    $this->id_dueno = isset($_SESSION['app_id']) ? $_SESSION['app_id'] : null;
  }

  public function Errors($url){
    try{
      if(empty($_POST['titulo']) or empty($_POST['content'])){
        throw new Exception(1);
      }else{
        $this->titulo = $this->db->real_escape_string($_POST['titulo']);
        $this->content = $this->db->real_escape_string($_POST['content']);
      }

      if(strlen($this->titulo) < MIN_TITULOS_TEMAS_LONGITUD){
        throw new Exception(2);
      }

      if(strlen($this->content) < MIN_CONTENT_TEMAS_LONGITUD){
        throw new Exception(3);
      }

      if(isset($_POST['anuncio']) and $_POST['anuncio'] == 1){
        $this->anuncio = 2;
      }else{
        $this->anuncio = 1;
      }

     } catch(Exception $error) {
       header('location: ' . $url . $error->getMessage());
       exit;
     }
  }

  private function UpdateMensajesMios(int $mensajes = 1, bool $restar = false){
    if($restar){
      $_SESSION['users'][$this->id_dueno]['mensajes'] = $_SESSION['users'][$this->id_dueno]['mensajes'] - $mensajes;
    }else{
      $_SESSION['users'][$this->id_dueno]['mensajes'] = $_SESSION['users'][$this->id_dueno]['mensajes'] + $mensajes;
    }

  }

  public function Add(){
    $this->Errors('?view=temas&mode=add&id_foro='.$this->id_foro.'&error=');
    $fecha = date('d/m/Y h:i a',time());//dia/mes/año completo despues hora:mins
    $this->db->query("INSERT INTO temas (titulo, contenido,id_foro,id_dueno,fecha,id_ultimo,fecha_ultimo,tipo) VALUES ('$this->titulo', '$this->content','$this->id_foro','$this->id_dueno', '$fecha','$this->id_dueno','$fecha','$this->anuncio')");
    $ID_TEMA = $this->db->insert_id;
    $query = "UPDATE foros SET cantidad_temas=cantidad_temas + '1', cantidad_mensajes=cantidad_mensajes + '1' , ultimo_tema='$this->titulo', id_ultimo_tema='$ID_TEMA' WHERE id='$this->id_foro'; LIMIT 1";
    $query .= "UPDATE users SET mensajes=mensajes + '1' WHERE id='$this->id_dueno' LIMIT 1;";
    $this->db->multi_query($query);
    $this->UpdateMensajesMios();
    header('location: ./temas/' . UrlAmigable($ID_TEMA,$this->titulo,$this->id_foro));//el insert_id nos va a devolver la ultima id que fue insertada
  }

  public function Edit(){
    $this->Errors('?view=temas&mode=edit&id='.$this->id.'&id_foro='.$this->id_foro.'&error=');
    $this->db->query("UPDATE temas SET titulo='$this->titulo', contenido='$this->content', tipo='$this->anuncio' WHERE id='$this->id' LIMIT 1;");
    header('location: ./temas/' . UrlAmigable($this->id,$this->titulo,$this->id_foro));
  }

  private function DeleteLast() {
    //Chequeamos que el tema que se quiere borrar sea el ultimo del foro
    $sql = $this->db->query("SELECT id FROM foros WHERE id_ultimo_tema='$this->id' AND id='$this->id_foro' LIMIT 1;");
    if($this->db->rows($sql) > 0) {
      //Extraemos el id y nombre del ultimo tema que NO sea el mismo que se va a borrar
      $sql_2 = $this->db->query("SELECT id,titulo FROM temas WHERE id_foro='$this->id_foro' AND id <> '$this->id' ORDER BY id DESC LIMIT 1;");
      if($this->db->rows($sql_2) > 0) {
        $data_t = $this->db->recorrer($sql_2);
        $id_ultimo_tema = $data_t[0];
        $ultimo_tema = $data_t[1];
      } else {
        $id_ultimo_tema = 0;
        $ultimo_tema = '';
      }
      $this->db->liberar($sql_2);
      $sql_4 = $this->db->query("UPDATE foros SET id_ultimo_tema='$id_ultimo_tema', ultimo_tema='$ultimo_tema' WHERE id='$this->id_foro' LIMIT 1;");
    }
    $this->db->liberar($sql);
  }
  public function Delete() {
    $this->DeleteLast();
    $sql2 = $this->db->query("SELECT id_dueno FROM temas WHERE id='$this->id' LIMIT 1;");
    if($this->db->rows($sql2) > 0) {
      $sql = $this->db->query("SELECT id_dueno FROM respuestas WHERE id_tema='$this->id';");
      $id_dueno_tema = $this->db->recorrer($sql2)[0];
      $mensajes_borrar = 1;
      $is_dueno = ($id_dueno_tema == $_SESSION['app_id']);
      $mensajes_user_actual = $is_dueno ? 1 : 0;
      if($this->db->rows($sql) > 0) {
        $prepare_sql = $this->db->prepare("UPDATE users SET mensajes=mensajes - '1' WHERE id=? LIMIT 1;");
        $prepare_sql->bind_param('i',$id_dueno);
        while($data = $this->db->recorrer($sql)) {
          $id_dueno = $data[0];
          $prepare_sql->execute();
          $mensajes_borrar++;
          if($id_dueno == $_SESSION['app_id']) {
            $mensajes_user_actual++;
          }
        }
        $prepare_sql->close();
      }
      $this->db->liberar($sql);
      $query = "DELETE FROM temas WHERE id='$this->id' LIMIT 1;";
      $query .= "UPDATE foros SET cantidad_mensajes=cantidad_mensajes - '$mensajes_borrar', cantidad_temas = cantidad_temas - '1'
      WHERE id='$this->id_foro' LIMIT 1;";
      $query .= "DELETE FROM respuestas WHERE id_tema='$this->id';";
      if($is_dueno) {
        $query .= "UPDATE users SET mensajes = mensajes - '1' WHERE id='$id_dueno_tema' LIMIT 1;";
      }
      $this->db->multi_query($query);
      $this->UpdateMensajesMios($mensajes_user_actual,true);
    }
    $this->db->liberar($sql2);
    header('location: index.php?view=foros&id=' . $this->id_foro);
  }

  public function Close(int $estado){// int $estado mejor pra que sirva tanto para abrir el tema como para cerrarlo
    $estado = intval($estado);
    $this->db->query("UPDATE temas SET estado='$estado' WHERE id='$this->id' LIMIT 1;");
    header('location: index.php?view=temas&id='.$this->id.'&id_foro=' . $this->id_foro);
  }

  public function Responder(){
    if(empty($_POST['content'])) {
      header('location: ?view=temas&mode=responder&id='.$this->id.'&id_foro=' . $this->id_foro);
      exit;
    } else {
      $this->content = $this->db->real_escape_string($_POST['content']);
    }
    $query = "INSERT INTO respuestas (id_dueno,id_tema,id_foro,contenido)
    VALUES ('$this->id_dueno','$this->id','$this->id_foro','$this->content');";
    $query .= "UPDATE foros SET cantidad_mensajes = cantidad_mensajes + '1' WHERE id='$this->id_foro' LIMIT 1;";
    $query .= "UPDATE users SET mensajes=mensajes + '1' WHERE id='$this->id_dueno' LIMIT 1;";
    $query .= "UPDATE temas SET respuestas=respuestas + '1' WHERE id='$this->id' LIMIT 1;";
    $this->db->multi_query($query);
    $this->UpdateMensajesMios();
    header('location: index.php?view=temas&id='.$this->id.'&id_foro=' . $this->id_foro);
  }

  public function Check(){
    $sql = $this->db->query("SELECT * FROM temas WHERE id='$this->id' LIMIT 1");
    if($this->db->rows($sql) > 0){
      $tema = $this->db->recorrer($sql);
    }else{
      $tema = false;
    }
    $this->db->liberar($sql);

    return $tema;
  }

  public function GetRespuestas(){
    $sql = $this->db->query("SELECT * FROM respuestas WHERE id_tema='$this->id';");
    if($this->db->rows($sql) > 0){
      while($data = $this->db->recorrer($sql)){
        $respuestas[] = $data;
      }
    }else{
      $respuestas = false;
    }
    $this->db->liberar($sql);

    return $respuestas;
  }

  public function __destruct(){
    $this->db->close();
  }

}

 ?>
