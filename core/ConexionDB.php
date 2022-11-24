<?php

require_once __DIR__."/../config/config.php";

class ConexionDB extends Constants{

  private $aDbConfig = array();
  private $oDbConnection = array();
  public function __construct(){
    $this->aDbConfig = $this->app_config['dbconfig'];
  }

  /**
   * @param string indice de la conexion a base de datos
   * @copyright <Nestor Alejandro Quinteo Cardozo>
  */
  public function getConexion( string $sDataBase = 'principal' ){
    try{
      return $this->oDbConnection[$sDataBase];
    }catch( Exception $e ){
      header("HTTP/1.0 404 Not Found");
      echo "<h1>404 Not Found</h1>";
      echo "The page that you have requested could not be found.";
      die();
    }
  }

  /**
   * @param string indice de la conexion a base de datos
   * @copyright <Nestor Alejandro Quinteo Cardozo>
  */
  public function executeQuery( string $sQuery, string $sDataBase = 'principal' ){
    return $this->getConexion($sDataBase)->query( $sQuery );
  }

  /**
   * @param string indice de la conexion a base de datos
   * @copyright <Nestor Alejandro Quinteo Cardozo>
  */
  public function start( string $sDataBase = 'principal' ){

    $aDbConfig = ( isset($this->aDbConfig[$sDataBase]) ) ? $this->aDbConfig[$sDataBase] : array();
    try{

      $db_type = (isset($aDbConfig['db_type'])) ? $aDbConfig['db_type']:null;
      switch( $db_type ){
        case 'mysql':
          $this->oDbConnection['principal'] = mysqli_connect(
            $aDbConfig['db_host_name'],
            $aDbConfig['db_user_name'],
            $aDbConfig['db_password'],
            $aDbConfig['db_name'],
            $aDbConfig['db_port']
            // string $socket = null
          );
          break;
        default:
          print "La conexión a la base de datos no es valida";
          die();
          break;
      }
    }catch( Exception $e ){
      print "Error!: " . $e->getMessage() . "<br>";
      exit();
    }
  }
}
