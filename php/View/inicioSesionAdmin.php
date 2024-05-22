<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="./css/styles.css">
  </head>

  <body>
     <div class="contenedorInicioSesion">
    <h1>Bienvenido Administrador</h1>
    <h2>Inicio sesión</h2>
    <form method="POST" id="inicioSesionForm">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="contrasenia" name="password" required>
      </div>
      <input type="submit" value="Login">
    </form>
  </div>
  </body>
    

</html>