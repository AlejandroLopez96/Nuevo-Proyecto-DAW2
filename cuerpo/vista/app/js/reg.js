function goReg(){
  var connect, form, response, result, user, pass, email, tyc, pass_dos;
  user = __('user_reg').value;/*Llamamos a la funcion y vamos a obtener su valor*/
  pass = __('pass_reg').value;
  email = __('email_reg').value;
  pass_dos = __('pass_reg_dos').value;
  tyc = __('tyc_reg').checked ? true : false;/**if comprimido para ver si esta checkeado o no*/

  if(tyc == true){
    if( user != '' && pass != '' && pass_dos != '' && email != ''){
      if(pass == pass_dos){
        form = 'user=' + user + '&pass=' + pass + '&email=' + email;/*estas son las variables que mandamos por formulario*/
        connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');/*Hay que verificar que tipo de objeto tenemos para ajax en el navegador del usuario, hay dos tipos XMLHttpRequest y ActiveXObject para garantizarnos que funcione en todos los navegadores Vamos a identificar si en el navegador actual existe un elemento que se llama XMLHttpRequest. Si existe lo que hacemos es instanciar XMLHttpRequest si no existe instanciamos ActiveXObject*/
        connect.onreadystatechange = function(){/*Esto se va a accionar cada vez que se note un cambio en ajax.*/
          if(connect.readyState == 4 && connect.status == 200){/*Cuando es igual a 4 es que ya tenemos response de php y podemos mostrar algo en el navegador*/
            if(connect.responseText == 1){
              result = '<div class="alert alert-dismissible alert-success">';
              result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result += '<h4>Reistro completado!!</h4>';
              result += '<p><strong>Estamos redirecionandote...</strong></p>';
              result += '</div>';
              __('_AJAX_REG_').innerHTML = result;
              location.reload();/*recargamos la pagina debido a que tenemos un modal*/
            }else{
              __('_AJAX_REG_').innerHTML = connect.responseText;/*vamos a mostrar connect.responseText*/
            }
          }else if(connect.readyState != 4){/*Cuando no este en 4 no tenemos response todavía*/
            result = '<div class="alert alert-dismissible alert-warning">';
            result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            result += '<h4>Procesando...</h4>';
            result += '<p><strong>Estamos procesando tu registro...</strong></p>';
            result += '</div>';
            __('_AJAX_REG_').innerHTML = result;/*vamos a llamar a la funcon pasnndole la id del elemento de javascript de html que queremos modificar que en ete caso es _AJAX_REG_. Vamos a acceder a innerHTML que modifica lo que esta dentro del html de ese elemento y le vamos a modificar por restult*/
          }
        }
        connect.open('POST','ajax.php?mode=reg',true);/*Abrimos una connect en metodo post, apuntamos al fichero ajax.php...*/
        connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');/*Forma en la que post manda cifrados los datos y asi los mandara de igual manera en todos los post*/
        connect.send(form);/*enviamos datos al ajax mediante este metodo connect*/
      }else{
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        result += '<h4>ERROR</h4>';
        result += '<p><strong>Las contraseñas no coinciden.</strong></p>';
        result += '</div>';
        __('_AJAX_REG_').innerHTML = result;
      }
    }else{
      result = '<div class="alert alert-dismissible alert-danger">';
      result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      result += '<h4>ERROR</h4>';
      result += '<p><strong>Todos los campos deben estar llenos.</strong></p>';
      result += '</div>';
      __('_AJAX_REG_').innerHTML = result;
    }
  } else {
    result = '<div class="alert alert-dismissible alert-danger">';
    result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    result += '<h4>ERROR</h4>';
    result += '<p><strong>Los terminos y condiciones deben ser aceptados.</strong></p>';
    result += '</div>';
    __('_AJAX_REG_').innerHTML = result;
  }



}

function runScriptReg(e){
  if(e.keyCode == 13/*boton ENTER*/){
    goReg();
  }
}
