<?= $content1; ?>
<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>

	<div class="m">
		<div class="header icon-48-pendaftaran_p">
			Verifikasi Pendaftaran WP
		</div>
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>

<div class="clr"></div>

<div id="element-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	<div class="m">
		<form action="">
            <span id="callData"></span>
            <div class="row">
                <div class="col md-6">
                    <table class="admintable" border=0 cellspacing="1">
                        <tr>
                            <td width="150" class="key">
                                <label for="name">No. Formulir</label>
                            </td>
                            <td>
                                <input type="text" size="10" maxlength="8" class="mandatory" id="txt_no_formulir" name="txt_no_formulir" value="<?= $wp_detail->wp_wr_no_form?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><label for="nama_wp">Jenis Pajak</label></td>
                            <td>
                            <textarea style="text-transform: uppercase;" cols="40" rows=2 name="txt_jenis_pajak" id="txt_jenis_pajak" class="inputbox mandatory" readonly><?= $jenis_pajak->ref_bidang_usaha_nama?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><label for="nama_wp">Nama WP</label></td>
                            <td>
                                <input style="text-transform: uppercase;" type="text" name="txt_nama" id="txt_nama" class="inputbox mandatory" size="40" value="<?= $wp_detail->wp_wr_nama?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td class="key" valign="top"><label for="alamat">Alamat</label></td>
                            <td>
                                <textarea style="text-transform: uppercase;" cols="40" rows=2 name="txt_alamat" id="txt_alamat" class="inputbox mandatory" readonly><?= $wp_detail->wp_wr_almt?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><label for="lbl_kelurahan">Kelurahan</label></td>
                            <td>
                                <input style="text-transform: uppercase;" type="text" name="txt_kelurahan" id="txt_kelurahan" class="inputbox mandatory" size="40" value="<?= $wp_detail->wp_wr_lurah?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"><label for="lbl_kecamatan">Kecamatan</label></td>
                            <td>
                                <input style="text-transform: uppercase;" type="text" name="txt_kecamatan" id="txt_kecamatan" class="inputbox mandatory" size="40" value="<?= $wp_detail->wp_wr_camat?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td class="key">Kabupaten/Kota</td>
                            <td>
                                <input style="text-transform: uppercase;" type="text" name="txt_kabupaten" id="txt_kabupaten" class="inputbox mandatory" size="40" value="<?= $wp_detail->wp_wr_kabupaten?>" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td class="key">Status Pending</td>
                            <td>
                                <input type="checkbox" name="stat_regis" id="stat_regis">
                            </td>
                        </tr>
                        <tr>
                            <td class="key">Keterangan</td>
                            <td>
                                <textarea cols="40" rows=2 name="txt_keterangan" id="txt_keterangan" class="inputbox mandatory"></textarea>
                            </td>
                        </tr>   
                    </table>
                </div>
                <div class="col md-6">
                    <h5><i class='fa fa-files-o'></i> Lampiran Dokumen</h5>
                    <?php
                    if ($wp_detail->wp_wr_lamp == null){
                        echo "<embed src='http://36.66.115.131:8000/ci-esptpd/assets/foto/pendaftaran/default.pdf' width='400px' height='300px'></embed><br>";
                    }else {
                        echo "<embed src='http://36.66.115.131:8000/ci-esptpd/assets/foto/pendaftaran/$wp_detail->wp_wr_lamp' width='400px' height='300px'></embed><br>";
                    }
                    ?>
                    <i class='fa fa-search-plus'> Klik Untuk Memperbesar </i>
                </div>
            </div>
        </form>
        <?php
        // echo $_SERVER['SERVER_NAME']; 
        if ($wp_detail->wp_wr_status_aktif == 'f'){
            echo "
                <button type='button' id='btn_save' class='btn-wide btn btn-success'>
                    Verifikasi
                </button>";
        }else {
            echo "
                <button type='button' id='btn_save' class='btn-wide btn btn-success' disabled>
                    Verifikasi
                </button>";
        }       
        ?>
	</div>

	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var GLOBAL_FORMULIR_VARS = new Array();
	// GLOBAL_FORMULIR_VARS["get_list"] = "<?= base_url(); ?>pendaftaran/verifikasi/get_list";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/view_verifikasi_wp.js"></script>