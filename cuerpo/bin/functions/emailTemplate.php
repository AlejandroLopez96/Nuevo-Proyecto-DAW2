<?php
function EmailTemplate($user,$link) {
  $HTML = '
  <html>
  <body style="background: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;">
  <div style="">
      <h2>Hola '.$user.'</h2>
      <p style="font-size:17px;">Gracias por registrarte en '. APP_TITLE .'.</p>
  	<p>Solo queda un paso más, activar tu cuenta para disfrutar de todos los beneficios de un usuario registrado.</p>
  	<p style="padding:15px;background-color:#ECF8FF;">
  			Para activar tu cuenta por favor haz <a style="font-weight:bold;color: #2BA6CB;" href="'.$link.'" target="_blank">click aquí &raquo;</a>
  	</p>
      <p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.</p>
  </div>
  </body>
  </html>
  ';
      return $HTML;
}
?>
