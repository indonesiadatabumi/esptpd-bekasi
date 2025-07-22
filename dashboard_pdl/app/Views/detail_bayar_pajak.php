<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<!-- BEGIN breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active">Detail Bayar Pasar</li>
</ol>
<!-- END breadcrumb -->
<!-- BEGIN page-header -->
<h1 class="page-header">Detail Bayar</h1>
<!-- END page-header -->

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
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
                            <?php
                            $no = 1; 
                            foreach ($detail_bayar as $row) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->npwprd; ?></td>
                                    <td><?= $row->wp_wr_nama; ?></td>
                                    <td><?= $row->wp_wr_almt; ?></td>
                                    <td><?= $row->kode_billing; ?></td>
                                    <td><?= "Rp " . number_format($row->tagihan, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($row->denda, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($row->sptpd_yg_dibayar, 2, ",", "."); ?></td>
                                    <td><?= $row->tgl_pembayaran; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // DataTables
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "emptyTable": "Data Kosong"
            }
        });
    });
</script>
<!-- <script>
    //datatable
    $(document).ready(function() {
        var dataTable = $('#datatable').DataTable({
            dom: 'Blfrtip',
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
                    d.start = $('#start').val();
                    d.end = $('#end').val();
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
                    "data": "tgl_pembayaran"
                },
                {
                    "data": "total_bayar"
                },
                {
                    "data": "id_user"
                }
            ],
        });
        $('#filter_bayar').click(function(event) {
            dataTable.ajax.reload();
        });
    });
</script> -->
<?= $this->endSection(); ?>