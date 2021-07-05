<?php 
session_start();
include 'app/koneksi.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key']))
{
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // cari user berdasarkan id
  $query = "SELECT email,roles FROM tb_admin WHERE id = '$id'";
  $sql = mysqli_query($koneksi,$query);
  $row = mysqli_fetch_assoc($sql);
  
  // cek email dan key
  if($key === hash('sha256',$row['email']))
  {
    if($row['roles'] == 'superadmin')
    {
        $_SESSION['isLoginSuperadmin']=true;
        $_SESSION['email']=$row['email'];
    }
    else if($row['roles'] == 'admin')
    {
        $_SESSION['isLoginAdmin']=true;
        $_SESSION['email']=$row['email'];
    }
  }
}

// cek apakah session login masih ada atau tidak
if(isset($_SESSION['isLoginSuperadmin']))
{
  header("Location:app/superadmin/index.php");
  exit;
}
if(isset($_SESSION['isLoginAdmin']))
{
  header("Location:index.php");
  exit;
}

// cek error ketika belum login
if(isset($_GET['pesan']))
{
  if($_GET['pesan'] == 'error_login')
  {
    echo "Anda belum login, silahkan login terlebih dahulu";
  }
}

// cek apakah tombol login sudah diklik atau belum
if(isset($_POST['submit']))
{
  $mail = GET('email','');
  $pass = GET('password','');

  $query = "SELECT * FROM tb_admin WHERE email='$mail'";
  $result = mysqli_query($koneksi,$query);
  
  if(mysqli_num_rows($result))
  {
    // ambil data user
    $row = mysqli_fetch_assoc($result);
    // cek papssword
    if(password_verify($pass,$row['password']))
    {  
    // cek roles
      if($row['roles'] == 'superadmin')
      {
        // cek tombol checkbox
        if(isset($_POST['rememberme']))
        {
          // menset cookie agar bisa auto login setelah keluar browser
          setcookie('id',$row['id'],time()+60);
          setcookie('key',hash('sha256',$row['email'],time()+60));
        }
        // buat session
        $_SESSION['isLoginSuperadmin']=true;
        $_SESSION['email']=$row['email'];
        header("Location:app/superadmin/index.php"); 
      }
      else
      {
        if(isset($_POST['rememberme']))
        {
          // menset cookie agar bisa auto login setelah keluar browser
          setcookie('id',$row['id'],time()+60);
          setcookie('key',hash('sha256',$row['email'],time()+60));
        }
        // jika yang login admin
        $_SESSION['isLoginAdmin']=true;
        $_SESSION['email']=$row['email'];
        header("Location:index.php");
      }
    }
    else
      echo "Password salah silahkan ulangi lagi";
  }
  else
    echo "Email tidak terdaftar";
}

echo '<!DOCTYPE html>
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <link rel="shortcut icon" href=”assets/icons/books.png”>
        <title>SIMP</title>
      </head>
      <body>
        <div class="login">
          <div class="content-login">
            <div class="content-left">
              <h5>Selamat Datang</h5>
              <span>Login untuk melanjutkan</span>
              <img class="img-login" src="assets/icons/books.png" alt="img-login">
            </div>
            <div class="content-right">
              <h3>SIMP</h3>
              <span>Sistem Informasi Manajemen Perpustakaan</span>
              <form name="form-login" action="" method="POST">
                <div class="form-group">
                  <label class="lb-login" for="username">Username</label><br>
                  <input type="text" autocomplete="off" class="inp-login" name="email" placeholder="Username">
                </div>
                <div class="form-group">
                  <label class="lb-login" for="password">Password</label><br>
                  <input type="password" class="inp-login" name="password" placeholder="Password">
                </div>
                <div class="from-group cbk">
                  <input type="checkbox" name="rememberme" id="remember"><label for="remember" class="rmb">Remember me</label>
                </div>
                <button type="submit" name="submit" class="btn-login btn-md">Login</button>
              </form> 
            </div><!-- ./content-right -->
          </div><!-- ./content-login -->
          <p class="cprght">Copyright &copy; Yayak Yogi 2021 - All Rights Reserved</p>
          <img class="wave-login" src="assets/img/wave-login.svg" alt="wave-login">
        </div><!-- ./login -->
      </body>
      </html>
';
?>