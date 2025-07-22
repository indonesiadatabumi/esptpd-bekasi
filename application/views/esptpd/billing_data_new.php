<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Billing</h3>
                        <div class="text-right">
                            <!-- <?php if (!empty($bil_nama)) {
                                echo $bil_nama;
                            } else {
                                echo $this->session->userdata('username');
                            } ?> -
                            <?php if (!empty($bil_npwpd)) {
                                echo $bil_npwpd;
                            } else {
                                echo $this->session->userdata('full_name');
                            } ?> -->
                            <?php echo $wp_wr_nama.' - '.$npwprd ?>
                        </div>
                        <input type="hidden" id="kodus" value="<?= $kodus; ?>">
                        <input type="hidden" id="noreg" value="<?= (empty($noreg)) ? $this->session->userdata('id_wp_wr') : $noreg; ?>">
                        <div class="text-right">
                            <?php if ($this->session->userdata('id_level') == "4") {
                                if (!empty($this->uri->segment(4))) {
                                    $reg = $this->uri->segment(4);
                                } else {
                                    $reg = $this->session->userdata('no_urut');
                                }
                            ?>
                               <input type="hidden" id="wp_wr_no_urut" value="<?= $reg; ?>">
                            <!--    <button type="button" class="btn btn-sm btn-outline-primary" onclick="location.href='<?php echo base_url('esptpd/add/' . $kodus . '/' . $reg); ?>'" title="Add Data"><i class="fas fa-plus"></i> INPUT SPTPD</button>-->
                        
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabelsubmenu" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>Nomor <br />Reg. SPT</th>
                                    <th>Tanggal Input</th>
                                    <th>Tahun Lapor SPT</th>
                                    <th>SPT Masa </th>
                                     <th>Tgl. Jatuh Tempo Bayar</th>
                                    <th align="right">SPT Pajak</th>
                                    <th align="right">Denda</th>
                                    <th align="right">Sanksi Pelaporan</th>
                                    <th align="right">Jml Harus Dibayar</th>
                                    <th>Kode Billing</th>
                                    <th>Status Bayar</th>
                                    <th>Status Lapor</th>
                                    <th>Tgl Lapor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $('#noreg').change(function() {
        table.draw();
    });

    $(document).ready(function() {

        //datatables
        table = $("#tabelsubmenu").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Billing Belum Ada"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "serverMethod": "post",
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('esptpd/ajax_list_new') ?>",
                "type": "POST",
                'data': function(data) {
                    // Read values
                    var noreg = $('#noreg').val();
                    var wp_wr_no_urut = $('#wp_wr_no_urut').val();

                    // Append to data
                    data.searchByName = noreg;
                    data.wp_wr_no_urut = wp_wr_no_urut;
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    });

    $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('esptpd/lihat_lampiran') ?>/" + data;
        window.location.href = url;

    });


    $(document).on('click', '#view', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('esptpd/view') ?>/" + data;
        window.location.href = url;

    });

    $(document).on('click', '#esptpd', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('esptpd/espt_print') ?>/" + data;
        // window.location.href = url;
        window.open(url)

    });

    $(document).on('click', '#billing2', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('esptpd/espt_billing_prt') ?>/" + data;
        // window.location.href = url;
        window.open(url)

    });

    $(document).on('click', '#billing', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('esptpd/espt_billing_new') ?>/" + data;
        // window.location.href = url;
        window.open(url)

    });


    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        Swal.fire({
            title: 'Apakah anda Yakin?',
            text: "akan menghapus Billing: " + data,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            $.ajax({
                type: "post",
                url: "<?= site_url('esptpd/billing_hapus') ?>",
                data: {
                    idbilling: data
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {

                        Swal.fire(
                            'Deleted!',
                            'Billing berhasil di hapus.',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr, thrownError) {
                    Swal(
                        'Billing Gagal dihapus!.',
                        'error'
                    )
                }
            });

        })

    });

    $(document).on('click', '#va', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?= site_url('esptpd/generate_va') ?>";
        let btn = $(this);
        btn.html(`
                <div class="spinner-border text-primary" role="status">
                     <span class="sr-only">Loading...</span>
                </div>`
        )
        
        $.ajax({
            type: "post",
            url: url,
            data: {
                idbilling: data
            },
            dataType: "json",
            success: function(response) {
                btn.html(`
                        <a class="load_va" id="va" href="javascript:void(0)" title="VA" data-href="`+response['kode_billing']+`"><img src="http://sipdah.bekasikota.go.id/assets/foto/logo/virtualaccount.png" style="height: 50px; width: 50px;"></a>`
                )
                if (response['status'] == 'Create VA Gagal'){
                    Swal.fire({
                        icon: 'error',
                        html: `
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <h5>`+response['status']+`</h5>
                                </div>
                            </div>`,
                        showCloseButton: true,
                        showConfirmButton: false,
                    })
                }else{
                    Swal.fire({
                        icon: 'info',
                        html: `
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <h4>`+response['status']+`</h4>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <h5>Nomor VA anda: `+response['va_number']+`</h5>
                                </div>
                            </div>`,
                        showCloseButton: true,
                        showConfirmButton: false,
                    })
                }                
            }
        })
        // alert("Pembayaran belum tersedia")

    });

    $(document).on('click', '#qris', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris/request_qris";

        let btn = $(this);
        btn.html(`
                <div class="spinner-border text-primary" role="status">
                     <span class="sr-only">Loading...</span>
                </div>`
        )

        $.ajax({
            type: "post",
            url: url,
            data: {
                idbilling: data
            },
            dataType: "json",
            success: function(response) {
                btn.html(`
                        <a class="load_qris" id="qris" href="javascript:void(0)" title="QRIS" data-href="`+response['kode_billing']+`"><img src="http://sipdah.bekasikota.go.id/assets/foto/logo/qris.png" style="height: 50px; width: 50px;"></a>`
                )
                if (response['status'] == 'Create QRIS Gagal'){
                    Swal.fire({
                        icon: 'error',
                        html: `
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <h5>`+response['status']+`</h5>
                                </div>
                            </div>`,
                        showCloseButton: true,
                        showConfirmButton: false,
                    })
                }else{
                    Swal.fire({
                        icon: 'info',
                        html: `
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <h4>Silahkan Scan Qris di Bawah Ini</h4>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <img src="http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris/assets/qris/` + response['kode_billing'] + `.png" alt="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <a class = "btn btn-primary btn-search" href = "http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris/assets/qris/` + response['kode_billing'] + `.png" title = "Download" download><i class="bi bi-download"></i> Download</a>
                                </div>
                            </div>`,
                        showCloseButton: true,
                        showConfirmButton: false,
                    })
                }
            }
        })
        
        // alert("Pembayaran masih dalam tahap pengembangan")
        
    });


    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    //view
    // $(".v_submenu").click(function(){
    function vsubmenu(id) {
        $('.modal-title').text('View Submenu');
        $("#modal-default").modal();
        $.ajax({
            url: '<?php echo base_url('submenu/viewsubmenu'); ?>',
            type: 'post',
            data: 'table=tbl_submenu&id=' + id,
            success: function(respon) {
                $("#md_def").html(respon);
            }
        })


    }

    function edit_submenu(id) {
        var url = "<?php echo site_url('esptpd/verifikasi') ?>/" + id;
        Window.location.href(url);
    }
</script>