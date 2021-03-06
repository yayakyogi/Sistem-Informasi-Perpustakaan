<?php 
function layoutHeader(){
  echo '<!DOCTYPE HTML>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="assets/style.css">
            <link rel=”icon” href=”assets/icons/books.png”>
            <title>SI-Perpustakaan</title>
        </head>
        <body>
        <div class="container">';
}

// fungsi sidebar
function layoutSidebar($nama,$photo){
  $page = GET('pages','');
  if(!isset($_GET['pages']) && !isset($_GET['views'])) {
      $page = 'dashboard';
  }
  echo '<!-- Sidebar -->
        <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">
            <span>HALAMAN '.$page.'</span>
            <span class="sidebar-close">&times;</span>
            </div>
            <div class="sidebar-akun">
              <img src="assets/profile_admin/'.$photo.'" class="img-sidebarakun" alt="img-sidebar">
              <div class="sidebar-user">
                <p>'.$nama.'</p>
                <a href="?pages=profileAdmin&views=index"><img src="assets/icons/search.png" alt="img-search"></a>
              </div>
            </div>
        </div>
        <div class="sidebar-body">
            <a href="?pages=dashboard&views=index"><img src="assets/icons/dashboard.png" alt="dashboard">Dashboard</a>
            <a href="?pages=buku&views=index"><img src="assets/icons/contact-list.png" alt="contact">Data Buku</a>
            <a href="?pages=transaksi&views=index"><img src="assets/icons/transaction-history.png" alt="transaction">Data Transaksi</a>
            <a href="?pages=anggota&views=index"><img src="assets/icons/group.png" alt="group">Data Anggota</a>';
            if(isset($_SESSION['isLoginSuperadmin']))
              echo '<a href="?pages=admin&views=index"><img src="assets/icons/admin.png" alt="group">Data Admin</a>';  
            echo '<a href="?pages=developer&views=index"><img src="assets/icons/card.png" alt="group">Developer</a>';  
            echo '<a href="app/logout.php"><img src="assets/icons/logout.png" class="img-logout">Logout</a>
        </div>
    </div>
  ';
}

// fungsi navbar
function layoutNavbar(){
echo '<div class="main">
        <div class="navbar">
          <span class="dsbrd-title">Sistem Informasi Perpustakaan</span>
          <p class="nav-footer">Copyright &copy; Yayak Yogi - 2021 All Rights Reserved</p>
          <button class="humberger-button"><img src="assets/icons/square-light.svg"></button>
        </div>
      ';
}

// fungsi footer
function layoutFooter(){
      echo '<p class="footer">Copyright &copy; KuliKode - 2021 All Right Reserved</p>
          </div><!-- ./main -->
        </div> <!--./container-->
      <script src="assets/script.js"></script>
      <script src="app/ajax/status.js"></script>
    </body>
  </html>
';
}
?>