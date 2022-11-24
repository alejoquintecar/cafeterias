<?php


// Core
require_once __DIR__."/../../core/ConexionDB.php";
require_once __DIR__."/../../core/BaseController.php";

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

          // Estado
          $sEstado = '';
          switch( $row->estado ){
            case '1': $sEstado = 'Activo'; break;
            case '2': $sEstado = 'Inactivo'; break;
            default: $sEstado = 'Estado no asignado'; break;
          }
          $aProductos[] = array(
            'id'          => $row->id,
            'nombre'      => $row->nombre,
            'referencia'  => $row->referencia,
            'precio'      => $row->precio,
            'peso'        => $row->peso,
            'categoria'   => $row->categoria,
            'stock'       => $row->stock
          );
        }
      }

      // // Cierre de conexion y Respuesta
      // $em->getConnection()->close();
      $aJson['data'] = $aProductos;
      $aJson['totalRows'] = $totalRegistros;
      $_SESSION['json'] = true;
      // json_encode([
      //   'totalRows' => $totalRegistros, 'data' => $aProductos
      // ]);

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

        header("Content-Type: application/json");
        echo json_encode($aJson);

      }else{

        $this->render('productos/indexCrud.html.php', array(
          'action' => 'new'
        ));
      }

    }
  }

  // --- --- --- Definicion de columnas --- --- ---
  private function indexDfColumnsButtons( $aPermisos = array() ){

    $aDfColumns = [ 'columns' => [
      [ 'width' => 100,
        'data' => 'nombres',       'title' => 'Nombres'
      ],
      [ 'width' => 100,
        'data' => 'apellidos',     'title' => 'Apellidos'
      ],
      [ 'width' => 100,
        'data' => 'documento',     'title' => 'Núm. Documento'
      ],
      [ 'width' => 70,
        'data' => 'username',      'title' => 'Nombre Usuario '
      ],
      [ 'width' => 70,
        'data' => 'tipoPermisos',  'title' => 'Tipo permisos'
      ],
      [ 'width' => 70, 'visible' => (empty($aPermisos)) ? false : true,
        'data' => 'nTipoPermisos',  'title' => 'Permisos',
        'cellRender' => [
          'render'  => 'buttons',
          'buttons' => (empty($aPermisos)) ? $aPermisos : $this->oMenuPermisos->getButtons($aPermisos, 2)
        ]
      ],
      [ 'width' => 70,
        'data' => 'estado',         'title' => 'Estado'
      ],
    ]];

    $aDfButtons = [
      'crear' => array(
        'id' => 'crear-registro',
        'text' => 'Crear',
        'title' => 'Crear Registro',
        'icons' => array('fas fa-user-plus'),
        'class' => array('btn-outline-success')
      ),
      'editar' => array(
        'id' => 'editar-registro',
        'text' => 'Editar',
        'title' => 'Crear Registro',
        'icons' => array('fas fa-user-edit'),
        'class' => array('btn-outline-warning')
      ),
      'eliminar' => array(
        'id' => 'editar-registro',
        'text' => 'Editar',
        'title' => 'Crear Registro',
        'icons' => array('fas fa-user-minus'),
        'class' => array('btn-outline-danger')
      )
    ];

    return [ 'columns' => $aDfColumns, 'buttons' => $aDfButtons ];
  }

}

?>