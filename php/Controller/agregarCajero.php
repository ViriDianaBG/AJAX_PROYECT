<?php

include_once '../Model/cajero.php';

$cajero = new Cajero();
$cajero->setIdCajero(0);

echo '<form id="agregarCajeroForm" method="POST"><br>';

echo '<label for="nombre">Nombre:</label><br>';
echo '<input type="text" name="nombre" id="nombre" value="'.$cajero->getNombre().'" required><br>';

echo '<label for="apellido">Apellido paterno:</label><br>';
echo '<input type="text" name="apellido" id="apellidoPaterno" value="'.$cajero->getApellidoPaterno().'"required><br>';

echo '<label for="apellido">Apellido materno:</label><br>';
echo '<input type="text" name="apellido" id="apellidoMaterno" value="'.$cajero->getApellidoMaterno().'" required><br>';

echo '<label for="telefono">Telefono:</label><br>';
echo '<input type="text" name="telefono" id="telefono" value="'.$cajero->getTelefono().'" required><br>';

echo '<label for="email">Email:</label><br>';
echo '<input type="email" name="email" id="email" value="'.$cajero->getEmail().'"required><br>';

echo '<label for="contrasenia">Contraseña:</label><br>';
echo '<input type="text" name="contrasenia" id="contrasenia" value="'.$cajero->getContrasenia().'" required><br>';


echo '<label for="direccion">Direccion:</label><br>';
echo '<input type="text" name="direccion" id="direccion" value="'.$cajero->getDireccion().'" required><br>';


echo '<br><input type="submit" value="Guardar"><br>';
echo '</form>';
