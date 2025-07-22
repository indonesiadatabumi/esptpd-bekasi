<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<!-- BEGIN breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item active">Report Pembayaran</li>
</ol>
<!-- END breadcrumb -->
<!-- BEGIN page-header -->
<h1 class="page-header">Report Pembayaran</h1>
<!-- END page-header -->

<!-- BEGIN row -->
<div class="row mb-3">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tgl_awal" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tgl_akhir" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Pasar</label>
                        <select class="form-select" id="id_user">
                            <option value="0">- SEMUA PASAR -</option>
                            <option value="2">- PASAR HARAPAN JAYA -</option>
                            <option value="3">- PASAR BINTARA KOTA -</option>
                            <option value="4">- PASAR WISMA ASRI -</option>
                            <option value="5">- PASAR WISMA JAYA -</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" id="filter_bayar" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>NPWRD</th>
                                <th>NAMA WP</th>
                                <th>KODE BILLING</th>
                                <th>TGL PEMBAYARAN</th>
                                <th>TOTAL PEMBAYARAN</th>
                                <th>NAMA PASAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // DataTables
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "emptyTable": "Data Kosong"
            }
        });
    });
</script> -->
<script>
    //datatable
    $(document).ready(function() {
        var dataTable = $('#datatable').DataTable({
            dom: 'Blfrtip',
            buttons: [
                'print',
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "language": {
                "emptyTable": "Data Kosong"
            },
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                url: '<?= base_url(); ?>/report/hasil_rekap',
                type: 'post',
                data: function(d) {
                    d.start = $('#tgl_awal').val();
                    d.end = $('#tgl_akhir').val();
                    d.id_user = $('#id_user').val();
                },
                "dataSrc": "",
            },
            "columns": [{
                    "data": "npwrd"
                },
                {
                    "data": "nm_wp_wr"
                },
                {
                    "data": "kd_billing"
                },
                {
                    "data": "tgl_pembayaran"
                },
                {
                    "data": "total_bayar"
                },
                {
                    "data": "fullname"
                }
            ],
            columnDefs: [{
                    targets: 4,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                }
            ],
        });
        $('#filter_bayar').click(function(event) {
            dataTable.ajax.reload();
        });
    });
</script>
<?= $this->endSection(); ?>