<?php

include '../BaseDatos/conexion.php';

//session_start();

class Proveedor{
    private $id_Proveedor;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
    private $id_TipoUsuario = 3;
    private $db;

    public function __construct($id_Proveedor = null, $nombre = null,$direccion = null, $telefono = null, $email = null,  $db = null)
    {
        global $db;
        $this->id_Proveedor = $id_Proveedor;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->db = $db;
    }

    public function getIdProveedor()
    {
        return $this->id_Proveedor;
    }

    public function setIdProveedor($id_proveedor)
    {
        $this->id_proveedor = $id_proveedor;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function mostrarProveedores()
    {
        $stmt = $this->db->prepare("SELECT * FROM proveedor");
        $stmt->execute();
        $proveedores = [];
        while($row = $stmt->fetch())
        {
            $proveedor = new Proveedor($row['id_Proveedor'], $row['nombre'], $row['direccion'], $row['telefono'], $row['email']);
            $proveedores[] = $proveedor;
        }
        return $proveedores;
    }

    public function agregarProveedor()
    {
        $stmt = $this->db->prepare("INSERT INTO proveedor (id_TipoUsuario, nombre, direccion, telefono, email) VALUES (?, ?, ?, ?, ?)");

        $stmt->execute([
            $this->id_TipoUsuario,
            $this->nombre, $this->direccion, $this->telefono, $this->email]);

        $this->id_Proveedor = $this->db->lastInsertId();

        return $stmt->rowCount();

    }

    public function eliminarProveedor($id_Proveedor)
    {
        $stmt = $this->db->prepare("DELETE FROM proveedor WHERE id_Proveedor = ?");
        $stmt->execute([$id_Proveedor]);
        return $stmt->rowCount();
    }

    public function actualizarProveedor()
    {
        $stmt = $this->db->prepare("UPDATE proveedor SET nombre = ?, direccion = ?, telefono = ?, email = ? WHERE id_Proveedor = ?");
        $stmt->execute([$this->nombre, $this->direccion, $this->telefono, $this->email, $this->id_Proveedor]);
        return $stmt->rowCount();
    }

    public function obtenerProveedorPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM proveedor WHERE id_Proveedor = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $id_Proveedor = $row['id_Proveedor'];
        $nombre = $row['nombre'];
        $direccion = $row['direccion'];
        $telefono = $row['telefono'];
        $email = $row['email'];

        return new Proveedor($id_Proveedor, $nombre, $direccion, $telefono, $email);
    }


}