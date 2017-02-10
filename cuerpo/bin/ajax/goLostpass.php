<?php

$db = new Conexion();
$email = $db->real_escape_string($_POST['email']);
$sql = $db->query("SELECT id,user FROM users WHERE email='$email' LIMIT 1;")
if($db->rows($sql) > 0){//si la consulta da resultado  es que existe el email solicitado
  $data = $db->recorrer($sql)[0];//se que solo tengo un solo resultado posible y esto me devuelve un solo array y por lo tanto siempre cogeré el primero
  $id = $data[0];
  $user = $data[1];
  $keypass = md5(time());
  $new_pass = strtoupper(substr(sha1(time()),0,8));//substr es una funcion que recibe tres parametros que serian en este caso un string, desde donde quiere mostrarse el texto y hasta donde, y con strtoupper lo pondriamos en mayuscula todo
  $link = APP_URL . 'view=lostpass&key=' . $keypass;//esta es la url que le va a llegar al usuario

  $mail = new PHPMailer;
  $mail->CharSet = "UTF-8";
  $mail->Encoding = "quoted-printable";
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = PHPMAILER_HOST;  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = PHPMAILER_USER;                 // SMTP username
  $mail->Password = PHPMAILER_PASS;                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = PHPMAILER_PORT;                                    // TCP port to connect to

  $mail->setFrom(PHPMAILER_USER, APP_TITLE); //Quien manda el correo?

  $mail->addAddress($email, $user);     // A quien le llega

  $mail->isHTML(true);    // Set email format to HTML

  $mail->Subject = 'Recuperar contraseña';
  $mail->Body    = LostpassTemplate($user,$link);
  $mail->AltBody = 'Hola ' . $user . ' para recuperar tu contraseña accede al siguiente elance: ' . $link;

  if(!$mail->send()) {
      $HTML = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';
  }else{

  $db->query("UPDATE users SET keypass='$keypass', new_pass='$new_pass' WHERE id='$id';");
  $HTML = 1;
  }
}else{//sino el email no existe por lo que hay que enviar un mensaje de error
  $HTML = '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <h4>ERROR:</h4> <p>El email solicitado no existe en el sistema.</p></div>';
}

$db->liberar($sql);
$db->close();

echo $HTML;

 ?>
