<?php
include_once '../Model/proveedor.php';

$proveedor = new Proveedor();
$proveedores = $proveedor->mostrarProveedores();
 echo "<div class='content-main'>";
echo "<table class='custom-table-producto'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nombre</th>";
echo "<th>Telefono</th>";
echo "<th>Email</th>";
echo "<th>Direccion</th>";
echo "<th>Acciones</th>";
echo "</tr>";

foreach ($proveedores as $proveedor) {
  echo "<tr>";
  echo "<td>" . htmlspecialchars($proveedor->getIdProveedor()) . "</td>";
  echo "<td>" . htmlspecialchars($proveedor->getNombre()). " " . "</td>";
  echo "<td>" . htmlspecialchars($proveedor->getTelefono()). " " . "</td>";
  echo "<td>" . htmlspecialchars($proveedor->getEmail()). " " . "</td>";
  echo "<td>" . htmlspecialchars($proveedor->getDireccion()). " " . "</td>";
  echo "<td>";
  echo "<button class='editarBtn' data-id='" . htmlspecialchars($proveedor->getIdProveedor()) . "' >Editar</button>";
  echo "<button class='eliminarBtn' data-id='" . htmlspecialchars($proveedor->getIdProveedor()) . "' >Eliminar</button>";
  echo "</td>";
  echo "</tr>";
}

  echo "</table></div>";