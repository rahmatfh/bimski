<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";

    if (isset($_POST['add_dosen'])) {
        $nidn = $_POST['nidn'];
        $nama = $_POST['nama'];
        $password = md5($_POST['nidn']);

        $sql = mysqli_query($koneksi, "INSERT INTO dosen(nidn, nama, password) VALUES('$nidn', '$nama', '$password')");
        if ($sql) {
            header("location: " . base_url('?mod=dosen'));
            $message = alertMsg('success', 'Dosen telah ditambahkan');
        } else {
            header("location: " . base_url('?mod=dosen'));
            $message = alertMsg('error', 'Dosen gagal ditambahakan');
        }
    }

    if (isset($_POST['edit_dosen'])) {
        $id_dosen = $_POST['id_dosen'];
        $nidn = $_POST['nidn'];
        $nama = $_POST['nama'];

        $sql = mysqli_query($koneksi, "UPDATE dosen SET nidn='$nidn', nama='$nama' WHERE id_dosen='$id_dosen'");
        if ($sql) {
            header("location: " . base_url('?mod=dosen'));
            $message = alertMsg('success', 'Dosen telah diperbaharui');
        } else {
            header("location: " . base_url('?mod=dosen'));
            $message = alertMsg('error', 'Dosen gagal diperbaharui');
        }
    }

    if (isset($_POST['delete_dosen'])) {
        $id_dosen = $_POST['id_dosen'];

        $sql = mysqli_query($koneksi, "DELETE FROM dosen WHERE id_dosen='$id_dosen'");
        if ($sql) {
            header("location: " . base_url('?mod=dosen'));
            $message = alertMsg('success', 'Dosen telah dihapus');
        } else {
            header("location: " . base_url('?mod=dosen'));
            $message = alertMsg('error', 'Dosen gagal dihapus');
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
                    <h4 class="page-title">Data Dosen</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-addDosen"><i class="fas fa-plus"></i> Tambah Dosen</button>
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
                                    <th>Nidn</th>
                                    <th>Nama</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen DESC");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['nidn']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td>
                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-editDosen_<?php echo $row['id_dosen']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target=".modal-deleteDosen_<?php echo $row['id_dosen']; ?>"><i class="fas fa-trash"></i></button>
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

<!-- Modal Tambah Dosen -->
<div class="modal fade modal-addDosen" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nidn</label>
                            <input class="form-control" type="text" required="" name="nidn" placeholder="Nidn">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nama</label>
                            <input class="form-control" type="text" required="" name="nama" placeholder="Nama Dosen">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_dosen" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit Dosen -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-editDosen_<?php echo $row['id_dosen']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input class="form-control" type="hidden" name="id_dosen" value="<?php echo $row['id_dosen']; ?>">
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-12">
                                <label>Nidn</label>
                                <input class="form-control" type="text" required="" name="nidn" value="<?php echo $row['nidn']; ?>" placeholder="Nidn">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label>Nama</label>
                                <input class="form-control" type="text" required="" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Nama Dosen">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_dosen" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>

<!-- Modal Delete Dosen -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-deleteDosen_<?php echo $row['id_dosen']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input class="form-control" type="hidden" name="id_dosen" value="<?php echo $row['id_dosen']; ?>">
                        <p>Yakin hapus dosen <b><?php echo $row['nama']; ?></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete_dosen" class="btn btn-primary">Setuju</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>