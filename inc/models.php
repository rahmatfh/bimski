<?php
include 'inc/koneksi.php';

function getNamaDosen($konek, $idos){
    $data_dosen = mysqli_query($konek, "SELECT * FROM dosen WHERE id_dosen='$idos' LIMIT 1");
    $e_dsn = mysqli_fetch_assoc($data_dosen);
    return $e_dsn['nama'];
}