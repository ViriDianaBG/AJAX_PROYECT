<?php

include_once '../BaseDatos/conexion.php';

session_start();
class Venta{
  private $id_Ventas;
  private $id_Cajero;
  private $total;
  private $tipo_pago;
  private $cantidad_total;
  private $fecha;
  private $db;

  public function __construct($id_Ventas = null, $id_Cajero = null, $total = null, $tipo_pago = null, $cantidad_total = null, $fecha = null, $db = null)
  {
    global $db;
    $this->id_Ventas = $id_Ventas;
    $this->id_Cajero = $id_Cajero;
    $this->total = $total;
    $this->tipo_pago = $tipo_pago;
    $this->cantidad_total = $cantidad_total;
    $this->fecha = $fecha;
    $this->db = $db;
  }

  public function registrarVenta($id_Cajero, $total, $tipo_pago, $cantidad_total, $fecha)
  {
    $stmt = $this->db->prepare("INSERT INTO ventas (id_Cajero, total, tipo_pago, cantidad_total, fecha) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_Cajero, $total, $tipo_pago, $cantidad_total, $fecha]);
    $this->id_Ventas = $this->db->lastInsertId();
    return $stmt->rowCount();
  }

  public function obtenerVentas()
  {
    $stmt = $this->db->prepare("SELECT * FROM ventas");
    $stmt->execute();
    $ventas = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $venta = new Venta($row['id_Ventas'], $row['id_Cajero'], $row['total'], $row['tipo_pago'], $row['cantidad_total'], $row['fecha']);
      $ventas[] = $venta;
    }
    return $ventas;
  }

  public function obtenerVentaId($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM ventas WHERE id_Ventas = ?");
    $stmt->execute([$id]);
    $venta = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_Ventas = $venta['id_Ventas'];
    $id_Cajero = $venta['id_Cajero'];
    $total = $venta['total'];
    $tipo_pago = $venta['tipo_pago'];
    $cantidad_total = $venta['cantidad_total'];
    $fecha = $venta['fecha'];
    return new Venta($id_Ventas, $id_Cajero, $total, $tipo_pago, $cantidad_total, $fecha);
  }

  public function eliminarVenta($id)
  {
    $stmt = $this->db->prepare("DELETE FROM ventas WHERE id_Ventas = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }


  public function getIdVentas()
  {
    return $this->id_Ventas;
  }

  public function setIdVentas($id_Ventas)
  {
    $this->id_Ventas = $id_Ventas;
  }

  public function getIdCajero()
  {
    return $this->id_Cajero;
  }

  public function setIdCajero($id_Cajero)
  {
    $this->id_Cajero = $id_Cajero;
  }

  public function getTotal()
  {
    return $this->total;
  }

  public function setTotal($total)
  {
    $this->total = $total;
  }

  public function getTipoPago()
  {
    return $this->tipo_pago;
  }

  public function setTipoPago($tipo_pago)
  {
    $this->tipo_pago = $tipo_pago;
  }

  public function getCantidadTotal()
  {
    return $this->cantidad_total;
  }

  public function setCantidadTotal($cantidad_total)
  {
    $this->cantidad_total = $cantidad_total;
  }

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }



}
