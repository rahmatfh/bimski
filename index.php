<?php
session_start();

include 'inc/koneksi.php';
include 'inc/models.php';
include 'inc/functions.php';

if($_SESSION['hak_akses'] == 'admin'){
	define('MODULE_PATH','modules/admin/');
}else if($_SESSION['hak_akses'] == 'dosen'){
	define('MODULE_PATH','modules/dosen/');
}else{
	define('MODULE_PATH','modules/mahasiswa/');
}

if(empty($_SESSION['id']) && empty($_SESSION['hak_akses'])){
	header("location: ".base_url('login.php'));
  exit();
}

//deklarsi pathinfo
if(empty($_GET['mod'])){
	$mod = MODULE_PATH . 'dashboard';
}else{
	$mod=sanitize($_GET['mod']);
	if ($mod == "") {
	  $mod = MODULE_PATH . 'dashboard';
	} else {
	  if (preg_match('/_/i', $mod)) {
		  $modname = explode('_', $mod);
		  $mod = MODULE_PATH . $modname[0] . '/' . $mod;
	  } else {

		  $mod = MODULE_PATH . $mod;
	  }
	}
}

//deklarsi title
if(empty($_GET['mod'])){
	$title = "Dahboard | BimSki UMC";
}else if($_GET['mod'] == "dahboard"){
	$title = "Dahboard | BimSki";
}else if($_GET['mod'] == "bimbingan"){
	$title = "Data Bimbingan | BimSki UMC";
}else if($_GET['mod'] == "admin"){
	$title = "Data Admin | BimSki UMC";
}else if($_GET['mod'] == "dosen"){
	$title = "Data Dosen | BimSki UMC";
}else if($_GET['mod'] == "mahasiswa"){
	$title = "Data Mahasiswa | BimSki UMC";
}else if($_GET['mod'] == "fakultas"){
	$title = "Data Fakultas | BimSki UMC";
}else if($_GET['mod'] == "prodi"){
	$title = "Data Prodi | BimSki UMC";
}else{
	$title = "Halaman Tidak Ditemukan | UAS Web Lanjut";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$message = "";

    if(isset($_POST['ganti_password'])){
		$id_user = $_SESSION['id'];
		$hak_akses = $_SESSION['level'];
		$password_lama = md5($_POST['password_lama']);
		$password_baru = md5($_POST['password_baru']);

		if($hak_akses == 'admin'){
			$cekpass_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id_user' AND password='$password_lama' LIMIT 1");
			if (mysqli_num_rows($cekpass_admin) > 0) {
				$sql = mysqli_query($koneksi, "UPDATE admin SET password='$password_baru' WHERE id_admin='$id_user'");
				if($sql){
					$message = alertMsg('success', 'Password berhasil diganti');
					echo logout();
					header("location: " . base_url('login.php'));
				}else{
					$message = alertMsg('error', 'Password gagal diganti');
				}
			}else{
				$message = alertMsg('error', 'Password lama salah');
			}
		}else if($hak_akses == 'dosen'){
			$cekpass_dosen = mysqli_query($koneksi, "SELECT * FROM dosen WHERE id_dosen='$id_user' AND password='$password_lama' LIMIT 1");
			if (mysqli_num_rows($cekpass_dosen) > 0) {
				$sql = mysqli_query($koneksi, "UPDATE dosen SET password='$password_baru' WHERE id_dosen='$id_user'");
				if($sql){
					$message = alertMsg('success', 'Password berhasil diganti');
					echo logout();
					header("location: " . base_url('login.php'));
				}else{
					$message = alertMsg('error', 'Password gagal diganti');
				}
			}else{
				$message = alertMsg('error', 'Password lama salah');
			}
		}else{
			$cekpass_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id_user' AND password='$password_lama' LIMIT 1");
			if (mysqli_num_rows($cekpass_mahasiswa) > 0) {
				$sql = mysqli_query($koneksi, "UPDATE mahasiswa SET password='$password_baru' WHERE id_mahasiswa='$id_user'");
				if($sql){
					$message = alertMsg('success', 'Password berhasil diganti');
					echo logout();
					header("location: " . base_url('login.php'));
				}else{
					$message = alertMsg('error', 'Password gagal diganti');
				}
			}else{
				$message = alertMsg('error', 'Password lama salah');
			}
		}
	}

	if(isset($_POST['logout_account'])){
		echo logout();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?php echo $title; ?></title>
    
    <?php include 'head.php'; ?>

</head>

<body>

    <div id="wrapper">

        <?php include 'topbar.php'; ?>

        <?php include 'sidebar.php'; ?>

        <div class="content-page">
            <?php include 'content.php'; ?>

            <?php include 'footer.php'; ?>

        </div>

    </div>

    <?php include 'foot.php'; ?>

</body>

</html>
