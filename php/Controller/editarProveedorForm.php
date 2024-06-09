<?php
include_once '../Model/proveedor.php';

if(isset($_POST['id']))
{
    $proveedor = new Proveedor();
    $proveedor = $proveedor->obtenerProveedorPorId($_POST['id']);
    echo "<h2>Información actual</h2>";
    echo "<div class='cajero-info'>";
    echo "<h3 id='titulo'>ID:</h3> <p>" . $proveedor->getIdProveedor() . "<br>";
    echo "<h3 id='titulo'>Nombre:</h3> <p>" . $proveedor->getNombre() . "<br>";
    echo "<h3 id='titulo'>Direccion:</h3> <p>" . $proveedor->getDireccion() . "<br>";
    echo "<h3 id='titulo'>Telefono:</h3> <p>" . $proveedor->getTelefono() . "<br>";
    echo "<h3 id='titulo'>Email:</h3> <p>" . $proveedor->getEmail() . "<br>";
    echo "</div>";

    echo "<h2>Editar información</h2>";
    echo "<form id='editarProveedorForm' method='POST'>";
    echo "<p id='id' data-id='{$proveedor->getIdProveedor()}'> ID: ". $proveedor->getIdProveedor()." </p>";
    echo "Nombre: <input type='text' name='nombre' id='nombre' value='" . $proveedor->getNombre() ."'><br>";
    echo "Direccion: <input type='text' name='direccion' id='direccion' value='". $proveedor->getDireccion()."'><br>";
    echo "Telefono: <input type='text' name='telefono' id='telefono' value='". $proveedor->getTelefono() ."'><br>";
    echo "Email: <input type='text' name='email' id='email' value='". $proveedor->getEmail() ."'><br>";
    echo "<input type='submit' value='Editar'>";             
    echo "</form>";
}
else
{
    echo "Error al obtener el proveedor";
}