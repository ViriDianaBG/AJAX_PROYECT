<?php
include_once '../Model/cajero.php';  

if(isset($_POST['id'])&& isset($_POST['nombre']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['direccion']))
{
    $cajero = new Cajero();
    $cajero = $cajero->obtenerCajeroPorId($_POST['id']);
    $cajero->setNombre($_POST['nombre']);
    $cajero->setApellidoPaterno($_POST['apellidoPaterno']);
    $cajero->setApellidoMaterno($_POST['apellidoMaterno']);
    $cajero->setTelefono($_POST['telefono']);
    $cajero->setEmail($_POST['email']);
    $cajero->setDireccion($_POST['direccion']);
    $cajero->actualizarCajero();
    
    echo "Cajero guardado";

    echo "<br>";
    echo "Nombre: " . $cajero->getNombre();
}
else
{   
    echo "Error al guardar el cajero";  
}


