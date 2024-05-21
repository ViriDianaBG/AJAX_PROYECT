<?php

include_once '../Model/carrito.php';

$carrito = new Carrito();
$carrito->setIdProducto($_POST['id_producto']);



