<?php

include_once '../Model/productos.php';

if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['marca']) && isset($_POST['proveedor']))
{
    $producto = new Producto();
    $producto->setNombre($_POST['nombre']);
    $producto->setPrecio($_POST['precio']);
    $producto->setStock($_POST['stock']);
    $producto->setDescripcion($_POST['descripcion']);
    $producto->setCategoria($_POST['categoria']);
    $producto->setMarca($_POST['marca']);
    $producto->setProveedor($_POST['proveedor']);
    $producto->agregarProducto();
    
    echo "Producto guardado";

    echo "<br>";
    echo "Nombre: " . $producto->getNombre();
}
else
{   
    echo "Error al guardar el producto";  
}