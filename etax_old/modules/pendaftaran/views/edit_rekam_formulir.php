<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>pendaftaran/rekam_formulir"><i class="fas fa-home"> Home </i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Formulir Pendaftaran</li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Edit Formulir Pendaftaran</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-body">
				<form name="frm_rekam_formulir" id="frm_rekam_formulir">
					<input type="hidden" name="form_id" value="<?= $row->form_id; ?>">
					<div class="form-group row">
						<label for="txt_no_formulir" class="col-sm-2 col-form-label">No. Formulir</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_no_formulir" name="txt_no_formulir" value="<?= $row->form_nomor; ?>" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_nama" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_nama" name="txt_nama" style="text-transform: uppercase;" value="<?= $row->form_nama; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_alamat" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-8">
							<textarea class="form-control mandatory" id="txt_alamat" name="txt_alamat" style="text-transform: uppercase;" rows="3"><?= $row->form_alamat; ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_kode_camat" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-8">
							<?php
							$attributes = 'id="txt_kode_camat" class="form-control mandatory"';
							echo form_dropdown('txt_kode_camat', $kecamatan, $row->form_camat, $attributes);
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_kode_lurah" class="col-sm-2 col-form-label">Kelurahan</label>
						<div class="col-sm-8">
							<?php
							$attributes = 'id="txt_kode_lurah" class="form-control mandatory"';
							echo form_dropdown('txt_kode_lurah', $kelurahan, $row->form_lurah, $attributes);
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
							echo form_dropdown('ddl_status', $status, $row->form_status, $attributes);
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="txt_tgl_kirim" class="col-sm-2 col-form-label">Tanggal</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mandatory" id="txt_tgl_kirim" name="txt_tgl_kirim" value="<?= format_tgl($row->form_tgl_kirim); ?>">
						</div>
					</div>
					<button type="button" id="btn_update" class="btn btn-block btn-primary"><i class="fas fa-save"> Simpan </i></button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var GLOBAL_FORMULIR_VARS = new Array();
	GLOBAL_FORMULIR_VARS["next_no_formulir"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/next_no_formulir";
	GLOBAL_FORMULIR_VARS["add"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/";
	GLOBAL_FORMULIR_VARS["view"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/view/";
	GLOBAL_FORMULIR_VARS["update"] = "<?= base_url(); ?>pendaftaran/rekam_formulir/update/";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/edit_rekam_formulir.js"></script>