<?php
session_start(); 
if(isset($_SESSION['estado'])){
  if($_SESSION['estado'] == 'Autenticado'){
    echo 200;
  }else{
    echo 400;
  }
}