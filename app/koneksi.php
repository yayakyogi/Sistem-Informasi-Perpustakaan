<?php 
  // Koneksi ke database
  $host = 'Localhost';
  $username = 'root';
  $password = '';
  $db = 'sim_perpustakaan';
  $koneksi = mysqli_connect($host,$username,$password,$db);
  if(!$koneksi){
    $koneksi = mysqli_connect($host,$username,$password);
    $query = "CREATE DATABASE IF NOT EXISTS $db";
    $sql = mysqli_query($koneksi,$query);
    $koneksi = mysqli_connect($host,$username,$password,$db);
  }

  function GET($key,$val){
    $res = isset($_SESSION[$key]) && $_SESSION[$key] != '' ? $_SESSION[$key] : $val;
    $res = isset($_POST[$key]) && $_POST[$key] != '' ? $_POST[$key] : $res;
    $res = isset($_GET[$key]) && $_GET[$key] != '' ? $_GET[$key] : $res;
    return $res; 
  }
?>