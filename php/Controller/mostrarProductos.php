<?php

include_once '../Model/productos.php';

  $producto = new Producto();
  $productos = $producto->obtenerProductos();
  echo "<div class='content-main'>";
  echo "<table  class='custom-table-producto'>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Nombre</th>";
  echo "<th>Precio</th>";
  echo "<th>Stock</th>";
  echo "<th>Descripción</th>";
  echo "<th>Categoría</th>";
  echo "<th>Marca</th>";
  echo "<th>Proveedor</th>";
  echo "<th>Acciones</th>";
  echo "</tr>";

  foreach ($productos as $producto)
  {
    echo "<tr>";
    echo "<td>" . $producto->getIdProducto() . "</td>";
    echo "<td>" . $producto->getNombre() . "</td>";
    echo "<td>" . $producto->getPrecio() . "</td>";
    echo "<td>" . $producto->getStock() . "</td>";
    echo "<td>" . $producto->getDescripcion() . "</td>";
    echo "<td>" . $producto->getCategoria() . "</td>";
    echo "<td>" . $producto->getMarca() . "</td>";
    echo "<td>" . $producto->getProveedor() . "</td>";
    echo "<td>";
   echo "<button class='editarBtn' data-id='" . htmlspecialchars($producto->getIdProducto()) . "' >Editar</button>";
    echo "<button class='eliminarBtn' data-id='" . htmlspecialchars($producto->getIdProducto()) . "' >Eliminar</button>";
    echo "</td>";
    echo "</tr>";
  }

  echo "</table></div>";



