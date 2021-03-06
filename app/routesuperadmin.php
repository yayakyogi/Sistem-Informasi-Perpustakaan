<?php 
  include 'koneksi.php';
  include 'template.php';
  include 'tabel.php';
  include 'view_superadmin.php';
  
  $page = GET('pages','dashboard');
  $view = GET('views','index');

  function halaman(){
    global $page;
    if($page == 'dashboard') dashboard();
    if($page == 'buku') buku();
    if($page == 'transaksi') transaksi();
    if($page == 'anggota') anggota();
    if($page == 'profileAdmin') profileAdmin();
    if($page == 'admin') admin();
    if($page == 'developer') aboutme();
  }

  function main(){
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
      halaman();
    echo '</div>';
    echo '</div>';
    layoutFooter();
  }
?>