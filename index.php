<?php
  session_start();
  include 'app/library_admin.php';
  if(!isset($_SESSION['isLoginAdmin'])){
    header("Location:login.php"); 
    exit;
  }
  main();
?>