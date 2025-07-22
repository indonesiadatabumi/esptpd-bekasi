<script language="javascript" src="<?= base_url('assets/js/main.js') ?>"></script>
<script language="javascript" src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
<!-- <script language="javascript" src="<?= base_url('assets/js/add_pajak_hiburan.js') ?>"></script> -->

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
                            <!-- <i class="nav-icon fas fa-music"></i> -->
                            Update Billing
                        </h3>
                    </div>

                    <!-- Form Input -->
                    <form name="sptpdForm" id="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="spt_id" id="spt_id" class="form-control-sm" value="<?= $spt_id ?>" size="3" readonly="true" style="background-color:azure;" />
                        <table class="table">
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
                                    <input type="text" name="nama_lengkap_wp" id="nama_lengkap_wp" class="form-control-sm" size="40" readonly="true" value="<?= $nama ?>" style="background-color:azure;text-transform: uppercase;" />
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label for="alamat_wp">Alamat</label>
                                </td>
                                <td>
                                    <textarea cols="34" rows="3" name="alamat_lengkap_usaha" id="alamat_lengkap_usaha" class="form-control-sm" readonly="true" style="background-color:azure;text-transform: uppercase;"><?= $alamat ?></textarea>
                                </td>
                            </tr>
                            <tr>
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
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label for="gid">Masa Pajak</label>

                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3">
                                            <div class="form-group">

                                                <div class="input-group date" id="searchStartDate" data-target-input="nearest">
                                                    <!-- onchange="changeDate(this);" -->
                                                    <input type="text" class="form-control datetimepicker-input StartDate" name="spt_periode_jual1" id="StartDate" value="<?= $spt_periode_jual1 ?>" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#searchStartDate"/>
                                                    <div class="input-group-append" data-target="#searchStartDate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>s/d
                                        <div class="col-xs-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="input-group date" id="searchEndDate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input EndDate" name="spt_periode_jual2" id="EndDate" value="<?= $spt_periode_jual2 ?>" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#searchEndDate"/>
                                                    <div class="input-group-append" data-target="#searchEndDate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="password">Periode Lapor SPT</label>
                                </td>
                                <td>
                                    <input type="text" name="spt_periode" id="spt_periode" size="11" value="<?= $spt_periode?>" class="form-control-sm" style="background-color:bisque;"/>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="dasar pengenaan">Dasar Pengenaan </label>
                                </td>
                                <td>
                                    <input type="text" name="spt_nilai" id="spt_nilai" class="inputbox is-valid" size="25" value="<?= $spt_dt_jumlah ?>" onfocus="this.value=unformatCurrency(this.value);" onkeyup="getPajak('spt_pajak','spt_nilai','korek_persen_tarif');" onblur="getPajak('spt_pajak','spt_nilai','korek_persen_tarif');this.value=formatCurrency(this.value);" style="font-weight:bold;text-align:right;" required />
                                    <label for="dasar pengenaan"> Tarif (%) : </label> <input type="text" name="korek_persen_tarif" id="korek_persen_tarif" class="inputbox" size="5" value="<?= $spt_dt_persen_tarif ?>" readonly="true" value="10" style="font-weight:bold;background-color:azure;text-align:right;" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="spt_pajak">Piutang Pajak</label>
                                </td>
                                <td>
                                    <input type="text" name="spt_pajak" id="spt_pajak" class="inputbox" value="<?= $spt_pajak ?>" size="20" onkeyup="this.value=formatCurrency(this.value);" style="font-weight:bold;font-size:25px;color:#18F518;background-color:black;text-align:right;">
                                </td>
                            </tr>
                        </table>
                        <!-- akhir inputan -->
                        <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->

            <div class="col-md-12">
                <div class="card-footer">
                    <button type="reset" class="btn btn-secondary back">Reset</button>
                    <input type="button" name="submit" class="btn btn-info float-right" id="btnSave" onclick="update()" value="Update"></input>
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
    });

    function update() {
        var url = "<?php echo site_url('esptpd/update_billing') ?>";

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
                        text: 'Your File has been save.',
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
    }
</script>