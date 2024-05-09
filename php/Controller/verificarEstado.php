<?php

session_start(); 

if(isset($_SESSION['estado'])){
  if($_SESSION['estado'] == 'Autenticado' && $_SESSION['tipo'] == 'cajero'){
      echo 200; // SI LA SESSION ESTA ACTIVA Y ES CAJERO
  }else if ($_SESSION['estado'] == 'Autenticado' && $_SESSION['tipo'] == 'admin'){
      echo 201; // SI LA SESSION ESTA ACTIVA Y ES ADMIN
  }else{
    echo 400;
  }
}

?>