<?php
include_once '../Model/productos.php';

session_start();
if (!isset($_SESSION["carrito"]))
{
  $_SESSION["carrito"] = [];
}

if (isset($_POST["operacion"]) && $_POST["operacion"] == "agregar")
{
  agregar($_POST["id"]);
} else if (isset($_POST["operacion"]) && $_POST["operacion"] == "eliminar")
{
  eliminar($_POST["id"]);
}

function agregar($id)
{
  $producto = new Producto();
  $producto = $producto->obtenerProductoPorId($id); // Asignar el resultado a $producto
  $carrito = $_SESSION["carrito"];

  $productoExistente = false;
  foreach ($carrito as &$productoCarrito)
  {
    if ($productoCarrito["ID"] == $producto->getIdProducto())
    {
      $productoCarrito["Cantidad"] += 1;
      $productoExistente = true;
      break;
    }
  }

  if (!$productoExistente)
  {
    array_push($carrito, [
      "ID" => $producto->getIdProducto(),
      "Nombre" => $producto->getNombre(),
      "Precio" => $producto->getPrecio(),
      "Cantidad" => 1
    ]);
  }

  $_SESSION["carrito"] = $carrito;
  printCarrito($carrito);
}


function eliminar($id)
{
  $carrito = $_SESSION["carrito"];

  foreach ($carrito as $key => &$productoCarrito)
  {
    if ($productoCarrito["ID"] == $id)
    {
      if ($productoCarrito["Cantidad"] > 1)
      {
        $productoCarrito["Cantidad"] -= 1;
      } else
      {
        unset($carrito[$key]);
      }
      break;
    }
  }

  $_SESSION["carrito"] = $carrito;
  printCarrito($carrito);
}

function printCarrito($carrito)
{
  echo "<table>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Descripción</th>";
  echo "<th>Cantidad</th>";
  echo "<th>Precio Unitario</th>";
  echo "<th>Total</th>";
  echo "<th>Acciones</th>";
  echo "</tr>";

  foreach ($carrito as $producto)
  {
    echo "<tr>";
    echo "<td>" . $producto["ID"] . "</td>";
    echo "<td>" . $producto["Nombre"] . "</td>";
    echo "<td>" . $producto["Cantidad"] . "</td>";
    echo "<td>" . $producto["Precio"] . "</td>";
    echo "<td>" . ($producto["Precio"] * $producto["Cantidad"]) . "</td>";
    echo "<td><button class='eliminarProducto' data-id='" . $producto["ID"] . "'>Eliminar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
  $total = 0;
  foreach ($carrito as $producto)
  {
    $total += $producto["Precio"] * $producto["Cantidad"];
  }
  echo "<div id='total'>TOTAL: " . $total . "</div>";
}
?>