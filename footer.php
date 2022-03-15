<footer class="footer">
    © 2022 BimSKi UMC.
</footer>

<!-- Modal Ganti Passsword -->
<div class="modal fade modal-changePassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label>Password Lama</label>
                            <input class="form-control" type="password" required="" name="password_lama" placeholder="Password Lama">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password Baru</label>
                            <input class="form-control" type="password" required="" name="password_baru" placeholder="Password Baru">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="ganti_password" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Logout Account -->
<div class="modal fade modal-logoutAccount" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Keluar Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <p>Yakin ingin keluar akun ?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="logout_account" class="btn btn-primary">Keluar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->