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
		<table id="verifikasi_table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="bg-info text-white">
                    <th>Nomor Formulir</th>
                    <th>Nama WP</th>
                    <th>Alamat WP</th>
                    <th>Kelurahan </th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
		<input type="hidden" name="id" value="" />
		<div class="clr"></div>
	</div>

	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var GLOBAL_FORMULIR_VARS = new Array();
	GLOBAL_FORMULIR_VARS["get_list"] = "<?= base_url(); ?>pendaftaran/verifikasi/get_list";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/pendaftaran/scripts/view_verifikasi_wp.js"></script>
<script>
$(document).on('click', '#edit', function(e) {
	e.preventDefault();
    e.stopPropagation();

    var data = $(this).data('href');

    var url = "<?php echo site_url('/pendaftaran/verifikasi/register') ?>/" + data;
    window.location.href = url;

});
</script>