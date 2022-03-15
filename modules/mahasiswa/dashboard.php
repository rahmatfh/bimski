 <?php
    $session_id = $_SESSION['id'];
    $data_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$session_id' LIMIT 1");
    $e_mhs = mysqli_fetch_assoc($data_mahasiswa);
    $dt_idprodi = $e_mhs['id_prodi'];

    $data_fakpro = mysqli_query($koneksi, "SELECT * FROM prodi p INNER JOIN fakultas f ON p.id_fakultas=f.id_fakultas WHERE id_prodi='$dt_idprodi'");
    $e_fkprd = mysqli_fetch_assoc($data_fakpro);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $message = "";

        if(isset($_POST['update_mahasiswa'])){
            $id_mahasiswa = $e_mhs['id_mahasiswa'];
            $judul = $_POST['judul'];
            $prodi = $_POST['prodi'];
            $pembimbing = $_POST['pembimbing'];
            $penguji = $_POST['penguji'];
            $penguji_dua = $_POST['penguji_dua'];

            if(!empty($_FILES['file_proposal']['tmp_name'])){
                if($e_mhs['file_proposal'] != ''){
                    unlink("./files/proposal/".$e_mhs['file_proposal']);
                }
                $file_proposal = time().$_FILES['file_proposal']['name'];
                if (is_uploaded_file($_FILES['file_proposal']['tmp_name'])) {
                    move_uploaded_file ($_FILES['file_proposal']['tmp_name'], "./files/proposal/".$file_proposal);
                }
            }else{
                if($e_mhs['file_proposal'] != ''){
                    $file_proposal = $e_mhs['file_proposal'];
                }else{
                    $file_proposal = null;
                }
            }

            $sql = mysqli_query($koneksi, "UPDATE mahasiswa SET id_prodi='$prodi', pembimbing='$pembimbing', judul='$judul', penguji='$penguji', penguji_dua='$penguji_dua', file_proposal='$file_proposal' WHERE id_mahasiswa='$id_mahasiswa'");
            if($sql){
                header("location: " . base_url());
                $message = alertMsg('success', 'Data berhasil diperbaharui');
            }else{
                header("location: " . base_url());
                exit();
                $message = alertMsg('error', 'Data tidak diperbaharui');
            }
        }
    }
 ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">BamSki</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end page-title -->

                    <div><?php echo $message; ?></div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama:</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php echo $e_mhs['nama']; ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php echo $e_mhs['nim']; ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Fakultas</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['id_prodi'] != ''){ echo $e_fkprd['nama_fakultas']; }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Prodi</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['id_prodi'] != ''){ echo $e_fkprd['nama_prodi']; }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Judul Skripsi</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['judul'] != ''){ echo $e_mhs['judul']; }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Pembimbing</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['pembimbing'] != ''){ echo getNamaDosen($koneksi, $e_mhs['pembimbing']); }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Pembimbing 2</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['pembimbing_dua'] != ''){ echo getNamaDosen($koneksi, $e_mhs['pembimbing_dua']); }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Penguji</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['penguji'] != ''){ echo getNamaDosen($koneksi, $e_mhs['penguji']); }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Penguji 2</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['penguji_dua'] != ''){ echo getNamaDosen($koneksi, $e_mhs['penguji_dua']); }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-url-input" class="col-sm-2 col-form-label">Proposal</label>
                                        <div class="col-sm-10">
                                            <label class="col-form-label">:</label>
                                            <label class="col-form-label"><?php if($e_mhs['file_proposal'] != ''){ echo '<a href="'.base_url('files/proposal/'.$e_mhs['file_proposal']).'" target="_blank">'.$e_mhs['file_proposal'].'</a>'; }else{ echo '-'; } ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group m-t-30 text-right">
                                        <div>
                                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".modal-data-bimbingan">
                                                Perbaharui
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div>
                <!-- container-fluid -->

            </div>
            <!-- content -->

            <!-- Modal Update Mahasiswa Bimbingan -->
            <div class="modal fade modal-data-bimbingan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">Perbaharui Data Bimbingan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Judul Skripsi</label>
                                        <input class="form-control" type="text" required="" name="judul" value="<?php echo $e_mhs['judul']; ?>" placeholder="Judul Skripsi">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Fakultas</label>
                                        <select class="form-control" name="fakultas">
                                            <?php
                                            $sql = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas");
                                            while($row=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row['id_fakultas']; ?>" <?php echo ($e_fkprd['id_fakultas'] == $row['id_fakultas']) ? 'selected="selected"' : ''; ?>><?php echo $row['nama_fakultas']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Prodi</label>
                                        <select class="form-control" name="prodi">
                                            <?php
                                            $sql = mysqli_query($koneksi, "SELECT * FROM prodi ORDER BY id_prodi");
                                            while($row=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row['id_prodi']; ?>" <?php echo ($e_fkprd['id_prodi'] == $row['id_prodi']) ? 'selected="selected"' : ''; ?>><?php echo $row['nama_prodi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Pembimbing</label>
                                        <select class="form-control" name="pembimbing">
                                            <?php
                                            $sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen");
                                            while($row=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row['id_dosen']; ?>" <?php echo ($e_mhs['pembimbing'] == $row['id_dosen']) ? 'selected="selected"' : ''; ?>><?php echo $row['nama']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Penguji</label>
                                        <select class="form-control" name="penguji">
                                            <?php
                                            $sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen");
                                            while($row=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row['id_dosen']; ?>" <?php echo ($e_mhs['penguji'] == $row['id_dosen']) ? 'selected="selected"' : ''; ?>><?php echo $row['nama']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Penguji 2</label>
                                        <select class="form-control" name="penguji_dua">
                                            <?php
                                            $sql = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen");
                                            while($row=mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row['id_dosen']; ?>" <?php echo ($row['id_dosen'] == $e_mhs['penguji_dua']) ? 'selected="selected"' : ''; ?>><?php echo $row['nama']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <label>Doc Proposal</label>
                                        <input class="form-control" name="file_proposal" type="file">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_mahasiswa" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->