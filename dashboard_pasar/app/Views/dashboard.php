<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<!-- BEGIN breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<!-- END breadcrumb -->
<!-- BEGIN page-header -->
<h1 class="page-header">Dashboard</h1>
<!-- END page-header -->

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
                </div>
                <div class="row">
                    <div class="col" id="loading_filter">
                        <button type="button" class="btn btn-primary" onclick="getTransaksi()">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN row -->
<div class="row mb-4">
    <!-- BEGIN col-3 -->
    <div class="col-xl-6 col-md-6 mb-3">
        <div class="widget-stats bg-green card">
            <div class="stats-icon"><i class="bi bi-cash"></i></div>
            <div class="stats-info text-white">
                <h4>TOTAL PEMBAYARAN</h4>
                <h1 id="total_bayar"></h1>	
            </div>
        </div>
    </div>
    <!-- END col-3 -->
    <!-- BEGIN col-3 -->
    <div class="col-xl-6 col-md-6">
        <div class="widget-stats bg-blue card">
            <div class="stats-icon"><i class="bi bi-people"></i></div>
            <div class="stats-info text-white">
                <h4>JUMLAH PEMBAYARAN</h4>
                <h1 id="jumlah_bayar"></h1>	
            </div>
        </div>
    </div>
    <!-- END col-3 -->
</div>
<!-- END row -->
<div class="row">
    <div class="col">
        <h3>Total Pembayaran Tiap Pasar</h3>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasar</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pasar Harapan Jaya</td>
                                <td id="harapan_jaya"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pasar('2')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Pasar Bintara Kota</td>
                                <td id="bintara_kota"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pasar('3')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Pasar Wisma Asri</td>
                                <td id="wisma_asri"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pasar('4')">Detail</button></td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Pasar Wisma Jaya</td>
                                <td id="wisma_jaya"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pasar('5')">Detail</button></td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$( document ).ready(function() {
    getTransaksi()
});

function getTransaksi() {
    let tgl_awal = $('#tgl_awal').val()
    let tgl_akhir = $('#tgl_akhir').val()

    $.ajax({
        type: "post",
        url: "<?= base_url() ?>/dashboard/get_total_transaksi",
        data: {
            tgl_awal: tgl_awal,
            tgl_akhir: tgl_akhir
        },
        dataType: "json",
        beforeSend: function() {
            $('#loading_filter').html(`
            <button class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
            </button>`)
        },
        success: function(response) {
            $('#loading_filter').html(`
            <button type="button" class="btn btn-primary" onclick="getTransaksi()">Cari</button>`)

            $('#total_bayar').html(`
            <h1 id="total_bayar">`+ (parseInt(response['total_bayar'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</h1>`)

            $('#jumlah_bayar').html(`
            <h1 id="jumlah_bayar">`+ response['jumlah_bayar'] +`</h1>`)

            // harapan_jaya
            $('#harapan_jaya').html(`
            <td id="harapan_jaya">`+ (parseInt(response['harapan_jaya'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // bintara_kota
            $('#bintara_kota').html(`
            <td id="bintara_kota">`+ (parseInt(response['bintara_kota'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // wisma_asri
            $('#wisma_asri').html(`
            <td id="wisma_asri">`+ (parseInt(response['wisma_asri'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // wisma_jaya
            $('#wisma_jaya').html(`
            <td id="wisma_jaya">`+ (parseInt(response['wisma_jaya'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)
        },
        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function detail_pasar(id_pasar) {
    let tgl_awal = $('#tgl_awal').val()
    let tgl_akhir = $('#tgl_akhir').val()
    let url = "<?= base_url() ?>/dashboard/detail_pasar/"+id_pasar+"/"+tgl_awal+"/"+tgl_akhir

    window.location = url
}
</script>
<?= $this->endSection(); ?>