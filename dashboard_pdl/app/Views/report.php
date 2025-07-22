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
                        <select class="form-select" id="kd_rekening">
                            <option value="0">- SEMUA PAJAK -</option>
                            <option value="41101">- PAJAK HOTEL -</option>
                            <option value="41102">- PAJAK RESTORAN -</option>
                            <option value="41103">- PAJAK HIBURAN -</option>
                            <option value="41104">- PAJAK REKLAME -</option>
                            <option value="41106">- PAJAK PENERANGAN JALAN -</option>
                            <option value="41107">- PAJAK PARKIR -</option>
                            <option value="41108">- PAJAK AIR TANAH -</option>
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
                                <th>ALAMAT WP</th>
                                <th>KODE BILLING</th>
                                <th>POKOK PAJAK</th>
                                <th>DENDA</th>
                                <th>TOTAL PEMBAYARAN</th>
                                <th>TGL PEMBAYARAN</th>
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
                    d.kd_rekening = $('#kd_rekening').val();
                },
                "dataSrc": "",
            },
            "columns": [{
                    "data": "npwprd"
                },
                {
                    "data": "wp_wr_nama"
                },
                {
                    "data": "wp_wr_almt"
                },
                {
                    "data": "kode_billing"
                },
                {
                    "data": "tagihan"
                },
                {
                    "data": "denda"
                },
                {
                    "data": "sptpd_yg_dibayar"
                },
                {
                    "data": "tgl_pembayaran"
                }
            ],
            columnDefs: [{
                    targets: 4,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    targets: 5,
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    targets: 6,
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