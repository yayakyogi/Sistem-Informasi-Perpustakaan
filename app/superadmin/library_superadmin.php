<?php 
// function cek email
  function cek_email($email)
  {
    global $koneksi;
    $query = "SELECT * FROM tb_admin WHERE email = '$email'";
    $sql = mysqli_query($koneksi,$query);
    if($sql)
      return mysqli_num_rows($sql);
    else 
      return null;
  }
  // function untuk menghindari sql injection
  function escape($data)
  {
    global $koneksi;
    return mysqli_real_escape_string($koneksi,$data);
  }
  // function hash password
  function passwordHash($data)
  {
    $hash = password_hash($data,PASSWORD_DEFAULT);
    return $hash;
  }
?>