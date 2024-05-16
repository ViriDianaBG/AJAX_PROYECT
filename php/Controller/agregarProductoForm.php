<?php

include_once '../Model/productos.php';

$producto = new Producto();
$producto->setIdProducto(0);

echo '<form id="agregarProductoForm" method="POST">';
echo 'Nombre: <input type="text" name="nombre" id="nombre" value="' . $producto->getNombre() . '"><br>'; 

  echo 'Precio: <input type="number" name="precio" id="precio" value="' . $producto->getPrecio() . '"><br>';

  echo 'Existencia: <input type="number" name="existencia" id="stock" value="' . $producto->getStock() . '"><br>';

  echo 'Descripción: <textarea name="descripcion" id="descripcion">' . $producto->getDescripcion() . '</textarea><br>';

   echo 'Categoría: <select id="categoria" name="categoria">';
  $categorias = $producto->getCategorias();
  foreach ($categorias as $categoria) {
    echo '<option value="' . $categoria . '">' . $categoria . '</option>';
  }
  echo '</select><br>';

 echo'Marca: <select id="marca" name="marca">';
  $marcas = $producto->getMarcas();
  foreach ($marcas as $marca) {
    echo '<option value="' . $marca . '">' . $marca . '</option>';
  }
  echo '</select><br>';

  echo 'Proveedor: <select id="proveedor" name="proveedor">';
  $proveedores = $producto->getProveedores();
  foreach ($proveedores as $proveedor) {
    echo '<option value="' . $proveedor . '">' . $proveedor . '</option>';
  }
  echo '</select><br>';

  
echo '<input type="submit" value="Guardar">';
echo '</form>';