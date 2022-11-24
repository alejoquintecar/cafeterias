<?php

class AppCustomAuthenticator{

  public function __construct(){
    
  }

  /**
   * @param $oConexionDB objeto con laconeccion a base de datos
   * @param $sUserName usuario diligenciado por el usuario
   * @param $sPassword contrasenia diligenciada por el usuario
  */
  public function authenticate( $oConexionDB, $sUserName, $sPassword ){

    // var_dump( $sUserName, $sPassword );exit();
    $bReturn = false;
    $sQueryAuthenticate = "SELECT us.id, us.nombres, us.apellidos, us.roles, us.estado
      FROM users as us
      WHERE us.user_name = '$sUserName' AND us.password = '$sPassword'
    ";

    $oResult = $oConexionDB->executeQuery($sQueryAuthenticate);
    if( $oResult->num_rows == 1 ){
      $bReturn = true;
      while( $row = $oResult->fetch_object() ){
        $_SESSION['id']        = $row->id;
        $_SESSION['nombres']   = $row->nombres;
        $_SESSION['apellidos'] = $row->apellidos;
        $_SESSION['roles']     = $row->roles;
        $_SESSION['estado']    = $row->estado;
      }
    }
    return $bReturn;
  }

}