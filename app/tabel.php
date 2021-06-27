<?php
  // Tabel anggota
   function tb_admin($koneksi)
  {
    $query = "CREATE TABLE IF NOT EXISTS tb_admin(
              id VARCHAR(32) NOT NULL,
              nama VARCHAR(100) NOT NULL,
              jenis_kelamin VARCHAR(16) NOT NULL,
              alamat VARCHAR(255) NOT NULL,
              email  VARCHAR(64) NOT NULL,
              telepon VARCHAR(32) NOT NULL,
              password VARCHAR(32) NOT NULL,
              roles VARCHAR(32) NOT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
            )";
      $sql = mysqli_query($koneksi,$query);
      return $sql;
  }
  
  function tb_user($koneksi)
  {
    $query = "CREATE TABLE IF NOT EXISTS tb_user(
              id VARCHAR(32) NOT NULL,
              nama VARCHAR(100) NOT NULL,
              jenis_kelamin VARCHAR(16) NOT NULL,
              alamat VARCHAR(255) NOT NULL,
              email  VARCHAR(64) NOT NULL,
              telepon VARCHAR(32) NOT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
            )";
      $sql = mysqli_query($koneksi,$query);
      return $sql;
  }

  function tb_tranksaksi($koneksi)
  {
    $query = "CREATE TABLE IF NOT EXISTS tb_transaksi(
              id INT(20) NOT NULL,
              anggota_id VARCHAR(32) NOT NULL,
              buku_id INT(20) NOT NULL,
              tanggal_pinjam DATETIME NOT NULL,
              tanggal_kembali DATETIME NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
            )";
      $sql = mysqli_query($koneksi,$query);
      return $sql;
  }
  function tb_buku($koneksi)
  {
    $query = "CREATE TABLE IF NOT EXISTS tb_buku(
              id INT(20) NOT NULL,
              judul_buku VARCHAR(255) NOT NULL,
              deskripsi TEXT NOT NULL;
              kategori_id INT(20) NOT NULL,
              cover VARCHAR(100) NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
              )";
        $sql = mysqli_query($koneksi,$query);
        return $sql;
  }
  function tb_kategori($koneksi)
  {
    $query = "CREATE TABLE IF NOT EXISTS tb_kategori(
              id INT(20) NOT NULL,
              kategori VARCHAR(255) NOT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
              )";
        $sql = mysqli_query($koneksi,$query);
        return $sql;
  }
?>