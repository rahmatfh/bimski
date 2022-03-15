<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $message = "";

    if(isset($_POST['add_bimbingan'])){
        $id_pembimbing = $_SESSION['id'];
        $mahasiswa = $_POST['mahasiswa'];
        $keterangan = $_POST['keterangan'];
        $catatan = $_POST['catatan'];

        if(!empty($_FILES['file_bimbingan']['tmp_name'])){
            $file_bimbingan = date('YmdHis').$_FILES['file_bimbingan']['name'];
            if (is_uploaded_file($_FILES['file_bimbingan']['tmp_name'])) {
				move_uploaded_file ($_FILES['file_bimbingan']['tmp_name'], "files/skripsi/".$file_bimbingan);
			}
        }else{
            $file_bimbingan = null;
        }

        $sql = mysqli_query($koneksi, "INSERT INTO bimbingan(id_mahasiswa, id_dosen, keterangan, catatan, file_bimbingan) VALUES('$mahasiswa', '$id_pembimbing', '$keterangan', '$catatan', '$file_bimbingan')");
        if($sql){
            header("location: " . base_url('?mod=bimbingan'));
            $message = alertMsg('success', 'Bimbingan telah buatkan');
        }else{
            header("location: " . base_url('?mod=bimbingan'));
            $message = alertMsg('error', 'Bimbingan gagal dibuatkan');
        }
    }

    if(isset($_POST['edit_bimbingan'])){
        $id_bimbingan = $_POST['id_bimbingan'];
        $pembimbing = $_SESSION['id'];
        $mahasiswa = $_POST['mahasiswa'];
        $keterangan = $_POST['keterangan'];
        $catatan = $_POST['catatan'];

        if (!empty($_FILES['file_bimbingan']['tmp_name'])) {
            $dataBimbingan = mysqli_query($koneksi, "SELECT * FROM bimbingan WHERE id_bimbingan='$id_bimbingan' LIMIT 1");
            $row = mysqli_fetch_assoc($dataBimbingan);
            if($row['file_bimbingan'] != ''){
                unlink("./files/skripsi/" . $row['file_bimbingan']);
            }

            $file_bimbingan = time().$_FILES['file_bimbingan']['name'];
            if (is_uploaded_file($_FILES['file_bimbingan']['tmp_name'])) {
                move_uploaded_file($_FILES['file_bimbingan']['tmp_name'], "./files/skripsi/" . $file_bimbingan);
            }
        } else {
            $dataBimbingan = mysqli_query($koneksi, "SELECT * FROM bimbingan WHERE id_bimbingan='$id_bimbingan' LIMIT 1");
            if (mysqli_num_rows($dataBimbingan) > 0) {
                $row = mysqli_fetch_assoc($dataBimbingan);
                $file_bimbingan = $row['file_bimbingan'];
            }else{
                $file_bimbingan = null;
            }
        }

        $sql = mysqli_query($koneksi, "UPDATE bimbingan SET id_mahasiswa='$mahasiswa', id_dosen='$pembimbing', keterangan='$keterangan', catatan='$catatan', file_bimbingan='$file_bimbingan' WHERE id_bimbingan='$id_bimbingan'");
        if($sql){
            header("location: " . base_url('?mod=bimbingan'));
            $message = alertMsg('success', 'Bimbingan telah diperbaharui');
        }else{
            header("location: " . base_url('?mod=bimbingan'));
            $message = alertMsg('error', 'Bimbingan gagal diperbaharui');
        }
    }

    if(isset($_POST['delete_bimbingan'])){
        $id_pembimbing = $_POST['id_bimbingan'];

        $sql = mysqli_query($koneksi, "DELETE FROM bimbingan WHERE id_bimbingan='$id_pembimbing'");
        if($sql){
            header("location: " . base_url('?mod=bimbingan'));
            $message = alertMsg('success', 'Bimbingan telah dihapus');
        }else{
            header("location: " . base_url('?mod=bimbingan'));
            $message = alertMsg('error', 'Bimbingan gagal dihapus');
        }
    }
}
?>
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Data Bimbingan</h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-addBimbingan"><i class="fas fa-plus"></i> Buat Bimbingan</button>
                                    </ol>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->

                        <div><?php echo $message; ?></div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Nim</th>
                                                    <th>Ket Bimbingan</th>
                                                    <th>Cat Bimbingan</th>
                                                    <th>Tanggal</th>
                                                    <th>File Skripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $id_pembimbing = $_SESSION['id'];
                                                $sql = mysqli_query($koneksi, "SELECT *, m.nama as nama_mahasiswa FROM bimbingan b INNER JOIN mahasiswa m ON b.id_mahasiswa=m.id_mahasiswa WHERE id_dosen='$id_pembimbing' ORDER BY id_bimbingan DESC");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nama_mahasiswa']; ?></td>
                                                        <td><?php echo $row['nim']; ?></td>
                                                        <td><?php echo $row['keterangan']; ?></td>
                                                        <td>-</td>
                                                        <td><?php echo $row['tgl_bimbingan']; ?></td>
                                                        <td><?php if($row['file_bimbingan'] != ''){ echo '<a href="'.base_url('files/skripsi/'.$row['file_bimbingan']).'" target="_blank">'.$row['file_bimbingan'].'</a>'; }else{ echo '-'; } ?></td>
                                                        <td>
                                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-editBimbingan_<?php echo $row['id_bimbingan']; ?>"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target=".modal-deleteBimbingan_<?php echo $row['id_bimbingan']; ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->

                <!-- Modal Buat Bimbingan -->
                <div class="modal fade modal-addBimbingan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">Buat Bimbingan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>Mahasiswa</label>
                                            <select class="form-control" name="mahasiswa">
                                                <?php
                                                $id_pembimbing = $_SESSION['id'];
                                                $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE pembimbing='$id_pembimbing' ORDER BY id_mahasiswa DESC");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo $row['id_mahasiswa']; ?>"><?php echo $row['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>Keterangan</label>
                                            <input class="form-control" type="text" required="" name="keterangan" placeholder="Ket bimbingan">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>File Bimbingan</label>
                                            <input class="form-control" name="file_bimbingan" type="file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>Catatan</label>
                                            <textarea class="form-control summernote" name="catatan" placeholder="Masukkan catatan..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="add_bimbingan" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- Modal Edit Bimbingan -->
                <?php
                    $id_pembimbing = $_SESSION['id'];
                    $sql = mysqli_query($koneksi, "SELECT *, m.nama as nama_mahasiswa FROM bimbingan b INNER JOIN mahasiswa m ON b.id_mahasiswa=m.id_mahasiswa WHERE id_dosen='$id_pembimbing' ORDER BY id_bimbingan DESC");
                    while ($row = mysqli_fetch_array($sql)) {
                ?>
                <div class="modal fade modal-editBimbingan_<?php echo $row['id_bimbingan']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">Perbaharui Bimbingan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input class="form-control" type="hidden" name="id_bimbingan" value="<?php echo $row['id_bimbingan']; ?>">
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>Mahasiswa</label>
                                            <select class="form-control" name="mahasiswa">
                                                <?php
                                                $id_pembimbing = $_SESSION['id'];
                                                $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE pembimbing='$id_pembimbing' ORDER BY id_mahasiswa DESC");
                                                while ($row2 = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo $row2['id_mahasiswa']; ?>" <?php ($row2['id_mahasiswa'] == $row['id_mahasiswa'] ) ? 'selected="selected"' : ''; ?>><?php echo $row2['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>Keterangan</label>
                                            <input class="form-control" type="text" required="" name="keterangan" value="<?php echo $row['keterangan']; ?>" placeholder="Ket bimbingan">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>File Bimbingan</label>
                                            <input class="form-control" name="file_bimbingan" type="file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12">
                                            <label>Catatan</label>
                                            <textarea class="form-control summernote" name="catatan" placeholder="Masukkan catatan..."><?php echo $row['catatan']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="edit_bimbingan" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <?php } ?>

                <!-- Modal Delete Bimbingan -->
                <?php
                    $id_pembimbing = $_SESSION['id'];
                    $sql = mysqli_query($koneksi, "SELECT *, m.nama as nama_mahasiswa FROM bimbingan b INNER JOIN mahasiswa m ON b.id_mahasiswa=m.id_mahasiswa WHERE id_dosen='$id_pembimbing' ORDER BY id_bimbingan DESC");
                    while ($row = mysqli_fetch_array($sql)) {
                ?>
                <div class="modal fade modal-deleteBimbingan_<?php echo $row['id_bimbingan']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0">Hapus Bimbingan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="id_bimbingan" value="<?php echo $row['id_bimbingan']; ?>">
                                <p>Yakin hapus bimbingan?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="delete_bimbingan" class="btn btn-primary">Setuju</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <?php } ?>