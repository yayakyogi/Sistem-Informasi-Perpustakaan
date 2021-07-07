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
              photos VARCHAR(255) NOT NULL,
              created_at DATETIME NOT NULL,
              updated_at DATETIME NOT NULL,
              deleted_at DATETIME NULL,
              PRIMARY KEY(id)
            )";
      $sql = mysqli_query($koneksi,$query);
      return $sql;
  }
  
  function tb_anggota($koneksi)
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
              id VARCHAR(32) NOT NULL,
              anggota VARCHAR(255) NOT NULL,
              buku VARCHAR (255) NOT NULL,
              tanggal_pinjam VARCHAR (200),
              tanggal_kembali VARCHAR (200),
              status VARCHAR(200);
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