<?php
include '../BaseDatos/conexion.php';

if (isset($_POST['email']) && isset($_POST['contrasenia'])) {
  $email = $_POST['email'];
  $contrasenia = $_POST['contrasenia'];

  $query = "SELECT contrasenia FROM cajeros WHERE email = :email";
  $stmt = $db->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $resultado = $stmt->fetch();

  if ($resultado) {
    $contrasenia_db = $resultado['contrasenia'];

    if ($contrasenia == $contrasenia_db) {
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['estado'] = 'Autenticado';
      $_SESSION['tipo'] = 'cajero';
      echo 200;
    } else {
      echo 401;
    }
  }
}

