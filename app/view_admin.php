<?php
/*
  =======================================================================================
  ##### HALAMAN DATA ANGGOTA ####
  =======================================================================================
*/
  $pages = GET('pages','');
  $views = GET('views','');
  
  function alert($message)
  {
    echo "<script>alert('$message');</script>";
  }

  // FUNCTION ANGGOTA
  function anggota()
  {
    global $koneksi;
    global $pages;
    global $views;
    if($pages == "anggota")
    {
      // buat tabel baru jika belum ada
      tb_anggota($koneksi);

      // tangkap variabel dari form
      $exec = htmlspecialchars(GET('exec',''));
      $nama = htmlspecialchars(GET('nama',''));
      $jenis_kelamin = htmlspecialchars(GET('jenis_kelamin',''));
      $alamat = htmlspecialchars(GET('alamat',''));
      $email = htmlspecialchars(GET('email',''));
      $telepon = htmlspecialchars(GET('telepon',''));

      // views index pages anggota
      if($views == "index")
      {
          echo '<div class="wrapper">
              <a href="?pages='.$pages.'&views=tambah" class="btn-success btn-md">&#10010; Tambah Anggota</a>
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
                $query = "SELECT * FROM tb_anggota WHERE deleted_at IS NULL ORDER BY created_at DESC";
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
      if($views == "tambah")
      {
        // Cek apakah ada variabel dari form yang masih kosong
        if($exec!='' && $nama!='' && $jenis_kelamin!='' && $alamat!='' && $email!='' && $telepon!=''){
          // cek email apakah sudah terdaftar
          $mail = "SELECT email FROM tb_anggota WHERE email='$email'";
          $sql = mysqli_query($koneksi,$mail);
          $count = mysqli_num_rows($sql);
          if($count>0){
            alert("Email sudah pernah terdaftar silahkan gunakan email anda yang lain");
          }
          // jika email belum terdaftar
          $id = md5(time());
          echo $query = "INSERT INTO tb_anggota  VALUES ('$id','$nama','$jenis_kelamin','$alamat','$email','$telepon',NOW(),NOW(),NULL)";
          $sql = mysqli_query($koneksi,$query);
          if($sql){
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
          else mysqli_error($koneksi);
        }
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Tambah Anggota</legend>
              <form name="formtambahAnggota" action="?pages='.$pages.'&views='.$views.'" method="POST">
                <input type="hidden" name="exec" value="'.time().'">';
                echo '<div class="form-group">
                        <label for="nama">Nama Anggota</label><br>
                        <input type="text" name="nama" placeholder="Nama anggota" id="nama" class="form-control" required>
                      </div>';
                echo '<div class="form-group">
                        <label for="jk">Jenis Kelamin</label><br>
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" style="margin:10px 0"> <span class="value-radio">Laki-laki</span>
                        <input type="radio" name="jenis_kelamin" value="Perempuan" style="margin:10px 0 10px 5px;"> <span class="value-radio">Perempuan</span>
                      </div>';
                echo '<div class="form-group">
                        <label for="alamat">Alamat</label><br>
                        <textarea name="alamat" placeholder="Alamat anggota" class="form-control"></textarea>
                      </div>';
                echo '<div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" class="form-control" placeholder="Email anggota">
                      </div>';
                echo '<div class="form-group">
                        <label for="no_telp">No Telepon / Handphone</label><br>
                        <input type="text" name="telepon" class="form-control" placeholder="No Telepon / Handphone">
                      </div>';
                echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
            ';
      }
      // end views tambah pages anggota
      
      // views edit pages angota
      if($views == "edit")
      {
        $id = GET('id','');
        $exec = GET('exec','');

        if($exec!='' && $nama!='' && $jenis_kelamin!='' && $alamat!='' && $email!='' && $telepon!='')
        {
          $query = "UPDATE tb_anggota SET nama='$nama',jenis_kelamin='$jenis_kelamin',alamat='$alamat',email='$email',telepon='$telepon',updated_at=NOW() WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_anggota WHERE id = '$id'";
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
                          echo '<input type="radio" name="jenis_kelamin" value="Laki-laki" style="margin:10px 0"'; if($row['jenis_kelamin'] == 'Laki-laki') echo "checked" ; echo'> <span class="value-radio">Laki-laki</span>';
                          echo '<input type="radio" name="jenis_kelamin" value="Perempuan" style="margin:10px 0 10px 5px;"'; if($row["jenis_kelamin"] == "Perempuan") echo "checked"; echo'> <span class="value-radio">Perempuan</span>
                        </div>';
                  echo '<div class="form-group">
                          <label for="deskripsi">Alamat</label><br>
                          <textarea name="alamat" placeholder="Alamat anggota" class="form-control">'.$row['alamat'].'</textarea>
                        </div>';
                  echo '<div class="form-group">
                          <label for="email">Email</label><br>
                          <input type="email" name="email" class="form-control" placeholder="Email anggota" value="'.$row['email'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="no_telp">No Telepon / Handphone</label><br>
                          <input type="text" name="telepon" class="form-control" placeholder="No Telepon / Handphone" value="'.$row['telepon'].'">
                        </div>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
      }
      // end views edit pages anggota

      // views hapus sementara pages anggota
      if($views == "hapus")
      {
        $id = GET('id','');
        $exec = GET('exec','');
        if($exec!='' && $id!='')
        {
          $query = "UPDATE tb_anggota SET deleted_at = NOW() WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_anggota WHERE id = '$id'";
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
    }
  }
  // END FUNCTION ANGOTA

  /*
  =======================================================================================
  ##### HALAMAN DASHBOARD #####
  =======================================================================================
  */
  function dashboard()
  {
    global $koneksi;
    // cari jumlah buku
    $query_buku = "SELECT * FROM tb_buku WHERE deleted_at IS NULL";
    $sql_buku = mysqli_query($koneksi,$query_buku);
    $jml_buku = mysqli_num_rows($sql_buku);
    // cari jumlah anggota
    $query_anggota = "SELECT * FROM tb_anggota WHERE deleted_at IS NULL";
    $sql_anggota = mysqli_query($koneksi,$query_anggota);
    $jml_anggota = mysqli_num_rows($sql_anggota);
    // cari jumlah transaksi
    $query_transaksi = "SELECT * FROM tb_transaksi WHERE deleted_at IS NULL";
    $sql_transaksi = mysqli_query($koneksi,$query_transaksi);
    $jml_transaksi = mysqli_num_rows($sql_transaksi);

    echo '<div class="menu-dashboard">
    <!-- DAFTAR BUKU -->
    <div class="card" style="border-top: 3px solid #5cb85c;">
      <div class="card-body card-dashboard">
        <div class="konten">
          <p class="card-title">Data Buku</p>
          <p class="jml-data">Jumlah</p>
          <span class="tot">'.$jml_buku.'</span>
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
          <span class="tot">'.$jml_transaksi.'</span>
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
          <span class="tot">'.$jml_anggota.'</span>
        </div>
        <div class="kontent-img">
          <img class="card-img" src="assets/icons/group.png">
        </div>
      </div> <!-- ./card-body -->
    </div> <!-- ./card -->
    <!-- AKHIR DAFTAR ANGGOTA -->
    </div> <!-- ./menu-content -->';
  
  }
  // END FUNCTION DASHBOARD

  /* 
  =======================================================================================
  ##### HALAMAN BUKU
  =======================================================================================
  */
  function buku()
  {
    global $koneksi;
    global $pages;
    global $views;

    if($pages == "buku")
    {
      // buat tabel baru jika belum ada
      tb_buku($koneksi);

      // tangkap variabel dari form buku
      $exec = htmlspecialchars(GET('exec',''));
      $judul_buku = htmlspecialchars(GET('judul_buku',''));
      $deskripsi = htmlspecialchars(GET('deskripsi',''));
      $kategori = htmlspecialchars(GET('kategori',''));
      $kategori_id = htmlspecialchars(GET('kategori_id',''));

      // views index pages buku
      if($views == "index")
      {
          echo '<div class="wrapper">
              <a href="?pages='.$pages.'&views=kategori" class="btn-primary btn-md">&#8801; Kategori</a>
              <a href="?pages='.$pages.'&views=tambah" class="btn-success btn-md">&#10010; Tambah Buku</a>
              <div class="table-responsive">
                <table>
                  <tr>
                    <th>&#8470;</th>
                    <th>Judul Buku</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Cover</th>
                    <th>Ditambahkan</th>
                    <th>Aksi</th>
                  </tr>';
                $query = "SELECT * FROM tb_buku WHERE deleted_at IS NULL ORDER BY created_at DESC";
                $sql = mysqli_query($koneksi,$query);
                $count = mysqli_num_rows($sql);
                $i=1;
                while($row = mysqli_fetch_assoc($sql))
                {
                  echo '<tr>';
                  echo '<td>'.$i++.'</td>';
                  echo '<td>'.$row['judul_buku'].'</td>';
                  echo '<td>'.$row['deskripsi'].'</td>';
                  echo '<td>'.$row['kategori'].'</td>';
                  echo '<td><img width="60" height="50" src="assets/cover_buku/'.$row['cover'].'"></td>';
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
      // end view index pages buku

      // views tambah pages buku
      if($views == "tambah")
      {    
        // Cek apakah ada variabel dari form yang masih kosong
        if($exec!='' && $judul_buku!='' && $deskripsi!='' && $kategori_id!='')
        {
          $nama_file = $_FILES['cover']['name']; // tangkap nama file
          $id = md5(time());

          $query = "SELECT * FROM tb_kategori WHERE id='$kategori_id'";
          $sql = mysqli_query($koneksi,$query);
          $result = mysqli_fetch_assoc($sql);
          $kategori = $result['kategori'];
          
          // Simpan foto
          if($nama_file!='')
          {
            $x = explode('.',$nama_file); // pisahkan nama file dengan ektenasi
            $ekstensi = strtolower(end($x)); // ubah ektensi file yang didapat ke lower case
            $file_tmp = $_FILES['cover']['tmp_name']; // tangkap file temporary file
            $size = $_FILES['cover']['size']; // tangkap ukuran file
            $target_dir = "assets/cover_buku/"; // direktori tempat menyimpan file
            $ektensi_diperbolehkan = array('png','jpg','jpeg');
            // cek ekstensi yang diperbolehkan
              if(in_array($ekstensi,$ektensi_diperbolehkan) === true)
              {
                // cek ukuran file
                if($size<2044070)
                {
                  $time = time(); // buat variabel untuk menyimpan waktu
                  $file = $time.'_'.$nama_file; // gabungkan variabel time dan nama file untuk merubah nama file dan simpan di variabel $file
                  move_uploaded_file($file_tmp,$target_dir.$file); // pindahkan file ke folder local
                  $query = "INSERT INTO tb_buku  VALUES ('$id','$judul_buku','$deskripsi','$kategori_id','$kategori','$file',NOW(),NOW(),NULL)";
                  $sql = mysqli_query($koneksi,$query);
                  if($sql){
                    GET('exec','');
                    header('Location:?pages='.$pages.'&views=index');
                  } else echo mysqli_error($koneksi);
                } else alert("Ukuran file lebih dari 2Mb");
              } else alert("Ektensi file tidak diizinkan");
          }
          // Jika tidak ada file yang di upload
          else
          {
            $nama_file = 'default.jpg';
            $query = "INSERT INTO tb_buku  VALUES ('$id','$judul_buku','$deskripsi','$kategori_id','$kategori','$nama_file',NOW(),NOW(),NULL)";
            $sql = mysqli_query($koneksi,$query);
            if($sql){
              GET('exec','');
              header('Location:?pages='.$pages.'&views=index');
            }
            else echo mysqli_error($koneksi);
          }
        }
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Tambah Buku</legend>
              <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="exec" value="'.time().'">';
                echo '<div class="form-group">
                        <label for="judul_buku">Judul buku</label><br>
                        <input type="text" name="judul_buku" placeholder="Judul buku" id="judul_buku" class="form-control" required>
                      </div>';
                echo '<div class="form-group">
                        <label for="deskripsi">Deskripsi</label><br>
                        <textarea name="deskripsi" placeholder="Deskripsi buku" class="form-control"></textarea>
                      </div>';
                echo '<div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori_id" class="form-control">
                        '.
                        $query = "SELECT * FROM tb_kategori";
                        $result = mysqli_query($koneksi,$query);
                        echo '<option value="-">--Pilih--</option>';
                        while($data = mysqli_fetch_assoc($result))
                        {
                          echo '<option value="'.$data['id'].'">'.$data['kategori'].'</option>';
                        }
                  echo '</br></br></select>
                      </div>';
                echo '<div class="form-group">
                        <label for="cover">Cover Buku</label>
                        <input type="file" class="form-control" name="cover">
                      </div>';
                echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
            ';
      }
      // end views tambah pages buku

      // views edit buku
      if($views == "edit")
      {
        $id = GET('id','');
        $exec = GET('exec','');

        echo $exec;
        echo $judul_buku;
        echo $deskripsi;
        echo $kategori;

        if($exec!='' && $judul_buku!='' && $deskripsi!='' && $kategori!='')
        {
          echo $exec;
          $query = "UPDATE tb_buku SET judul_buku='$judul_buku',deskripsi='$deskripsi',kategori='$kategori',updated_at=NOW() WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_buku WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);

        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Edit Data</legend>
                <form name="formEditBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="judul_buku">Judul Buku</label><br>
                          <input type="text" name="judul_buku" placeholder="Judul buku" id="judul_buku" class="form-control" required value="'.$row['judul_buku'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="deskripsi">Deskripsi</label><br>
                          <textarea name="deskripsi" placeholder="Deskripsi buku" id="deskripsi" class="form-control" required>'.$row['deskripsi'].'</textarea>
                        </div>';
                  echo '<div class="form-group">
                          <label for="kategori">Kategori</label>
                          <select name="kategori" id="kategori" class="form-control">';
                            $query = "SELECT kategori FROM tb_kategori";
                            $sql = mysqli_query($koneksi,$query);
                            while($data = mysqli_fetch_assoc($sql)){
                              if($data['kategori'] == $row['kategori'])
                                  echo '<option value="'.$data['kategori'].'" selected>'.$data['kategori'].'</option>';
                              else
                                  echo '<option value="'.$data['kategori'].'">'.$data['kategori'].'</option>'; 
                            }
                          echo '</select>
                        </div>';
                    echo '<a href="?pages='.$pages.'&views=updatephoto&id='.$row['id'].'" class="btn-success btn-md">Update cover buku</a>';
                    echo '<br><br>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
      }
      // end edit buku

      // Hapus buku
      if($views == 'hapus')
      {
        $id = GET('id','');
        $exec = GET('exec','');
        if($exec!='' && $id!='')
        {
          $query = "UPDATE tb_buku SET deleted_at=NOW() WHERE id='$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_buku WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Hapus Data</legend>
                <div class="alert-danger">Apakah anda yakin ingin menghapus data <span>'.$row['judul_buku'].'</span>?</div>
                  <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                    <input type="hidden" name="exec" value="'.time().'">
                    <input type="hidden" name="id" value="'.$row['id'].'">
                    <button type="submit" class="btn-danger btn-md">Hapus</button>
                    <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
        ';
      }
      // End hapus buku

      // update photo
      if($views == "updatephoto")
      {
        $id = GET('id','');
        $exec = GET('exec','');
        if($id!='' && $exec!='')
        {
          $nama_file = $_FILES['cover']['name']; // tangkap nama file
          if($nama_file!='')
          {
           $x = explode('.',$nama_file); // pisahkan nama file dengan ektenasi
            $ekstensi = strtolower(end($x)); // ubah ektensi file yang didapat ke lower case
            $file_tmp = $_FILES['cover']['tmp_name']; // tangkap file temporary file
            $size = $_FILES['cover']['size']; // tangkap ukuran file
            $target_dir = "assets/cover_buku/"; // direktori tempat menyimpan file
            $ektensi_diperbolehkan = array('png','jpg','jpeg');
            // cek ekstensi yang diperbolehkan
              if(in_array($ekstensi,$ektensi_diperbolehkan) === true)
              {
                // cek ukuran file
                if($size<2044070)
                {
                  $time = time(); // buat variabel untuk menyimpan waktu
                  $file = $time.'_'.$nama_file; // gabungkan variabel time dan nama file untuk merubah nama file dan simpan di variabel $file
                  move_uploaded_file($file_tmp,$target_dir.$file); // pindahkan file ke folder local
                  $query = "UPDATE tb_buku SET cover='$file' WHERE id='$id'";
                  $sql = mysqli_query($koneksi,$query);
                  if($sql){
                    GET('exec','');
                    header('Location:?pages='.$pages.'&views=index');
                  } else echo mysqli_error($koneksi);
                } else alert("Ukuran file lebih dari 2Mb") ;
              } else alert("Ektensi file tidak diizinkan");
            GET('exec','');
          }
        }
        $query = "SELECT * FROM tb_buku WHERE id = '$id' AND deleted_at IS NULL";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Update Cover</legend>
                <img src="assets/cover_buku/'.$row['cover'].'" class="img_cover_edit"/>
                <br><br>
                <form name="formEditBuku" action="?pages='.$pages.'&views='.$views.'" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="cover">Upload Cover Buku Baru</label><br>
                          <input type="file" name="cover" id="cover" class="form-control" required>
                        </div>';
                  echo '<br>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=edit&id='.$row['id'].'" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
      }
      // end update photo
      
      /*
        ================
        ||  KATEGORI  ||
        ================
      */
      // views kategori
      if($views == 'kategori')
      {
        echo '<div class="wrapper">
              <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">&#x21d0; Kembali</a>
              <a href="?pages='.$pages.'&views=tambah_kategori" class="btn-success btn-md">&#10010; Tambah Kategori</a>
              <div class="table-responsive">
                <table>
                  <tr>
                    <th>&#8470;</th>
                    <th>Kategori</th>
                    <th>Ditambahkan</th>
                    <th>Aksi</th>
                  </tr>';
                $query = "SELECT * FROM tb_kategori WHERE deleted_at IS NULL ORDER BY created_at DESC";
                $sql = mysqli_query($koneksi,$query);
                $count = mysqli_num_rows($sql);
                $i=1;
                while($row = mysqli_fetch_assoc($sql))
                {
                  echo '<tr>';
                  echo '<td>'.$i++.'</td>';
                  echo '<td>'.$row['kategori'].'</td>';
                  echo '<td>'.date("d M Y, G:i", strtotime($row['created_at'])).' WIB </td>';
                  echo '<td>
                          <a href="?pages='.$pages.'&views=editkategori&id='.$row['id'].'" class="btn-warning btn-sm">&#9998;</a>
                          <a href="?pages='.$pages.'&views=hapuskategori&id='.$row['id'].'" class="btn-danger btn-sm">&#10008;</a>
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
      // end views kategori
      
      // view tambah kategori
      if($views == "tambah_kategori")
      {
        // Cek apakah ada variabel dari form yang masih kosong
        if($exec!='' && $kategori!=''){
          $id = md5(time());
          $query = "INSERT INTO tb_kategori  VALUES ('$id','$kategori',NOW(),NOW(),NULL)";
          $sql = mysqli_query($koneksi,$query);
          if($sql){
            GET('exec','');
            header('Location:?pages='.$pages.'&views=kategori');
          }
        }
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Tambah Anggota</legend>
              <form name="formtambahKategori" action="?pages='.$pages.'&views='.$views.'" method="POST">
                <input type="hidden" name="exec" value="'.time().'">';
                echo '<div class="form-group">
                        <label for="kategori">Kategori</label><br>
                        <input type="text" name="kategori" placeholder="Masukkan kategori buku" id="kategori" class="form-control" required>
                      </div>';
                echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
            ';
      }
      // end views tambah pages kategori

      // views edit pages kategori
      if($views == "editkategori")
      {
        $id = GET('id','');
        $exec = GET('exec','');

        if($exec!='' && $kategori!='')
        {
          $query = "UPDATE tb_kategori SET kategori='$kategori',updated_at=NOW() WHERE id = '$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            // Update kategori di tabel buku
            $query = "UPDATE tb_buku SET kategori='$kategori' WHERE kategori_id='$id'";
            mysqli_query($koneksi,$query);
            GET('id','');
            GET('exec','');
            header('Location:?pages='.$pages.'&views=kategori');
          }
        }

        $query = "SELECT * FROM tb_kategori WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);

        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Edit Data</legend>
                <form name="formEditKategori" action="?pages='.$pages.'&views='.$views.'" method="POST">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="kategori">Nama Anggota</label><br>
                          <input type="text" name="kategori" placeholder="Kategori buku" id="kategori" class="form-control" required value="'.$row['kategori'].'">
                        </div>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=kategori" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
      }
      // End edit kategori
      
      // Hapus kategori
      if($views == 'hapuskategori')
      {
         $id = GET('id','');
        $exec = GET('exec','');
        if($exec!='' && $id!='')
        {
          $query = "DELETE FROM tb_kategori WHERE id='$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            GET('exec','');
            header('Location:?pages='.$pages.'&views=kategori');
          }
        }

        $query = "SELECT * FROM tb_kategori WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Hapus Data</legend>
                <div class="alert-danger">Apakah anda yakin ingin menghapus data <span>'.$row['kategori'].'</span>?</div>
                  <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                    <input type="hidden" name="exec" value="'.time().'">
                    <input type="hidden" name="id" value="'.$row['id'].'">
                    <button type="submit" class="btn-danger btn-md">Hapus</button>
                    <a href="?pages='.$pages.'&views=kategori" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
        ';
      }
      // End hapus kategori
      
    }
    // end page buku 
  }
  // END FUNCTION BUKU

  /*
  ========================================================================================
  ##### HALAMAN TRANSAKSI
  ========================================================================================
  */
  function transaksi()
  {
    global $koneksi;
    global $pages;
    global $views;

    if($pages == 'transaksi')
    {
      // Buat tabel baru
      tb_tranksaksi($koneksi);

      $exec = htmlspecialchars(GET('exec',''));
      $anggota = htmlspecialchars(GET('anggota',''));
      $buku = htmlspecialchars(GET('buku',''));
      $tgl_pinjam = htmlspecialchars(GET('tanggal_pinjam',''));
      $tgl_kembali = htmlspecialchars(GET('tanggal_kembali',''));

      // Views index
      if($views == 'index')
      {
        echo '<div class="wrapper">
              <a href="?pages='.$pages.'&views=tambah" class="btn-success btn-md">&#10010; Tambah Transaksi</a>
              <div class="table-responsive">
                <table>
                  <tr>
                    <th>&#8470;</th>
                    <th>Nama Anggota</th>
                    <th>Buku</th>
                    <th>Pinjam</th>
                    <th>Kembali</th>
                    <th>Status</th>
                    <th>Cek</th>
                    <th>Ditambahkan</th>
                    <th>Aksi</th>
                  </tr>';
                $query = "SELECT * FROM tb_transaksi WHERE deleted_at IS NULL ORDER BY created_at DESC";
                $sql = mysqli_query($koneksi,$query);
                $count = mysqli_num_rows($sql);
                $i=1;
                $today = date("Y-m-d");
                while($row = mysqli_fetch_assoc($sql))
                {
                  $expire = $row['tanggal_kembali']; //from database

                  $today_time = strtotime($today);
                  $expire_time = strtotime($expire);
                  echo '<tr>';
                  echo '<td>'.$i++.'</td>';
                  echo '<td>'.$row['anggota'].'</td>';
                  echo '<td>'.$row['buku'].'</td>';
                  echo '<td align="center">'.date("d M Y", strtotime($row['tanggal_pinjam'])).'</td>';
                  echo '<td align="center">'.date("d M Y", strtotime($row['tanggal_kembali'])).'</td>';
                  echo '<td>';
                        // cek status dan beri warna sesuai status
                        if(($row['status'] === 'Dipinjam' || $row['status'] === 'Terlambat') && $expire_time<$today_time ) echo '<div class="status status-danger">Terlambat</div>';
                        if($row['status'] === 'Dipinjam' && $expire_time>=$today_time) echo '<div class="status status-warning">Dipinjam</div>';
                        if($row['status'] === 'Dikembalikan') echo '<div class="status status-success">'.$row['status'].'</div>';
                        // if($row['status'] === 'Terlambat') echo '<div class="status status-danger">'.$row['status'].'</div>';
                  echo '</td>';
                  // cek apakah sudah dikembalikan atau terlamabat, jika ya maka hilangkan checkbox
                  if($row['status'] === 'Dikembalikan') echo '<td>&#10004;</td>';
                  else if(($row['status'] === 'Dipinjam' || $row['status'] === 'Terlambat') && $expire_time<$today_time) echo '<td>&#10008;</td>';
                  else
                    echo '<td align="center"><input type="checkbox" name="status" value='.$row['id'].' id="statusTransaksi" onclick="if(this.checked){status()}"></td>';
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
      // End views index

      // Views tambah transaksi
      if($views == 'tambah')
      { 
        // Cek apakah ada variabel dari form yang masih kosong
        if($exec!='' && $anggota!='' && $buku!='' && $tgl_pinjam!='' && $tgl_kembali!='')
        {
          $time_pinjam = strtotime($tgl_pinjam);
          $time_kembli = strtotime($tgl_kembali);
          if($time_kembli<$time_pinjam)
            alert("Tanggal kembali seharusnya lebih dari tanggal pinjam");
          else
          {
            $name = ucwords($anggota);
            $status = 'Dipinjam';
            $id = md5(time());
            $query = "INSERT INTO tb_transaksi VALUES ('$id','$name','$buku','$tgl_pinjam','$tgl_kembali','$status',NOW(),NOW(),NULL)";
            $sql = mysqli_query($koneksi,$query);
            if($sql){
              GET('exec','');
              header('Location:?pages='.$pages.'&views=index');
            }
            else echo mysqli_error($koneksi);
          }
        }
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Tambah Transaksi</legend>
              <form name="formtambahTransaksi" action="?pages='.$pages.'&views='.$views.'" method="POST">
                <input type="hidden" name="exec" value="'.time().'">';
                echo '<div class="form-group">
                        <label for="anggota">Nama Peminjam</label><br>
                        <input type="text" name="anggota" placeholder="Masukkan nama peminjam" class="form-control" required>
                      </div>';
                echo '<div class="form-group">
                        <label for="buku">Buku</label><br>
                        <input type="text" name="buku" placeholder="Masukkan nama buku" class="form-control" required>
                      </div>';
                echo '<div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label><br>
                        <input type="date" name="tanggal_pinjam" id="tgl_pinjam" class="form-control" required>
                      </div>';
                echo '<div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label><br>
                        <input type="date" name="tanggal_kembali" id="tgl_kembali" class="form-control" required>
                      </div>';
                echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
            ';
      }
      // End views tambah transaksi

      // views edit transaksi
      if($views == "edit")
      {
        $id = GET('id','');
        $exec = GET('exec','');
        $stts = GET('status','');

        if($exec!='' && $anggota!='' && $buku!='' && $tgl_pinjam!='' && $tgl_kembali!='' && $stts!='')
        {
          $time_pinjam = strtotime($tgl_pinjam);
          $time_kembli = strtotime($tgl_kembali);
          if($time_kembli<$time_pinjam)
            alert("Tanggal kembali seharusnya lebih dari tanggal pinjam");
          else
          {
            $query = "UPDATE tb_transaksi SET anggota='$anggota',buku='$buku',tanggal_pinjam='$tgl_pinjam',tanggal_kembali='$tgl_kembali',status='$stts',updated_at=NOW() WHERE id = '$id'";
            $sql = mysqli_query($koneksi,$query);
            $rows = mysqli_affected_rows($koneksi);
            if($rows > 0)
            {
              GET('id','');
              GET('exec','');
              header('Location:?pages='.$pages.'&views=index');
            }
          }
        }

        $query = "SELECT * FROM tb_transaksi WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        $today = date("Y-m-d");
        $expire = $row['tanggal_kembali']; //from database

        $today_time = strtotime($today);
        $expire_time = strtotime($expire);
        $late = 'Terlambat';
        $kmbl = 'Dikembalikan';
        $pnjm = 'Dipinjam';
        $status = '';

        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Edit Data</legend>';
          // status terlambat
          if ($row['status'] === 'Terlambat')
          { 
            $status = $late;
            echo '<span style="font-size:18px;">Status buku </span><div class="status-edit status-danger">'.$late.'</div>';
          }
          // status masih dipinjam tapi sudah melebihi batas pengembalian
          if ($row['status'] === 'Dipinjam' && $expire_time < $today_time) 
          {
            $status = $late;
            echo '<span style="font-size:18px;">Status buku </span><div class="status-edit status-danger">'.$late.'</div>';
          }
          // sudah dikembalikan
          if ($row['status'] === 'Dikembalikan' && ($expire_time >= $today_time || $expire_time <= $today_time))
          {
            $status = $kmbl;
            echo '<span style="font-size:18px;">Status buku </span><div class="status-edit status-success">'.$kmbl.'</div>';
          }
          // masih dipinjam
          if ($row['status'] === 'Dipinjam' && $expire_time >= $today_time)
          {
            $status = $pnjm;
            echo '<span style="font-size:18px;">Status buku </span><div class="status-edit status-warning">'.$pnjm.'</div>';
          }
          echo '<form name="formEditTransaksi" action="?pages='.$pages.'&views='.$views.'" method="POST">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">
                  <input type="hidden" name="status" value="'.$status.'">';
                  echo '<div class="form-group">
                          <label for="anggota">Nama Anggota</label><br>
                          <input type="text" name="anggota" placeholder="Nama anggota" id="anggota" class="form-control" required value="'.$row['anggota'].'">
                        </div>';
                   echo '<div class="form-group">
                          <label for="buku">Buku</label><br>
                          <input type="text" name="buku" placeholder="Buku" id="buku" class="form-control" required value="'.$row['buku'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="tgl_pinjam">Tanggal Pinjam</label>
                          <input type="date" name="tanggal_pinjam" class="form-control" value="'.$row['tanggal_pinjam'].'">
                        </div>';
                  echo '<div class="from-group">
                          <label for="tgl_kembali">Tanggal Kembali</label>
                          <input type="date" name="tanggal_kembali" class="form-control" value="'.$row['tanggal_kembali'].'">
                        </div>';
                  echo '<br>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
      }
      // end views transaksi

      // Hapus transaksi
      if($views == 'hapus')
      {
        $id = GET('id','');
        $exec = GET('exec','');
        if($exec!='' && $id!='')
        {
          $query = "UPDATE tb_transaksi SET deleted_at=NOW() WHERE id='$id'";
          $sql = mysqli_query($koneksi,$query);
          $rows = mysqli_affected_rows($koneksi);
          if($rows > 0)
          {
            GET('exec','');
            header('Location:?pages='.$pages.'&views=index');
          }
        }

        $query = "SELECT * FROM tb_transaksi WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Hapus Data</legend>
                <div class="alert-danger">Apakah anda yakin ingin menghapus data transaksi <span>'.$row['anggota'].'</span>?</div>
                  <form name="formtambahBuku" action="?pages='.$pages.'&views='.$views.'" method="POST">
                    <input type="hidden" name="exec" value="'.time().'">
                    <input type="hidden" name="id" value="'.$row['id'].'">
                    <button type="submit" class="btn-danger btn-md">Hapus</button>
                    <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>
                  </form>
                </fieldset>
        ';
      }
      // End hapus transaksi
    }
    // End pages transaksi
  }
  // END FUNCTION TRANSAKSI

  /*
  ======================================================
  ##### HALAMAN SUPERADMIN
  ======================================================
  */
  // FUNCTION PROFIL ADMIN
  function profileAdmin()
  {
    global $koneksi;
    global $pages;
    global $views;

    // tangkap variabel dari form
    $exec = htmlspecialchars(GET('exec',''));
    $nama = htmlspecialchars(GET('nama',''));
    $jenis_kelamin = htmlspecialchars(GET('jenis_kelamin',''));
    $alamat = htmlspecialchars(GET('alamat',''));
    $email = htmlspecialchars(GET('email',''));
    $telepon = htmlspecialchars(GET('telepon',''));
    $password = htmlspecialchars(GET('password',''));
    $password_confirm = htmlspecialchars(GET('password_confirm',''));

    $email = $_SESSION['email'];
    // page index admin
    if($views=='index')
    {
      $profile = "SELECT * FROM tb_admin WHERE email='$email'";
      $sql = mysqli_query($koneksi,$profile);
      $result = mysqli_fetch_assoc($sql);
      echo '
          <div class="wrapper">
            <h2>Profil Admin</h2><br>
            <div class="picture-admin">
              <img src="assets/img/male-default.svg" alt="img-sidebar"><br>
            </div>
            <div class="table-responsive">
              <table class="table-profile">
                <tr>
                  <td width="15%">Email</td>
                  <td>'.$result['email'].'</td>
                </tr>
                <tr>
                  <td width="15%">Nama</td>
                  <td>'.strtoupper($result['nama']).'</td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>'.$result['jenis_kelamin'].'</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>'.$result['alamat'].'</td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>'.$result['telepon'].'</td>
                </tr>
                <tr>
                  <td>Roles</td>
                  <td>'.ucwords($result['roles']).'</td>
                </tr>
              </table>
              <br>
              <a class="btn-success btn-md" href="?pages='.$pages.'&views=update&id='.$result['id'].'">&#x270E; Edit Profil</a>
            </div>
          </div>
      ';
    }
    // end page index admin

    // page update data admin
    if($views=='update')
    {
      $id = GET('id','');
      $exec = GET('exec','');

      if($id!='' && $exec!='' && $jenis_kelamin!='' && $alamat!='' && $email!='' && $telepon!='')
      {
        $query = "UPDATE tb_admin SET nama='$nama',jenis_kelamin='$jenis_kelamin',alamat='$alamat',email='$email',telepon='$telepon' WHERE id='$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_affected_rows($koneksi);
        if($row>0)
        {
          GET('id','');
          GET('exec','');
          header('Location:?pages='.$pages.'&views=index');
        }
        else mysqli_error($koneksi);
      }
      $query = "SELECT * FROM tb_admin WHERE id='$id' AND deleted_at IS NULL";
      $sql = mysqli_query($koneksi,$query);
      $row = mysqli_fetch_assoc($sql);

       echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Edit Profil</legend>
                <form name="formEditDataAdmin" action="?pages='.$pages.'&views='.$views.'" method="POST">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="email">Email</label><br>
                          <input type="text" name="email" placeholder="Email anda" id="email" class="form-control" required value="'.$row['email'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="nama">Nama</label><br>
                          <input type="text" name="nama" placeholder="Nama anda" id="nama" class="form-control" required value="'.$row['nama'].'">
                        </div>';
                  echo '<div class="form-group">
                          <label for="jk">Jenis Kelamin</label><br>';
                          echo '<input id="jk" type="radio" name="jenis_kelamin" value="Laki-laki" style="margin:10px 0"'; if($row['jenis_kelamin'] == 'Laki-laki') echo "checked" ; echo'> <span class="value-radio">Laki-laki</span><br>';
                          echo '<input id="jk" type="radio" name="jenis_kelamin" value="Perempuan" style="margin-bottom:10px"'; if($row["jenis_kelamin"] == "Perempuan") echo "checked"; echo'> <span class="value-radio">Perempuan</span>
                        </div>';
                  echo '<div class="form-group">
                          <label for="alamat">ALamat</label>
                          <textarea name="alamat" class="form-control">'.$row['alamat'].'</textarea>
                        </div>';
                  echo '<div class="form-group">
                          <label for="no_telepon">No Telepon</label>
                          <input type="text" class="form-control" name="telepon" value="'.$row['telepon'].'"/>
                        </div>';
                  echo '<a href="?pages='.$pages.'&views=updatephoto&id='.$row['id'].'" class="btn-warning btn-sm">&#9998; Edit photo</a>';
                  echo '<a href="?pages='.$pages.'&views=updatepassword&id='.$row['id'].'" class="btn-success btn-sm">&#128065 Edit password</a><br><br>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=index" class="btn-default btn-md">Kembali</a>';
                  echo '</form>
              </fieldset>
          ';
    }
    // end page update data admin

    // update photo
    if($views == "updatephoto")
    {
        $id = GET('id','');
        $exec = GET('exec','');
        if($id!='' && $exec!='')
        {
          $nama_file = $_FILES['photo']['name']; // tangkap nama file
          if($nama_file!='')
          {
           $x = explode('.',$nama_file); // pisahkan nama file dengan ektenasi
            $ekstensi = strtolower(end($x)); // ubah ektensi file yang didapat ke lower case
            $file_tmp = $_FILES['photo']['tmp_name']; // tangkap file temporary file
            $size = $_FILES['photo']['size']; // tangkap ukuran file
            $target_dir = "assets/profile_admin/"; // direktori tempat menyimpan file
            $ektensi_diperbolehkan = array('png','jpg','jpeg');
            // cek ekstensi yang diperbolehkan
              if(in_array($ekstensi,$ektensi_diperbolehkan) === true)
              {
                // cek ukuran file
                if($size<2044070)
                {
                  $time = time(); // buat variabel untuk menyimpan waktu
                  $file = $time.'_'.$nama_file; // gabungkan variabel time dan nama file untuk merubah nama file dan simpan di variabel $file
                  move_uploaded_file($file_tmp,$target_dir.$file); // pindahkan file ke folder local
                  echo $query = "UPDATE tb_admin SET photo='$file' WHERE id='$id'";
                  $sql = mysqli_query($koneksi,$query);
                  if($sql){
                    GET('exec','');
                    header('Location:?pages='.$pages.'&views=index');
                  } else echo mysqli_error($koneksi);
                } else alert("Ukuran file lebih dari 2Mb") ;
              } else alert("Ektensi file tidak diizinkan");
            GET('exec','');
          }
        }
        $query = "SELECT * FROM tb_admin WHERE id = '$id' AND deleted_at IS NULL";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);
        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Update Cover</legend>
                <img src="assets/profile_admin/'.$row['photo'].'" class="img_cover_edit"/>
                <br><br>
                <form name="formEditAdmin" action="?pages='.$pages.'&views='.$views.'" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="photo">Upload Cover Buku Baru</label><br>
                          <input type="file" name="photo" id="photo" class="form-control" required>
                        </div>';
                  echo '<br>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=update&id='.$row['id'].'" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
    }
    // end update photo data admin

    // views edit password pages data admin
    if($views == "updatepassword")
    {
        $id = GET('id','');
        $exec = GET('exec','');

        if($exec!='' && $password!='' && $password_confirm!='')
        {
          if($password==$password_confirm){
            if(strlen($password)>=8){
              $hash = password_hash($password,PASSWORD_DEFAULT);
              $query = "UPDATE tb_admin SET password='$hash',updated_at=NOW() WHERE id = '$id'";
              $sql = mysqli_query($koneksi,$query);
              $rows = mysqli_affected_rows($koneksi);
              if($rows > 0)
              {
                GET('id','');
                GET('exec','');
                header('Location:?pages='.$pages.'&views=index');
              }
            } else alert("Password minimal harus 8 karakter");
          }
          else alert('Password tidak sama silahkan ulangi lagi');
        }

        $query = "SELECT * FROM tb_admin WHERE id = '$id'";
        $sql = mysqli_query($koneksi,$query);
        $row = mysqli_fetch_assoc($sql);

        echo '<fieldset class="box-shadow fieldset"><legend class="box-shadow">Edit Password</legend>
                <form name="formEditKategori" action="?pages='.$pages.'&views='.$views.'" method="POST">
                  <input type="hidden" name="exec" value="'.time().'">
                  <input type="hidden" name="id" value="'.$row['id'].'">';
                  echo '<div class="form-group">
                          <label for="password">Masukkan password baru</label><br>
                          <input type="password" name="password" placeholder="Password baru" id="password" class="form-control" required>
                        </div>';
                  echo '<div class="form-group">
                          <label for="password_confirm">Masukkan password baru</label><br>
                          <input type="password" name="password_confirm" placeholder="Password baru" id="password_confirm" class="form-control" required>
                        </div>';
                  echo '<button type="submit" class="btn-simpan btn-md">Simpan</button>
                      <a href="?pages='.$pages.'&views=update&id='.$row['id'].'" class="btn-default btn-md">Kembali</a>
                  </form>
              </fieldset>
          ';
    }
  }
  // END FUNCTION PROFILE ADMIN

  // FUNCTION ABOUT ME
  function aboutme()
  {
    global $views;
    if($views=='index')
    {
      echo '
          <div class="wrapper">
            <h2>Developer</h2><br>
            <div class="picture-admin">
              <img src="assets/img/foto-profil.jfif" alt="img-sidebar">
            </div>
            <div class="table-responsive">
              <table class="table-profile">
                <tr>
                  <td width="15%">Email</td>
                  <td>yayaktaka@gmail.com</td>
                </tr>
                <tr>
                  <td width="15%">Nama</td>
                  <td>Yayak Yogi Ginantaka</td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>Laki-laki</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>Desa Bolorejo Kecamatan Kauman Kabupaten Tulungagung</td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>082233863080</td>
                </tr>
                <tr>
                  <td>Project</td>
                  <td>Sekumpulan project cupu saya &#10152; <a href="https://github.com/yayakyogi">Lihat project</a></td>
                </tr>
              </table>
            </div>
          </div>
      ';
    }
    // end page index about me
  }
  // END FUNCTION ABOUT ME
?>