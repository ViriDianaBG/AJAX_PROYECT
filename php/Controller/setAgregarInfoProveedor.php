<?php

include_once '../Model/proveedor.php';

if(isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['direccion']))
{
    $proveedor = new Proveedor();
    $proveedor->setNombre($_POST['nombre']);
    $proveedor->setTelefono($_POST['telefono']);
    $proveedor->setEmail($_POST['email']);
    $proveedor->setDireccion($_POST['direccion']);
    $proveedor->agregarProveedor();
    
    echo "Proveedor guardado";

    echo "<br>";
    echo "Nombre: " . $proveedor->getNombre();
}
else
{   
    echo "Error al guardar el proveedor";  
}