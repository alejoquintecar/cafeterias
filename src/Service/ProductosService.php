<?php

class ProductosService{

  public function __construct(){
    
  }

  /**
   * @param $oConexionDB objeto con laconeccion a base de datos
   * @param $sUserName usuario diligenciado por el usuario
   * @param $sPassword contrasenia diligenciada por el usuario
  */
  public function setProducto( $oConexionDB, $aParams ){

    $sFecha = date('Y-m-d');
    $nPeso  = $aParams['peso'];
    $nStock = $aParams['stock'];
    $sNombre = $aParams['producto'];
    $nPrecio = $aParams['precio'];
    $sCategoria = $aParams['categoria'];
    $sReferencia = $aParams['referencia'];

    $sQueryAuthenticate = "INSERT INTO productos( nombre, referencia, precio, peso, categoria, stock, fecha_creacion )VALUES(
      '{$sNombre}', '{$sReferencia}', $nPrecio, $nPeso, '{$sCategoria}', $nStock, '{$sFecha}'
    )";
    $bResult = $oConexionDB->executeQuery($sQueryAuthenticate);
    return $bResult;
  }

}