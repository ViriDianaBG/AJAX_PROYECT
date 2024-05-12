<?php
include_once '../Model/cajero.php';

if(isset($_POST['id']))
{
    include_once '../Model/proveedor.php';
    $proveedor = new Proveedor();
    $proveedor = $proveedor->obtenerProveedorPorId($_POST['id']);
  
    echo "ID: " . $proveedor->getIdProveedor() . "<br>";
    echo "Nombre: " . $proveedor->getNombre() . "<br>";
    echo "Direccion: " . $proveedor->getDireccion() . "<br>";
    echo "Telefono: " . $proveedor->getTelefono() . "<br>";
    echo "Email: " . $proveedor->getEmail() . "<br>";

    echo "<h2>Editar información</h2>";
    echo "<form id='editarProveedorForm' method='POST'>";
    echo "<p id='id' data-id='{$proveedor->getIdProveedor()}'> ID: ". $proveedor->getIdProveedor()." </p>";
    echo "Nombre: <input type='text' name='nombre' id='nombre' value='" . $proveedor->getNombre() ."'><br>";
    echo "Direccion: <input type='text' name='direccion' id='direccion' value='". $proveedor->getDireccion()."'><br>";
    echo "Telefono: <input type='text' name='telefono' id='telefono' value='". $proveedor->getTelefono() ."'><br>";
    echo "Email: <input type='text' name='email' id='email' value='". $proveedor->getEmail() ."'><br>";
    echo "<input type='submit' value='Agregar'>";             
    echo "</form>";
}
else
{
    echo "Error al obtener el proveedor";
}