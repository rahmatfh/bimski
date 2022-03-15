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
                                                <th>Penguji 1</th>
                                                <th>Penguji 2</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <?php
                                            $id_pembimbing = $_SESSION['id'];
                                            $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE pembimbing='$id_pembimbing' ORDER BY id_mahasiswa DESC");
                                            while($row=mysqli_fetch_array($sql)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['nim']; ?></td>
                                                <td><?php echo $row['nama']; ?></td>
                                                <td><?php echo $row['judul']; ?></td>
                                                <td><a href="<?php echo base_url('files/proposal/'.$row['file_proposal']); ?>"><?php echo $row['file_proposal']; ?></a></td>
                                                <td>-</td>
                                                <td>-</td>
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