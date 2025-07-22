<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"> Home </i></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Cetak Daftar Formulir Pendaftaran</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-body">
				<form method="post" name="frm_cetak_formulir" id="frm_cetak_formulir">
					<div class="form-group row">
						<label for="from_formulir" class="col-sm-2 col-form-label">Nomor Formulir</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="from_formulir" name="from_formulir" maxlength="8">
						</div>
						<div class="col-sm-2">
							<p class="text-center">s/d</p>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="to_formulir" name="to_formulir" maxlength="8">
						</div>
					</div>
					<div class="form-group row">
						<label for="fDate" class="col-sm-2 col-form-label">Tanggal Kirim</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="fDate" name="fDate" maxlength="10">
						</div>
						<div class="col-sm-2">
							<p class="text-center">s/d</p>
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="tDate" name="tDate" maxlength="10">
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<select class="form-control" name="status" id="status">
								<option value="">--</option>
								<option value="1">Dikirim</option>
								<option value="2">Kembali</option>
								<option value="0">Belum Kembali</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="tgl_cetak" class="col-sm-2 col-form-label">Tanggal Cetak</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="tgl_cetak" id="tgl_cetak" value="" maxlength="10">
						</div>
					</div>
					<div class="form-group row">
						<label for="ddl_mengetahui" class="col-sm-2 col-form-label">Mengetahui</label>
						<div class="col-sm-10">
							<?php
							$attributes = 'id="ddl_mengetahui" class="form-control"';
							echo form_dropdown('ddl_mengetahui', $pejabat_daerah, '', $attributes);
							?>
						</div>
					</div>
					<div class="form-group row">
						<label for="ddl_pemeriksa" class="col-sm-2 col-form-label">Diperiksa Oleh</label>
						<div class="col-sm-10">
							<?php
							$attributes = 'id="ddl_pemeriksa" class="form-control"';
							echo form_dropdown('ddl_pemeriksa', $pejabat_daerah, '', $attributes);
							?>
						</div>
					</div>
					<button type="button" id="btn_cetak" class="btn btn-block btn-primary"><i class="fas fa-print"> Cetak </i></button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/form_cetak_daftar_formulir.js"></script>