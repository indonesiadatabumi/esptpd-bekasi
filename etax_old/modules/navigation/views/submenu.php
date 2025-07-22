	 <!-- <h5 class="card-title"><?= $content ?></h5> -->
	 <div class="row">
	 	<div class="col-lg-12 col-xl-12">
	 		<div class="main-card mb-6 card">
	 			<div class="card-body">
	 				<h5 class="card-title"><?= $content ?></h5>
	 				<div class="grid-menu grid-menu-6col">
	 					<div class="no-gutters row">
	 						<?php foreach ($sub_sub_menu as $sm) :
									//if ($sm['reference'] == $men_id) {
								?>
	 							<div class="col-sm-6 col-xl-4">
	 								<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-warning" onclick="window.location.href='<?= base_url($sm['url'])  ?>';">
	 									<i class="btn-icon-wrapper pe-7s-news-paper"> </i><?= $sm['title']; ?>
	 								</button>
	 							</div>
	 						<?php //}
								endforeach; ?>
	 					</div>
	 				</div>
	 				<div class="divider"></div>
	 			</div>
	 		</div>
	 	</div>

	 </div>