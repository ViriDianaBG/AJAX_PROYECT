<?php

include '../BaseDatos/conexion.php';

session_start();

class Cajero
{
  private $id_Cajero;
  private $nombre;
  private $apellidoPaterno;
  private $apellidoMaterno;
  private $telefono;
  private $email;
  private $direccion;
  private $contrasenia;
  private $db;

  private $tipo_usuario = 2;
  // Constructor with default null values
  public function __construct($id_Cajero = null, $nombre = null, $apellidoPaterno = null, $apellidoMaterno = null, $telefono = null, $email = null, $direccion = null, $contrasenia = null, $db = null)
  {
    global $db;
    $this->id_Cajero = $id_Cajero;
    $this->nombre = $nombre;
    $this->apellidoPaterno = $apellidoPaterno;
    $this->apellidoMaterno = $apellidoMaterno;
    $this->telefono = $telefono;
    $this->email = $email;
    $this->direccion = $direccion;
    $this->contrasenia = $contrasenia;
    $this->db = $db;
  }

  //Todos los cajeros
  public function obtenerCajeros()
  {
    $stmt = $this->db->prepare("SELECT * FROM cajeros");
    $stmt->execute();
    $cajeros = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $cajero = new Cajero($row['id_Cajero'], $row['nombre'], $row['apellido_paterno'], $row['apellido_materno'], $row['email'], $row['direccion']);
      $cajeros[] = $cajero;
    }
    return $cajeros;
  }

  // Agregar nuevo cajero con tipo de usuario
  public function agregarCajero()
{
    $stmt = $this->db->prepare("INSERT INTO cajeros (nombre, apellido_paterno, apellido_materno, telefono, email, direccion, contrasenia, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$this->nombre, $this->apellidoPaterno, $this->apellidoMaterno, $this->telefono, $this->email, $this->direccion, $this->contrasenia, $this->tipo_usuario]);

    // Obtener el ID generado automáticamente
    $this->id_Cajero = $this->db->lastInsertId();

    return $stmt->rowCount();
}




  //Eliminar cajero
  public function eliminarCajero($id_Cajero)
  {
    $stmt = $this->db->prepare("DELETE FROM cajeros WHERE id_Cajero = ?");
    $stmt->execute([$id_Cajero]);
    return $stmt->rowCount();
  }

  // Actualizar cajero
  public function actualizarCajero()
  {
    $stmt = $this->db->prepare("UPDATE cajeros SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, telefono = ?, email = ?, direccion = ? WHERE id_Cajero = ?");
    $stmt->execute([$this->nombre, $this->apellidoPaterno, $this->apellidoMaterno, $this->telefono, $this->email, $this->direccion,$this->id_Cajero]);
    return $stmt->rowCount(); // Regresa el número de filas afectadas
  }

  // Obtener usuario por id
  public function obtenerCajeroPorId($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM cajeros WHERE id_Cajero = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_Cajero = $row['id_Cajero'];
    $nombre = $row['nombre'];
    $apellido_paterno = $row['apellido_paterno'];
    $apellido_materno = $row['apellido_materno'];
    $telefono = $row['telefono'];
    $email = $row['email'];
    $direccion = $row['direccion'];

    return new Cajero($id_Cajero, $nombre, $apellido_paterno, $apellido_materno, $telefono, $email, $direccion);
  }

  public function getIdCajero()
  {
    return $this->id_Cajero;
  }

  public function setIdCajero($id_Cajero)
  {
    $this->id_Cajero = $id_Cajero;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getApellidoPaterno()
  {
    return $this->apellidoPaterno;
  }

  public function setApellidoPaterno($apellidoPaterno)
  {
    $this->apellidoPaterno = $apellidoPaterno;
  }

  public function getApellidoMaterno()
  {
    return $this->apellidoMaterno;
  }

  public function setApellidoMaterno($apellidoMaterno)
  {
    $this->apellidoMaterno = $apellidoMaterno;
  }

  public function getTelefono()
  {
    return $this->telefono;
  }

  public function setTelefono($telefono)
  {
    $this->telefono = $telefono;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getDireccion()
  {
    return $this->direccion;
  }

  public function setDireccion($direccion)
  {
    $this->direccion = $direccion;
  }

  public function getContrasenia()
  {
    return $this->contrasenia;
  }

  public function setContrasenia($contrasenia)
  {
    $this->contrasenia = $contrasenia;
  }
}