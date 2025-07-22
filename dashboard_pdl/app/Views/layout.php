<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- Favicons -->
    <link href="<?= base_url()?>/assets/img/logo.png" rel="icon">
    <link href="<?= base_url()?>/assets/img/logo.png" rel="logo">
	
	<!-- ================== BEGIN core-css ================== -->
    <link href="<?= base_url() ?>/assets/css/vendor.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/css/facebook/app.min.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

    <!-- Plugins CSS Files -->
	<link href="<?= base_url() ?>/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables/css/buttons.bootstrap4.min.css">
    <link href="<?= base_url() ?>/assets/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <script src="<?= base_url() ?>/assets/plugins/jquery/dist/jquery.min.js"></script>
	<style>
		.card {
			border-radius: 16px;
		}
	</style>
</head>
<body>
    <div id="flash" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
    <div id="flashfail" data-flash="<?= session()->getFlashdata('fail'); ?>"></div>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app app-header-fixed app-sidebar-fixed ">
		<!-- BEGIN #header -->
		<div id="header" class="app-header app-header-inverse">
			<!-- BEGIN navbar-header -->
			<div class="navbar-header">
				<a href="<?= base_url() ?>" class="navbar-brand"><img src="<?= base_url()?>/assets/img/logo.png" alt="logo" class="img-fluid"> <b>Pajak Daerah Lainnya Kota Bekasi</b></a>
				<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- END navbar-header -->
			<!-- BEGIN header-nav -->
			<div class="navbar-nav">
				<div class="navbar-item navbar-user dropdown">
					<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
						<img src="<?= base_url()?>/assets/img/default.jpg" alt="" /> 
						<span class="d-none d-md-inline"></span> <b class="caret ms-6px"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-end me-1">
						<a href="<?= base_url()?>/auth/logout" class="dropdown-item logout text-danger"><i class="bi bi-box-arrow-in-right"></i> Log Out</a>
					</div>
				</div>
			</div>
			<!-- END header-nav -->
		</div>
		<!-- END #header -->
	
		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-profile">
						<div href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
							<div class="menu-profile-cover with-shadow"></div>
							<div class="menu-profile-image">
								<img src="<?= base_url()?>/assets/img/default.jpg" alt="" />
							</div>
							<div class="menu-profile-info">
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
                                        
									</div>
									<div class="menu-caret ms-auto"></div>
								</div>
							</div>
                        </div>
					</div>
					<div id="appSidebarProfileMenu" class="collapse">
						<div class="menu-item pt-5px">
							<a href="<?= base_url()?>/auth/logout" class="menu-link logout text-danger">
								<div class="menu-icon"><i class="bi bi-box-arrow-in-right"></i></div>
								<div class="menu-text">Logout</div>
							</a>
						</div>
						<div class="menu-divider m-0"></div>
					</div>
					<div class="menu-header">Navigation</div>
					<?php if ($menu == 'dashboard') :?>
					<div class="menu-item active">
					<?php else : ?>
					<div class="menu-item">
					<?php endif ?>
						<a href="<?= base_url()?>/dashboard" class="menu-link">
							<div class="menu-icon">
                                <i class="bi bi-speedometer2"></i> 
							</div>
							<div class="menu-text">Dashboard</div>
						</a>
					</div>
                    <?php if ($menu == 'report') :?>
					<div class="menu-item active">
					<?php else : ?>
					<div class="menu-item">
					<?php endif ?>
						<a href="<?= base_url()?>/report" class="menu-link">
							<div class="menu-icon">
                                <i class="bi bi-journal-text"></i> 
							</div>
							<div class="menu-text">Report Pembayaran</div>
						</a>
					</div>
					
					<!-- BEGIN minify-button -->
					<div class="menu-item d-flex">
						<a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
					</div>
					<!-- END minify-button -->
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
		</div>
		<div class="app-sidebar-bg"></div>
		<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
		<!-- END #sidebar -->
		
		<!-- BEGIN #content -->
		<div id="content" class="app-content">
            <?= $this->renderSection('content-page'); ?>
		</div>
		<!-- END #content -->
	
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
    <script src="<?= base_url() ?>/assets/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.min.js"></script>
    <!-- ================== END core-js ================== -->

    <!-- Plugins JS Files -->
	<script src="<?= base_url() ?>/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
	<script charset="utf8" src="<?= base_url() ?>/assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/datatables/js/buttons.html5.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/datatables/js/buttons.print.min.js"></script>
    <script charset="utf8" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>

    <!-- Custom Js -->
    <script>
        // Log Off
        let log_off = new Date();
        log_off.setMinutes(log_off.getMinutes() + 30)
        log_off = new Date(log_off)

        let int_logoff = setInterval(function() {
            let now = new Date();
            if (now > log_off) {
                alert("Maaf sesi anda telah habis")
                window.location.assign("<?= base_url(); ?>/auth/logout");
                clearInterval(int_logoff);
            }
        }, 30000);

        // Alert Logout
        $(function() {
            $('.logout').click(function() {
                if (confirm('Anda yakin ingin keluar?')) {
                    return true;
                }
                return false;
            });
        });

        // Alert Success
        var flash = $('#flash').data('flash');
        if (flash) {
            Swal.fire({
                icon: 'success',
                showConfirmButton: false,
                timer: 1400,
                timerProgressBar: true,
                text: flash,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }

        //Alert Fail
        var flashfail = $('#flashfail').data('flash');
        if (flashfail) {
            Swal.fire({
                icon: 'error',
                showConfirmButton: false,
                timer: 1400,
                timerProgressBar: true,
                text: flashfail,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }
    </script>
</body>
</html>