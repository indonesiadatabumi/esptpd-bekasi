<?= $content1; ?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-card mb-6 card">
			<div class="card-header">
				<h5 class="card-title">Cetak Daftar Induk WP</small> </h5>
				<div class="btn-actions-pane-right">
					<div class="d-inline-block dropdown">
						<button type="button" id="btn_view" class="btn-shadow  btn btn-info">
							<span class="btn-icon-wrapper pr-2 opacity-7">
								<i class="fa fa-print fa-w-20"></i>
							</span>
							CETAK
						</button>
					</div>
				</div>
			</div>
			<div class="card-body">

				<div id="element-box">
					<div class="t">
						<div class="t">
							<div class="t"></div>
						</div>
					</div>
					<div class="m">
						<!-- content body -->
						<form name="frm_daftar_induk" id="frm_daftar_induk" action="" method="post">
							<fieldset>
								<legend>Cetak Daftar Induk WP</legend>
								<table class="admintable">
									<tr>
										<td class="key">Golongan</td>
										<td>
											<select name="wp_wr_jenis" id="wp_wr_jenis">
												<option value="p">P</option>
												<!-- <option value="r">R</option> -->
											</select>&nbsp;&nbsp;
											<select name="wp_wr_golongan" id="wp_wr_golongan">
												<option value="1"> 1 | Pribadi </option>
												<option value="2" selected="selected"> 2 | Badan Usaha </option>
												<option value="0"> 0 | Semua Golongan </option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="key" id="namabidus">Jenis Pajak</td>
										<td id="pilihbidus">
											<?php
											$attributes = 'id="bidus" class="inputbox"';
											echo form_dropdown('bidus', $bidang_usaha, '', $attributes);
											?>
										</td>
									</tr>
									<tr>
										<td class="key">Kecamatan</td>
										<td>
											<?php
											$attributes = 'id="wp_wr_kd_camat" class="inputbox mandatory"';
											echo form_dropdown('wp_wr_kd_camat', $kecamatan, '', $attributes);
											?>
										</td>
									</tr>
									<tr>
										<td class="key">Kelurahan</td>
										<td>
											<span id="pilihan_kelurahan"></span>
											<?php
											$attributes = 'id="wp_wr_kd_lurah" class="inputbox"';
											echo form_dropdown('wp_wr_kd_lurah', $kelurahan, '', $attributes);
											?>
										</td>
									</tr>
									<tr>
										<td class="key">Tgl. Pendaftaran</td>
										<td>
											<input type="text" id="fDate" name="fDate" size="10" />
											s / d
											<input type="text" id="tDate" name="tDate" size="10" />
										</td>
									</tr>
									<tr>
										<td class="key">Mengetahui</td>
										<td>
											<?php
											$attributes = 'id="ddl_mengetahui" class="inputbox"';
											echo form_dropdown('ddl_mengetahui', $pejabat_daerah, '', $attributes);
											?>
										</td>
									</tr>
									<tr>
										<td class="key">Diperiksa oleh</td>
										<td>
											<?php
											$attributes = 'id="ddl_pemeriksa" class="inputbox"';
											echo form_dropdown('ddl_pemeriksa', $pejabat_daerah, '', $attributes);
											?>
										</td>
									</tr>
									<tr>
										<td class="key"> Baris Spasi </td>
										<td>
											<select name="linespace" id="linespace" tabindex="4">
												<option value="3.5">3.5</option>
												<option value="4">4.0</option>
												<option value="4.5" selected>4.5</option>
												<option value="5">5.0</option>
												<option value="5.5">5.5</option>
												<option value="6">6.0</option>
												<option value="6.5">6.5</option>
												<option value="7">7</option>
												<option value="7.5">7.5</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="key">Tgl. Cetak</td>
										<td>
											<input type="text" name="tgl_cetak" id="tgl_cetak" size="10" />
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="button" name="format_cetak" id="format_cetak_pdf" value="  Cetak PDF " class="button" />
											&nbsp;&nbsp;&nbsp;
											<input type="button" name="format_cetak_xls" id="format_cetak_xls" value="  Cetak Excel " class="button" />
										</td>
									</tr>
								</table>
							</fieldset>
						</form>
						<div class="clr"></div>
					</div>

					<div class="b">
						<div class="b">
							<div class="b"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/form_daftar_induk_wpwr.js"></script>