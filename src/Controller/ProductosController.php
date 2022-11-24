<?php


// Core
require_once __DIR__."/../../core/ConexionDB.php";
require_once __DIR__."/../../core/BaseController.php";
// Srvices
require_once __DIR__."/../../src/Service/ProductosService.php";

class ProductosController extends BaseController{

  /** Iniciar variables
   * @author <Nestor Alejandro Quintero Cardozo>
  */
  private $oConexionDB;
  public function __construct(){
    parent::__construct();
    $this->oConexionDB = new ConexionDB();
    $this->oConexionDB->start();
  }

  /** Render template
   * @author <Nestor Alejandro Quintero Cardozo>
  */
  // UsersController@index
  public function index(){

    $this->render('productos/index.html.php', array(
      
    ));
  }

  public function indexJson( $bExportar = true ){

    $aJson = array();

    if( $_SERVER['REQUEST_SCHEME'] == 'http' || $bExportar == true ){

      // --- --- --- --- Total Filas --- --- --- --- //
      $totalRegistros = 0;
      // if( $aDataGrilla["paginaActual"] == 1 && $exportar === false ){
        $oResultContador = $this->oConexionDB->executeQuery("SELECT COUNT(pd.id) AS totalRegistros FROM productos pd");
        $totalRegistros = $oResultContador->fetch_object()->totalRegistros;
      // }

      // DQL Data
      $oQueryProductos = $this->oConexionDB->executeQuery("SELECT pd.id, pd.nombre, pd.referencia, pd.precio, pd.peso, pd.categoria,
        pd.stock, pd.fecha_creacion
        FROM productos pd
      ");

      // --- --- --- Lógica --- --- --- //
      $aProductos = array();
      if( $oQueryProductos->num_rows > 0 ){
        while( $row = $oQueryProductos->fetch_object() ){
          $aProductos[] = array(
            'id'          => $row->id,
            'nombre'      => $row->nombre,
            'referencia'  => $row->referencia,
            'precio'      => $row->precio,
            'peso'        => $row->peso,
            'categoria'   => $row->categoria,
            'stock'       => $row->stock,
            'fecha_creacion'  => $row->fecha_creacion
          );
        }
      }

      $aJson['data'] = $aProductos;
      $aJson['totalRows'] = $totalRegistros;
      $_SESSION['json'] = true;

    }else{
      $aJson['status'] = 0;
      $aJson['message'] = "Acción no valida";
    }

    header("Content-Type: application/json");
    echo json_encode($aJson);
  }

  public function indexNew(){

    $aJson = array();

    if( $_SERVER['REQUEST_SCHEME'] == 'http' ){

      $aDataForm = (isset($_REQUEST['producto'])) ? $_REQUEST['producto'] : null;

      // var_dump( $aDataForm );exit();

      if( !empty($aDataForm) ){

        $oProductosService = new ProductosService();

        $aJson['status'] = 1;
        $aJson['message'] = "";

        $bResult = $oProductosService->setProducto( $this->oConexionDB, $aDataForm );
        if( $bResult ){
          $aJson['status'] = 1;
          $aJson['message'] = "Producto agregado.";
        }else{
          $aJson['status'] = 0;
          $aJson['message'] = "El producto no pudo ser agregado.";
        }

        header("Content-Type: application/json");
        echo json_encode($aJson);
        exit();

      }else{

        $this->render('productos/indexCrud.html.php', array(
          'action' => 'new'
        ));
      }

    }
  }

  public function indexEdit(){

    $aJson = array();

    if( $_SERVER['REQUEST_SCHEME'] == 'http' ){

      $oProductosService = new ProductosService();
      $aDataForm = (isset($_REQUEST['producto'])) ? $_REQUEST['producto'] : null;

      if( !empty($aDataForm) ){

        

        $aJson['status'] = 1;
        $aJson['message'] = "";

        $bResult = $oProductosService->setProducto( $this->oConexionDB, $aDataForm );
        if( $bResult ){
          $aJson['status'] = 1;
          $aJson['message'] = "Producto actualizado.";
        }else{
          $aJson['status'] = 0;
          $aJson['message'] = "El producto no pudo ser actualizado.";
        }

        header("Content-Type: application/json");
        echo json_encode($aJson);
        exit();

      }else{

        $sIdProducto = $_COOKIE['registroId'];

        $aProducto = $oProductosService->getProductos( $this->oConexionDB, "pd.id = ".$sIdProducto );

        $this->render('productos/indexCrud.html.php', array(
          'action' => 'edit',
          'producto' => $aProducto[0]
        ));
      }

    }
  }

  

}

?>