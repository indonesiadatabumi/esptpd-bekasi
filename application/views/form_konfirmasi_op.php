<!-- Content Wrapper. Contains page content -->

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Konfirmasi Objek Pajak</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    Silahkan input nomor npwpd, kemudian klik tombol cari data!
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Npwpd</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="npwpd" placeholder="P.X.XX.XXXXXX.XX.XX">
                </div>
                <div class="col-sm-4">
                    <button type="button" id="cari_data" class="btn btn-primary" onclick = cari_data()>Cari Data</button>
                </div>
            </div>
            <hr>
            <div class="col">
                <h3 class="text-center">Detail Data</h3>
            </div>
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama OP</label>
                            <input type="hidden" class="form-control" id="wp_wr_id" readonly>
                            <input type="text" class="form-control" id="wp_wr_nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" id="wp_wr_lurah" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Kabupaten/Kota</label>
                            <input type="text" class="form-control" id="wp_wr_kabupaten" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Alamat OP</label>
                            <input type="text" class="form-control" id="wp_wr_almt" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" id="wp_wr_camat" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Pajak</label>
                            <input type="text" class="form-control" id="jenis_pajak" readonly>
                        </div>
                    </div>
                </div>
                <button type="button" id="confirm" class="btn btn-primary" onclick="confirm_data()">Konfirmasi</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<script>
    function cari_data() {
        $('#cari_data').attr('disabled', true); //set button disable 
        const data = $("#npwpd").val();
        const npwpd = btoa(data);
        var url = "<?php echo site_url('konfirmasi_op/cari_data') ?>";


        // console.log(formdata);

        $.ajax({
            url: url,
            type: "POST",
            data: {
                    npwpd: npwpd
                },
            dataType: "json",
            success: function(response) {
                if (response.responseMessage == false) {
                    Swal.fire(
                            'Gagal',
                            'Data tidak ditemukan',
                            'error'
                        )
                }else{
                    $('#wp_wr_id').val(response.data.wp_wr_id);
                    $('#wp_wr_nama').val(response.data.wp_wr_nama);
                    $('#wp_wr_almt').val(response.data.wp_wr_almt);
                    $('#wp_wr_lurah').val(response.data.wp_wr_lurah);
                    $('#wp_wr_camat').val(response.data.wp_wr_camat);
                    $('#wp_wr_kabupaten').val(response.data.wp_wr_kabupaten);
                    $('#jenis_pajak').val(response.data.ref_kodus_nama);
                }

                $('#cari_data').attr('disabled', false); //set button enable 
                // window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR);
                // alert(jqXHR);
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
                $('#cari_data').attr('disabled', false); //set button enable 

            }
        });
    }

    function confirm_data(params) {
        $('#confirm').attr('disabled', true); //set button disable
        const data = $("#wp_wr_id").val();
        const wp_wr_id = btoa(data);
        var url = "<?php echo site_url('konfirmasi_op/confirm_data') ?>";


        // console.log(formdata);

        $.ajax({
            url: url,
            type: "POST",
            data: {
                    wp_wr_id: wp_wr_id
                },
            dataType: "json",
            success: function(response) {
                if (response.responseMessage == false) {
                    Swal.fire(
                            'Gagal',
                            'Gagal dikonfirmasi',
                            'error'
                        )
                }else{
                    Swal.fire(
                            'Berhasil',
                            'Berhasil dikonfirmasi',
                            'success'
                        )
                }

                $('#confirm').attr('disabled', false); //set button enable 
                // window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR);
                // alert(jqXHR);
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
                $('#confirm').attr('disabled', false); //set button enable 

            }
        });
    }
</script>