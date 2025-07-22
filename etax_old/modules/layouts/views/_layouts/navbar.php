	<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
		<div class="app-header bg-color header-text-light header-shadow">
			<div class="app-header__logo">
				<div class="logo-src"></div>
				<div class="header__pane ml-auto">
					<div>
						<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
						</button>
					</div>
				</div>
			</div>
			<div class="app-header__mobile-menu">
				<div>
					<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>
			</div>
			<div class="app-header__menu">
				<span>
					<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
						<span class="btn-icon-wrapper">
							<i class="fa fa-ellipsis-v fa-w-6"></i>
						</span>
					</button>
				</span>
			</div>
			<div class="app-header__content">
				<!-- <div class="app-header-right pr-0">
					<ul class="header-menu nav">
						<li class="nav-item">
							<a href="pendaftaran/wp_pribadi" class="nav-link">
								<i class="nav-link-icon fa fa-tablet"> </i>
								Daftar WPWR Pribadi
							</a>
						</li>
						<li class="btn-group nav-item">
							<a href="javascript:void(0);" class="nav-link">
								<i class="nav-link-icon fa fa-edit"></i>
								Daftar WPWR
							</a>
						</li>
						<li class="dropdown nav-item">
							<a href="javascript:void(0);" class="nav-link">
								<i class="nav-link-icon fa fa-file"></i>
								Pendataan SPT
							</a>
						</li>
						<li class="dropdown nav-item">
							<a href="javascript:void(0);" class="nav-link">
								<i class="nav-link-icon fa fa-edit"></i>
								LHP
							</a>
						</li>
						<li class="dropdown nav-item">
							<a href="javascript:void(0);" class="nav-link">
								<i class="nav-link-icon fa fa-gavel"></i>
								PENETAPAN PAJAK
							</a>
						</li>
						<li class="dropdown nav-item">
							<a href="javascript:void(0);" class="nav-link">
								<i class="nav-link-icon fa fa-edit"></i>
								PENAGIHAN STPD
							</a>
						</li>
					</ul>
					<marquee scrolldelay="200" class="nav-link" style=" font-size:800; font-weight:bold; color:aliceblue" onmouseover="this.stop();" onmouseout="this.start();"> >> PENYALAHGUNAAN USER MENJADI TANGGUNGJAWAB PEMILIK USER, UNTUK KEAMANAN GANTI PASSWORD SECARA BERKALA!!! << </marquee>
				</div> -->
				<div class="app-header-right">
					<div class="header-btn-lg pr-0">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="btn-group">
										<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
											<img width="42" class="rounded-circle" src="<?= base_url('assets/images/avatars/2.jpg') ?>" alt="">
											<i class="fa fa-angle-down ml-2 opacity-8"></i>
										</a>
										<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
											<button type="button" tabindex="0" class="dropdown-item">User Account</button>
											<button type="button" tabindex="0" class="dropdown-item" onclick="window.location.href='<?= base_url('navigation/setting') ?>'">Settings</button>
											<div tabindex="-1" class="dropdown-divider"></div>
											<button type="button" tabindex="0" class="dropdown-item" onclick="window.location.href='<?= BASE_URL() . 'login/out'; ?>';"> Logout</button>
										</div>
									</div>
								</div>
								<div class="widget-content-left  ml-3 header-user-info">
									<div class="widget-heading">
										<?= $this->session->userdata('USER_FULL_NAME'); ?>
									</div>
									<div class="widget-subheading">
										<?= $this->session->userdata('USER_JABATAN_NAME'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>