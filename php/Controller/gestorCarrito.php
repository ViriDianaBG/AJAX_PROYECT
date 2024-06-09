<?php

include_once '../Model/productos.php';

session_start();
if (!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST["operacion"]))
    {
        if ($_POST["operacion"] == "agregar")
        {
            agregar($_POST["id"]);
        } elseif ($_POST["operacion"] == "eliminar")
        {
            eliminar($_POST["id"]);
        }
    } elseif (isset($_POST["pago"]))
    {
        if ($_POST["pago"] == "efectivo")
        {
            pagarCarritoEfectivo($_SESSION["carrito"]);
        } elseif ($_POST["pago"] == "tarjeta")
        {
            pagarCarritoTarjeta($_SESSION["carrito"]);
        }
    }
}


function agregar($id)
{
    $productoModel = new Producto();
    $producto = $productoModel->obtenerProductoPorId($id);
    $carrito = $_SESSION["carrito"];

    $productoExistente = false;
    foreach ($carrito as &$productoCarrito)
    {
        if ($productoCarrito["ID"] == $producto->getIdProducto())
        {
            if ($productoCarrito["Cantidad"] < $producto->getStock())
            {
                $productoCarrito["Cantidad"] += 1;
            } else
            {
                echo "<div class='alert-alert-warning'>No se puede agregar más de la cantidad disponible en stock.</div>";
            }
            $productoExistente = true;
            break;
        }
    }

    if (!$productoExistente)
    {
        if ($producto->getStock() > 0)
        {
            $carrito[] = [
                "ID" => $producto->getIdProducto(),
                "Nombre" => $producto->getNombre(),
                "Precio" => $producto->getPrecio(),
                "Cantidad" => 1
            ];
        } else
        {
            echo "<div class='alert alert-warning'>No hay stock disponible para este producto.</div>";
        }
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

    $_SESSION["carrito"] = array_values($carrito);
    printCarrito($carrito);
}

function printCarrito($carrito)
{
    echo "<div class='content-main'>";
    echo "<table class='custom-table'>";
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
        echo "<td>{$producto['ID']}</td>";
        echo "<td>{$producto['Nombre']}</td>";
        echo "<td>{$producto['Cantidad']}</td>";
        echo "<td>{$producto['Precio']}</td>";
        echo "<td>" . ($producto['Precio'] * $producto['Cantidad']) . "</td>";
        echo "<td><button class='eliminarProducto' data-id='{$producto['ID']}'>Eliminar</button></td>";
        echo "</tr>";
    }
    echo "</table></div>";

    $total = array_reduce($carrito, function ($carry, $producto) {
        return $carry + ($producto["Precio"] * $producto["Cantidad"]);
    }, 0);

    echo "<div id='total'>TOTAL: {$total}</div>";
    echo "<button class='efectivoBoton'>Pago Efectivo</button>";
    echo "<button id='tarjetaBoton'>Pago Tarjeta</button>";
}
function calcularTotal($carrito)
{
    $total = array_reduce($carrito, function ($carry, $producto) {
        return $carry + ($producto["Precio"] * $producto["Cantidad"]);
    }, 0);
    return $total;
}

function pagarCarritoEfectivo($carrito)
{
    echo "<div class='content-main'>";
    echo "<h2>Ticket de Compra</h2>";
    echo "<table class='custom-table'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Descripción</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Precio Unitario</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    foreach ($carrito as $producto)
    {
        echo "<tr>";
        echo "<td>{$producto['ID']}</td>";
        echo "<td>{$producto['Nombre']}</td>";
        echo "<td>{$producto['Cantidad']}</td>";
        echo "<td>{$producto['Precio']}</td>";
        echo "<td>" . ($producto['Precio'] * $producto['Cantidad']) . "</td>";
        echo "</tr>";
    }
    echo "</table></div>";

    $total = calcularTotal($carrito);
    echo "<h3 id='total' data-value={$total}>TOTAL: {$total}</h3>";
    echo "<label for='efectivo'>Cantidad Pagada en Efectivo:</label>";
    echo "<input type='number' id='efectivo' min=0 name='efectivo'  required>";
    echo "<button id='pagoEfectivo' class='efectivoBoton' value='Pagar en Efectivo'> Pagar </button>";
    echo "<p id='resultado'></p>";
    nuevoCarrito();
}

function pagarCarritoTarjeta($carrito)
{
    echo "<div class='content-main'>";
    echo "<h2>Ticket de Compra</h2>";
    echo "<table class='custom-table'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Descripción</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Precio Unitario</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    foreach ($carrito as $producto)
    {
        echo "<tr>";
        echo "<td>{$producto['ID']}</td>";
        echo "<td>{$producto['Nombre']}</td>";
        echo "<td>{$producto['Cantidad']}</td>";
        echo "<td>{$producto['Precio']}</td>";
        echo "<td>" . ($producto['Precio'] * $producto['Cantidad']) . "</td>";
        echo "</tr>";
    }
    echo "</table></div>";

    $total = calcularTotal($carrito);

    echo "<form id='tarjetaForm'>";
    echo "    <label for='nombreTarjeta'>Nombre en la Tarjeta:</label>";
    echo "    <input type='text' id='nombreTarjeta' name='nombreTarjeta' pattern='^[a-zA-Z ]+$' title='Ingresa solo letras y espacios' required>";
    echo "    <label for='numeroTarjeta'>Número de Tarjeta:</label>";
    echo "    <input type='text' id='numeroTarjeta' name='numeroTarjeta' pattern='[0-9]{16}' title='El número de tarjeta debe contener 16 dígitos' minlength='16' maxlength='16' required>";
    echo "    <label for='fechaVencimiento'>Fecha de Vencimiento (MM/AA):</label>";
    echo "    <input type='text' id='fechaVencimiento' name='fechaVencimiento' pattern='(0[1-9]|1[0-2])\/[0-9]{2}' title='El formato debe ser MM/AA' minlength='5' maxlength='5' required>";
    echo "    <label for='codigoSeguridad'>Código de Seguridad:</label>";
    echo "    <input type='password' id='codigoSeguridad' name='codigoSeguridad' pattern='[0-9]{3,4}' title='El código de seguridad debe contener entre 3 y 4 dígitos numéricos' minlength='3' maxlength='4' required>";
    echo "    <button id='pagoTarjeta' class='tarjetaBoton' type='submit'> Pagar con Tarjeta </button>";
    
    echo "</form>";
    nuevoCarrito();
}

function nuevoCarrito()
{
    echo "<button id='nuevaCompra' class='fill'> Nueva Compra </button>";
    $_SESSION["carrito"] = [];
}