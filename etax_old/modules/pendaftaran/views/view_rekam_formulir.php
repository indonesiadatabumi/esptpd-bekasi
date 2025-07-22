<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>pendaftaran/rekam_formulir"><i class="fas fa-home"> Home </i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Formulir Pendaftaran</li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Data Formulir Pendaftaran</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-body">
				<div class="table-responsive">
					<table id="list_form" class="table table-sm table-hover" style="width: 100%;">
						<thead>
							<tr class="bg-info text-white">
								<th>No</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								<th>Status</th>
								<th>Tgl Kirim</th>
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
	GLOBAL_FORMULIR_VARS["get_list"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/get_list";
	GLOBAL_FORMULIR_VARS["add"] = "<?= base_url(); ?>pendaftaran/rekam_formulir";
	GLOBAL_FORMULIR_VARS["edit"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/edit/";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/view_rekam_formulir.js"></script>
<script>
$(document).on('click', '#edit', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');

    var url = "<?php echo site_url('/pendaftaran/rekam_formulir/edit') ?>/" + data;
    window.location.href = url;

});

$(document).on('click', '#hapus', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');

    var url = "<?php echo site_url('/pendaftaran/rekam_formulir/delete') ?>/" + data;
	if(window.confirm("Anda yakin untuk menghapus?")){
		$.ajax({
			type: "post",
			url: url,
			// data: {
			// 	id_produk: id_produk
			// },
			dataType: "json",
			success: function(response) {
				if (response) {
					Swal.fire(
						'Berhasil',
						response.sukses,
						'success'
					).then((result) => {
						window.location.reload();
					});
				}
			},
			error: function(xhr, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	}else{
		return false;
	}

});
</script>