<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">

                        <div class="row">
                            <div class="col-md-4">

                                <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Awal : </label>

                                <div class="form-group">

                                    <div class="input-group date" id="searchStartDate" data-target-input="nearest">

                                        <input type="text" class="form-control datetimepicker-input StartDate" id="StartDate" maxlength="10" placeholder="yyyy-mm-dd" data-target="#searchStartDate" value="<?= date('Y-m-d')?>"/>

                                        <div class="input-group-append" data-target="#searchStartDate" data-toggle="datetimepicker">

                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Akhir : </label>

                                <div class="form-group">

                                    <div class="input-group date" id="searchEndDate" data-target-input="nearest">

                                        <input type="text" class="form-control datetimepicker-input EndDate" id="EndDate" maxlength="10" placeholder="yyyy-mm-dd" data-target="#searchEndDate" value="<?= date('Y-m-d')?>"/>

                                        <div class="input-group-append" data-target="#searchEndDate" data-toggle="datetimepicker">

                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <label for="jenis_pajak" class="col-sm-6 col-form-label">Jenis Pajak : </label>

                                <div class="form-group">

                                    <select class="form-control" id="jenis_pajak" name="jenis_pajak">
                                        <option value="">---- PILIH JENIS PAJAK ----</option>
                                        <option value="1">PAJAK HOTEL</option>
                                        <option value="2">PAJAK RESTORAN</option>
                                        <option value="3">PAJAK HIBURAN</option>
                                        <option value="4">PAJAK REKLAME</option>
                                        <option value="5">PAJAK PENERANGAN JALAN NON PLN</option>
                                        <option value="6">PAJAK PENERANGAN JALAN PLN</option>
                                        <option value="7">PAJAK PARKIR</option>
                                        <option value="8">PAJAK AIR TANAH</option>
                                    </select>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary" id="filter_bayar">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Rekap Pembayaran e-SPTPD </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tbl_datawp" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>No.</th>
                                    <th>NPWPD</th>
                                    <th>Kode Billing</th>
                                    <th>Tahun</th>
                                    <th>Jml. Pajak</th>
                                    <th>Denda</th>
                                    <th>Jumlah Bayar</th>
                                    <th>RRN</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status Bayar</th>
                                    <th>Metode Bayar</th>
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
    // $(document).ready(function() {

    //     $('#searchStartDate').datetimepicker({
    //         format: 'YYYY-MM-DD'
    //     });

    //     $('#searchEndDate').datetimepicker({
    //         format: 'YYYY-MM-DD'
    //     });

    //     $('#StartDate').blur(function() {
    //         table.draw();
    //     });

    //     $('#EndDate').blur(function() {
    //         table.draw();
    //     });


    //     $('#searchEndDate').change(function() {
    //         table.draw();
    //     });

    //     $('#jenis_pajak').change(function() {
    //         table.draw();
    //     });

    //     //datatables
    //     var table = $("#tbl_datawp").DataTable({
    //         dom: 'Bfrtip',
    //         buttons: {
    //             buttons: [{
    //                 'text': 'Cetak Rekap Pembayaran',
    //                 'className': 'btn-default',
    //                 'action': function(data) {
    //                     window.open('rekap_pembayaran/cetakpenerimaan?StartDate=' + $('#StartDate').val() + '&EndDate=' + $('#EndDate ').val() + '&jenis_pajak=' + $('#jenis_pajak ').val(), "", "width=800,height=1200,titlebar=no,toolbar=no,location=no,status=no,menubar=no");
    //                 }
    //             }],
    //             dom: {
    //                 button: {
    //                     className: 'btn'
    //                 },
    //                 buttonLiner: {
    //                     tag: null
    //                 }
    //             }
    //         },
    //         "responsive": true,
    //         "autoWidth": false,
    //         "language": {
    //             "sEmptyTable": "Data WP Belum Ada"
    //         },
    //         "processing": true, //Feature control the processing indicator.
    //         "serverSide": true, //Feature control DataTables' server-side processing mode.
    //         "serverMethod": "post",
    //         "searching": false, //remove default searching
    //         "order": [], //Initial no order.
    //         // Load data for the table's content from an Ajax source
    //         "ajax": {
    //             "url": "<?php echo site_url('rekap_pembayaran/ajax_list') ?>",
    //             "type": "POST",
    //             'data': function(data) {
    //                 var startDate = $('#StartDate').val();
    //                 var endDate = $('#EndDate').val();
    //                 var jenis_pajak = $('#jenis_pajak').val();
    //                 // Append to data 
    //                 data.searchStartDate = startDate;
    //                 data.searchEndDate = endDate;
    //                 data.jenis_pajak = jenis_pajak;
    //             }
    //         }
    //     });


    // });

    // function reload_table() {
    //     table.ajax.reload(null, false); //reload datatable ajax 
    // }

    // const Toast = Swal.mixin({
    //     toast: true,
    //     position: 'top-end',
    //     showConfirmButton: false,
    //     timer: 3000
    // });

    // function edit_brg(wr_id, no_urut, bid_usaha) {

    //     // alert(wr_id + ' ' + no_urut + ' ' + bid_usaha);
    //     // save_method = 'update';
    //     $('#form')[0].reset(); // reset form on modals
    //     $('.form-group').removeClass('has-error'); // clear error class
    //     $('.help-block').empty(); // clear error string

    //     //Ajax Load data from ajax
    //     $.ajax({
    //         url: "<?php echo site_url('datawp/lihat') ?>",
    //         data: {
    //             wr_id: wr_id,
    //             no_urut: no_urut,
    //             bid_usaha: bid_usaha
    //         },
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function(data) {

    //             $('[name="id"]').val(data.id);
    //             $('[name="nama"]').val(data.nama);
    //             $('[name="harga"]').val(data.harga);
    //             $('[name="satuan"]').val(data.satuan);
    //             $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    //             $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title

    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             alert('Error get data from ajax');
    //         }
    //     });
    // }

    //datatable
    $(document).ready(function() {
        $('#searchStartDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#searchEndDate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        var dataTable = $('#tbl_datawp').DataTable({
            dom: 'Blfrtip',
            buttons: {
                buttons: [{
                    'text': 'Cetak Rekap Pembayaran',
                    'className': 'btn-default',
                    'action': function(data) {
                        window.open('rekap_pembayaran/cetakpenerimaan?StartDate=' + $('#StartDate').val() + '&EndDate=' + $('#EndDate ').val() + '&jenis_pajak=' + $('#jenis_pajak ').val(), "", "width=800,height=1200,titlebar=no,toolbar=no,location=no,status=no,menubar=no");
                    }
                }],
                dom: {
                    button: {
                        className: 'btn'
                    },
                    buttonLiner: {
                        tag: null
                    }
                }
            },
            "responsive": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "Data Kosong"
            },
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                url: '<?php echo site_url('rekap_pembayaran/ajax_list') ?>',
                type: 'post',
                data: function(d) {
                    d.start = $('#StartDate').val();
                    d.end = $('#EndDate').val();
                    d.jenis_pajak = $('#jenis_pajak').val();
                },
            },
        });
        $('#filter_bayar').click(function(event) {
            dataTable.ajax.reload();
        });
    });
</script>