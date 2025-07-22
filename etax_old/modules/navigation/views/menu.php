	 <!-- <h5 class="card-title"><?= $content ?></h5> -->
	 <div class="row">
	 	<?php if ($content == 'Pelayanan') {
				$men_id = 'MEN-000002';
			} else if ($content == 'Pendataan') {
				$men_id = 'MEN-000009';
			} else if ($content == 'Penetapan') {
				$men_id = 'MEN-000017';
			} else if ($content == 'Pembayaran') {
				$men_id = 'MEN-000023';
			} else if ($content == 'Pembukuan') {
				$men_id = 'MEN-000031';
			} else if ($content == 'Penagihan') {
				$men_id = 'MEN-000034';
			} elseif ($content == 'Setting') {
				$men_id = 'MEN-000055';
			}
			?>
	 	<!-- <div class="col-md-12">
					<div class="p-1 mb-2 card-border card">
						<div class="dropdown-menu dropdown-menu-inline dropdown-menu-hover-primary">
							<?php foreach ($sub_menu as $sm) :
								if ($sm['reference'] == $men_id) {
							?>
									<button onclick="window.location.href='<?= base_url($sm['url'])  ?>';" class="dropdown-item"><?= $sm['title']; ?></button>
							<?php }
							endforeach; ?>
						</div>
					</div>
				</div> -->
	 	<div class="col-lg-12 col-xl-12">
	 		<div class="main-card mb-3 card border">
	 			<div class="card-body">
	 				<h5 class="card-title"><?= $content ?></h5>
	 				<div class="grid-menu grid-menu-3col">
	 					<div class="no-gutters row">
	 						<?php foreach ($sub_menu as $sm) :
									if ($sm['reference'] == $men_id) {
								?>
	 								<div class="col-sm-6 col-xl-4">
	 									<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary" onclick="window.location.href='<?= base_url($sm['url'])  ?>';">
	 										<i class="btn-icon-wrapper pe-7s-news-paper"> </i><?= $sm['title']; ?>
	 									</button>
	 								</div>
	 						<?php }
								endforeach; ?>

							<?php
							if ($content == 'Setting') :
							?>
							<div class="col-sm-6 col-xl-4">
	 							<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary" onclick="window.location.href='<?= base_url()  ?>pemeliharaan/operator';">
	 								<i class="btn-icon-wrapper pe-7s-news-paper"> </i>Tabel Operator
	 							</button>
	 						</div>
							 <div class="col-sm-6 col-xl-4">
	 							<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary" onclick="window.location.href='<?= base_url()  ?>pemeliharaan/pejabat';">
	 								<i class="btn-icon-wrapper pe-7s-news-paper"> </i>Tabel Pejabat
	 							</button>
	 						</div>
							<?php endif ?>
	 					</div>
	 				</div>
	 				<div class="divider"></div>
	 			</div>
	 		</div>
	 	</div>

	 </div>