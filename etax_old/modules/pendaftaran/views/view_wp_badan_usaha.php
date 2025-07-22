<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>pendaftaran/wp_badan_usaha"><i class="fas fa-home"> Home </i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Wajib Pajak</li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Data Wajib Pajak</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-body">
				<div class="table-responsive">
					<table id="list_wp" class="table table-sm table-hover" style="width: 100%;">
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
	var GLOBAL_WP_BU_VARS = new Array();
	GLOBAL_WP_BU_VARS["get_list_data"] = "<?= base_url(); ?>pendaftaran/wp_badan_usaha/get_list";
	GLOBAL_WP_BU_VARS["add_wp_bu"] = "<?= base_url(); ?>pendaftaran/wp_badan_usaha/add";
	GLOBAL_WP_BU_VARS["edit_wp_bu"] = "<?= base_url(); ?>pendaftaran/wp_badan_usaha/edit/";
	GLOBAL_WP_BU_VARS["tambah_op"] = "<?= base_url(); ?>pendaftaran/wp_badan_usaha/tambah_op/";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/view_wp_badan_usaha.js"></script>
<script>
$(document).on('click', '#edit', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');

    var url = "<?php echo site_url('/pendaftaran/wp_badan_usaha/edit') ?>/" + data;
    window.location.href = url;

});

$(document).on('click', '#tambah_op', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');

    var url = "<?php echo site_url('/pendaftaran/wp_badan_usaha/tambah_op') ?>/" + data;
    window.location.href = url;

});

$(document).on('click', '#hapus', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');

    var url = "<?php echo site_url('/pendaftaran/wp_badan_usaha/delete') ?>/" + data;
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