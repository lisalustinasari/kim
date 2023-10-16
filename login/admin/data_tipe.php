<?php
date_default_timezone_set("Asia/Jakarta");
include('../config/config.php');
$lib = new config();
$data_tipe_all = $lib->showTipe();
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

if (isset($_GET['cari'])) {
    $nama = $_GET['cari'];
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 5;
    $limit_start = ($page - 1) * $limit;
    $value = 1;
    $data_tipe = $lib->showPagination6($nama, $limit, $limit_start);
    $data_tipe_count_search = $lib->hitungPage6($nama);
} else {
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 10;
    $limit_start = ($page - 1) * $limit;
    $data_tipe = $lib->showPagination5($limit, $limit_start);
}

if (isset($_GET['id'])) {
    $kd_pengguna = $_GET['id'];
    $status_hapus = $lib->deleteTipe($kd_pengguna);
    if ($status_hapus) {
        echo "<script type='text/javascript'>alert('Berhasil Mengapus Data!');window.location.href = 'data_tipe.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Gagal Mengapus Data!');window.location.href = 'data_tipe.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicons-->
    <link rel="icon" href="../../img/icons.png" sizes="32x32" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <title>Data Tipe | KIM</title>
    <style>
        .judul {
            font-family: 'Patua One', cursive;
        }

        .section {
            padding-top: 4vw;
            padding-bottom: 4vw;
        }

        .report td,
        .report th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #data-table-simple th,
        td {
            white-space: nowrap;
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
                    <li><a href="../config/logout.php">Logout</a></li>
                </ul>
                <ul class="sidenav" id="mobile-menu">
                    <li><a href="data_report.php" class="active">Report</a></li>
                    <li><a href="data_akun.php" class="active">Data Akun</a></li>
                    <li><a href="data_tipe.php" class="active">Data Tipe</a></li>
                    <li><a href="../config/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h4 class="teal-text text-darken-2 container section judul">Data Tipe</h4>
    <section class="container section scrollspy">
        <div class="row">
            <div class="col s12 l12 m12">
                <a class="btn-floating btn-medium waves-effect waves-light green pulse tooltipped" href="form_tipe.php" data-position="top" data-tooltip="Tambah Tipe Data Baru"><i class="material-icons">add</i></a>
                <!-- Modal Trigger -->
                <a class="btn-floating pulse waves-effect waves-light btn right modal-trigger blue tooltipped" href="#modal1" data-position="top" data-tooltip="Info"><i class="material-icons">info</i></a>
            </div>
        </div>
        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Info</h4>
                <p><b>1. Tambah Data</b> jika ingin menambahkan data pengguna silahkan klik tombol plus berwarna hijau, tombol tersebut berada disamping tombol info.</p>
                <p><b>2. Ubah Data</b> jika ingin menagubah data pengguna silahkan klik tombol pensil berwarna biru yang berada didalam tabel, pilih tabel mana yang ingin di ubah.</p>
                <p><b>3. Hapus Data</b> jika ingin menghapus data pengguna silahkan klik tombol tempat sampah berwarna merah yang berada didalam tabel, pilih tabel data mana yang ingin dihapus</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Mengerti</a>
            </div>
        </div>
        <div class="row">
            <div class="col offset-l8 l4 s12">
                <form action="" method="GET">
                    <div class="input-field">
                        <input placeholder="nama" id="search" type="text" name="cari" class="validate">
                        <label for="search">Search</label>
                    </div>
                </form>
            </div>
            <div class="col s12 l12 m12">
                <?php
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    echo "<p>Hasil pencarian : <b>" . $cari . "</b></p>";
                }
                ?>
            </div>
            <div class="col s12 l12" style="overflow-x:auto ;">

                <table id="data-table-simple" class="report highlight centered striped" cellspacing="0" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = $limit_start + 1;
                        foreach ($data_tipe as $row) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['tipe_name'] . "</td>";
                            echo "<td>
                                                        <a href='form_ubah_tipe.php?id=" . $row['id_tipe'] . "' class='btn waves-effect waves-light blue'><i class='material-icons'>edit</i></a>
                                                        <a href='data_tipe.php?id=" . $row['id_tipe'] . "' class='btn waves-effect waves-light red'><i class='material-icons'>delete</i></a>
                                                        </td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col s12 l12 m12" style="margin-top:4px;">
                <?php
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    echo "Ditampilkan <b>" . count($data_tipe) . "</b> dari sekitar <b>" . $data_tipe_count_search . "</b>";
                }
                ?>
            </div>
            <div class="row right">
                <div class="col s12 l12 m12">
                    <ul class="pagination">
                        <!-- LINK FIRST AND PREV -->
                        <?php
                        if (isset($value) == 1) {
                            if ($page == 1) {
                        ?>
                                <li class="disabled"><a href="#>"><i class="material-icons">chevron_left</i></a></li>
                            <?php
                            } else {
                                $link_prev = ($page > 1) ? $page - 1 : 1;
                            ?>
                                <li class="waves-effect"><a href="data_tipe.php?cari=<?= $cari; ?>&page=1&page=<?php echo $link_prev; ?>"><i class="material-icons">chevron_left</i></a></li>
                            <?php
                            }
                        } else {
                            if ($page == 1) {
                            ?>
                                <li class="disabled"><a href="#>"><i class="material-icons">chevron_left</i></a></li>
                            <?php
                            } else {
                                $link_prev = ($page > 1) ? $page - 1 : 1;
                            ?>
                                <li class="waves-effect"><a href="data_tipe.php?page=1&page=<?php echo $link_prev; ?>"><i class="material-icons">chevron_left</i></a></li>
                        <?php }
                        } ?>

                        <!-- LINK NUMBER -->
                        <?php
                        if (isset($value) == 1) {
                            $hitungAkunSearch = $lib->hitungPage6($cari);
                            $jumlah_page = ceil($hitungAkunSearch / $limit);
                            $jumlah_number = 3;
                            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
                            $temp = 1;
                        } else {
                            $hitungPengguna = $lib->hitungPage5();
                            $jumlah_page = ceil($hitungPengguna / $limit);
                            $jumlah_number = 3;
                            $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                            $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;
                        }
                        if (isset($temp) == 1) {
                            for ($i = $start_number; $i <= $end_number; $i++) {
                                $link_active = ($page == $i) ? ' class="active teal"' : '';
                        ?>
                                <li<?php echo $link_active; ?>><a href="data_tipe.php?cari=<?= $cari; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                        } else {
                            for ($i = $start_number; $i <= $end_number; $i++) {
                                $link_active = ($page == $i) ? ' class="active teal"' : '';
                                ?>
                                    <li<?php echo $link_active; ?>><a href="data_tipe.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                        }
                                ?>

                                <!-- LINK NEXT AND LAST -->
                                <?php
                                if (isset($temp) == 1) {
                                    if ($page == $jumlah_page) {
                                ?>
                                        <li class="disabled"><a href="#"><i class="material-icons">chevron_right</i></a></li>
                                    <?php
                                    } else {
                                        $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                                    ?>
                                        <li class="waveseffect"><a href="data_tipe.php?cari=<?= $cari; ?>&page=<?php echo $link_next; ?>&page=<?php echo $link_next; ?>"><i class="material-icons">chevron_right</i></a></li>
                                    <?php
                                    }
                                } else {
                                    if ($page == $jumlah_page) {
                                    ?>
                                        <li class="disabled"><a href="#"><i class="material-icons">chevron_right</i></a></li>
                                    <?php
                                    } else {
                                        $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                                    ?>
                                        <li class="waveseffect"><a href="data_tipe.php?page=<?php echo $link_next; ?>&page=<?php echo $link_next; ?>"><i class="material-icons">chevron_right</i></a></li>

                                <?php }
                                } ?>
                    </ul>
                </div>
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
        $(document).ready(function() {
            $(".sidenav").sidenav();
            $('.scrollspy').scrollSpy();
            $(".slider").slider();
            $('select').formSelect();
            $('.modal').modal();
            $('.tooltipped').tooltip();
        });
        $(document).ready(function() {
            $('#data-table-simple').DataTables({
                "scrollX": true,
                "scrollY": true,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>

</html>