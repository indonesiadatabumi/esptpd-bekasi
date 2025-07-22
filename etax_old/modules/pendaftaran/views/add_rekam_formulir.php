<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"> Home </i></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Form Formulir Pendaftaran</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-header">
				<button href="#" id="btn_view" class="btn btn-primary">
					<i class="fas fa-search"> Lihat Data</i>
				</button>
			</div>
			<div class="card-body">
				<form name="frm_rekam_formulir" id="frm_rekam_formulir">
					<div class="form-group row">
						<label for="txt_no_formulir" class="col-sm-2 col-form-label">No. Formulir</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_no_formulir" name="txt_no_formulir">
						</div>
						<div class="col-sm-2">
							<a href="#" id="txt_next_nomor">[refresh]</a>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_nama" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_nama" name="txt_nama" style="text-transform: uppercase;">
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_alamat" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-8">
							<textarea class="form-control mandatory" id="txt_alamat" name="txt_alamat" style="text-transform: uppercase;" rows="3"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_kode_camat" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-8">
							<?php
							$attributes = 'id="txt_kode_camat" class="form-control mandatory"';
							echo form_dropdown('txt_kode_camat', $kecamatan, '', $attributes);
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_kode_lurah" class="col-sm-2 col-form-label">Kelurahan</label>
						<div class="col-sm-8">
							<?php
							$attributes = 'id="txt_kode_lurah" class="form-control mandatory"';
							echo form_dropdown('txt_kode_lurah', $kelurahan, '', $attributes);
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_kabupaten" name="txt_kabupaten" value="<?= strtoupper($kabupaten); ?>" style="text-transform: uppercase;" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="ddl_status" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-8">
							<?php
							$attributes = 'id="ddl_status" class="form-control mandatory"';
							echo form_dropdown('ddl_status', $status, '', $attributes);
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_tgl_kirim" class="col-sm-2 col-form-label">Tanggal</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_tgl_kirim" name="txt_tgl_kirim">
						</div>
					</div>
					<button type="button" id="btn_save" class="btn btn-block btn-primary"><i class="fas fa-save"> Simpan </i></button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var GLOBAL_FORMULIR_VARS = new Array();
	GLOBAL_FORMULIR_VARS["next_no_formulir"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/next_no_formulir";
	GLOBAL_FORMULIR_VARS["view"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/view/";
	GLOBAL_FORMULIR_VARS["save"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/save/";
</script>

<script type="text/javascript" src="<?= base_url('modules/pendaftaran/scripts/add_rekam_formulir.js'); ?>"></script>