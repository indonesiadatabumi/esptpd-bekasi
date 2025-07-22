<script language="javascript" src="<?= base_url('assets/js/main.js') ?>"></script>
<script language="javascript" src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>

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
                            <i class="nav-icon fas fa-utensils"></i>
                            Input SPTPD PBJT Makanan dan atau Minuman
                        </h3>
                    </div>

                    <!-- Form Input -->
                    <form name="sptpdForm" id="form" method="post" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <td><label for="no_sptpd">No. SPTPD</label></td>
                                <td>
                                    <input type="hidden" name="wp_id" id="wp_id" class="form-control-sm" value="<?= $wp_id ?>" size="3" readonly="true" style="background-color:azure;" />
                                    <input type="hidden" name="spt_jenis" id="spt_jenis" class="form-control-sm" value="2" size="3" readonly="true" style="background-color:azure;" />
                                    <input type="hidden" name="spt_status" id="spt_status" class="form-control-sm" value="8" size="3" readonly="true" style="background-color:azure;" />
                                    <input type="text" name="kd_spt" id="kd_spt" class="form-control-sm" value="<?= $kode_spt ?>" size="3" readonly="true" style="background-color:azure;" />
                                    <input type="text" name="no_sptpd" id="no_sptpd" class="form-control-sm mandatory" size="15" value="<?= $no_register ?>" maxlength="5" readonly="true" style="background-color:azure;" />
                                    <span style="vertical-align:middle; "><img src="<?= base_url('assets/images/reload.png') ?>" title="refresh spt" style="cursor:pointer; " id="btnRefresh"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">NPWPD</label>
                                </td>
                                <td>
                                    <input type="text" name="npwpd" id="npwpd" class="form-control-sm" value="<?= $npwprd ?>" readonly="true" style="background-color:azure;" />
                            </tr>
                            <tr>
                                <td>
                                    <label for="nama_wp">Nama WP</label>
                                </td>
                                <td>
                                    <input type="text" name="nama_lengkap_wp" id="nama_lengkap_wp" class="form-control-sm" size="70" readonly="true" value="<?= $nama ?>" style="background-color:azure;text-transform: uppercase;" />
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label for="alamat_wp">Alamat</label>
                                </td>
                                <td>
                                    <textarea cols="34" rows="3" name="alamat_lengkap_usaha" id="alamat_lengkap_usaha" class="form-control-sm" readonly="true" style="background-color:azure;text-transform: uppercase;"><?= $alamat ?></textarea>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>
                                    <label for="nama_wp">Kelurahan</label>
                                </td>
                                <td>
                                    <input type="text" name="kelurahan" id="kelurahan" class="form-control-sm" size="40" readonly="true" value="<?= $kelurahan ?>" style="background-color:azure;text-transform: uppercase;" />
                            </tr>
                            <tr>
                                <td>
                                    <label for="nama_wp">Kecamatan</label>
                                </td>
                                <td>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control-sm" size="40" readonly="true" value="<?= $kecamatan ?>" style="background-color:azure;text-transform: uppercase;" />
                            </tr>
                            <tr>
                                <td>
                                    <label for="nama_wp">Kota</label>
                                </td>
                                <td>
                                    <input type="text" name="kota" id="kota" class="form-control-sm" size="40" readonly="true" value="<?= $kota ?>" style="background-color:azure;text-transform: uppercase;" />
                            </tr> -->
                            <tr>
                                <td valign="top">
                                    <label for="gid">Masa Pajak</label>

                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3">
                                            <div class="form-group">

                                                <div class="input-group date" id="searchStartDate" data-target-input="nearest">

                                                    <input type="text" class="form-control datetimepicker-input StartDate" name="spt_periode_jual1" id="StartDate" value="<?= $masa_awal ?>" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#searchStartDate"/>

                                                    <div class="input-group-append" data-target="#searchStartDate" data-toggle="datetimepicker">

                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>s/d
                                        <div class="col-xs-3 col-sm-3">
                                            <div class="form-group">

                                                <div class="input-group date" id="searchEndDate" data-target-input="nearest">

                                                    <input type="text" class="form-control datetimepicker-input EndDate" name="spt_periode_jual2" id="EndDate" value="<?= $masa_akhir ?>" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#searchEndDate" />

                                                    <div class="input-group-append" data-target="#searchEndDate" data-toggle="datetimepicker">

                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- <input type="text" name="spt_periode_jual1" id="spt_periode_jual1" size="12" value="<?= $masa_awal ?>" class="form-control-sm" style="background-color:bisque;" /> s/d
                                    <input type="text" name="spt_periode_jual2" id="spt_periode_jual2" size="12" value="<?= $masa_akhir ?>" class="form-control-sm" style="background-color:bisque;" /> -->
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="password">Periode Lapor SPT</label>
                                </td>
                                <td>
                                    <!-- <input type="text" name="spt_periode" id="spt_periode" size="11" value="<?= substr($masa_awal, 0, 4) ?>" class="form-control-sm" style="background-color:azure;" /> -->
                                    <input type="text" name="spt_periode" id="spt_periode" size="11" value="<?= date('Y') ?>" class="form-control-sm" style="background-color:bisque;"/>
                                </td>
                            </tr>

                            <tr>
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
                                    <!-- <select name="nama_rekening" id="nama_rekening" style="width:200px; ">
                                        <option value="9" selected>Rumah Makan</option>
                                        <option value="10">Katering</option>
                                    </select> -->
                                    <!-- <input type="hidden" size="4" name="kode_rekening_id" id="kode_rekening_id" value="9"> -->
                                    <select name="nama_rekening" id="nama_rekening" style="width:200px; ">
                                        <option value="9" selected>Rumah Makan</option>
                                        <option value="10">Katering</option>
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
                            <!-- <tr>
                                <td><label for="pajak Terutang">Pernyataan</label></td>
                                <td>
                                    <div class="row">
                                        <div> <input type="checkbox" name="disclamer" id="disclamer" class="form-control-sm is-valid" style="font-weight:bold;font-size:25px;color:#18F518;background-color:gray;text-align:right;" required /></div>
                                        <div class="disclamer_id"> Dengan ini menyatakan bahwasannya input data dan lampiran yang diupload adalah benar apa adanya,<br> apabila terbukti tidak benar maka dengan ini kami siap untuk dilakukan proses sesuai ketentuan yang berlaku!
                                        </div>
                                    </div>
                                </td>
                            </tr> -->

                        </table>

                        <!-- akhir inputan -->
                        <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->


            <!-- right column -->
            <!-- <div class="col-md-3">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="callout callout-warning">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            <p>- Masukkan Data - data Laporan:</p>
                            <p>- Masa Pajak, Periode, Omzet dan Lampiran Laporan berformat .pdf</p>
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
                                <label class="custom-file-label" for="imagefile" accept=".pdf" style="color:red;" required> * Upload file Pdf</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="msg-tmp col-sm-12"></div>
            </div> -->
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

    $(document).ready(function() {

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

        $("#btnRefresh").click(function() {
            var periode = $("#spt_periode").val();
            var jenis_pajret = $("#spt_jenis").val();
            var spt_kode = $("#kd_spt").val();
            $.ajax({
                type: "POST",
                url: "<?= site_url('esptpd/next_spt_no_register') ?>",
                dataType: "JSON",
                data: {
                    periode: periode,
                    pajret: jenis_pajret,
                    spt_kode: spt_kode
                },
                cache: false,
                success: function(data) {
                    // if (data.length > 0) {
                    //     // console.log(data['nomor']);
                    //     $('#no_sptpd').val(data['nomor']);
                    // }
                    $('#no_sptpd').val(data['nomor']);
                }
            });
        });
    });

    // var ldmonth = function(obj) {

    //     alert('xxx');
    //     var T = obj.value;
    //     var D = new Date();
    //     var dt = T.split("/");
    //     D.setFullYear(dt[2]); //alert("__1_>"+D.toString());  
    //     D.setMonth(dt[1] - 1); // alert("__2_>"+D.toString());  
    //     D.setDate("32");
    //     var ldx = 32 - D.getDate();
    //     var m = D.getMonth();
    //     if (m == "0") m = "12";
    //     if (m < 10) m = "0" + m;
    //     var ldo = ldx + "/" + m + "/" + dt[2]; //D.getFullYear();
    //     if (ldo != "NaN-NaN-undefined") {
    //         $('input[name=spt_periode_jual2]').val(ldo);
    //     } else {
    //         $('input[name=spt_periode_jual2]').val('');
    //     }
    // };


    function save() {
        var url = "<?php echo site_url('esptpd/insert') ?>";

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
                alert(jqXHR);
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

    // $("#imagefile").change(function() {
    //     var fileExtension = ['pdf'];
    //     if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
    //         alert("Format File Harus  : " + fileExtension.join(', '));
    //         $("#imagefile").val('');
    //     } else {
    //         bsCustomFileInput.init();
    //     }
    // });

    // $(function() {
    //     var d = new Date(),
    //         n = d.getMonth() + 1;
    //     var masa_pajak = $('#StartDate').val();
    //     masa_pajak = masa_pajak.substring(5, 7)
    //     // alert(n);

    //     $('input[type="submit"]').prop('disabled', false);

    //     if (masa_pajak == n) {
    //         $('input[type="submit"]').prop('disabled', false);
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