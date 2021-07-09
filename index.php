<?php
  session_start();
  include 'app/routesuperadmin.php';
  if(!isset($_SESSION['isLoginSuperadmin'])){
      echo "<script>window.location='login.php'</script>";
    exit;
  }
  main();
?>