<?php
date_default_timezone_set("Asia/Jakarta");
include('../config/config.php');
$lib = new config();
$data_tipe = $lib->showTipe();

//session
session_start();
if (!isset($_SESSION["npk"]) && !isset($_SESSION["akses"])) {
  echo "<script type='text/javascript'>alert('Anda Harus Login Terlebih Dahulu!');window.location.href = '../../index.php';</script>";
  exit;
}

$aks = $_SESSION["akses"];
$id_akun = $_SESSION["id_akun"];

if ($aks != "admin") {
  echo "<script type='text/javascript'>alert('Anda Tidak Memiliki Akses Admin!');window.location.href = '../../index.php';</script>";
  exit;
}

if (isset($_POST['tombol_tambah'])) {
  $idx = $_POST['id_report'];
  $akun = $_POST['id_akun'];
  $tgl_id = $_POST['input_date'];
  $id = date("Y-m-d", strtotime($tgl_id));
  $type = $_POST['type'];
  $jg = $_POST['judge'];
  $afterR = $_POST['after_repair'];
  $defectx = $_POST['defect'];

  //batas upload
  $foto =   $_FILES['foto']['name'];
  $ukuran_file = $_FILES['foto']['size'];
  $tipe_file = $_FILES['foto']['type'];
  $tmp = $_FILES['foto']['tmp_name'];

  $sizex = $_POST['size'];
  $arx = $_POST['area'];
  $subx = $_POST['sub_area'];
  $tgl_smdx = $_POST['smd'];
  $smdx = date("Y-m-d", strtotime($tgl_smdx));
  $isq = $_POST['isk'];
  $tgl_rmdx = $_POST['rmd'];
  $rmdx = date("Y-m-d", strtotime($tgl_rmdx));
  $irmx = $_POST['irk'];
  $ismx = $_POST['ism'];

  $add_status = $lib->buatReport($idx, $akun, $id, $type, $jg, $afterR, $defectx, $foto, $ukuran_file, $tipe_file, $tmp, $sizex, $arx, $subx, $smdx, $isq, $rmdx, $irmx, $ismx);
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
  <title>Form Tambah Report | KIM</title>
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
    <nav class="nav-wrapper teal responsive-images">
      <div class="container">
        <a href="#" class="brand-logo"><img src="../../img/logo-brand.png" alt="logo-kim" height="50" width="110"></a>
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
    <div class="row">
      <div class="col s12">
        <h4 class="teal-text text-darken-2 judul">Form Membuat Report</h2>
          <div class="divider"></div>
          <form action="" method="POST" class="section" enctype="multipart/form-data">
            <div class="row">
              <div class="col s12 l12">
                <div class="input-field">
                  <?php
                  $id_dummy = "Report" . date('dmYhis');
                  ?>
                  <input type="hidden" name="id_report" value="<?= $id_dummy; ?>" />
                  <input type="hidden" name="id_akun" value="<?= $id_akun ?>" />
                  <input type="text" id="date" class="datepicker validate" name="input_date" required />
                  <label for="date">Choose a date you need me for...</label>
                </div>
              </div>
              <div class="col l4 s12">
                <div class="input-field">
                  <div class="card">
                    <div class="card-image">
                      <img id="previewImg" height="200" width="200" class="responsive-images" src="../../img/choose.png" alt="Placeholder">
                    </div>
                  </div>
                </div>
                <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file" name="foto" onchange="previewFile(this);" required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>
              </div>
              <div class="col s12 l4">
                <div class="input-field">
                  <select name="type" required>
                    <?php foreach ($data_tipe as $row) {
                    ?>
                      <option value="<?php echo $row['id_tipe']; ?>"><?php echo $row['tipe_name']; ?></option>
                    <?php } ?>
                  </select>
                  <label>Type</label>
                </div>
                <div class="input-field">
                  <select name="judge" id="mySelect" onchange="afterRepair()" required>
                    <option value="OK">OK</option>
                    <option value="REPAIR">CAN BE REPAIRED</option>
                    <option value="REJECT">REJECT</option>
                  </select>
                  <label>Judge</label>
                </div>
                <div id="afterRepair" style="display:none;" class="input-field">
                  <select name="after_repair">
                    <option value="" selected>Choose your option</option>
                    <option value="OK">OK</option>
                    <option value="REJECT">REJECT</option>
                  </select>
                  <label>After Repair</label>
                </div>
                <div class="input-field">
                  <select name="defect" id="defect" onchange="other(event)" required>
                    <option value="" selected disabled>Choose your option</option>
                    <option value="SCRATHCH">SCRATCH</option>
                    <option value="CHIPPING">CHIPPING</option>
                    <option value="SCRATCH PACKAGING">SCRATCH PACKAGING</option>
                    <option value="DUST">DUST</option>
                    <option value="DENT">DENT</option>
                    <option value="POPPING">POPPING</option>
                    <option value="">OTHERS</option>
                  </select>
                  <label>Defect</label>
                </div>
                <div id="lainnya" style="display:none;" class="input-field">
                  <input type="text" id="others" class="other" name="defect" />
                  <label for="others" class="active">Other Defect</label>
                </div>
                <div class="input-field">
                  <textarea id="size" class="materialize-textarea" name="size" required></textarea>
                  <label for="size">Size(mm)</label>
                </div>
                <div class="input-field">
                  <select name="area">
                    <option value="AREA 1" selected>AREA 1</option>
                    <option value="AREA 2">AREA 2</option>
                    <option value="AREA 3">AREA 3</option>
                    <option value="AREA 4">AREA 4</option>
                  </select>
                  <label>Area</label>
                </div>
              </div>
              <div class="col s12 l4">
                <div class="input-field">
                  <select name="sub_area">
                    <option value="HUB" selected>HUB</option>
                    <option value="SPOKE">SPOKE</option>
                    <option value="FLANGE">FLANGE</option>
                  </select>
                  <label>Sub Area</label>
                </div>
                <div class="input-field">
                  <input type="text" id="date2" class="datepicker validate" name="smd" required />
                  <label for="date2">Square Mark Date</label>
                </div>
                <div class="input-field">
                  <textarea id="isk" class="materialize-textarea validate" name="isk" required></textarea>
                  <label for="isk">Initial Square Mark</label>
                </div>
                <div class="input-field">
                  <input type="text" id="date3" class="datepicker validate" name="rmd" required />
                  <label for="date3">Round Mark Date</label>
                </div>
                <div class="input-field">
                  <textarea id="irk" class="materialize-textarea validate" name="irk" required></textarea>
                  <label for="irk">Initial Round Mark</label>
                </div>
                <div class="input-field">
                  <textarea id="ism" class="materialize-textarea validate" name="ism" required></textarea>
                  <label for="ism">Small Round Mark</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <div class="input-field right">
                  <input type="submit" name="tombol_tambah" class="btn" />
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
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
    function afterRepair() {
      var o = document.getElementById("mySelect").value;
      var x = document.getElementById("afterRepair");

      if (o == 'REPAIR') {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }

    function other(e) {
      var d = document.getElementById("defect").value;
      var l = document.getElementById("lainnya");
      document.getElementById("others").value = e.target.value;

      if (d == '') {
        l.style.display = "block";
      } else {
        l.style.display = "none";
      }
    }

    function previewFile(input) {
      var file = $("input[type=file]").get(0).files[0];

      if (file) {
        var reader = new FileReader();

        reader.onload = function() {
          $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
      }
    }
    $(document).ready(function() {
      $(".sidenav").sidenav();
      $(".slider").slider();
      $(".datepicker").datepicker({
        disableWeekends: true,
      });
      $('select').formSelect();
      M.updateTextFields();
    });
  </script>
</body>

</html>