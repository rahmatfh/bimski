<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $message = "";

    if(isset($_POST['edit_mahasiswa'])){
        $id_mahasiswa = $_POST['id_mahasiswa'];
        $pembimbing_dua = $_POST['pembimbing_dua'];

        $sql = mysqli_query($koneksi, "UPDATE mahasiswa SET pembimbing_dua='$pembimbing_dua' WHERE id_mahasiswa='$id_mahasiswa'");
        if($sql){
            header("location: " . base_url('?mod=mahasiswa'));
            $message = alertMsg('success', 'Mahasiswa telah diperbaharui');
        }else{
            header("location: " . base_url('?mod=mahasiswa'));
            $message = alertMsg('error', 'Mahasiswa gagal diperbaharui');
        }
    }

    if(isset($_POST['delete_mahasiswa'])){
        $id_mahasiswa = $_POST['id_mahasiswa'];

        $sql = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
        if($sql){
            header("location: " . base_url('?mod=mahasiswa'));
            $message = alertMsg('success', 'Mahasiswa telah dihapus');
        }else{
            header("location: " . base_url('?mod=mahasiswa'));
            $message = alertMsg('error', 'Mahasiswa gagal dihapus');
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
                                    <h4 class="page-title">Data Mahasiswa</h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Master</a></li>
                                        <li class="breadcrumb-item active">Data Mahasiswa</li>
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
                                                    <th>Nim</th>
                                                    <th>Nama</th>
                                                    <th>Judul</th>
                                                    <th>Proposal</th>
                                                    <th>Pembimbing 1</th>
                                                    <th>Pembimbing 2</th>
                                                    <th>Penguji 1</th>
                                                    <th>Penguji 2</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nim']; ?></td>
                                                        <td><?php echo $row['nama']; ?></td>
                                                        <td><?php echo $row['judul']; ?></td>
                                                        <td><a href="<?php echo base_url('files/proposal/' . $row['file_proposal']); ?>"><?php echo $row['file_proposal']; ?></a></td>
                                                        <td><?php if ($row['pembimbing'] != '') {
                                                                echo getNamaDosen($koneksi, $row['pembimbing']);
                                                            } else {
                                                                echo '-';
                                                            } ?></td>
                                                        <td><?php if ($row['pembimbing_dua'] != '') {
                                                                echo getNamaDosen($koneksi, $row['pembimbing_dua']);
                                                            } else {
                                                                echo '-';
                                                            } ?></td>
                                                        <td><?php if ($row['penguji'] != '') {
                                                                echo getNamaDosen($koneksi, $row['penguji']);
                                                            } else {
                                                                echo '-';
                                                            } ?></td>
                                                        <td><?php if ($row['penguji_dua'] != '') {
                                                                echo getNamaDosen($koneksi, $row['penguji_dua']);
                                                            } else {
                                                                echo '-';
                                                            } ?></td>
                                                        <td>
                                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-editMahasiswa_<?php echo $row['id_mahasiswa']; ?>"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target=".modal-deleteMahasiswa_<?php echo $row['id_mahasiswa']; ?>"><i class="fas fa-trash"></i></button>
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

                <!-- Modal Edit Mahasiswa -->
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <div class="modal fade modal-editMahasiswa_<?php echo $row['id_mahasiswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0">Perbaharui Mahasiswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input class="form-control" type="hidden" name="id_mahasiswa" value="<?php echo $row['id_mahasiswa']; ?>">

                                        <div class="form-group">
                                            <div class="col-12">
                                                <label>Pembimbing 2</label>
                                                <select class="form-control" name="pembimbing_dua">
                                                    <?php
                                                    $sql2 = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen");
                                                    while ($row2 = mysqli_fetch_array($sql2)) {
                                                    ?>
                                                        <option value="<?php echo $row2['id_dosen']; ?>" <?php echo ($row['pembimbing_dua'] == $row2['id_dosen']) ? 'selected="selected"' : ''; ?>><?php echo $row2['nama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit_mahasiswa" class="btn btn-success">Update</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                <?php } ?>

                <!-- Modal Delete Mahasiswa -->
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <div class="modal fade modal-deleteMahasiswa_<?php echo $row['id_mahasiswa']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0">Hapus Mahasiswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input class="form-control" type="hidden" name="id_mahasiswa" value="<?php echo $row['id_mahasiswa']; ?>">
                                        <p>Yakin hapus mahasiswa atas nama <b><?php echo $row['nama']; ?></b>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="delete_mahasiswa" class="btn btn-primary">Setuju</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                <?php } ?>