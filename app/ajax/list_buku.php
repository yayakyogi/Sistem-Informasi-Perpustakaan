<?php
  require '../koneksi.php';
  echo '<link rel="stylesheet" href="../../assets/style.css"/>';
  $data = $_GET['data'];
  $query = "SELECT * FROM tb_buku WHERE deleted_at IS NULL AND judul_buku LIKE '%$data%' ORDER BY created_at DESC";
  $sql = mysqli_query($koneksi,$query);

  echo '<ul class="form-control">';
        while($row = mysqli_fetch_assoc($sql)){
          echo '<li style="list-style-type:none;cursor:pointer;"><a style="text-decoration:none;" href="index.php?pages=transaksi&views=tambah&book='.$row['judul_buku'].'">'.$row['judul_buku'].'</a></li>';
        }
  echo '</ul>';
?>