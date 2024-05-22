<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Agregar Cajero</title>
<link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<?php
include_once '../Model/cajero.php';
$cajero = new Cajero();
$cajero->setIdCajero(0);
?>
  <form id="agregarCajeroForm" method="POST">
  <div class="form-group">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $cajero->getNombre(); ?>" data-id="{$cajero->getIdCajero()}" required>
  </div>

  <div class="form-group">
    <label for="apellido">Apellido paterno:</label>
    <input type="text" name="apellido" id="apellidoPaterno" value="<?php echo $cajero->getApellidoPaterno(); ?>" required>
  </div>

  <div class="form-group">
    <label for="apellido">Apellido materno:</label>
    <input type="text" name="apellido" id="apellidoMaterno" value="<?php echo $cajero->getApellidoMaterno(); ?>" required>
  </div>

  <div class="form-group">
    <label for="telefono">Telefono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $cajero->getTelefono(); ?>" required>
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $cajero->getEmail(); ?>" required>
  </div>

  <div class="form-group">
    <label for="contrasenia">Contraseña:</label>
    <input type="text" name="contrasenia" id="contrasenia" value="<?php echo $cajero->getContrasenia(); ?>" required>
  </div>

  <div class="form-group">
    <label for="direccion">Direccion:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo $cajero->getDireccion(); ?>" required>
  </div>

  <div class="form-group">
    <button type="submit" class="fill" value="Guardar">Guardar</button>
    <button id="regresar" class="fill">Regresar</button>
  </div>
</form>
</body>
</html>
