<?php
  session_start();
  include 'app/routesuperadmin.php';
  if(!isset($_SESSION['isLoginSuperadmin'])){
    header("Location:login.php?pesan=error_login"); 
    exit;
  }
  main();
?>