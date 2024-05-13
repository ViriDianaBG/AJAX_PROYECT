<?php

include_once '../Model/cajero.php';

if (isset($_POST['id']))
{

    $cajero = new Cajero();
    $cajero = $cajero->obtenerCajeroPorId($_POST['id']);
  
    echo "ID: " . $cajero->getIdCajero() . "<br>";
    echo "Nombre: " . $cajero->getNombre() . "<br>";
    echo "Apellido paterno: " . $cajero->getApellidoPaterno() . "<br>";
    echo "Apellido materno: " . $cajero->getApellidoMaterno() . "<br>";
    echo "Email: " . $cajero->getEmail() . "<br>";
    echo "Telefono: " . $cajero->getTelefono() . "<br>";
    echo "Direccion: " . $cajero->getDireccion() . "<br>";

    echo "<h2>Editar información</h2>";
    echo "<form id='editarCajeroForm' method='POST'>";
    echo "<p id='id' data-id='{$cajero->getIdCajero()}'> ID: ". $cajero->getIdCajero()." </p>";
    echo "Nombre: <input type='text' name='nombre' id='nombre' value='" . $cajero->getNombre() ."'><br>";
    echo "Apellido Paterno: <input type='text' name='apellidoPaterno' id='apellidoPaterno' value='". $cajero->getApellidoPaterno()."'><br>";
    echo "Apellido Materno: <input type='text' name='apellidoMaterno' id='apellidoMaterno'value='". $cajero->getApellidoMaterno()."' ><br>";
    echo "Email: <input type='text' name='email' id='email'  value='". $cajero->getEmail() ."'><br>";
    echo "Telefono: <input type='text' name='telefono' id='telefono' value='".$cajero->getTelefono()."'><br>";
    echo "Direccion: <input type='text' name='direccion' id='direccion' value='".$cajero->getDireccion(). "'><br>";

    echo "<input type='submit' value='Editar'>";             
    echo "</form>";
}