<?php

include_once '../BaseDatos/conexion.php';

class Carrito{
  private $venta;
  private $id_producto;
  private $cantidad;
  private $db;

  public function __construct($venta = null, $id_producto = null, $cantidad = null, $db = null)
  {
    global $db;
    $this->venta = $venta;
    $this->id_producto = $id_producto;
    $this->cantidad = $cantidad;
    $this->db = $db;
  }

  public function agregarCarrito()
  {
    $stmt = $this->db->prepare("INSERT INTO carrito (venta, id_producto, cantidad) VALUES (?, ?, ?)");
    $stmt->execute([$this->venta, $this->id_producto, $this->cantidad]);

    return $stmt->rowCount();
  }

  public function getVenta()
  {
    return $this->venta;
  }

  public function setVenta($venta)
  {
    $this->venta = $venta;
  }

  public function getIdProducto()
  {
    return $this->id_producto;
  }

  public function setIdProducto($id_producto)
  {
    $this->id_producto = $id_producto;
  }

  public function getCantidad()
  {
    return $this->cantidad;
  }

  public function setCantidad($cantidad)
  {
    $this->cantidad = $cantidad;
  }

  public function getDb()
  {
    return $this->db;
  }

  public function setDb($db)
  {
    $this->db = $db;
  }


}