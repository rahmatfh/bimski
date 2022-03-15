<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";

    if (isset($_POST['add_fakultas'])) {
        $nama_fakultas = $_POST['nama_fakultas'];

        $sql = mysqli_query($koneksi, "INSERT INTO fakultas(nama_fakultas) VALUES('$nama_fakultas')");
        if ($sql) {
            header("location: " . base_url('?mod=fakultas'));
            $message = alertMsg('success', 'Fakultas telah ditambahkan');
        } else {
            header("location: " . base_url('?mod=fakultas'));
            $message = alertMsg('error', 'Fakultas gagal ditambahakan');
        }
    }

    if (isset($_POST['edit_fakultas'])) {
        $id_fakultas = $_POST['id_fakultas'];
        $nama_fakultas = $_POST['nama_fakultas'];

        $sql = mysqli_query($koneksi, "UPDATE fakultas SET nama_fakultas='$nama_fakultas' WHERE id_fakultas='$id_fakultas'");
        if ($sql) {
            header("location: " . base_url('?mod=fakultas'));
            $message = alertMsg('success', 'Fakultas telah diperbaharui');
        } else {
            header("location: " . base_url('?mod=fakultas'));
            $message = alertMsg('error', 'Fakultas gagal diperbaharui');
        }
    }

    if (isset($_POST['delete_fakultas'])) {
        $id_fakultas = $_POST['id_fakultas'];

        $sql = mysqli_query($koneksi, "DELETE FROM fakultas WHERE id_fakultas='$id_fakultas'");
        if ($sql) {
            header("location: " . base_url('?mod=fakultas'));
            $message = alertMsg('success', 'Fakultas telah dihapus');
        } else {
            header("location: " . base_url('?mod=fakultas'));
            $message = alertMsg('error', 'Fakultas gagal dihapus');
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
                    <h4 class="page-title">Data Fakultas</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-addFakultas"><i class="fas fa-plus"></i> Tambah Fakultas</button>
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
                                    <th>No</th>
                                    <th>Nama Fakultas</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas DESC");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['nama_fakultas']; ?></td>
                                        <td>
                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-editFakultas_<?php echo $row['id_fakultas']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target=".modal-deleteFakultas_<?php echo $row['id_fakultas']; ?>"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
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

<!-- Modal Tambah Fakultas -->
<div class="modal fade modal-addFakultas" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Fakultas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nama Fakultas</label>
                            <input class="form-control" type="text" required="" name="nama_fakultas" placeholder="Nama Fakultas">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_fakultas" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit Fakultas -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-editFakultas_<?php echo $row['id_fakultas']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Tambah Fakultas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                    <input class="form-control" type="hidden" name="id_fakultas" value="<?php echo $row['id_fakultas']; ?>">

                        <div class="form-group">
                            <div class="col-12">
                                <label>Nama Fakultas</label>
                                <input class="form-control" type="text" required="" name="nama_fakultas" value="<?php echo $row['nama_fakultas']; ?>" placeholder="Nama Fakultas">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_fakultas" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>

<!-- Modal Delete Prodi -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-deleteFakultas_<?php echo $row['id_fakultas']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Fakultas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input class="form-control" type="hidden" name="id_fakultas" value="<?php echo $row['id_fakultas']; ?>">
                        <p>Yakin hapus fakultas <b><?php echo $row['nama_fakultas']; ?></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete_fakultas" class="btn btn-primary">Setuju</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>