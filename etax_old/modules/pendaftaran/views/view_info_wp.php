<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"> Home </i></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Cetak Info Rinci WP</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-body">
				<div class="table-responsive">
					<table id="info_wp_table" class="table table-sm table-hover" style="width: 100%;">
						<thead>
							<tr class="bg-info text-white">
								<th>Nama WP</th>
								<th>Alamat WP</th>
								<th>Kelurahan </th>
								<th>Kecamatan</th>
								<th>Kabupaten</th>
								<th>NPWPD</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var GLOBAL_FORMULIR_VARS = new Array();
	GLOBAL_FORMULIR_VARS["get_list"] = "<?= base_url(); ?>pendaftaran/info_wp/get_list";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/view_info_wp.js"></script>
<script>
$(document).on('click', '#cetak', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');
	if (data == ""){
		alert("Silahkan tambahkan nomor nik/nib terlebih dahulu")
	}else{
		var url = "<?php echo site_url('/pendaftaran/info_wp/cetak') ?>/" + data;
    	// window.location.href = url;
		window.open(url);
	}

});
</script>