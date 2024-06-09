<?php

include_once '../Model/productos.php';

if(isset($_POST['id'])){

  $producto = new Producto();
  $producto = $producto->obtenerProductoPorId($_POST['id']);
  echo "<h2>Información actual</h2>";
  echo "<div class='cajero-info'>";
  echo "<h3 id='titulo'>ID:</h3> <p>" . $producto->getIdProducto() . "</p>";
  echo "<h3 id='titulo'>Nombre:</h3> <p> " . $producto->getNombre() . "</p>";
  echo "<h3 id='titulo'>Precio:</h3> <p> " . $producto->getPrecio() . "</p>";
  echo "<h3 id='titulo'>Stock:</h3> <p> " . $producto->getStock() . "</p>";
  echo "<h3 id='titulo'>Descripción:</h3> <p> " . $producto->getDescripcion() . "</p>";
  echo "<h3 id='titulo'>Categoría:</h3> <p>" . $producto->getCategoria() . "</p>";
  echo "<h3 id='titulo'>Marca:</h3> <p> " . $producto->getMarca() . "<br>";
  echo "<h3 id='titulo'>Proveedor:</h3> <p>" . $producto->getProveedor() . "</p>";
  echo "</div>";

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