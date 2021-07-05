<?php
  require '../koneksi.php';
  echo '<link rel="stylesheet" href="../../assets/style.css"/>';
  $data = $_GET['data'];
  $query = "SELECT * FROM tb_anggota WHERE deleted_at IS NULL AND nama LIKE '%$data%' ORDER BY created_at DESC";
  $sql = mysqli_query($koneksi,$query);

  echo '<ul class="form-control">';
        while($row = mysqli_fetch_assoc($sql)){
          echo '<li style="list-style-type:none;cursor:pointer;"><a style="text-decoration:none;" href="index.php?pages=transaksi&views=tambah&name='.$row['nama'].'">'.$row['nama'].'</a></li>';
        }
  echo '</ul>';
?>