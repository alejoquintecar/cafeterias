<?php

require_once __DIR__."/../core/Routing.php";
$oRouter = new Routing();

// --- --- --- Rutas --- --- ---
// --- Usuarios
$oRouter->add('/users',      'UsersController@index');
$oRouter->add('/users-json', 'UsersController@indexJson');
// --- Productos
$oRouter->add('/productos',           'ProductosController@index');
$oRouter->add('/productos-json',      'ProductosController@indexJson');
$oRouter->add('/productos-new',       'ProductosController@indexNew');
$oRouter->add('/productos-edit',      'ProductosController@indexEdit');
$oRouter->add('/productos-eliminar',  'ProductosController@indexEliminar');
// --- Productos
$oRouter->add('/productos-vender',          'ProductosVenderController@index');
$oRouter->add('/productos-vender-json',     'ProductosVenderController@indexJson');
$oRouter->add('/productos-vender-new',      'ProductosVenderController@indexNew');
$oRouter->add('/productos-vender-edit',     'ProductosVenderController@indexEdit');
$oRouter->add('/productos-vender-eliminar', 'ProductosVenderController@indexEliminar');
// --- Login
$oRouter->add('/',      'LoginController@index');
$oRouter->add('/login', 'LoginController@index');
$oRouter->add('/logout','LoginController@logout');
$oRouter->add('/authenticate','LoginController@authenticate');
// --- --- END Rutas --- --- ---

$sController = $oRouter->getController( $_SERVER['REQUEST_URI'] );
if( !empty($sController) ){
  require_once __DIR__."/../src/Controller/".$sController.".php";
  $oRouter->run();
}else{
  header("HTTP/1.0 404 Not Found");
  echo "<h1>404 Not Found</h1>";
  echo "The page that you have requested could not be found.";
  exit();
}