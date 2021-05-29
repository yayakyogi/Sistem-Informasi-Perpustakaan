<?php
  function dashboard(){
    echo '<div class="menu-dashboard">
    <!-- DAFTAR BUKU -->
    <div class="card" style="border-top: 3px solid #5cb85c;">
      <div class="card-body card-dashboard">
        <div class="konten">
          <p class="card-title">Data Buku</p>
          <p class="jml-data">Jumlah</p>
          <span class="tot">100</span>
        </div>
        <div class="kontent-img">
          <img class="card-img" src="assets/icons/contact-list.png">
        </div>
      </div> <!-- ./card-body -->
    </div> <!-- ./card-->
    <!-- AKHIR DAFTAR BUKU -->

    <!-- DAFTAR TRANSAKSI -->
    <div class="card" style="border-top: 3px solid #5bc0de;" >
      <div class="card-body card-dashboard">
        <div class="konten">
          <p class="card-title">Data Transaksi</p>
          <p class="jml-data">Jumlah</p>
          <span class="tot">5</span>
        </div>
        <div class="kontent-img">
          <img class="card-img" src="assets/icons/transaction-history.png">
        </div>
      </div> <!-- ./card-body -->
    </div> <!-- ./card -->
    <!-- AKHIR DAFTAR TRANSAKSI -->

    <!-- DAFTAR ANGGOTA -->
    <div class="card" style="border-top:3px solid #337ab7;">
      <div class="card-body card-dashboard">
        <div class="konten">
          <p class="card-title">Data Anggota</p>
          <p class="jml-data">Jumlah</p>
          <span class="tot">10</span>
        </div>
        <div class="kontent-img">
          <img class="card-img" src="assets/icons/group.png">
        </div>
      </div> <!-- ./card-body -->
    </div> <!-- ./card -->
    <!-- AKHIR DAFTAR ANGGOTA -->
  </div> <!-- ./menu-content -->';
  }
?>