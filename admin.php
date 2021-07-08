<?php
  session_start();
  include 'app/routesadmin.php';
  if(!isset($_SESSION['isLoginAdmin'])){
    header("Location:login.php?pesan=error_login"); 
    exit;
  }
  main_admin();
?>