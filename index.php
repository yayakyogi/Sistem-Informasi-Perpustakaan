<?php
  session_start();
  include 'app/routeadmin.php';
  if(!isset($_SESSION['isLoginAdmin'])){
    header("Location:login.php?pesan=error_login"); 
    exit;
  }
  main();
?>