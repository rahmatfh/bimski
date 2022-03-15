<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = "";

    if (isset($_POST['add_prodi'])) {
        $fakultas = $_POST['fakultas'];
        $nama_prodi = $_POST['nama_prodi'];

        $sql = mysqli_query($koneksi, "INSERT INTO prodi(id_fakultas, nama_prodi) VALUES('$fakultas', '$nama_prodi')");
        if ($sql) {
            header("location: " . base_url('?mod=prodi'));
            $message = alertMsg('success', 'Prodi telah ditambahkan');
        } else {
            header("location: " . base_url('?mod=prodi'));
            $message = alertMsg('error', 'Prodi gagal ditambahakan');
        }
    }

    if (isset($_POST['edit_prodi'])) {
        $id_prodi = $_POST['id_prodi'];
        $fakultas = $_POST['fakultas'];
        $nama_prodi = $_POST['nama_prodi'];

        $sql = mysqli_query($koneksi, "UPDATE prodi SET id_fakultas='$fakultas', nama_prodi='$nama_prodi' WHERE id_prodi='$id_prodi'");
        if ($sql) {
            header("location: " . base_url('?mod=prodi'));
            $message = alertMsg('success', 'Prodi telah diperbaharui');
        } else {
            header("location: " . base_url('?mod=prodi'));
            $message = alertMsg('error', 'Prodi gagal diperbaharui');
        }
    }

    if (isset($_POST['delete_prodi'])) {
        $id_prodi = $_POST['id_prodi'];

        $sql = mysqli_query($koneksi, "DELETE FROM prodi WHERE id_prodi='$id_prodi'");
        if ($sql) {
            header("location: " . base_url('?mod=prodi'));
            $message = alertMsg('success', 'Prodi telah dihapus');
        } else {
            header("location: " . base_url('?mod=prodi'));
            $message = alertMsg('error', 'Prodi gagal dihapus');
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
                    <h4 class="page-title">Data Prodi</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-addProdi"><i class="fas fa-plus"></i> Tambah Prodi</button>
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
                                    <th>Nama Prodi</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM prodi p INNER JOIN fakultas f ON p.id_fakultas=f.id_fakultas ORDER BY id_prodi DESC");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['nama_fakultas']; ?></td>
                                        <td><?php echo $row['nama_prodi']; ?></td>
                                        <td>
                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-editProdi_<?php echo $row['id_prodi']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target=".modal-deleteProdi_<?php echo $row['id_prodi']; ?>"><i class="fas fa-trash"></i></button>
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

<!-- Modal Tambah Prodi -->
<div class="modal fade modal-addProdi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Prodi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Mahasiswa</label>
                            <select class="form-control" name="fakultas">
                                <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas DESC");
                                while ($row2 = mysqli_fetch_array($sql)) {
                                ?>
                                    <option value="<?php echo $row2['id_fakultas']; ?>"><?php echo $row2['nama_fakultas']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Nama Prodi</label>
                            <input class="form-control" type="text" required="" name="nama_prodi" placeholder="Nama Prodi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_prodi" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Edit Prodi -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM prodi ORDER BY id_prodi DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-editProdi_<?php echo $row['id_prodi']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Tambah Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                    <input class="form-control" type="hidden" name="id_prodi" value="<?php echo $row['id_prodi']; ?>">
                        <div class="form-group">
                            <div class="col-12">
                                <label>Fakultas</label>
                                <select class="form-control" name="fakultas">
                                    <?php
                                    $sql2 = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas DESC");
                                    while ($row2 = mysqli_fetch_array($sql2)) {
                                    ?>
                                        <option value="<?php echo $row2['id_fakultas']; ?>" <?php ($row2['id_fakultas'] == $row['id_fakultas'] ) ? 'selected="selected"' : ''; ?>><?php echo $row2['nama_fakultas']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label>Nama Prodi</label>
                                <input class="form-control" type="text" required="" name="nama_prodi" value="<?php echo $row['nama_prodi']; ?>" placeholder="Nama Prodi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_prodi" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>

<!-- Modal Delete Prodi -->
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM prodi ORDER BY id_prodi DESC");
while ($row = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade modal-deleteProdi_<?php echo $row['id_prodi']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Hapus Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input class="form-control" type="hidden" name="id_prodi" value="<?php echo $row['id_prodi']; ?>">
                        <p>Yakin hapus prodi <b><?php echo $row['nama_prodi']; ?></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete_prodi" class="btn btn-primary">Setuju</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>