<?php

include '../BaseDatos/conexion.php';

session_start();

class Cajero
{
  private $id_Cajero;
  private $nombre;
  private $numero;
  private $email;
  private $direccion;
  private $contrasenia;
  private $db;

  public function __construct($id = null, $nombre = null, $apellidoPaterno = null, $apellidoMaterno = null, $nss = null, $email = null, $db) {
    global $db;
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellidoPaterno = $apellidoPaterno;
    $this->apellidoMaterno = $apellidoMaterno;
    $this->nss = $nss;
    $this->email = $email;
    $this->db = $db;
}


  // Getters
  public function getIdCajero()
  {
    return $this->id_Cajero;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function getNumero()
  {
    return $this->numero;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getDireccion()
  {
    return $this->direccion;
  }

  public function getContrasenia()
  {
    return $this->contrasenia;
  }

  // Setters
  public function setIdCajero($id_Cajero)
  {
    $this->id_Cajero = $id_Cajero;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function setNumero($numero)
  {
    $this->numero = $numero;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setDireccion($direccion)
  {
    $this->direccion = $direccion;
  }

  public function setContrasenia($contrasenia)
  {
    $this->contrasenia = $contrasenia;
  }

  //Todos los cajeros
  public function obtenerCajero()
  {
    $stmt = $this->db->prepare("SELECT * FROM cajeros");
    $stmt->execute();
    $cajeros = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $cajero = new Cajero($row['id_Cajero'], $row['nombre'], $row['numero'], $row['email'], $row['direccion'], $this->db);
      $cajeros[] = $cajero;
    }
    return $cajeros;
  }

  //Cajero por id
  public function obtenerCajeroID($id_Cajero)
  {
    $stmt = $this->db->prepare("SELECT * FROM cajeros WHERE id_Cajeros = :id_Cajero");
    $stmt->bindParam(':id_Cajero', $id_Cajero);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $cajero = new Cajero($row['id_Cajero'], $row['nombre'], $row['numero'], $row['email'], $row['direccion'], $this->db);
    return $cajero;
  }

  //Agregar cajero
 public function agregarCajero() {
    $stmt = $this->db->prepare("INSERT INTO cajeros (nombre, numero, email, direccion, contrasenia) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$this->nombre, $this->numero, $this->email, $this->direccion, $this->contrasenia]);
    $this->id_Cajero = $this->db->lastInsertId();
    return $this->id_Cajero;
}


    //Eliminar cajero
    public function eliminarCajero($id_Cajero) {
        $stmt = $this->db->prepare("DELETE FROM cajeros WHERE id_Cajero = ?");
        $stmt->execute([$id_Cajero]);
        return $stmt->rowCount();
    }

    //Actualizar cajero
    public function actualizarCajero($id_Cajero) {
        $stmt = $this->db->prepare("UPDATE cajeros SET nombre = ?, numero = ?, email = ?, direccion = ? WHERE id_Cajero = ?");
        $stmt->execute([$this->nombre, $this->numero, $this->email, $this->direccion, $id_Cajero]);
        return $stmt->rowCount();
    }







}