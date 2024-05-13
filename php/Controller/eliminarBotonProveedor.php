<?php

include_once '../Model/proveedor.php';

if(isset($_POST['id']))
{
    $proveedor = new Proveedor();
    $proveedor = $proveedor->eliminarProveedor($_POST['id']);
    echo "Proveedor eliminado";
}
else
{
    echo "Error al eliminar el proveedor";  
}