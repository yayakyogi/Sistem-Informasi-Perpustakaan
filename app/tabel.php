<?php
  // Tabel anggota
  function tb_user($koneksi){
    $query = "CREATE TABLE IF NOT EXISTS tb_user(
              id VARCHAR(32) NOT NULL,
              nama VARCHAR(100) NOT NULL,
              jns_klmn VARCHAR(16) NOT NULL,
              almt VARCHAR(255) NOT NULL,
              email  VARCHAR(64) NOT NULL,
              tlpn VARCHAR(32) NOT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              stts VARCHAR(32) NOT NULL DEFAULT 'aktif',
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
            )";
      $sql = mysqli_query($koneksi,$query);
      return $sql;
  }
?>