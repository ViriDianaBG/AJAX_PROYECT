<?php

include_once '../Model/productos.php';

if(isset($_POST['id']))
{
    $producto = new Producto();
    $producto = $producto->eliminarproducto($_POST['id']);
    echo "producto eliminado";
}
else
{
    echo "Error al eliminar el producto";  
}
