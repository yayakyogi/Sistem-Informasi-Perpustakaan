<?php
  session_start();
  include 'app/routesadmin.php';
  if(!isset($_SESSION['isLoginAdmin'])){
    echo "<script>window.location='login.php'</script>";
    exit;
  }
  main_admin();
?>