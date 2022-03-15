<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";

    if (isset($_POST['add_admin'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = md5('admin');

        $sql = mysqli_query($koneksi, "INSERT INTO admin(nama, email, password) VALUES('$nama', '$email', '$password')");
        if ($sql) {
            header("location: " . base_url('?mod=admin'));
            $message = alertMsg('success', 'Admin telah ditambahkan');
        } else {
            header("location: " . base_url('?mod=admin'));
            $message = alertMsg('error', 'Admin gagal ditambahakan');
        }
    }

    if (isset($_POST['edit_admin'])) {
        $id_admin = $_POST['id_admin'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];

        $sql = mysqli_query($koneksi, "UPDATE admin SET nama='$nama', email='$email' WHERE id_admin='$id_admin'");
        if ($sql) {
            header("location: " . base_url('?mod=admin'));
            $message = alertMsg('success', 'Admin telah diperbaharui');
        } else {
            header("location: " . base_url('?mod=admin'));
            $message = alertMsg('error', 'Admin gagal diperbaharui');
        }
    }

    if (isset($_POST['delete_admin'])) {
        $id_admin = $_POST['id_admin'];

        $sql = mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin='$id_admin'");
        if ($sql) {
            header("location: " . base_url('?mod=admin'));
            $message = alertMsg('success', 'Admin telah dihapus');
        } else {
            header("location: " . base_url('?mod=admin'));
            $message = alertMsg('error', 'Admin gagal dihapus');
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
                    <h4 class="page-title">Data Admin</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-addAdmin"><i class="fas fa-plus"></i> Tambah Admin</button>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM admin ORDER BY id_admin DESC");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-editAdmin_<?php echo $row['id_admin']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target=".modal-deleteAdmin_<?php echo $row['id_admin']; ?>"><i class="fas fa-trash"></i></button>
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

<!-- Modal Tambah Admin -->
<div class="modal fade modal-addAdmin" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nama</label>
                            <input class="form-control" type="text" required="" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Email</label>
                            <input class="form-control" type="text" required="" name="email" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_admin" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit Admin -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM admin ORDER BY id_admin DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-editAdmin_<?php echo $row['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input class="form-control" type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="col-12">
                                <label>Nama</label>
                                <input class="form-control" type="text" required="" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Nama Lengkap">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label>Email</label>
                                <input class="form-control" type="text" required="" name="email" value="<?php echo $row['email']; ?>" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_admin" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>

<!-- Modal Delete Dosen -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM admin ORDER BY id_dosen DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-deleteAdmin_<?php echo $row['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input class="form-control" type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
                        <p>Yakin hapus admin <b><?php echo $row['nama']; ?></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete_admin" class="btn btn-primary">Setuju</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>