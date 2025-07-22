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
			Tambah Hak Akses User
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
		<form action="<?= base_url()?>setting/user/simpanaksesmenu" method="post">
            <input type="hidden" name="usr_type_id" value="<?= $jab_id ?>">
            <label for="">Daftar Menu</label>
            <select name="men_id" id="">
                <?php foreach($menu as$row) :?>
                    <option value="<?= $row['men_id']?>"><?= $row['title']?></option>
                <?php endforeach ?>
            </select>
            <label for="">Read</label>
            <input type="checkbox" name="read_priv">
            <label for="">Edit</label>
            <input type="checkbox" name="edit_priv">
            <label for="">Delete</label>
            <input type="checkbox" name="delete_priv">
            <label for="">Add</label>
            <input type="checkbox" name="add_priv">
            <button type="submit">Simpan</button>
        </form>
	</div>

	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>