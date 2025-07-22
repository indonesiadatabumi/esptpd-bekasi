<script language="javascript" src="<?= base_url('assets/js/main.js') ?>"></script>
<script language="javascript" src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
<!-- <script language="javascript" src="<?= base_url('assets/js/add_pajak_hiburan.js') ?>"></script> -->

<script>
    $(document).ready(function() {
        $("select[name=nama_rekening]").change(function() {
            var rek_id = $("#nama_rekening").val();
            $.ajax({
                type: "POST",
                url: "<?= site_url('esptpd/get_tarif') ?>",
                dataType: "JSON",
                data: {
                    rek_id: rek_id
                },
                cache: false,
                success: function(data) {
                    // console.log(data);
                    $("#korek_persen_tarif").val(data['nilai']);
                }
            });
            $("#kode_rekening_id").val(rek_id);
        });
    });


</script>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- Input addon -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="nav-icon fas fa-music"></i>
                            Input SPTPD Hiburan
                        </h3>
                    </div>

                    <!-- Form Input -->
                    <form name="sptpdForm" id="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="spt_id" id="spt_id" class="form-control-sm" value="<?= $spt_id ?>" size="3" readonly="true" style="background-color:azure;" />
                        <input type="hidden" name="jenis_pajak" id="jenis_pajak" class="form-control-sm" value="<?= $jenis_pajak ?>" size="3" readonly="true" style="background-color:azure;" />
                        <input type="hidden" name="kode_billing" id="kode_billing" class="form-control-sm" value="<?= $kode_billing ?>" size="3" readonly="true" style="background-color:azure;" />
                        <table class="table">
                            tr>
                                <td>
                                    <label for="name">Kode Rekening </label>
                                </td>
                                <td>
                                    <input type="hidden" name="kd_rekening" id="kd_rekening" class="form-control-sm" value="8"/>
                                    <input type="text" class="form-control-sm" value="41102" size="30" readonly="true" style="background-color:azure;" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="name">Nama Rekening </label>
                                </td>
                                <td>
                                    <select name="nama_rekening" id="nama_rekening" style="width:200px; ">
                                        <option value="427" selected>Tontonan Film / Bioskop</option>
                                        <option value="429">Film Import</option>
                                        <option value="428">Film Nasional</option>
                                        <option value="426">Pagelaran Kesenian, Tari, dan/atau Pagelaran Busana</option>
                                        <option value="425">Pagelaran Kesenian, Tari</option>
                                        <option value="424">rekreasi wahana air, wahana ekologi, wahana pendidikan, wahana budaya, agrowisata,dan kebun binatang</option>
                                        <option value="344">Pagelaran Musik</option>
                                        <option value="351">rekreasi wahana salju, wahana permainan, pemancingan</option>
                                        <option value="376">Sirkus, Akrobat dan Sulap</option>
                                        <option value="14">Kontes Kecantikan, Binaraga dan Sejenisnya</option>
                                        <option value="76">Kontes Kecantikan, Binaraga dan Sejenisnya</option>
                                        <option value="359">Kontes Kecantikan, Binaraga dan Sejenisnya yang Berkelas Internasional</option>
                                        <option value="358">Pameran yang Bersifat Komersial</option>
                                        <option value="15">Diskotik, Karaoke, Klab Malam, Pub dan Sejenisnya</option>
                                        <option value="78">Diskotik, Klub malam, Pub dan Sejenisnya</option>
                                        <option value="378">Karaoke, Rumah Bernyanyi</option>
                                        <option value="16">Kolam Renang</option>
                                        <option value="69">Permainan Bilyard, Bowling</option>
                                        <option value="18">Pacuan Kuda, Kendaraan Bermotor, Road Race, Gelanggang Permainan Anak dan atau Permainan Ketangkasan</option>
                                        <option value="70">Gelanggang Permainan Anak dan atau Permainan Ketangkasan</option>
                                        <option value="77">Pacuan Kuda, Kendaraan Bermotor, Road Race</option>
                                        <option value="72">Permainan seluncur es (Ice Skating)</option>
                                        <option value="82">Permainan Panahan</option>
                                        <option value="79">Panti Pijat, Refleksi</option>
                                        <option value="373">Fitnes</option>
                                        <option value="19">Panti Pijat Modern, Panti Pijat Tradisional dan Refleksi</option>
                                        <option value="430">Fitnes (Pusat Kebugaran)</option>
                                        <option value="20">Mandi Uap/SPA</option>
                                        <option value="21">Pertandingan Olahraga</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="dasar pengenaan">Dasar Pengenaan </label>
                                </td>
                                <td>
                                    <input type="text" name="spt_nilai" id="spt_nilai" class="inputbox is-valid" size="25" onfocus="this.value=unformatCurrency(this.value);" onkeyup="getPajak('spt_pajak','spt_nilai','korek_persen_tarif');" onblur="getPajak('spt_pajak','spt_nilai','korek_persen_tarif');this.value=formatCurrency(this.value);" style="font-weight:bold;text-align:right;" required />
                                    <label for="dasar pengenaan"> Tarif (%) : </label> <input type="text" name="korek_persen_tarif" id="korek_persen_tarif" class="inputbox" size="5" readonly="true" value="10" style="font-weight:bold;background-color:azure;text-align:right;" />
                                </td>
                            </tr>
                            <tr>
                                <td><label for="pajak Terutang">Pajak Terhutang </label></td>
                                <td>
                                    <input type="text" name="spt_pajak" id="spt_pajak" class="form-control-sm is-valid" size="20" readonly="true" onkeyup="thousand_format(this);" onkeypress="return only_number(event,this);" style="font-weight:bold;font-size:25px;color:#18F518;background-color:gray;text-align:right;" required />
                                </td>
                            </tr>
                            <tr>
                                <td><label for="pajak Terutang">Pernyataan</label></td>
                                <td>
                                    <div class="row">
                                        <div> <input type="checkbox" name="disclamer" id="disclamer" class="form-control-sm is-valid" style="font-weight:bold;font-size:25px;color:#18F518;background-color:gray;text-align:right;" required /></div>
                                        <div class="disclamer_id"> Dengan ini menyatakan bahwasannya input data dan lampiran yang diupload adalah benar apa adanya,<br> apabila terbukti tidak benar maka dengan ini kami siap untuk dilakukan proses sesuai ketentuan yang berlaku!
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!-- akhir inputan -->
                        <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->

            <!-- right column -->
            <div class="col-md-3">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="callout callout-warning">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            <p>- Masukkan Data - data Laporan:</p>
                            <p>- Omzet dan Bukti Setor berformat .pdf</p>
                            <p>- Ukuran lampiran maksimal 1 MB</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="callout callout-danger">
                            <h5><i class="fas fa-file-upload"></i> Upload Lampiran :Ukuran lampiran maksimal 1 MB</h5>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="imagefile" id="imagefile">
                                <label class="custom-file-label" for="imagefile" accept=".pdf" style="color:red;" required> * Upload file Pdf omzet dan bukti setor</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="msg-tmp col-sm-12"></div>
            </div>
            <!--/.col (right) -->

            <div class="col-md-12">
                <div class="card-footer">
                    <button type="reset" class="btn btn-secondary back">Batal</button>
                    <input type="button" name="submit" class="btn btn-info float-right" id="btnSave" onclick="save()" value="Simpan"></input>
                </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>
<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function save() {
        let btn = $(this);
        btn.html(`
                <div class="spinner-border text-primary" role="status">
                     <span class="sr-only">Loading...</span>
                </div>`
        )

        if ($('#disclamer').is(":checked")) {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 
            var url = "<?php echo site_url('esptpd/insert_lapor') ?>";

            var formdata = new FormData($('#form')[0]);
            $.ajax({
                url: url,
                type: "POST",
                data: formdata,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    btn.html(`
                        <input type="button" name="submit" class="btn btn-info float-right" id="btnSave" onclick="save()" value="Simpan"></input>`
                    )
                    if (data.status == true) //if success close modal and reload ajax table
                    {
                        Swal.fire({
                            title: 'Save!',
                            text: 'Your File has bees save.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 
                        window.location.assign("<?php echo site_url('esptpd/billing_new') ?>");
                    } else if (data.error == true) {
                        Swal.fire({
                            title: 'Error!',
                            text: data.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        $('#btnSave').attr('disabled', false); //set button disable 
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                        }
                        $('#btnSave').attr('disabled', false); //set button disable 
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // console.log(jqXHR);
                    // alert(jqXHR);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error!!.'
                    });
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 

                }
            });
        } else {
            Swal.fire({
                title: 'Informasi!',
                text: 'Silakan klik checkboxes pernyataan untuk melanjutkan!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return false;
        }
    }

    $("#imagefile").change(function() {
        var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Format File Harus  : " + fileExtension.join(', '));
            $("#imagefile").val('');
        } else {
            bsCustomFileInput.init();
        }
    });
</script>