<?php
include_once '../Model/cajero.php';

if (isset($_POST['id'])) {
    $cajero = new Cajero();
    $cajero = $cajero->obtenerCajeroPorId($_POST['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Cajero</title>
<link rel="stylesheet" href="./css/styles.css"> <!-- Asegúrate de ajustar la ruta de tu archivo CSS -->
</head>
<body>

<?php
    echo "<h2>Información actual</h2>";
    echo "<div class='cajero-info'>";
    echo "<h3 id='titulo'>ID:</h3> <p>" . $cajero->getIdCajero() . "</p>";
    echo "<h3 id='titulo'>Nombre:</h3> <p>" . $cajero->getNombre() . "</p>";
    echo "<h3 id='titulo'>Apellido paterno:</h3> <p>" . $cajero->getApellidoPaterno() . "</p>";
    echo "<h3 id='titulo'>Apellido materno:</h3> <p>" . $cajero->getApellidoMaterno() . "</p>";
    echo "<h3 id='titulo'>Email:</h3> <p>" . $cajero->getEmail() . "</p>";
    echo "<h3 id='titulo'>Telefono:</h3> <p>" . $cajero->getTelefono() . "</p>";
    echo "<h3 id='titulo'>Direccion:</h3> <p>" . $cajero->getDireccion() . "</p>";
    echo "</div>";
?>

<form id='editarCajeroForm' method='POST'>
    <p id='id' data-id='<?php echo $cajero->getIdCajero(); ?>'> ID: <?php echo $cajero->getIdCajero(); ?> </p>
    <div class="form-group">
        <label for="nombre" id="titulo">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $cajero->getNombre(); ?>">
    </div>
    <div class="form-group">
        <label for="apellidoPaterno" id="titulo">Apellido Paterno:</label>
        <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="<?php echo $cajero->getApellidoPaterno(); ?>">
    </div>
    <div class="form-group">
        <label for="apellidoMaterno" id="titulo">Apellido Materno:</label>
        <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="<?php echo $cajero->getApellidoMaterno(); ?>">
    </div>
    <div class="form-group">
        <label for="email" id="titulo">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $cajero->getEmail(); ?>">
    </div>
    <div class="form-group">
        <label for="telefono" id="titulo">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="<?php echo $cajero->getTelefono(); ?>">
    </div>
    <div class="form-group">
        <label for="direccion" id="titulo">Dirección:</label>
        <input type="text" name="direccion" id="direccion" value="<?php echo $cajero->getDireccion(); ?>">
    </div>
    <div class="form-group">
        <button type="submit" class="fill">Guardar</button>
        <button id="regresar" class="fill">Regresar</button>
    </div>
    
</form>

</body>
</html>

<?php
}
?>
