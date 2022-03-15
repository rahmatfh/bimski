<?php
date_default_timezone_set("Asia/Jakarta");
function sanitize($input) {
    $input = trim(htmlentities(strip_tags($input,",")));
    $val = stripslashes($input);

    return $val;
}

function alertMsg($status, $message){
  if($status == "success"){
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.'</div>';
  }else{
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$message.'</div>';
  }
  return $alert;
}

function base_url($query=null){
  if($query != null){
    return "http://localhost/bimbingan/".$query;
  }else{
    return "http://localhost/bimbingan/";
  }
}

function logout(){
  unset($_SESSION['login']);
		unset($_SESSION['id']);
		unset($_SESSION['hak_akses']);
		unset($_SESSION['nama']);
		session_destroy();
		header("location: ".base_url('login.php'));
		exit();
}

?>
