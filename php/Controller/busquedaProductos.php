<?php

include_once '../Model/productos.php';

if (isset($_POST['nombre']))
{
    $producto = new Producto();
    $productos = $producto->busqueda($_POST['nombre']);

    if ($productos != null)
    {
        foreach ($productos as $producto)
        {
            echo "<table class='tablaProductos'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Id_Producto</th>";
            echo "<th>Nombre</th>";
            echo "<th>Precio</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Mostrar el nombre del producto solo en la primera fila
            echo "<tr>";
            echo "<td>" . $producto->getIdProducto() . "</td>";
            echo "<td rowspan='3'><p id='nombre'>" . $producto->getNombre() . "</p></td>"; // rowspan indica cuántas filas ocupará esta celda
            echo "<td>" . $producto->getPrecio() . "</td>";
            echo "</tr>";

            echo "</tbody>";
            echo "</table>";

            echo "<button id='agregarProducto' data-id='" . $producto->getIdProducto() . "' class='agregarProducto'>Agregar</button>";
        }
    } else
    {
        echo "No se encontraron productos";
    }

} else
{
    echo "Error al buscar el producto";
}