<?php
date_default_timezone_set("Asia/Jakarta");
include('../config/config.php');
$lib = new config();
session_start();
if (!isset($_SESSION["npk"]) && !isset($_SESSION["akses"])) {
  echo "<script type='text/javascript'>alert('Anda Harus Login Terlebih Dahulu!');window.location.href = '../../index.php';</script>";
  exit;
}

$aks = $_SESSION["akses"];

if ($aks != "admin") {
  echo "<script type='text/javascript'>alert('Anda Tidak Memiliki Akses Admin!');window.location.href = '../../index.php';</script>";
  exit;
}
if (isset($_POST['tombol_tambah'])) {
  $nama = $_POST['nama'];
  $npk = $_POST['npkx'];
  $pass = md5($_POST['passwordx']);
  $map = $_POST['alamat'];
  $aks = $_POST['akses'];
  $negara = $_POST['negara'];

  $add_status = $lib->registrasiPengguna($nama, $npk, $pass, $map, $aks, $negara);
  if ($add_status) {
    echo "<script type='text/javascript'>alert('Berhasil Menambah Data Pengguna!');window.location.href = 'data_akun.php';</script>";
  } else {
    echo "<script type='text/javascript'>alert('Gagal Menambah Data Pengguna!');window.location.href = 'form_akun.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicons-->
  <link rel="icon" href="../../img/icons.png" sizes="32x32" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <!-- font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous" />
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <title>Form Tambah Akun | KIM</title>
  <style>
    .judul {
      font-family: 'Patua One', cursive;
    }

    .section {
      padding-top: 4vw;
      padding-bottom: 4vw;
    }
  </style>
</head>

<body>
  <header>
    <nav class="nav-wrapper teal">
      <div class="container">
        <a href="home.php" class="brand-logo"><img src="../../img/logo-brand.png" alt="logo-kim" height="50" width="110"></a>
        <a href="#" class="sidenav-trigger floating" data-target="mobile-menu">
          <i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="data_report.php" class="active">Report</a></li>
          <li><a href="data_akun.php" class="active">Data Akun</a></li>
          <li><a href="data_tipe.php" class="active">Data Tipe</a></li>
          <li><a href="../config/logout.php" class="active">Logout</a></li>
        </ul>
        <ul class="sidenav" id="mobile-menu">
          <li><a href="data_report.php" class="active">Report</a></li>
          <li><a href="data_akun.php" class="active">Data Akun</a></li>
          <li><a href="data_tipe.php" class="active">Data Tipe</a></li>
          <li><a href="../config/logout.php" class="active">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <section class="container section scrollspy">
    <h4 class="teal-text text-darken-2 judul">Form Tambah Pengguna</h2>
      <div class="divider"></div>
      <form action="" method="POST" class="section">
        <div class="row">
          <div class="col l4 hide-on-med-and-down">
            <center>
              <img height="300" width="300" class="responsive-img materialboxed" src="../../img/tambah_data.jpg" alt="Placeholder">
            </center>
          </div>
          <div class="col offset-l2 l6 s12 m12">
            <div class="row">
              <div class="input-field col s12 m12 l6">
                <input id="nama" type="text" class="validate" name="nama" required />
                <label for="nama">Nama</label>
              </div>
              <div class="input-field col s12 m12 l6">
                <input id="npk" type="text" class="validate" name="npkx" required />
                <label for="npk">NPK</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="password" type="password" class="validate" name="passwordx" required />
                <label for="password">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s8 m8 l8">
                <textarea id="alamat" class="materialize-textarea validate" name="alamat" required></textarea>
                <label for="alamat">Alamat</label>
              </div>
              <div class="input-field col s4 m4 l4">
                <select name="akses" required>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
                <label>Pilih Akses</label>
              </div>
            </div>
            <div class="row">
              <div class="col s12 m12 l12">
                <label for="negara">Pilih Negara Asal</label>
              </div>
              <div class="input-field col s4 m4 l4">
                <label>
                  <input class="with-gap" name="negara" value="Indonesia" type="radio" checked required />
                  <span>Indonesia</span>
                </label>
              </div>
              <div class="input-field col s4 m4 l4">
                <label>
                  <input class="with-gap" name="negara" value="Malaysia" type="radio" required />
                  <span>Malaysia</span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col s12 m12 l12">
                <div class="input-field right">
                  <input type="submit" name="tombol_tambah" value="tambah data" class="btn" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
  </section>
  <footer class="page-footer grey darken-3" style="margin-top:20%">
    <div class="container">
      <div class="row">
        <div class="col s12 l12">
          <h5>Contact Us</h5>
          <div class="divider"></div>
          <p>
            <i class="material-icons left">business</i>
            Head Office
          </p>
          <p>
            <i class="material-icons left">location_on</i>
            Jl. Gaya Motor Raya, RT.9/RW.9, Sungai Bambu, North Jakarta, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14330
          </p>
          <p>
            <i class="material-icons left">phone</i> (021) 6511228
          </p>
        </div>
      </div>
    </div>
    <div class="footer-copyright grey darken-4">
      <div class="container center-align">&copy; 2021 | Komunikasi Indonesia Malaysia (KIM)</div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".sidenav").sidenav();
      $('.scrollspy').scrollSpy();
      $(".slider").slider();
      $('select').formSelect();
      $('.materialboxed').materialbox();
      M.updateTextFields();
    });
  </script>
</body>

</html>