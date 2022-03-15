<?php
session_start();
include 'inc/koneksi.php';
include 'inc/functions.php';

if (!empty($_SESSION['id']) && !empty($_SESSION['hak_akses'])) {
    header("location: " . base_url());
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nama']) && !empty($_POST['nim'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $password = md5($_POST['nim']);

        $sql = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama, password) VALUES('$nim', '$nama', '$password')");
        if ($sql) {
            $message = alertMsg('success', 'Anda sudah terdaftar, silakan klik <a href="'.base_url('login.php').'">login</a><br>Nim: '.$nim.'<br>Password: '.$nim);
            //$_SESSION['login'] = true;
            //$_SESSION['id'] = '';//$data['iduser'];
            //$_SESSION['hak_akses'] = 'mahasiswa;
            //$_SESSION['nama'] = $row['nama];
            //header("location: " . base_url());
        } else {
            $message = alertMsg('error', 'Gagal input data');
        }
    } else {
        $message = alertMsg('error', 'Field tidak lengkap');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Register - BimSki</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />

    <?php include 'head.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="home-btn d-none d-sm-block">
        <a href="<?php echo base_url(); ?>" class="text-white"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <h5 class="font-18 text-center">Daftar Bimbingan Skripsi Mahasiswa</h5>

                <div><?php echo $message; ?></div>

                <form class="form-horizontal m-t-30" method="post" action="">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nama</label>
                            <input class="form-control" type="text" required="" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nim</label>
                            <input class="form-control" type="text" required="" name="nim" placeholder="Nim">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Register</button>
                        </div>
                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-12 m-t-10 text-center">
                            <a href="<?php echo base_url('login.php'); ?>" class="text-muted">Sudah punya akun?</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <?php include 'foot.php'; ?>

</body>

</html>