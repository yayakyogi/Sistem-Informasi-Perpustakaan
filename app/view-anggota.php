<?php
/*
  ============================================================================================= 
  ##### HALAMAN DATA ANGGOTA ####
  ==============================================================================================
*/
  function anggota(){
    global $koneksi;
    $pages = GET('pages','');
    $views = GET('views','');

  if($pages == "anggota"){
    // buat tabel baru jika belum ada
    tb_user($koneksi);

    // tangkap variabel dari form
    $exec = htmlspecialchars(GET('exec',''));
    $nama = htmlspecialchars(GET('nama',''));
    $jns_klmn = htmlspecialchars(GET('jns_klmn',''));
    $almt = htmlspecialchars(GET('almt',''));
    $email = htmlspecialchars(GET('email',''));
    $tlpn = htmlspecialchars(GET('tlpn',''));

    // views index pages anggota
    if($views == "index"){
      echo '<div class="wrapper">
            <a href="?pages='.$pages.'&views=tambah" class="btn-success btn-md">&#10010; Tambah Anggota</a>
            <a href="?pages='.$pages.'&views=temporary" class="btn-danger btn-md">&#10008; Data Terhapus</a>
            <div class="table-responsive">
              <table>
                <tr>
                  <th>&#8470;</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>No Telepon</th>
                  <th>Ditambahkan</th>
                  <th>Aksi</th>
                </tr>';
              $query = "SELECT * FROM tb_user WHERE stts='aktif' ORDER BY created_at DESC";
              $sql = mysqli_query($koneksi,$query);
              $count = mysqli_num_rows($sql);
              $i=1;
              while($row = mysqli_fetch_assoc($sql))
              {
                echo '<tr>';
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row['nama'].'</td>';
                echo '<td>'.$row['jns_klmn'].'</td>';
                echo '<td>'.$row['almt'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['tlpn'].'</td>';
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
      }
      // end views index pages anggota

      // views tambah pages anggota
      if($views == "tambah"){
        // Cek apakah ada variabel dari form yang masih kosong
        if($exec!='' && $nama!='' && $jns_klmn!='' && $almt!='' && $email!='' && $tlpn!=''){
          $id = md5(time());
          $query = "INSERT INTO tb_user  VALUES ('$id','$nama','$jns_klmn','$almt','$email','$tlpn',NOW(),NOW(),DEFAULT,NULL)";
          $sql = mysqli_query($koneksi,$query);
          if($sql){
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Tambah Anggota</legend>
              <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                <input type="hidden" name="exec" value="'.time().'">';
                echo '<div class="form-group">
                        <label for="nama">Nama Anggota</label><br>
                        <input type="text" name="nama" placeholder="Nama anggota" id="nama" class="form-control" required>
                      </div>';
                echo '<div class="form-group">
                        <label for="jk">Jenis Kelamin</label><br>
                        <input type="radio" name="jns_klmn" value="Laki-laki" style="margin:10px 0"> <span class="value-radio">Laki-laki</span>
                        <input type="radio" name="jns_klmn" value="Perempuan" style="margin:10px 0 10px 5px;"> <span class="value-radio">Perempuan</span>
                      </div>';
                echo '<div class="form-group">
                        <label for="deskripsi">Alamat</label><br>
                        <textarea name="almt" placeholder="Alamat anggota" class="form-control"></textarea>
                      </div>';
                echo '<div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" class="form-control" placeholder="Email anggota">
                      </div>';
                echo '<div class="form-group">
                        <label for="no_telp">No Telepon / Handphone</label><br>
                        <input type="text" name="tlpn" class="form-control" placeholder="No Telepon / Handphone">
                      </div>';
                echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
            ';
      }
      // end views tambah pages anggota
      
      // views edit pages angota
      if($views == "edit"){
        $id = GET('id','');
        $exec = GET('exec','');

        if($exec!='' && $nama!='' && $jns_klmn!='' && $almt!='' && $email!='' && $tlpn!=''){
          $query = "UPDATE tb_user SET nama='$nama',jns_klmn='$jns_klmn',almt='$almt',email='$email',tlpn='$tlpn',updated_at=NOW() WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0){
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_user WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);

        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Edit Data</legend>
                <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="nama">Nama Anggota</label><br>
                          <input type="text" name="nama" placeholder="Nama anggota" id="nama" class="form-control" required value="'.$row['nama'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="jk">Jenis Kelamin</label><br>';
                          echo '<input type="radio" name="jns_klmn" value="Laki-laki" style="margin:10px 0"'; if($row['jns_klmn'] == 'Laki-laki') echo "checked" ; echo'> <span class="value-radio">Laki-laki</span>';
                          echo '<input type="radio" name="jns_klmn" value="Perempuan" style="margin:10px 0 10px 5px;"'; if($row["jns_klmn"] == "Perempuan") echo "checked"; echo'> <span class="value-radio">Perempuan</span>
                        </div>';
                  echo '<div class="form-group">
                          <label for="deskripsi">Alamat</label><br>
                          <textarea name="almt" placeholder="Alamat anggota" class="form-control">'.$row['almt'].'</textarea>
                        </div>';
                  echo '<div class="form-group">
                          <label for="email">Email</label><br>
                          <input type="email" name="email" class="form-control" placeholder="Email anggota" value="'.$row['email'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="no_telp">No Telepon / Handphone</label><br>
                          <input type="text" name="tlpn" class="form-control" placeholder="No Telepon / Handphone" value="'.$row['tlpn'].'">
                        </div>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
      }
      // end views edit pages anggota

      // views hapus sementara pages anggota
      if($views == "hapus"){
        $id = GET('id','');
        $exec = GET('exec','');
        if($exec!='' && $id!=''){
          $query = "UPDATE tb_user SET deleted_at = NOW(), stts = 'deleted' WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0){
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_user WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Hapus Data</legend>
                <div class="alert-danger">Apakah anda yakin ingin menghapus data <span>'.$row['nama'].'</span>?</div>
                  <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                    <input type="hidden" name="exec" value="'.time().'">
                    <input type="hidden" name="id" value="'.$row['id'].'">
                    <button type="submit" class="btn-danger btn-md">Hapus</button>
                    <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
        ';
      }
      // end views hapus sementara pages anggota
      
      // views temporary pages anggota
      if($views == "temporary"){
      echo '<div class="wrapper">
              <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">&#8678;</a>
              <a href="?pages='.$pages.'&views=restore" class="btn-warning btn-md">&#9851; Kembalikan Semua</a>
              <a href="?pages='.$pages.'&views=deleteall" class="btn-danger btn-md">&#10008; Hapus Semua</a>
              <div class="table-responsive">
                  <table>
                    <tr>
                      <th>&#8470;</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>No Telepon</th>
                      <th>Dihapus</th>
                      <th>Aksi</th>
                    </tr>';
                  $query = "SELECT * FROM tb_user WHERE stts = 'deleted' ORDER BY deleted_at DESC";
                  $sql = mysqli_query($koneksi,$query);
                  $count = mysqli_num_rows($sql);
                  $i=1;
                  while($row = mysqli_fetch_assoc($sql))
                  {
                    echo '<tr>';
                    echo '<td>'.$i++.'</td>';
                    echo '<td>'.$row['nama'].'</td>';
                    echo '<td>'.$row['jns_klmn'].'</td>';
                    echo '<td>'.$row['almt'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['tlpn'].'</td>';
                    echo '<td>'.$row['deleted_at'].'</td>';
                    echo '<td>
                            <a href="?pages='.$pages.'&views=restoreid&id='.$row['id'].'" class="btn-warning btn-sm">&#10226;</a>
                            <a href="?pages='.$pages.'&views=deleteid&id='.$row['id'].'" class="btn-danger btn-sm">&#10008;</a>
                          </td>';
                    echo '</tr>';
                  }
                  if($count<=0){
                    echo '<tr><td colspan="8">Data kosong</td></tr>';
                  }
                  echo '</table>
                </div><!-- ./table-responsive -->
          </div><!-- ./wrapper -->
        ';
      }
       // end views temporary pages anggota

       // views restore pages anggota
       if($views == "restore"){
          $query = "UPDATE tb_user SET stts='aktif' , deleted_at=NULL";;
          $sql = mysqli_query($koneksi,$query);
          if($sql){
            header('Location:?pages='.$pages.'&views=index');
          }
       }
       // end view restore pages anggota

       // views delete all (Hapus permanen) pages anggota
       if($views == "deleteall"){
          $exec = GET('exec','');
          if($exec!=''){
            $query = "DELETE FROM tb_user WHERE stts = 'deleted'";
            $sql = mysqli_query($koneksi,$query);
            if($sql){
              GET('exec','');
              header('Location:?pages='.$pages.'&views=index');
            }
          }

          echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Hapus Data</legend>
                  <div class="alert-danger">Apakah anda yakin ingin menghapus semua data ini?';
                    $query = "SELECT nama FROM tb_user WHERE stts = 'deleted'";
                    $sql = mysqli_query($koneksi,$query);
                    $i=1;
                    echo '<ul class="list-hapus">';
                      while($nama = mysqli_fetch_assoc($sql)){
                        echo '<li>'.$i++.'. '.$nama['nama'].'</li>';
                      }
                    echo '</ul>';
              echo '</div>';
              echo '<form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                      <input type="hidden" name="exec" value="'.time().'">
                      <button type="submit" class="btn-danger btn-md">Hapus Data</button>
                      <a href="?pages='.$pages.'&views=temporary" class="btn-default btn-md">Kembali</a>
                    </form>
              </fieldset>
          ';
       }
       // end views delete all pages anggota

       // views restore data terpilih pages anggota
       if($views == "restoreid"){
          $id = GET('id','');
          $query = "UPDATE tb_user SET stts='aktif',deleted_at=NULL WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          if($sql){
            header('Location:?pages='.$pages.'&views=index');
          }
       }
       // end views restore data terpilih pages anggota

       // views hapus permanen data terpilih pages anggota
       if($views == "deleteid"){
          $id = GET('id','');
          $exec = GET('exec','');
          if($exec!='' && $id!=''){
            $query = "DELETE FROM tb_user WHERE id = '$id'";
            $sql = mysqli_query($koneksi,$query);
            if($sql){
              $exec = GET('exec','');
              header('Location:?pages='.$pages.'&views=index');
            }
          }

          $query = "SELECT * FROM tb_user WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $row = mysqli_fetch_assoc($sql);
          echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Hapus Data</legend>
                <div class="alert-danger">Apakah anda yakin ingin menghapus data <span>'.$row['nama'].'</span>?</div>
                  <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                    <input type="hidden" name="exec" value="'.time().'">
                    <input type="hidden" name="id" value="'.$row['id'].'">
                    <button type="submit" class="btn-danger btn-md">Hapus Data</button>
                    <a href="?hal=4" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
            ';
       }
    }
    /*
      ==============================================================================================
      END PAGES ANGGOTA
      ==============================================================================================
    */
  
  }
  // END FUNGSI MAIN
?>