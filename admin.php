<?php
    ob_start();
    //cek session
    session_start();

    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
?>
<!--

Name        : Aplikasi Sederhana Manajemen Surat Menyurat
Version     : v1.0.1
Description : Aplikasi untuk mencatat data surat masuk dan keluar secara digital.
Date        : 2016
Developer   : M. Rudianto
Phone/WA    : 0852-3290-4156
Email       : rudi@masrud.com
Website     : https://masrud.com

-->
<!doctype html>
<html lang="en">

<!-- Include Head START -->
<?php include('include/head.php'); ?>
<!-- Include Head END -->

<!-- Body START -->
<body class="bg">

<!-- Header START -->
<header>

<!-- Include Navigation START -->
<?php include('include/menu.php'); ?>
<!-- Include Navigation END -->

</header>
<!-- Header END -->

<!-- Main START -->
<main>

    <!-- container START -->
    <div class="container">

    <?php
        if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            switch ($page) {
                case 'tsm':
                    include "transaksi_surat_masuk.php";
                    break;
                case 'ctk':
                    include "cetak_disposisi.php";
                    break;
                case 'tsk':
                    include "transaksi_surat_keluar.php";
                    break;
                case 'asm':
                    include "agenda_surat_masuk.php";
                    break;
                case 'ask':
                    include "agenda_surat_keluar.php";
                    break;
                case 'ref':
                    include "referensi.php";
                    break;
                case 'sett':
                    include "pengaturan.php";
                    break;
                case 'pro':
                    include "profil.php";
                    break;
                case 'gsm':
                    include "galeri_sm.php";
                    break;
                case 'gsk':
                    include "galeri_sk.php";
                    break;
                case 'tsmp':
                    include "transaksi_surat_masuk_public.php";
                    break;
                case 'tskp':
                    include "transaksi_surat_keluar_public.php";
                    break;
            }
        } else {
    ?>
        <!-- Row START -->
        <div class="row">

            <!-- Include Header Instansi START -->
            <?php include('include/header_instansi.php'); ?>
            <!-- Include Header Instansi END -->

            <!-- Welcome Message START -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>Selamat Datang <?php echo $_SESSION['nama']; ?></h4>
                        <p class="description">Anda login sebagai
                        <?php
                            if($_SESSION['admin'] == 1){
                                echo "<strong>Super Admin</strong>. Anda memiliki akses penuh terhadap sistem.";
                            } elseif($_SESSION['admin'] == 2){
                                echo "<strong>Administrator</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            } else {
                                echo "<strong>Petugas Disposisi</strong>. Berikut adalah statistik data yang tersimpan dalam sistem.";
                            }?></p>
                    </div>
                </div>
            </div>
            <!-- Welcome Message END -->

            <?php
                //menghitung jumlah surat masuk
                $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_masuk"));

                //menghitung jumlah surat masuk
                //$count6 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE status_publish = '0'"));

                //menghitung jumlah surat keluar private
                //$count7 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE status_publish = '0'"));

                //menghitung jumlah surat masuk
                $count2 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_keluar"));

                //menghitung jumlah surat masuk
                $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_disposisi"));

                //menghitung jumlah klasifikasi
                $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_klasifikasi"));

                //menghitung jumlah pengguna
                $count5 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_user"));
            ?>
            <!-- table surat masuk public -->
            <div class="col s6">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Isi Surat</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <?php $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE status_publish = '0' AND tgl_diterima >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY ORDER BY tgl_surat DESC LIMIT 5");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                          echo '
                          <tbody>
                          <tr>
                            <td>'.$row['tgl_surat'].'</td>
                            <td>'.substr($row['isi'],0,200).'</td>
                            <td>
                                <a class="btn small blue waves-effect waves-light" href="?page=gsm&act=fsm&id_surat='.$row['id_surat'].'">
                                <i class="small material-icons">details</i></a>
                            </td>
                          </tr>
                          </tbody>';
                        }
                    }else{
                        echo '
                        <tr>
                            <td colspan="3">belum ada data terbaru</td>
                        </tr>
                        ';
                    }
                    ?>
                </table><br/>
            </div>
            <!-- table surat keluar public -->
            <div class="col s6">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Isi Surat</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <?php $query = mysqli_query($config, "SELECT * FROM tbl_surat_keluar WHERE status_publish = '0' AND tgl_catat >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY ORDER BY tgl_catat DESC LIMIT 5");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                          echo '
                          <tbody>
                          <tr>
                            <td>'.$row['tgl_surat'].'</td>
                            <td>'.substr($row['isi'],0,200).'</td>
                            <td>
                                <a class="btn small blue waves-effect waves-light" href="?page=gsk&act=fsk&id_surat='.$row['id_surat'].'">
                                <i class="small material-icons">details</i></a>
                            </td>
                          </tr>
                          </tbody>';
                        }
                    }else{
                        echo '
                        <tr>
                            <td colspan="3">belum ada data terbaru</td>
                        </tr>
                        ';
                    }
                    ?>
                </table><br/>
            </div>
            <!-- Info Statistic START -->
            <div class="col s12">
                <a href="?page=tsm">
                    <div class="col s12 m3">
                        <div class="card cyan">
                            <div class="card-content">
                                <span class="card-title white-text" style="font-size:20px;"><i class="material-icons md-36">mail</i> Jumlah Surat Masuk</span>
                                <?php echo '<h5 class="white-text link">'.$count1.' Surat Masuk</h5>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="?page=tsk">
                    <div class="col s12 m3">
                        <div class="card lime darken-1">
                            <div class="card-content">
                                <span class="card-title white-text" style="font-size:20px;"><i class="material-icons md-36">drafts</i> Jumlah Surat Keluar</span>
                                <?php echo '<h5 class="white-text link">'.$count2.' Surat Keluar</h5>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <div class="col s12 m3">
                <div class="card yellow darken-3">
                    <div class="card-content">
                        <span class="card-title white-text" style="font-size:20px;"><i class="material-icons md-36">description</i> Jumlah Disposisi</span>
                        <?php echo '<h5 class="white-text link">'.$count3.' Disposisi</h5>'; ?>
                    </div>
                </div>
            </div>
            <a href="?page=ref">
                <div class="col s12 m3">
                    <div class="card deep-orange">
                        <div class="card-content">
                            <span class="card-title white-text" style="font-size:18px;"><i class="material-icons md-36">class</i> Jumlah Klasifikasi Surat</span>
                            <?php echo '<h5 class="white-text link">'.$count4.' Klasifikasi Surat</h5>'; ?>
                        </div>
                    </div>
                </div>
            </a>
            </div>
        <?php
            if($_SESSION['id_user'] == 1 || $_SESSION['admin'] == 2){?>
                <a href="?page=sett&sub=usr">
                    <div class="col s12 m4">
                        <div class="card blue accent-2">
                            <div class="card-content">
                                <span class="card-title white-text"><i class="material-icons md-36">people</i> Jumlah Pengguna</span>
                                <?php echo '<h5 class="white-text link">'.$count5.' Pengguna</h5>'; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <!-- Info Statistic START -->
        <?php
            }
        ?>


        </div>
        <!-- Row END -->
    <?php
        }
    ?>
    </div>
    <!-- container END -->

</main>
<!-- Main END -->

<!-- Include Footer START -->
<?php include('include/footer.php'); ?>
<!-- Include Footer END -->

</body>
<!-- Body END -->

</html>

<?php
    }
?>
