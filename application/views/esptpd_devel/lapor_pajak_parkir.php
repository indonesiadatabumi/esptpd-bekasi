<script language="javascript" src="<?= base_url('assets/js/main.js') ?>"></script>
<script language="javascript" src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
<!-- <script language="javascript" src="<?= base_url('assets/js/pajak_parkir.js') ?>"></script> -->

<script>
    $(document).ready(function() {
        $("select[name=nama_rekening]").change(function() {
            var rek_id = '9';
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
                            <i class="nav-icon fas fa-parking"></i>
                            Input SPTPD Parkir
                        </h3>
                    </div>

                    <!-- Form Input -->
                    <form name="sptpdForm" id="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="spt_id" id="spt_id" class="form-control-sm" value="<?= $spt_id ?>" size="3" readonly="true" style="background-color:azure;" />
                        <input type="hidden" name="jenis_pajak" id="jenis_pajak" class="form-control-sm" value="<?= $jenis_pajak ?>" size="3" readonly="true" style="background-color:azure;" />
                        <input type="hidden" name="kode_billing" id="kode_billing" class="form-control-sm" value="<?= $kode_billing ?>" size="3" readonly="true" style="background-color:azure;" />
                        <table class="table">
                            <tr>
                                <td>
                                    <label for="name">Kode Rekening </label>
                                </td>
                                <td>
                                    <input type="hidden" name="kd_rekening" id="kd_rekening" class="form-control-sm" value="36"/>
                                    <input type="text" class="form-control-sm" value="41107" size="30" readonly="true" style="background-color:azure;" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="name">Nama Rekening </label>
                                </td>
                                <td>
                                    <select name="nama_rekening" id="nama_rekening" style="width:200px; ">
                                        <option value="38" selected>Pajak Parkir</option>
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
                            <h5><i class="fas fa-file-upload"></i> Upload Lampiran : Ukuran lampiran maksimal 1 MB</h5>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="imagefile" id="imagefile">
                                <label class="custom-file-label" for="imagefile" accept=".pdf" style="color:red;" required> * Upload file Pdf Omzet dan Bukti Setor</label>
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

    var max_masa_pajak1 = $("#StartDate").val();
    var max_masa_pajak2 = $("#EndDate").val();
    $('#searchStartDate').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: max_masa_pajak1
    });

    // $('#searchStartDate').datetimepicker().on('dp.change', function(e) {
    //     alert(formatedValue);
    // });

    $('#searchEndDate').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: max_masa_pajak2
    });

    $("#StartDate").blur(function() {
        let date = $("#StartDate").val();
        var y = date.substring(0, 4);
        var m = date.substring(5, 7);
        var d2 = y + '-' + m + '-' + lastday(y, m);

        $("#EndDate").val(d2);
        // alert("This input field has lost its focus." + d2);
    });

    var lastday = function(y, m) {
        return new Date(y, m + 1, 0).getDate();
    }


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
    // $(function() {
    //     var d = new Date(),
    //         n = d.getMonth() + 1;
    //     var masa_pajak = $('#StartDate').val();
    //     masa_pajak = masa_pajak.substring(5, 7)
    //     console.log(n)

    //     $('input[type="submit"]').prop('disabled', false);

    //     if (masa_pajak == n) {
    //         $('input[type="submit"]').prop('disabled', true);
    //     } else {
    //         $('input[type="submit"]').prop('disabled', false);
    //     }

    // });
    $(function() {
        var n = new Date().getFullYear();
        var periode_spt = $('#spt_periode').val();

        $('input[type="submit"]').prop('disabled', false);

        if (periode_spt == n) {
            $('input[type="submit"]').prop('disabled', false);
        } else {
            $('input[type="submit"]').prop('disabled', true);
        }

    });
    // $("#spt_periode").change(function() {
    //     var n = new Date().getFullYear();
    //     var periode_spt = $('#spt_periode').val();

    //     $('input[type="submit"]').prop('disabled', false);

    //     if (periode_spt == n) {
    //         $('input[type="submit"]').prop('disabled', false);
    //     } else {
    //         $('input[type="submit"]').prop('disabled', true);
    //     }

    // });
</script>
<script language="javascript" src="<?= base_url('assets/js/pajak_restoran.js') ?>">