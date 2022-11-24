<?php

class ProductosService{

  public function __construct(){
    
  }

  /**
   * @param $oConexionDB objeto con laconeccion a base de datos
   * @param $aParams Parametros para el guardado
  */
  public function setProducto( $oConexionDB, $aParams ){

    $sFecha = date('Y-m-d');
    $nPeso  = $aParams['peso'];
    $nStock = $aParams['stock'];
    $sNombre = $aParams['producto'];
    $nPrecio = $aParams['precio'];
    $sCategoria = $aParams['categoria'];
    $sReferencia = $aParams['referencia'];

    $sQueryNewProducto = "INSERT INTO productos( nombre, referencia, precio, peso, categoria, stock, fecha_creacion )VALUES(
      '{$sNombre}', '{$sReferencia}', $nPrecio, $nPeso, '{$sCategoria}', $nStock, '{$sFecha}'
    )";
    $bResult = $oConexionDB->executeQuery($sQueryNewProducto);
    return $bResult;
  }

  /**
   * @param $oConexionDB objeto con laconeccion a base de datos
   * @param $sFiltros Filtros para buscar un producto
  */
  public function getProductos( $oConexionDB, $sFiltros ){
    
    $sFecha = date('Y-m-d');
    $sFiltros = ( !empty($sFiltros) ) ? 'AND '.$sFiltros:"";
    $sQuerySearchProductos = "SELECT pd.id, pd.nombre, pd.referencia, pd.precio, pd.peso, pd.categoria, pd.stock
    FROM productos as pd
    WHERE 1 = 1 $sFiltros";

    $oResult = $oConexionDB->executeQuery($sQuerySearchProductos);
    $aProductos = array();
    if( $oResult->num_rows == 1 ){
      $bReturn = true;
      while( $row = $oResult->fetch_object() ){
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
    return $aProductos;
  }

  public function putProducto( $oConexionDB, $aParams ){

    $sFecha   = date('Y-m-d');
    $nId      = intval($aParams['id']);
    $nPeso    = $aParams['peso'];
    $nStock   = $aParams['stock'];
    $sNombre  = $aParams['producto'];
    $nPrecio  = $aParams['precio'];
    $sCategoria = $aParams['categoria'];
    $sReferencia = $aParams['referencia'];

    $sQueryEditProducto = "UPDATE productos
      SET nombre = '{$sNombre}', referencia = '{$sReferencia}', precio = $nPrecio,
      peso = $nPeso, categoria = '{$sCategoria}', stock = $nStock
    WHERE id = $nId";
    $bResult = $oConexionDB->executeQuery($sQueryEditProducto);
    return $bResult;
  }


}