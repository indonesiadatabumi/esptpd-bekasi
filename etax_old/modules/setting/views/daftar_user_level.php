<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>

	<div class="m">
		<div class="toolbar" id="toolbar">
			<table class="toolbar">
				<tr>
					<td class="button" id="toolbar-back">
						<a href="<?= base_url() ?>navigation/setting" class="toolbar">
							<span class="icon-32-back" title="Back"></span>Back
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-pendaftaran_p">
			Tabel Data User Level
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
		<table id="formulir_table" style="display:none"></table>
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
	GLOBAL_FORMULIR_VARS["get_list"] = "<?= base_url(); ?>setting/user/get_list";
	GLOBAL_FORMULIR_VARS["aksesmenu"] = "<?= base_url(); ?>setting/user/aksesmenu/";
</script>
<script type="text/javascript" src="<?= base_url(); ?>modules/setting/scripts/daftar_user_level.js"></script>