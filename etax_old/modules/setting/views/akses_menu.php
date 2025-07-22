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
						<a href="<?= base_url() ?>/etax/setting/user" class="toolbar">
							<span class="icon-32-back" title="Back"></span>Back
						</a>
					</td>

					<td class="button" id="toolbar-new">
						<a href="<?= base_url() ?>setting/user/addaksesmenu/<?= $jab_id?>" class="toolbar">
							<span class="icon-32-new" title="Add"></span>Add
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="header icon-48-pendaftaran_p">
			Tabel Akses Menu
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
		<table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Menu</th>
                    <th class="text-center">Hak Akses</th>
					<th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no = 1;
                    foreach ($akses_menu as $row) :
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td class="text-center"><input type="checkbox" checked="checked" disabled></td>
					<td><a class="btn btn-sm" href="#" onclick="hapus('<?= $row['men_id'] ?>', '<?= $row['title'] ?>', '<?= $row['usr_type_id'] ?>')">Hapus</a></td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
	</div>

	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>
<script>
	function hapus(men_id, title, usr_type_id){
		var konfirmasi = confirm(`Anda yakin ingin menghapus hak akses ${title}?`)
		if (konfirmasi) {
			$.ajax({
				type: "post",
                url: "<?= base_url() ?>setting/user/hapusaksesmenu",
                data: {
                    men_id: men_id,
					usr_type_id: usr_type_id
                },
                dataType: "json",
				success: function(response) {
                    alert(response.sukses)
					window.location.reload();
                },
			})
		}else{
			return false
		}
	}
</script>
