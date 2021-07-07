<?php
  include '../koneksi.php';
  include 'library_superadmin.php';

  $nama = escape(GET('nama',''));
  $jnkl = escape(GET('jenis_kelamin',''));
  $almt = escape(GET('alamat',''));
  $mail = escape(GET('email',''));
  $pass = escape(GET('password',''));
  $telp = escape(GET('telepon',''));
  $role = escape(GET('roles',''));
  $id   = md5(time().$mail);
  
  // cek panjang password
  if(strlen($pass)<8) header("Location:index.php?pesan=error_pass");
  // cek email apakah pernah terdaftar sebelumnya
  if(cek_email($mail) == 0)
  {
    // enkripsi password
    $hash = passwordHash($pass);
    // simpan data kedalam database
    $query = "INSERT INTO tb_admin (id,nama,jenis_kelamin,alamat,email,telepon,password,roles,created_at,updated_at) VALUES ('$id','$nama','$jnkl','$almt','$mail','$telp','$hash','$role',NOW(),NOW());";
    $sql = mysqli_query($koneksi,$query);

    if($sql)
    {
      $admin = "SELECT * FROM tb_admin WHERE email = '$mail'";
      $result = mysqli_query($koneksi,$admin);
      $newadmin = mysqli_fetch_assoc($result);
      echo 'nama'.$newadmin['nama'];
    }
    else
    {
      echo 'Error :'.mysqli_errno($koneksi).' + '.mysqli_error($koneksi);
      //  header("Location:index.php?pesan=error_save");
      // exit;
    }
  }
  else {
    header("Location:index.php?pesan=error_mail");
    exit;
  }

  // 
  function register_user($name,$jnkl,$almt,$mail,$pass,$telp,$role)
  {
    global $koneksi;
   
    echo $name;
    echo $jnkl;
    echo $almt;
    echo $mail;
    echo $pass;
    echo $telp;
    echo $role;
    echo 'id'.$id   = md5(time().$mail);
    // cek panjang password
    if(strlen($pass)<8)
    {
      $error = "Jumlah password kurang dari 8";
      return $error;
      exit;
    }
    
  }

  
?>