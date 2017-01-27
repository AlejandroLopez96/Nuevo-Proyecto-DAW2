<?php
require('cuerpo/cuerpo.php');

if(isset($_GET['view'])){
  if(file_exists('cuerpo/controlador/'.strtolower($_GET['view']). 'Controlador.php')){
    include('cuerpo/controlador/'.strtolower($_GET['view']). 'Controlador.php');
  }else{
    include('cuerpo/controlador/errorControlador.php');
  }
}else{
  include('cuerpo/controlador/indexControlador.php');
}
