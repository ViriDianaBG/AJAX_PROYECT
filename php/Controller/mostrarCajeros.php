<?php
include '../Model/cajero.php';

$cajeroModel = new Cajero();
$cajeros = $cajeroModel->obtenerCajeros();

echo "<table>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nombre</th>";
echo "<th>Acciones</th>";
echo "</tr>";

foreach ($cajeros as $cajero) {
  echo "<tr>";
  echo "<td>" . htmlspecialchars($cajero->getIdCajero()) . "</td>"; 
  echo "<td>" . htmlspecialchars($cajero->getNombre()) ." " . htmlspecialchars($cajero->getApellidoPaterno()). " " . htmlspecialchars($cajero->getApellidoMaterno()). "</td>"; 
  echo "<td>";
  echo "<button class='editarBtn' data-id='" . htmlspecialchars($cajero->getIdCajero()) . "' >Editar</button>";
  echo "<button class='eliminarBtn' data-id='" . htmlspecialchars($cajero->getIdCajero()) . "' >Eliminar</button>";
  echo "</td>";
  echo "</tr>";
}

echo "</table>";
