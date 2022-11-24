<?php

session_start();
$_SESSION['json'] = false;
require_once __DIR__."/../core/Loader.php"; // Recursos globales
require_once __DIR__."/../config/routes.php"; // Rutas

if( !$_SESSION['json'] ){
  $sFilePath = __DIR__."/../templates/base.php";
  ob_start();
  include($sFilePath);
  $oTemplate = ob_get_contents();
  ob_end_clean();
  echo $oTemplate;
  unset($oTemplate);
}

?>