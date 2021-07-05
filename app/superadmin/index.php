<?php
  session_start();
  include '../koneksi.php';

  if(!isset($_SESSION['isLoginSuperadmin']))
  {
    header("Location:../../login.php?pesan=error_login");
    exit;
  }
  if(isset($_GET['pesan']))
  {
    if($_GET['pesan'] == 'error_pass')
    {
      echo "Password kurang dari 8";
    }
    if($_GET['pesan'] == 'error_save')
    {
      echo "Gagal menyimpan data";
    }
    if($_GET['pesan'] == 'error_mail')
    {
      echo "Email sudah pernah terdaftar sebelumnya";
    }
  }
$pages = 'admin';

echo '<div class="wrapper">
    <a href="?pages='.$pages.'&views=tambah" class="btn-success btn-md">&#10010; Tambah Anggota</a>
    <a href="?pages='.$pages.'&views=temporary" class="btn-danger btn-md">&#10008; Data Terhapus</a>
    <div class="table-responsive">
      <table border="1">
        <tr>
          <th>&#8470;</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>Email</th>
          <th>No Telepon</th>
          <th>Roles</th>
          <th>Ditambahkan</th>
          <th>Aksi</th>
        </tr>';
      $query = "SELECT * FROM tb_admin WHERE deleted_at IS NULL ORDER BY created_at DESC";
      $sql = mysqli_query($koneksi,$query);
      $count = mysqli_num_rows($sql);
      $i=1;
      while($row = mysqli_fetch_assoc($sql))
      {
        echo '<tr>';
        echo '<td>'.$i++.'</td>';
        echo '<td>'.$row['nama'].'</td>';
        echo '<td>'.$row['jenis_kelamin'].'</td>';
        echo '<td>'.$row['alamat'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        echo '<td>'.$row['telepon'].'</td>';
        echo '<td>'.$row['roles'].'</td>';
        echo '<td>'.date("d M Y, G:i", strtotime($row['created_at'])).' WIB </td>';
        echo '<td>
                <a href="?pages='.$pages.'&views=edit&id='.$row['id'].'" class="btn-warning btn-sm">&#9998;</a>
                <a href="?pages='.$pages.'&views=hapus&id='.$row['id'].'" class="btn-danger btn-sm">&#10008;</a>
              </td>';
        echo '</tr>';
      }
      if($count<=0){
        echo '<tr><td colspan="8">Data kosong</td></tr>';
      }
  echo '</table>
      </div><!-- ./table-responsive -->
    <span class="data-count">'.$count.' Data ditemukan</span>
  </div><!-- ./wrapper -->
';
  echo '<br><br>';
  echo '<form name="formtambahBuku" action="tambah_user.php" method="POST">
        <input type="hidden" name="exec" value="'.time().'">';
        echo '<div class="form-group">
                <label for="nama">Nama Admin</label><br>
                <input type="text" name="nama" placeholder="Nama admin" id="nama" class="form-control" required>
              </div>';
        echo '<div class="form-group">
                <label for="jk">Jenis Kelamin</label><br>
                <input type="radio" name="jenis_kelamin" value="Laki-laki" style="margin:10px 0"> <span class="value-radio">Laki-laki</span>
                <input type="radio" name="jenis_kelamin" value="Perempuan" style="margin:10px 0 10px 5px;"> <span class="value-radio">Perempuan</span>
              </div>';
        echo '<div class="form-group">
                <label for="deskripsi">Alamat</label><br>
                <textarea name="alamat" placeholder="Alamat anggota" class="form-control"></textarea>
              </div>';
        echo '<div class="form-group">
                <label for="email">Email</label><br>
                <input type="email" name="email" class="form-control" placeholder="Email anggota">
              </div>';
        echo '<div class="form-group">
                <label for="password">Password</label><br>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>';
        echo '<div class="form-group">
                <label for="no_telp">No Telepon / Handphone</label><br>
                <input type="text" name="telepon" class="form-control" placeholder="No Telepon / Handphone">
              </div>';
        echo '<div class="form-group">
                <label for="roles">Roles</label><br>
                <select name="roles">
                  <option value="admin">Admin</option>
                  <option value="superadmin">Super Admin</option>
                </select>
              </div>';
              echo '<br>';
        echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
          </form>
    ';
    echo '<a href="../logout.php">Logout</a>';
?>