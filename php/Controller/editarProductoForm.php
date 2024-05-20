<?php

include_once '../Model/productos.php';

if(isset($_POST['id'])){

  $producto = new Producto();
  $producto = $producto->obtenerProductoPorId($_POST['id']);

  echo "ID: " . $producto->getIdProducto() . "<br>";
  echo "Nombre: " . $producto->getNombre() . "<br>";
  echo "Precio: " . $producto->getPrecio() . "<br>";
  echo "Existencia: " . $producto->getStock() . "<br>";
  echo "Descripción: " . $producto->getDescripcion() . "<br>";
  echo "Categoría: " . $producto->getCategoria() . "<br>";
  echo "Marca: " . $producto->getMarca() . "<br>";
  echo "Proveedor: " . $producto->getProveedor() . "<br>";

  echo '<form id="editarProductoForm" method="POST">';

  echo '<p id="id" data-id="' . $producto->getIdProducto() . '"> ID: ' . $producto->getIdProducto() . '</p>';

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
}