<?php

include_once '../Model/productos.php';

if(isset($_POST['nombre']))
{
    $producto = new Producto();
    $productos = $producto->busqueda($_POST['nombre']);
    
    if($productos != null)
    {
        foreach ($productos as $producto)
        {
            echo "<div class='producto' id='{$producto->getNombre()}'>";
            echo "<table class='tablaProductos'>";
            echo " thread>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Id_Producto</th>";
            echo "<th>Precio</th>";
            echo "</tr>";
            echo "</thread>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td><p id='nombre'>{$producto->getNombre()}</p></td>";
            echo "<td>{}{$producto->getIdProducto()}</td>";
            echo "<td>{}{$producto->getPrecio()}</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "<div class='panel-{$producto->getIdProducto()}'>";      

            echo "</div>";
            
        }
    }
    else
    {
        echo "No se encontraron productos";
    }
    
}
else
{
    echo "Error al buscar el producto";  
}