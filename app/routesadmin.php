<?php 
  include 'koneksi.php';
  include 'template.php';
  include 'tabel.php';
  include 'view_admin.php';
  
  $page = GET('pages','dashboard');
  $view = GET('views','index');

  function halaman_admin(){
    global $page;
    if($page == 'dashboard') dashboard();
    if($page == 'buku') buku();
    if($page == 'transaksi') transaksi();
    if($page == 'anggota') anggota();
    if($page == 'profileAdmin') profileAdmin();
    if($page == 'developer') aboutme();
  }

  function main_admin(){
    global $page;
    global $view;
    $nama = $_SESSION['email'];
    $photo = $_SESSION['photo'];
    layoutHeader();
    layoutSidebar($nama,$photo);
    layoutNavbar();
    echo '<div class="main-content">';
    echo '<div class="breadcrumb">';
    echo '<span><a href="?pages='.$page.'&views=index">'.$page.'</a> &#10095; <span>'.$view.'</span></span>';
    echo '</div>';
    echo '<div class="content">';
      halaman_admin();
    echo '</div>';
    echo '</div>';
    layoutFooter();
  }
?>