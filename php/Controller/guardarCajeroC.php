<?php

include_once '../Model/cajero.php';  

if(isset($_POST['nombre']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['direccion']) && isset($_POST['contrasenia']) )
{
    $cajero = new Cajero();
    $cajero->setNombre($_POST['nombre']);
    $cajero->setApellidoPaterno($_POST['apellidoPaterno']);
    $cajero->setApellidoMaterno($_POST['apellidoMaterno']);
    $cajero->setTelefono($_POST['telefono']);
    $cajero->setEmail($_POST['email']);
    $cajero->setDireccion($_POST['direccion']);
    $cajero->setContrasenia($_POST['contrasenia']);
    $cajero->agregarCajero();
    
    echo "Cajero guardado";
}
else
{   
    echo "Error al guardar el cajero";  
}
