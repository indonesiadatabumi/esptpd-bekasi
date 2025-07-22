<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"> Home </i></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Cetak NPWPD</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-body">
				<div class="table-responsive">
					<table id="list_npwpd" class="table table-sm table-hover" style="width: 100%;">
						<thead>
							<tr class="bg-info text-white">
								<th>No</th>
								<th>NPWPD</th>
								<th>NOPD</th>
								<th>Nama WP</th>
								<th>Nama OP</th>
								<th>Alamat</th>
								<th>Kelurahan</th>
								<th>Kecamatan</th>
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
	var GLOBAL_CETAK_KARTU_VARS = new Array();
	GLOBAL_CETAK_KARTU_VARS["get_list_data"] = "<?= base_url(); ?>pendaftaran/cetak_kartu_npwpd/get_list?sqtype=&squery=";
	GLOBAL_CETAK_KARTU_VARS["cetak"] = "<?= base_url(); ?>pendaftaran/cetak_kartu_npwpd/cetak_npwpd";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/view_cetak_kartu_npwpd.js"></script>
<script>
	$(document).on('click', '#btn_print', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var data = $(this).data('href');
		
		url = GLOBAL_CETAK_KARTU_VARS["cetak"] +
						"?wp_id=" + data;
		var html = '<iframe id="pdf" class="pdf" src="' + url + '" width="100%" height="100%" scrollbar="yes" marginwidth="0" marginheight="0" hspace="0" align="middle" frameborder="0" scrolling="yes" style="width:100%; border:0;  height:100%; overflow:auto;"></iframe>';
		var w = window.open(url);
		w.document.writeln(html);
		w.document.close();
		return false;
	});
</script>