        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <?php if ($_SESSION['hak_akses'] == 'admin') { ?>
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="<?php echo base_url(); ?>" class="waves-effect">
                                    <i class="icon-accelerator"></i><span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('?mod=fakultas'); ?>" class="waves-effect"><i class="icon-todolist"></i><span> Fakultas </span></a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('?mod=prodi'); ?>" class="waves-effect"><i class="icon-todolist"></i><span> Prodi </span></a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> Data Master <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="<?php echo base_url('?mod=admin'); ?>">admin</a></li>
                                    <li><a href="<?php echo base_url('?mod=dosen'); ?>">Dosen</a></li>
                                    <li><a href="<?php echo base_url('?mod=mahasiswa'); ?>">Mahasiswa</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else if ($_SESSION['hak_akses'] == 'dosen') { ?>
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="<?php echo base_url(); ?>" class="waves-effect">
                                    <i class="icon-accelerator"></i><span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('?mod=bimbingan'); ?>" class="waves-effect"><i class="icon-calendar"></i><span> Bimbingan </span></a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('?mod=mahasiswa'); ?>" class="waves-effect"><i class="mdi mdi-account-group "></i><span> Data Mahasiswa </span></a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="<?php echo base_url(); ?>" class="waves-effect">
                                    <i class="icon-accelerator"></i><span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="?mod=bimbingan" class="waves-effect"><i class="icon-calendar"></i><span> Bimbingan </span></a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->