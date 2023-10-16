<?php
date_default_timezone_set("Asia/Jakarta");
$lib = new PDO("mysql:host=localhost;dbname=kim", "root", "");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = '';
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    // Akses
    if (isset($_POST['login'])) {
        $user = $_POST['npkx'];
        $pass = input(md5($_POST["passwordx"]));
        $query = $lib->prepare("select * from akun where npk=:npkx and pass=:passwordx");
        $query->BindParam(":npkx", $user);
        $query->BindParam(":passwordx", $pass);
        $query->execute();
        if ($query->rowCount() > 0) {
            session_start();
            $data = $query->fetch();
            if ($data['akses'] == 'admin') {
                sleep(2);
                $_SESSION["id_akun"] = $data["id_akun"];
                $_SESSION["npk"] = $data["npk"];
                $_SESSION["nama"] = $data["nama"];
                $_SESSION["akses"] = $data["akses"];

                echo "<script type='text/javascript'>alert('Selamat Datang Di Page Admin!');window.location.href = 'login/admin/data_report.php';</script>";;
            } else {
                $_SESSION["id_akun"] = $data["id_akun"];
                $_SESSION["npk"] = $data["npk"];
                $_SESSION["nama"] = $data["nama"];
                $_SESSION["akses"] = $data["akses"];
                echo "<script type='text/javascript'>alert('Selamat Datang Di User!');window.location.href = 'login/user/index.php';</script>";;
            }
        } else {
            echo "<script type='text/javascript'>alert('Akses Di Tolak!');window.location.href = 'index.php?pesan=invalid';</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Akses Di Tolak!');window.location.href = 'index.php?pesan=gagal';</script>";
    }
}
?>
<html lang="en">

<head>
    <!-- Favicons-->
    <link rel="icon" href="img/icons.png" sizes="32x32" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <title>Selamat Datang | KIM</title>
</head>
<style>
    header {
        background: url(img/cover3.jpg);
        background-size: cover;
        background-position: center;
        min-height: 1000px;
    }

    .section {
        padding-top: 4vw;
        padding-bottom: 4vw;
    }

    .tabs .indicator {
        background-color: #1a237e;
    }

    .tabs .tab a:focus,
    .tabs .tab a:focus.active {
        background: transparent;
    }

    .parallax-container {
        min-height: 380px;
        line-height: 0;
        height: auto;
        color: rgba(255, 255, 255, .9);
    }

    .parallax-container .section {
        width: 100%;
    }

    .modal {
        max-height: 650px;
    }

    .modal-form-row {
        margin-bottom: 0px;
    }

    div.tabs-content.carousel.carousel-slider {
        height: 550px !important;
    }

    @media only screen and (max-width : 992px) {
        .parallax-container .section {
            position: absolute;
            top: 40%;
        }
    }

    @media screen and (max-width: 670px) {
        header {
            min-height: 500px;
        }

        .parallax-container .section {
            position: absolute;
            top: 40%;
        }
    }
</style>

<body>

    <!-- navbar -->
    <header>
        <nav class="nav-wrapper transparent">
            <div class="container">
                <a href="#" class="brand-logo hide-on-med-and-down"><img src="img/logo-brand.png" alt="logo-kim" height="50" width="110"></a>
                <a href="#" class="sidenav-trigger" data-target="mobile-menu">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#about">About Site</a></li>
                    <li><a href="#informasi">Informasi</a></li>
                    <li><a class="modal-trigger" href="#modal1">Login</a></li>
                </ul>
                <ul class="sidenav" id="mobile-menu">
                    <li><a href="#about">About Site</a></li>
                    <li><a href="#informasi">Informasi</a></li>
                    <li><a class="modal-trigger" href="#modal1">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- about -->
    <section class="section container scrollspy" id="about">
        <div class="row">
            <div class="col s12 m12 l5">
                <h2 class="teal-text text-darken-4">About Site</h2>
                <p>Website ini memudahkan proses komunikasi antara pako group di negara indonesia dengan pako group di negara malaysia.</p>
            </div>
            <div class="col s12 m12 l5 offset-l2">
                <center>
                    <img src="img/about.png" class="responsive-img materialboxed" alt="about">
                </center>
            </div>
        </div>
    </section>
    <!-- parallax -->
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/ativa.jpg" alt="img-stars">
        </div>
    </div>
    <!-- photo / grid -->
    <section class="container section scrollspy" id="informasi">
        <div class="row">
            <div class="col s12">
                <h2 class="teal-text text-darken-4">Informasi Jenis-Jenis Velg</h2>
                <div class="divider"></div>
            </div>
            <div class="col s12 l4">
                <img src="img/maxresdefault.jpg" alt="img-potrait" class="responsive-img materialboxed move">
            </div>
            <div class="col s12 l6 offset-l1">
                <h4 class="teal-text text-darken-4">Jenis Velg Mobil Alloy Wheel</h4>
                <p>Untuk jenis velg mobil alloy wheel, bisa dikatakan hampir sama dengan tipe velg pertama. Proses pembentukannya juga menggunakan metode casting. Namun perbedaannya terletak pada bahan velg mobil yang digunakan. Jenis velg mobil cast iron wheel dibuat dari bahan besi sehingga berat namun kuat, sementara velg mobil alloy wheel terbuat dari campuran alumunium dan logam sehingga lebih ringan tetapi tetap kuat. Karena jenis velg mobil alloy wheel terbuat dari bahan campuran besi dan logam, velg mobil ini memiliki kelemahan yakni ketika bengkok karena benturan akan sangat berpengaruh kepada sistem kemudi.</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 push-l7 offset-l1">
                <img src="img/velg.jpg" alt="img-potrait" class="responsive-img materialboxed">
            </div>
            <div class="col s12 l6 pull-l5 right-align offset-l1">
                <h4 class="teal-text text-darken-4">Jenis Velg Mobil Iron Cast Wheel</h4>
                <p>Mungkin pada sepeda motor kita pernah mendengar kata CW. Dua kata itu berasal dari cast wheel yang artinya velg cetak. Model ini juga sering disebut sebagai velg racing karena memang kendaraan-kendaraan racing menggunakan jenis velg mobil dengan model seperti ini. Pembuatan jenis velg mobil ini menggunakan besi cair yang dituangkan kedalam cetakan.
                    Pada mobil, velg jenis ini dikenal kuat dan anti bengkok sehingga banyak digunakan pada kendaraan berlabel SUV. Selain kekuatannya, jenis velg mobil ini juga lebih stylish. Karena model cetakan dibuat dengan gaya serta desain yang cukup ciamik, itulah mengapa jenis velg ini sudah menjadi standar velg kendaraan di Indonesia.
                </p>
            </div>
        </div>
    </section>
    <!-- parallax -->
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/ativa2.jpg" alt="img-civic">
        </div>
    </div>
    <!-- login / tabs -->
    <!-- <section class="container section scrollspy" id="login">
        <div class="row">
            <div class="col s12 l12">
                <ul class="tabs">
                    <li class="tab col s6">
                        <a href="#loginhere" class="indigo-text text-darken-4">Login</a>
                    </li>
                    <li class="tab col s6">
                        <a href="#daftarhere" class="indigo-text text-darken-4">Registrasi</a>
                    </li>
                </ul>
                <div class="col s12 l12" id="loginhere">
                    <div class="row" style="margin-top: 4%;">
                        <div class="col s12 l4">
                            <center>
                                <img src="img/login.png" class="materialboxed responsive-img circle" height="200" width="200" alt="login">
                            </center>
                        </div>
                        <div class="col s12 l8">
                            <p class="flow-text indigo-text text-darken-4">
                                Login
                            </p>
                            <p>
                                Pastikan anda sudah memiliki akun untuk mengakses portal ini, harap isi sesuai dengan hak akses masing-masing
                            </p>
                            <form action="" method="post">
                                <div class="input-field">
                                    <?php
                                    if (isset($_GET['pesan'])) {
                                        if ($_GET['pesan'] == "gagal") {
                                            echo '<div class="row">
                <div class="col s12">
                  <div class="card-panel red darken-3 white-text">Anda Tidak Memilih Akses, Akses Harap Di isi!</div>
                </div>
              </div>';
                                        } else {
                                            echo '<div class="row">
                <div class="col s12">
                  <div class="card-panel red darken-3 white-text">Data Tidak Di Temukan, Silahkan Mendaftar Ke Admin!</div>
                </div>
              </div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" id="npk" name="npkx" required>
                                    <label for="npk">NPK</label>
                                </div>
                                <div class="input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input type="password" id="password" name="passwordx" class="materialize-textarea" required />
                                    <label for="password">Password</label>
                                </div>
                                <div class="input-field right">
                                    <input type="submit" value="Login" name="login" class="btn" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col s12" id="daftarhere">
                    <div class="row" style="margin-top: 4%;">
                        <div class="col s12 l4">
                            <center>
                                <img src="img/regis.png" class="materialboxed responsive-img circle" height="200" width="200" alt="login">
                            </center>
                        </div>
                        <div class="col s12 l8">
                            <p class="flow-text indigo-text text-darken-4">
                                Registrasi
                            </p>
                            <p>
                                Jika anda belum memiliki akun, silahkan hubungi admin sistem kami untuk dibuatkan akun.
                            </p>
                            <p>
                                <i class="material-icons left">phone_in_talk</i> 081210370349
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Modal Structure -->
    <div id="modal1" class="modal" style="max-width: 450px;">
        <div class="modal-content">
            <h6>Please Enter Your Account</h6>
            <br>
            <div class="row">
                <div class="col s12 l12 m12">
                    <ul id="tabs-swipe-demo" class="tabs">
                        <li class="tab col s6">
                            <a href="#loginhere" class="indigo-text text-darken-4 bg-light">Login</a>
                        </li>
                        <li class="tab col s6">
                            <a href="#daftarhere" class="indigo-text text-darken-4 bg-light">Registrasi</a>
                        </li>
                    </ul>
                    <div class="col s12 l12 m12" id="loginhere">
                        <div class="row" style="margin-top: 4%;">
                            <div class="col s12 l12 m12">
                                <p class="flow-text indigo-text text-darken-4">
                                    Login
                                </p>
                                <p>
                                    Pastikan anda sudah memiliki akun untuk mengakses portal ini, harap isi sesuai dengan hak akses masing-masing
                                </p>
                                <form action="" method="post">
                                    <div class="input-field">
                                        <?php
                                        if (isset($_GET['pesan'])) {
                                            if ($_GET['pesan'] == "gagal") {
                                                echo '<div class="row">
                <div class="col s12">
                  <div class="card-panel red darken-3 white-text">Anda Tidak Memilih Akses, Akses Harap Di isi!</div>
                </div>
              </div>';
                                            } else {
                                                echo '<div class="row">
                <div class="col s12">
                  <div class="card-panel red darken-3 white-text">Data Tidak Di Temukan, Silahkan Mendaftar Ke Admin!</div>
                </div>
              </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="input-field">
                                        <i class="material-icons prefix">person</i>
                                        <input type="text" id="npk" name="npkx" required />
                                        <label for="npk">NPK</label>
                                    </div>
                                    <div class="input-field">
                                        <i class="material-icons prefix">lock</i>
                                        <input type="password" id="password" name="passwordx" required />
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="input-field right">
                                        <input type="submit" value="Login" name="login" class="btn" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col s12" id="daftarhere">
                        <div class="row" style="margin-top: 4%;">
                            <div class="col s12 l12 m12">
                                <p class="flow-text indigo-text text-darken-4">
                                    Registrasi
                                </p>
                                <p>
                                    Jika anda belum memiliki akun, silahkan hubungi admin sistem kami untuk dibuatkan akun.
                                </p>
                                <p>
                                    <i class="material-icons left">phone_in_talk</i> 081210370349
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>
    <!-- footer -->
    <footer class="page-footer grey darken-3">
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
    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('.parallax').parallax();
            $('.scrollspy').scrollSpy({
                scrollOffset: 0,
            });
            $('.tabs').tabs();
            // $('.modal').modal();
            $('.modal').modal({
                onOpenEnd: function(el) {
                    $(el).find('.tabs').tabs({
                        swipeable: true
                    });
                }
            });
        });
    </script>
</body>

</html>