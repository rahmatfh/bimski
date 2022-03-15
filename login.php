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
    if (!empty($_POST['id']) && !empty($_POST['password']) && !empty($_POST['hak_akses'])) {
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $hak_akses = $_POST['hak_akses'];
        if ($hak_akses == 'admin') {
            $sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE email='$id' AND password='$password' LIMIT 1");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['login'] = true;
                $_SESSION['id'] = $row['id_admin'];
                $_SESSION['hak_akses'] = 'admin';
                $_SESSION['nama'] = $row['nama'];
                header("location: " . base_url());
            } else {
                $message = alertMsg('error', 'Id ataupun password salah');
            }
        } else if ($hak_akses == 'dosen') {
            $sql = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nidn='$id' AND password='$password' LIMIT 1");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['login'] = true;
                $_SESSION['id'] = $row['id_dosen'];
                $_SESSION['hak_akses'] = 'dosen';
                $_SESSION['nama'] = $row['nama'];
                header("location: " . base_url());
            } else {
                $message = alertMsg('error', 'Id ataupun password salah');
            }
        } else {
            $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$id' AND password='$password' LIMIT 1");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['login'] = true;
                $_SESSION['id'] = $row['id_mahasiswa'];
                $_SESSION['hak_akses'] = 'mahasiswa';
                $_SESSION['nama'] = $row['nama'];
                header("location: " . base_url());
            } else {
                $message = alertMsg('error', 'Id ataupun password salah');
            }
        }
    } else {
        $message = alertMsg('error', 'Id atau password salah');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login | BimSki UMC</title>

    <?php include 'head.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <h5 class="font-18 text-center">Sign in to continue to BimSKi.</h5>

                <div><?php echo $message; ?></div>

                <form class="form-horizontal m-t-30" method="post" action="">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nim/Nidn/Email</label>
                            <input class="form-control" type="text" required="" name="id" placeholder="Masukkan Nim/Nidn/Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Sebagai</label>
                            <select class="form-control" name="hak_akses">
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <div class="form-group row m-t-30 m-b-0">
                        <div class="col-sm-7">
                            <!--<a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>-->
                        </div>
                        <div class="col-sm-5 text-right">
                            <a href="<?php echo base_url('register.php'); ?>" class="text-muted">Create an account</a>
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