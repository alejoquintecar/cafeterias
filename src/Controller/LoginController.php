<?php

/**
 * parent::__construct();
 * 
 * Colocar la linea anterior en una funcion disparara el constructor de BaseControlle, lo cual validara que exista una session
 * Si no existe la session redireccionara al login
*/ 

// Core
require_once __DIR__."/../../core/ConexionDB.php";
require_once __DIR__."/../../core/BaseController.php";
// Serices
require_once __DIR__."/../../src/Service/AppCustomAuthenticator.php";


class LoginController extends BaseController{

  /** Iniciar variables
   * @author <Nestor Alejandro Quintero Cardozo>
  */
  private $oConexionDB;
  public function __construct(){
    $this->oConexionDB = new ConexionDB();
    $this->oConexionDB->start();
    // var_dump( $ConexionDB );exit();
  }

  /** Render template
   * @author <Nestor Alejandro Quintero Cardozo>
  */
  //LoginController@index
  public function index(){
    $this->render('app/login.html.php', array(
      'prueba' => '01'
    ));
  }

  public function authenticate(){
    
    $sUserName = $_REQUEST['username'];
    $sPassword = $_REQUEST['password'];

    $oAppCustomAuthenticator = new AppCustomAuthenticator();
    $bAuthenticate = $oAppCustomAuthenticator->authenticate( $this->oConexionDB, $sUserName, $sPassword );

    if( $bAuthenticate ){
      switch( $_SESSION['roles'] ){
        case 'ADMIN':
          header("Location: http://transportes-acme.com/users"); /* Redirect browser */
          break;
        default: header("Location: http://transportes-acme.com/logout"); /* Redirect browser */ break;
      }      
    }else{
      $_SESSION['app']->error = "Credenciales invalidades.";
      header("Location: http://transportes-acme.com/login"); /* Redirect browser */
    }
  }

  public function logout(){
    session_destroy();
    header("Location: http://transportes-acme.com/login"); /* Redirect browser */
  }

  public function __destruct(){
    unset( $this->oConexionDB );
  }

}

?>