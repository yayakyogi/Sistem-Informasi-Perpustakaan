<?php
  require '../koneksi.php';
  $id = $_GET['id'];
  $status = "Dikembalikan";
  $query = "UPDATE tb_transaksi SET status='$status' WHERE id='$id'";
  $sql = mysqli_query($koneksi,$query);
  if(!$sql) echo mysqli_error($koneksi);
?>