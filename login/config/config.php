<?php
$error = '';
date_default_timezone_set("Asia/Jakarta");
class config
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "kim";
        $user = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);
    }
    public function showReport()
    {
        $query = $this->db->prepare("SELECT * FROM report order by input_date desc");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showAkun()
    {
        $query = $this->db->prepare("SELECT * FROM akun");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showTipe()
    {
        $query = $this->db->prepare("SELECT * FROM tipe");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPagination($limit, $limit_start)
    {
        $query = $this->db->prepare("SELECT * FROM akun LIMIT " . $limit_start . "," . $limit);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPagination2($limit, $limit_start)
    {
        $query = $this->db->prepare("SELECT * FROM report order by input_date desc LIMIT " . $limit_start . "," . $limit);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPagination5($limit, $limit_start)
    {
        $query = $this->db->prepare("SELECT * FROM tipe LIMIT " . $limit_start . "," . $limit);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPagination3($cari, $limit, $limit_start)
    {
        $query = $this->db->prepare("SELECT * FROM akun where nama like '%" . $cari . "%' or negara like '%" . $cari . "%' LIMIT " . $limit_start . "," . $limit);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPagination4($cari, $limit, $limit_start)
    {
        $query = $this->db->prepare("SELECT * FROM report where tipe like '%" . $cari . "%' or judge like '%" . $cari . "%' LIMIT " . $limit_start . "," . $limit);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPagination6($cari, $limit, $limit_start)
    {
        $query = $this->db->prepare("SELECT * FROM tipe where tipe_name like '%" . $cari . "%' LIMIT " . $limit_start . "," . $limit);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showAkunSearch($cari)
    {
        $query = $this->db->prepare("select * from akun where nama like '%" . $cari . "%' or negara like '%" . $cari . "%'");
        $query->bindParam(1, $cari);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showReportSearch($cari)
    {
        $query = $this->db->prepare("select * from report where tipe like '%" . $cari . "%' or judge like '%" . $cari . "%' ");
        $query->bindParam(1, $cari);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function hitungPage()
    {
        $query = $this->db->prepare("SELECT COUNT(id_akun)
        FROM akun");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPage2()
    {
        $query = $this->db->prepare("SELECT COUNT(id_report)
        FROM report");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPage5()
    {
        $query = $this->db->prepare("SELECT COUNT(id_tipe)
        FROM tipe");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPage3($cari)
    {
        $query = $this->db->prepare("SELECT COUNT(id_report)
        FROM report where tipe like '%" . $cari . "%' or judge like '%" . $cari . "%' ");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    public function hitungPage4($cari)
    {
        $query = $this->db->prepare("SELECT COUNT(id_akun)
        FROM akun where nama like '%" . $cari . "%' or negara like '%" . $cari . "%' ");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    public function hitungPage6($cari)
    {
        $query = $this->db->prepare("SELECT COUNT(id_tipe)
        FROM tipe where tipe_name like '%" . $cari . "%'");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    public function get_by_id_pengguna($kd_pengguna)
    {
        $query = $this->db->prepare("SELECT * FROM akun where id_akun=?");
        $query->bindParam(1, $kd_pengguna);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_pengguna2($kd_pengguna)
    {
        $query = $this->db->prepare("SELECT * FROM akun where id_akun=?");
        $query->bindParam(1, $kd_pengguna);
        $query->execute();
        return $query->fetchAll();
    }
    public function get_by_id_report($kd_report)
    {
        $query = $this->db->prepare("SELECT * FROM report where id_report=?");
        $query->bindParam(1, $kd_report);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_tipe($kd_tipe)
    {
        $query = $this->db->prepare("SELECT * FROM tipe where id_tipe=?");
        $query->bindParam(1, $kd_tipe);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_tipe2($kd_tipe)
    {
        $query = $this->db->prepare("SELECT * FROM tipe where id_tipe=?");
        $query->bindParam(1, $kd_tipe);
        $query->execute();
        return $query->fetchAll();
    }
    //REGISTRASI AKUN
    public function registrasiPengguna($nama, $npk, $pass, $map, $aks, $negara)
    {
        $id = date("Ymds");
        if (!isset($error)) {
            $data = $this->db->prepare('INSERT INTO akun (id_akun, nama, npk, pass, alamat, akses, negara) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $data->bindParam(1, $id);
            $data->bindParam(2, $nama);
            $data->bindParam(3, $npk);
            $data->bindParam(4, $pass);
            $data->bindParam(5, $map);
            $data->bindParam(6, $aks);
            $data->bindParam(7, $negara);

            $data->execute();
            return $data->rowCount();
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>";
            exit();
        }
    }
    //REGISTRASI Tipe
    public function registrasiTipe($tn)
    {
        $name = "TP";
        $id = $name . date("Ymds");
        $create_at = date("Ymds");

        if (!isset($error)) {
            $data = $this->db->prepare('INSERT INTO tipe (id_tipe, tipe_name, create_at) VALUES (?, ?, ?)');
            $data->bindParam(1, $id);
            $data->bindParam(2, $tn);
            $data->bindParam(3, $create_at);

            $data->execute();
            return $data->rowCount();
        } else {
            echo "<script>alert('Gagal Mengirim Data!')</script>";
            exit();
        }
    }
    //Buat Report penggunaan : form_pm.php
    public function buatReport(
        $idx,
        $akun,
        $id,
        $type,
        $jg,
        $afterR,
        $defectx,
        $foto,
        $ukuran_file,
        $tipe_file,
        $tmp,
        $sizex,
        $arx,
        $subx,
        $smdx,
        $isq,
        $rmdx,
        $irmx,
        $ismx
    ) {
        $limit = 90 * 1024 * 1024;
        $foto_ket = date('dmYHis') . $foto;
        $path = "../../img/picture_report/" . $foto_ket;
        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
            if ($ukuran_file <= $limit) {
                if (move_uploaded_file($tmp, $path)) {
                    $sql = $this->db->prepare("INSERT INTO report(id_report, id_akun, input_date, id_tipe, judge, after_repair, defect, picture, size, area, sub_area, smd, ism, rmd , irm, isk) VALUES(:id_reportx, :id_akunx, :input_datex, :tipex, :judgex, :after_repairx, :defectx, :picturex, :sizex, :areax, :sub_areax, :smdx, :ismx, :rmdx , :irmx, :isk)");
                    $sql->bindParam(':id_reportx', $idx);
                    $sql->bindParam(':id_akunx', $akun);
                    $sql->bindParam(':input_datex', $id);
                    $sql->bindParam(':tipex', $type);
                    $sql->bindParam(':judgex', $jg);
                    $sql->bindParam(':after_repairx', $afterR);
                    $sql->bindParam(':defectx', $defectx);
                    $sql->bindParam(':picturex', $foto_ket);
                    $sql->bindParam(':sizex', $sizex);
                    $sql->bindParam(':areax', $arx);
                    $sql->bindParam(':sub_areax', $subx);
                    $sql->bindParam(':smdx', $smdx);
                    $sql->bindParam(':ismx', $isq);
                    $sql->bindParam(':rmdx', $rmdx);
                    $sql->bindParam(':irmx', $irmx);
                    $sql->bindParam(':isk', $ismx);
                    $sql->execute();

                    if ($sql) {
                        echo "<script type='text/javascript'>alert('Berhasil Membuat Report!');window.location.href = '../admin/data_report.php';</script>"; //redirect halaman
                    } else {
                        echo "<script type='text/javascript'>alert('Gagal Membuat Report!');window.location.href = '../admin/form_pm.php';</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Gagal mengupload file!');window.location.href = '../admin/form_pm.php';</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Size tidak boleh lebih dari 2 Mb!');window.location.href = '../admin/data_report.php';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Gambar yang diupload harus ber ekstensi JPG/JPEG/PNG');window.location.href = '../admin/data_report.php';</script>";
        }
    }
    public function ubahDataReport(
        $id,
        $akun,
        $tipex,
        $jg,
        $afterR,
        $defectx,
        $foto,
        $ukuran_file,
        $tipe_file,
        $tmp,
        $sizex,
        $arx,
        $subx,
        $smdx,
        $isq,
        $rmdx,
        $irmx,
        $ismx,
        $idx
    ) {
        if (empty($foto)) {
            $queryUpdate = $this->db->prepare('UPDATE report set id_akun=?, input_date=?, id_tipe=?, judge=?, after_repair=?, defect=?, size=?, area=?, sub_area=?, smd=?, ism=?, rmd=?, irm=?, isk=?  where id_report=?');
            $queryUpdate->bindParam(1, $akun);
            $queryUpdate->bindParam(2, $id);
            $queryUpdate->bindParam(3, $tipex);
            $queryUpdate->bindParam(4, $jg);
            $queryUpdate->bindParam(5, $afterR);
            $queryUpdate->bindParam(6, $defectx);
            $queryUpdate->bindParam(7, $sizex);
            $queryUpdate->bindParam(8, $arx);
            $queryUpdate->bindParam(9, $subx);
            $queryUpdate->bindParam(10, $smdx);
            $queryUpdate->bindParam(11, $isq);
            $queryUpdate->bindParam(12, $rmdx);
            $queryUpdate->bindParam(13, $irmx);
            $queryUpdate->bindParam(14, $ismx);
            $queryUpdate->bindParam(15, $idx);
            $queryUpdate->execute();
            if ($queryUpdate) {
                echo "<script type='text/javascript'>alert('Berhasil Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>"; //redirect halaman
            } else {
                echo "<script type='text/javascript'>alert('Gagal Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>";
            }
        } else {
            $limit = 90 * 1024 * 1024;
            $foto_ket = date('dmYHis') . $foto;
            $path = "../../img/picture_report/" . $foto_ket;
            if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") {
                if ($ukuran_file <= $limit) {
                    if (move_uploaded_file($tmp, $path)) {
                        $query = $this->db->prepare("SELECT * FROM report where id_report=?");
                        $query->bindParam(1, $idx);
                        $query->execute();
                        $data = $query->fetch();
                        if (is_file("../../img/picture_report/" . $data['picture'])) {
                            unlink("../../img/picture_report/" . $data['picture']);
                        }
                        $queryUpdate = $this->db->prepare('UPDATE report set id_akun=?, input_date=?, id_tipe=?, judge=?, after_repair=?, defect=? , picture=?, size=?, area=?, sub_area=?, smd=?, ism=?, rmd=?, irm=?, isk=? where id_report=?');
                        $queryUpdate->bindParam(1, $akun);
                        $queryUpdate->bindParam(2, $id);
                        $queryUpdate->bindParam(3, $tipex);
                        $queryUpdate->bindParam(4, $jg);
                        $queryUpdate->bindParam(5, $afterR);
                        $queryUpdate->bindParam(6, $defectx);
                        $queryUpdate->bindParam(7, $foto_ket);
                        $queryUpdate->bindParam(8, $sizex);
                        $queryUpdate->bindParam(9, $arx);
                        $queryUpdate->bindParam(10, $subx);
                        $queryUpdate->bindParam(11, $smdx);
                        $queryUpdate->bindParam(12, $isq);
                        $queryUpdate->bindParam(13, $rmdx);
                        $queryUpdate->bindParam(14, $irmx);
                        $queryUpdate->bindParam(15, $ismx);
                        $queryUpdate->bindParam(16, $idx);

                        $queryUpdate->execute();

                        if ($queryUpdate) {
                            echo "<script type='text/javascript'>alert('Berhasil Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>"; //redirect halaman
                        } else {
                            echo "<script type='text/javascript'>alert('Gagal Mengubah Data Report!');window.location.href = '../admin/data_report.php';</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('Gagal mengupload file!');window.location.href = '../admin/data_report.php';</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Size tidak boleh lebih dari 2 Mb!');window.location.href = '../admin/data_report.php';</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Gambar yang diupload harus ber ekstensi JPG/JPEG/PNG');window.location.href = '../admin/data_report.php';</script>";
            }
        }
    }
    public function ubahDataTipe($id, $tn)
    {
        $uat = date('dmYHis');
        $queryUpdate = $this->db->prepare('UPDATE tipe set tipe_name=?, update_at=?  where id_tipe=?');
        $queryUpdate->bindParam(1, $tn);
        $queryUpdate->bindParam(2, $uat);
        $queryUpdate->bindParam(3, $id);
        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function ubahDataAkun($id, $nama, $npk, $map, $aks, $negara)
    {
        $queryUpdate = $this->db->prepare('UPDATE akun set nama=?, npk=?, alamat=?, akses=?,  negara=?  where id_akun=?');
        $queryUpdate->bindParam(1, $nama);
        $queryUpdate->bindParam(2, $npk);
        $queryUpdate->bindParam(3, $map);
        $queryUpdate->bindParam(4, $aks);
        $queryUpdate->bindParam(5, $negara);
        $queryUpdate->bindParam(6, $id);
        $queryUpdate->execute();
        if ($queryUpdate) {
            echo "<script type='text/javascript'>alert('Berhasil Mengubah Data Pengguna!');window.location.href = '../admin/data_akun.php';</script>"; //redirect halaman
        } else {
            echo "<script type='text/javascript'>alert('Gagal Mengubah Data Pengguna!');window.location.href = '../admin/form_akun.php';</script>";
        }
    }

    public function deletePengguna($kd_pengguna)
    {
        $query = $this->db->prepare("DELETE FROM akun where id_akun=?");

        $query->bindParam(1, $kd_pengguna);

        $query->execute();
        return $query->rowCount();
    }

    public function deleteTipe($kd_tipe)
    {
        $query = $this->db->prepare("DELETE FROM tipe where id_tipe=?");

        $query->bindParam(1, $kd_tipe);

        $query->execute();
        return $query->rowCount();
    }

    public function deleteReport($kd_report)
    {
        $sql = $this->db->prepare("SELECT picture FROM report WHERE id_report=:id");
        $sql->bindParam(':id', $kd_report);
        $sql->execute();
        $data = $sql->fetch();
        if (is_file("../../img/picture_report/" . $data['picture']))
            unlink("../../img/picture_report/" . $data['picture']);
        $query = $this->db->prepare("DELETE FROM report where id_report=?");

        $query->bindParam(1, $kd_report);

        $query->execute();
        return $query->rowCount();
    }

    public function showLastHistoryTipe()
    {
        $query = $this->db->prepare("SELECT * FROM tipe ORDER BY create_at DESC LIMIT 1");
        $query->execute();
        $data = $query->fetch();
        return $data;
    }
}
