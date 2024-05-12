<?php

include_once '../Model/cajero.php';

if(isset($_POST['id']))
{
    $cajero = new Cajero();
    $cajero = $cajero->eliminarCajero($_POST['id']);
    echo "Cajero eliminado";
}
else
{
    echo "Error al eliminar el cajero";  
}
