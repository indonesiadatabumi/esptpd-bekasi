<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-header bg-light">
                    <h3 class="card-title"><i class="fa fa-list text-blue"></i> Verifikasi WP Baru</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="modal-body">

                        <!-- mulai form-->
                        <form id='form' name='form' class='form-horizontal form-label-left' method='POST'>
                            <div class="row">
                                <div class="col-6">
                                    <!-- <div class="form-group">
                                        <label class='col-md-4 control-label'>Nomor SPT </label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control readonly-bg' name='no_pelayanan' id='no_pelayanan' value='<?= $spt_id ?>' readonly />
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>NIK / NIB</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control readonly-bg' name='wp_id' id='wp_id' value='<?= $data_wp->WP_ID ?>' readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Nama </label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control readonly-bg' name='nama' id='nama' value='<?= $data_wp->NAMA ?>' readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Nama Usaha</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control readonly-bg' name='nama_usaha' id='nama_usaha' value='<?= $data_wp->NAMA_USAHA ?>' readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Jenis Pajak </label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control readonly-bg' name='jns_pajak' id='jns_pajak' value='<?= $data_wp->ref_kodus_nama ?>' readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Alamat </label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control readonly-bg' name='alamat_op' id='alamat_op' value='<?= $data_wp->JALAN . " Blok " . $data_wp->BLOK . " RT " . $data_wp->RT . " RW " . $data_wp->RW ?>' readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Kelurahan</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='kelurahan' id='kelurahan' value='<?= $data_wp->KELURAHAN ?>' readonly required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Kecamatan</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='kecamatan' id='kecamatan' value='<?= $data_wp->KECAMATAN ?>' readonly required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Kota</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='kota' id='kota' value='<?= $data_wp->KOTA ?>' readonly required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>No. HP</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='no_hp' id='no_hp' value='<?= $data_wp->NO_HP ?>' readonly required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class='col-md-4 control-label'>Email</label>
                                        <div class='col-md-8'>
                                            <input type='text' class='form-control' name='email' id='email' value='<?= $data_wp->EMAIL ?>' readonly required />
                                        </div>
                                    </div>
                                    <!-- 
                                        <div class="form-group">
                                    <span class="label label-primary">Dasar Pengenaan :</span>
                                    <input type="text" class="form-control dasar_pengenaan" style="text-align:right;">
                                </div>
                                <div class="form-group">
                                    <span class="label label-primary">Tarif :</span>
                                    <input type="text" class="form-control tarif" style="text-align:right;">
                                </div>
                                <div class="form-group">
                                    <span class="label label-primary">Ketetapan :</span>
                                    <input type="text" class="form-control jml_ketetapan" style="text-align:right;">
                                </div> -->
                                </div>

                                <div class="col-6">
                                    <h3 align="center"><u>Lampiran Dokumen</u></h3>
                                    <?php if (isset($lampiran_nik)) : ?>
                                        <div class="row">
                                            <div class="col text-center">
                                                <p>NIK/NIB</p>
                                                <embed src="http://etax.bekasikota.go.id/assets/lampiran/nik_nib/<?= $lampiran_nik->name ?>" type="application/pdf" width="100%" height="500px" />
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <hr>
                                    <?php if (isset($lampiran_npwp)) : ?>
                                        <div class="row">
                                            <div class="col text-center">
                                                <p>NPWP</p>
                                                <embed src="http://etax.bekasikota.go.id/assets/lampiran/npwp/<?= $lampiran_npwp->name ?>" type="application/pdf" width="100%" height="500px" />
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <hr>
                                    <?php if (isset($lampiran_akta)) : ?>
                                        <div class="row">
                                            <div class="col text-center">
                                                <p>Akta Pendirian</p>
                                                <!-- <img class="img-fluid" src="http://sipdah.bekasikota.go.id/etax/assets/lampiran/akta_pendirian/<?= $lampiran_akta->name ?>" alt="<?= $lampiran_akta->name ?>"> -->
                                                <embed src="http://etax.bekasikota.go.id/assets/lampiran/akta_pendirian/<?= $lampiran_akta->name ?>" type="application/pdf" width="100%" height="500px" />
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <hr>
                                    <?php if (isset($lampiran_sipa)) : ?>
                                        <div class="row">
                                            <div class="col text-center">
                                                <p>SIPA</p>
                                                <!-- <img class="img-fluid" src="http://sipdah.bekasikota.go.id/etax/assets/lampiran/akta_pendirian/<?= $lampiran_sipa->name ?>" alt="<?= $lampiran_sipa->name ?>"> -->
                                                <embed src="http://etax.bekasikota.go.id/assets/lampiran/sipa/<?= $lampiran_sipa->name ?>" type="application/pdf" width="100%" height="500px" />
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>

                            </div>
                            <div class=" form-group">
                                <span class="label label-primary">Status Pending :</span>
                                <input type="checkbox" name="stat_regis" id="stat_regis" value="1">
                            </div>

                            <div class="form-group">
                                <span class="label label-primary">Keterangan :</span>
                                <!-- <input type="text" class="form-control keterangan" style="text-align:right;"> -->
                                <textarea class="form-control" name="ket_register" id="ket_register"></textarea>
                            </div>
                    </div>
                </div>
                <div class='ln_solid'></div>
                <div class="modal-footer justify-content-between">
                    <button type='reset' class='btn btn-danger _btnbatal' onclick="history.back()" id='close-modal-form' data-dismiss='modal'>Batal</button>
                    <div class="modal-footer">
                        <!-- <button type='button' class='btn btn-secondary _btnhapus  pull-right' id="btnHapus" onclick="hapus()">Batal Verifikasi</button> -->
                        <button type='submit' class='btn btn-success _btnsimpan  pull-right' id="btnSave" onclick="save()">Verifikasi</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function hapus() {
        let wp_id = $("#wp_id").val();
        let url = "<?php echo site_url('verifikasi_wp/batal_verifikasi') ?>";
        if (confirm('Anda yakin ingin membatalkan verifikasi?')) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    wp_id: wp_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == false) {
                        Swal.fire(
                            'Gagal',
                            response.message,
                            'error'
                        )
                    } else {
                        Swal.fire(
                            'Berhasil',
                            response.message,
                            'success'
                        )
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
        return false;
    }


    function save() {
        // e.preventDefault();

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url = "<?php echo site_url('verifikasi_wp/save_verifikasi_kabid') ?>";

        var formdata = new FormData($('#form')[0]);

        // console.log(formdata);

        $.ajax({
            url: url,
            type: "POST",
            data: formdata,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                // alert(data)
                if (data.status == true) {
                    Swal.fire(
                        'Save!',
                        data.message,
                        'success'
                    );
                } else {
                    // for (var i = 0; i < data.inputerror.length; i++) {
                    //     $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                    //     $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                    //     $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                    // }
                    Swal.fire(
                        'Gagal!',
                        data.message,
                        'error'
                    );
                }
                $('#btnSave').text('Verifikasi'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
                // window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR);
                // alert(jqXHR);
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
                $('#btnSave').text('Verifikasi'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
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