<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <h1>List-to!</h1>

    <div class="contenedorPuntoVenta" id="contenedorPuntoVenta">
        <!-- cabecera y busqueda -->
        <div class="sidebar">
            <h2>Venta</h2>
            <div class="busqueda" id="busqueda">
                <input type="text" id="buscador" placeholder="Buscar producto">
            </div>
            <div class="productosCarrito" id="listaProductos">
                <h2>Lista de Productos</h2>
                <!-- Aquí irán los productos añadidos al carrito -->
            </div>
        </div>

        <!-- contenido -->
        <div class="carrito" id="carrito">
            <!-- Aquí irán los productos añadidos al carrito -->
        </div>

        <div class="buttons">
            
            <button id="cerrarSesion">Cerrar</button>
            
        </div>
    </div>
</body>

</html>
