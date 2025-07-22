<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"> Home </i></li>
  </ol>
</nav>

<div class="row">
	<div class="col">
		<h3>Pendaftaran Wajib Pajak</h3>
	</div>
</div>

<div class="row mt-3">
	<div class="col">
		<div class="card border">
			<div class="card-header">
				<button href="#" id="btn_view" class="btn btn-primary">
					<i class="fas fa-search"> Lihat Data WP </i>
				</button>
			</div>
			<div class="card-body">
				<form method="post" name="frm_add_wp_bu" id="frm_add_wp_bu">
					<input type="hidden" name="wp_wr_jenis" value="p" />
					<input type="hidden" name="wp_wr_id" value="" />
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-bidang_usaha-tab" data-toggle="pill" href="#pills-bidang_usaha" role="tab" aria-controls="pills-bidang_usaha" aria-selected="true">BIDANG USAHA</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-identitas-tab" data-toggle="pill" href="#pills-identitas" role="tab" aria-controls="pills-identitas" aria-selected="false">IDENTITAS</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-bidang_usaha" role="tabpanel" aria-labelledby="pills-bidang_usaha-tab">
							<div class="row">
								<div class="col">
									<?php
									foreach ($bidang_usaha as $key => $value) {
										echo '<input type="radio" name="bidus" value="' . $key . '" />' . $value . '<br />';
									}
									?>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col">
									<div id="detail_usaha">

									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-identitas" role="tabpanel" aria-labelledby="pills-identitas-tab">
							<p class="text-info text-center"><b><u>Data Objek Pajak</u></b></p>
							<div class="form-group row">
								<label for="wp_wr_no_urut" class="col-sm-2 col-form-label">No. Reg. Pendaftaran</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="wp_wr_no_urut" name="wp_wr_no_urut" maxlength="7" readonly>
								</div>
								<div class="col-sm-2">
									<a href="#" id="txt_next_nomor">[refresh]</a>
									<input type="hidden" name="wp_wr_gol" value="2" />
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_nama" class="col-sm-2 col-form-label">Nama OP</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="wp_wr_nama" name="wp_wr_nama" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_almt" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-8">
									<textarea class="form-control mandatory" id="wp_wr_almt" name="wp_wr_almt" style="text-transform: uppercase;" rows="3"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_kd_camat" class="col-sm-2 col-form-label">Kecamatan</label>
								<div class="col-sm-8">
									<?php
									$attributes = 'id="wp_wr_kd_camat" class="form-control mandatory"';
									echo form_dropdown('wp_wr_kd_camat', $kecamatan, '', $attributes);
									?>
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_kd_lurah" class="col-sm-2 col-form-label">Kelurahan</label>
								<div class="col-sm-8">
									<?php
									$attributes = 'id="wp_wr_kd_lurah" class="form-control mandatory"';
									echo form_dropdown('wp_wr_kd_lurah', $kelurahan, '', $attributes);
									?>
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="wp_wr_kabupaten" name="wp_wr_kabupaten" value="<?= strtoupper($kabupaten); ?>" style="text-transform: uppercase;" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_telp" class="col-sm-2 col-form-label">No. Telp</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_telp" name="wp_wr_telp" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_kodepos" class="col-sm-2 col-form-label">Kodepos</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_kodepos" name="wp_wr_kodepos" maxlength="5" style="text-transform: uppercase;">
								</div>
							</div>
							<hr>
							<p class="text-info text-center"><b><u>Data Wajib Pajak</u></b></p>
							<div class="form-group row">
								<label for="wp_wr_nama_milik" class="col-sm-2 col-form-label">Nama WP</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="wp_wr_nama_milik" name="wp_wr_nama_milik" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_almt_milik" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-8">
									<textarea class="form-control mandatory" id="wp_wr_almt_milik" name="wp_wr_almt_milik" style="text-transform: uppercase;" rows="3"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_lurah_milik" class="col-sm-2 col-form-label">Kelurahan</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_lurah_milik" name="wp_wr_lurah_milik" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_camat_milik" class="col-sm-2 col-form-label">Kecamatan</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_camat_milik" name="wp_wr_camat_milik" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_kabupaten_milik" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_kabupaten_milik" name="wp_wr_kabupaten_milik" value="<?= strtoupper($kabupaten); ?>" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_telp_milik" class="col-sm-2 col-form-label">No. Telp</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_telp_milik" name="wp_wr_telp_milik" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_kodepos_milik" class="col-sm-2 col-form-label">Kodepos</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="wp_wr_kodepos_milik" name="wp_wr_kodepos_milik" maxlength="5" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="wp_wr_nik" class="col-sm-2 col-form-label">No. NIB/NIK</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="wp_wr_nik" name="wp_wr_nik" style="text-transform: uppercase;">
								</div>
							</div>
							<div class="form-group row">
								<label for="f_date_a" class="col-sm-2 col-form-label">Tgl Diterima WP</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="f_date_a" name="wp_wr_tgl_terima_form">
								</div>
							</div>
							<div class="form-group row">
								<label for="f_date_b" class="col-sm-2 col-form-label">Tgl Batas Kirim</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="f_date_b" name="wp_wr_tgl_bts_kirim">
								</div>
							</div>
							<div class="form-group row">
								<label for="f_date_c" class="col-sm-2 col-form-label">Tgl Pendaftaran</label>
								<div class="col-sm-8">
									<input type="text" class="form-control mandatory" id="f_date_c" name="wp_wr_tgl_kartu">
								</div>
							</div>
							<button type="button" id="btn_saved" class="btn btn-block btn-primary"><i class="fas fa-save"> Simpan </i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="bidus_1" style="display: none;">
	<p class="text-center text-info"><b>Detail Hotel</b></p>
	<div class="form-group">
		<label for="gol_hotel">Golongan Hotel</label>
		<?php
		$attributes = 'id="gol_hotel" class="form-control"';
		echo form_dropdown('gol_hotel', $golongan_hotel, '', $attributes);
		?>
	</div>
	<div class="form-group">
		<label for="txt_jumlah_kamar">Total Jumlah Kamar</label>
		<input type="text" class="form-control" id="txt_jumlah_kamar" name="txt_jumlah_kamar" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_standar">Jumlah Standar</label>
				<input type="text" class="form-control" id="txt_jumlah_standar" name="txt_jumlah_standar" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_standar">Tarif Standar</label>
				<input type="text" class="form-control" id="txt_tarif_standar" name="txt_tarif_standar" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_standar_ac">Jumlah Standar AC</label>
				<input type="text" class="form-control" id="txt_jumlah_standar_ac" name="txt_jumlah_standar_ac" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_standar_ac">Tarif Standar AC</label>
				<input type="text" class="form-control" id="txt_tarif_standar_ac" name="txt_tarif_standar_ac" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_double">Jumlah Double</label>
				<input type="text" class="form-control" id="txt_jumlah_double" name="txt_jumlah_double" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_double">Tarif Double</label>
				<input type="text" class="form-control" id="txt_tarif_double" name="txt_tarif_double" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_superior">Jumlah Superior</label>
				<input type="text" class="form-control" id="txt_jumlah_superior" name="txt_jumlah_superior" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_superior">Tarif Superior</label>
				<input type="text" class="form-control" id="txt_tarif_superior" name="txt_tarif_superior" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_delux">Jumlah Delux</label>
				<input type="text" class="form-control" id="txt_jumlah_delux" name="txt_jumlah_delux" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_delux">Tarif Delux</label>
				<input type="text" class="form-control" id="txt_tarif_delux" name="txt_tarif_delux" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_executive_suite">Jumlah Executive Suite</label>
				<input type="text" class="form-control" id="txt_jumlah_executive_suite" name="txt_jumlah_executive_suite" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_executive_suite">Tarif Executive Suite</label>
				<input type="text" class="form-control" id="txt_tarif_executive_suite" name="txt_tarif_executive_suite" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_club_room">Jumlah Club Room</label>
				<input type="text" class="form-control" id="txt_jumlah_club_room" name="txt_jumlah_club_room" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_club_room">Tarif Club Room</label>
				<input type="text" class="form-control" id="txt_tarif_club_room" name="txt_tarif_club_room" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_jumlah_apartment">Jumlah Apartment</label>
				<input type="text" class="form-control" id="txt_jumlah_apartment" name="txt_jumlah_apartment" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="txt_tarif_apartment">Tarif Apartment</label>
				<input type="text" class="form-control" id="txt_tarif_apartment" name="txt_tarif_apartment" onKeypress="return numbersonly(this, event)">
			</div>
		</div>
	</div>
</div>

<div id="bidus_16" style="display: none;">
	<p class="text-center text-info"><b>Detail Restoran</b></p>
	<div class="form-group">
		<label for="ddl_jenis_restoran">Golongan Restoran</label>
		<?php
		$attributes = 'id="ddl_jenis_restoran" class="form-control"';
		echo form_dropdown('ddl_jenis_restoran', $jenis_restoran, '', $attributes);
		?>
	</div>
	<div class="form-group">
		<label for="txt_jumlah_meja">Jumlah Meja</label>
		<input type="text" class="form-control" id="txt_jumlah_meja" name="txt_jumlah_meja" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="form-group">
		<label for="txt_jumlah_kursi">Jumlah Kursi</label>
		<input type="text" class="form-control" id="txt_jumlah_kursi" name="txt_jumlah_kursi" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="form-group">
		<label for="txt_kapasitas_pengunjung">Kapasitas Pengunjung</label>
		<input type="text" class="form-control" id="txt_kapasitas_pengunjung" name="txt_kapasitas_pengunjung" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="form-group">
		<label for="txt_jumlah_karyawan">Jumlah Karyawan</label>
		<input type="text" class="form-control" id="txt_jumlah_karyawan" name="txt_jumlah_karyawan" onKeypress="return numbersonly(this, event)">
  	</div>	
</div>

<div id="bidus_11" style="display: none;">
	<p class="text-center text-info"><b>Detail Hiburan</b></p>
	<div class="form-group">
		<label for="ddl_jenis_restoran">Golongan Hotel</label>
		<?php
		$attributes = 'id="ddl_jenis_restoran" class="form-control"';
		echo form_dropdown('ddl_jenis_restoran', $jenis_restoran, '', $attributes);
		?>
	</div>
	<div class="form-group">
		<label for="txt_jumlah_meja">Jumlah Meja</label>
		<input type="text" class="form-control" id="txt_jumlah_meja" name="txt_jumlah_meja" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="form-group">
		<label for="txt_jumlah_kursi">Jumlah Kursi</label>
		<input type="text" class="form-control" id="txt_jumlah_kursi" name="txt_jumlah_kursi" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="form-group">
		<label for="txt_kapasitas_pengunjung">Kapasitas Pengunjung</label>
		<input type="text" class="form-control" id="txt_kapasitas_pengunjung" name="txt_kapasitas_pengunjung" onKeypress="return numbersonly(this, event)">
  	</div>
	<div class="form-group">
		<label for="txt_jumlah_karyawan">Jumlah Karyawan</label>
		<input type="text" class="form-control" id="txt_jumlah_karyawan" name="txt_jumlah_karyawan" onKeypress="return numbersonly(this, event)">
  	</div>	
</div>

<script type="text/javascript">
	var GLOBAL_WP_BU_VARS = new Array();
	GLOBAL_WP_BU_VARS["get_next_number_wp"] = "<?= base_url(); ?>common/get_next_number_wp";
	GLOBAL_WP_BU_VARS["view_wp_badan_usaha"] = "<?= base_url(); ?>pendaftaran/wp_badan_usaha/view/";
	GLOBAL_WP_BU_VARS["save_wp_badan_usaha"] = "<?= base_url(); ?>pendaftaran/wp_badan_usaha/save/";
	GLOBAL_WP_BU_VARS["cetak"] = "<?= base_url(); ?>pendaftaran/cetak_kartu_npwpd/cetak_npwpd";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/add_wp_badan_usaha.js"></script>