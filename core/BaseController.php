<?php

// var_dump( __DIR__."/../config.php" );exit();
// require_once __DIR__."/../config.php";

class BaseController{

  // private $aVarHtml = array();
  public function __construct(){

    // Si no existe session se redirecciona al inicio de la pagina.
    if( !isset($_SESSION['id']) ){
      header("Location: http://transportes-acme.com/login"); /* Redirect browser */
      exit();
    }
  }

  /**
   * Render template y cargar argumentos template
  */
  function render( string $sFilePath, array $aArgs){
    
    $_SESSION['app']->html = $aArgs;
    $sFilePath = __DIR__."/../templates/".$sFilePath;
    ob_start();
    include($sFilePath);
    $_SESSION['app']->block['body'] = ob_get_contents();
    ob_end_clean();
  }

  /**
   * Render template y cargar argumentos template
  */
  function renderModal( string $sFilePath, array $aArgs){
    
    $_SESSION['app']->html = $aArgs;
    $sFilePath = __DIR__."/../templates/".$sFilePath;
    ob_start();
    include($sFilePath);
    ob_end_clean();
    // $_SESSION['app']->block['body'] = ob_get_contents();
  }

  /**
   * Inicia el Objeto de Conexion
   * @return array resultado Coneccion
  */
  public static function startConexion(){
    try{
      $aAuthDb = "Constants::conexionDefault()";
      // $aAuthDb = Constants::conexionDefault();
      $sConexionHost = 'host='.$aAuthDb['host'];
      $sConexionDBName = 'dbname='.$aAuthDb['db'];
      $sConexion = $aAuthDb['motor'].':'.$sConexionHost.';'.$sConexionDBName;
      $oConexion = new PDO( $sConexion, $aAuthDb['user'], $aAuthDb['pass'] );
      // ('mysql:host=localhost;dbname=prueba-calculadora', $this->usuario, $this->usuario);
      return $oConexion;
    }catch( \PDOException $e ){
      // throw new \PDOException($e->getMessage(), (int)$e->getCode());
      $aReturn['status'] = 0;
      $aReturn['message'] = $e->getMessage().'<br>Message Code: '.$e->getCode();
    }
    return $aReturn;
  }

  protected function closeConexion(){
    // $this->oConexion = Connections::closeConexion();
    $this->connection->query('KILL CONNECTION_ID()');
    $this->connection = null;
  }
}
