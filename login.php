<?php 
echo '<!DOCTYPE html>
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <title>SIMP</title>
      </head>
      <body>
        <div class="login">
          <div class="content-login">
            <div class="content-left">
              <h5>Selamat Datang</h5>
              <span>Login untuk melanjutkan</span>
              <img class="img-login" src="assets/img/login-welcome.png" alt="img-login">
            </div>
            <div class="content-right">
              <h3>SIMP</h3>
              <span>Sistem Informasi Manajemen Perpustakaan</span>
              <form name="form-login" action="" method="POST">
                <div class="form-group">
                  <label class="lb-login" for="username">Username</label><br>
                  <input type="text" autocomplete="off" class="inp-login" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <label class="lb-login" for="password">Password</label><br>
                  <input type="password" class="inp-login" name="password" placeholder="Password">
                </div>
                <div class="from-group cbk">
                  <input type="checkbox" name="rememberme" id="remember"><label for="remember" class="rmb">Remember me</label>
                </div>
                <button type="submit" class="btn-login btn-md">Login</button>
              </form> 
            </div><!-- ./content-right -->
          </div><!-- ./content-login -->
          <p class="cprght">Copyright &copy; KuliKode 2021 - All Right Reserved</p>
          <img class="wave-login" src="assets/img/wave-login.svg" alt="wave-login">
        </div><!-- ./login -->
      </body>
      </html>
';
?>