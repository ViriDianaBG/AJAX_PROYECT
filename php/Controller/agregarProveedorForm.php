<?php

include_once '../Model/proveedor.php';

$proveedor = new Proveedor();
$proveedor->setIdProveedor(0);
echo '<form id="agregarProveedorForm" method="POST"><br>';

echo '<label for="nombre">Nombre:</label>';
echo '<input type="text" name="nombre" id="nombre" value="'.$proveedor->getNombre().'" required><br>';

echo '<label for="direccion">Dirección:</label>';
echo '<input type="text" name="direccion" id="direccion" value="'.$proveedor->getDireccion().'" required><br>';

echo '<label for="telefono">Teléfono:</label>';
echo '<input type="text" name="telefono" id="telefono" value="'.$proveedor->getTelefono().'" required><br>';

echo '<label for="email">Email:</label>';
echo '<input type="email" name="email" id="email" value="'.$proveedor->getEmail().'" required><br>';

echo '<input type="submit" value="Agregar"><br>';
echo '</form>';
