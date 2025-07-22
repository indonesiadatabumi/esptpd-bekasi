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
                                <th>Nama Pajak</th>
                                <th>Total Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pajak Hotel</td>
                                <td id="pajak_hotel"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41101')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Pajak Restoran</td>
                                <td id="pajak_resto"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41102')">Detail</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Pajak Hiburan</td>
                                <td id="pajak_hiburan"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41103')">Detail</button></td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Pajak Reklame</td>
                                <td id="pajak_reklame"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41104')">Detail</button></td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Pajak Penerangan Jalan</td>
                                <td id="pajak_ppj"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41106')">Detail</button></td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Pajak Parkir</td>
                                <td id="pajak_parkir"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41107')">Detail</button></td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Pajak Air Tanah</td>
                                <td id="pajak_abt"></td>
                                <td><button type="button" class="btn btn-sm btn-info" onclick="detail_pajak('41108')">Detail</button></td></td>
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

            // pajak_hotel
            $('#pajak_hotel').html(`
            <td id="pajak_hotel">`+ (parseInt(response['pajak_hotel'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // pajak_resto
            $('#pajak_resto').html(`
            <td id="pajak_resto">`+ (parseInt(response['pajak_resto'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // pajak_hiburan
            $('#pajak_hiburan').html(`
            <td id="pajak_hiburan">`+ (parseInt(response['pajak_hiburan'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // pajak_reklame
            $('#pajak_reklame').html(`
            <td id="pajak_reklame">`+ (parseInt(response['pajak_reklame'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // pajak_ppj
            $('#pajak_ppj').html(`
            <td id="pajak_ppj">`+ (parseInt(response['pajak_ppj'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // pajak_parkir
            $('#pajak_parkir').html(`
            <td id="pajak_parkir">`+ (parseInt(response['pajak_parkir'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)

            // pajak_abt
            $('#pajak_abt').html(`
            <td id="pajak_abt">`+ (parseInt(response['pajak_abt'])).toLocaleString('en-US', {
            style: 'currency',
            currency: 'IDR',
            }) +`</td>`)
        },
        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function detail_pajak(kd_rekening) {
    let tgl_awal = $('#tgl_awal').val()
    let tgl_akhir = $('#tgl_akhir').val()
    let url = "<?= base_url() ?>/dashboard/detail_pajak/"+kd_rekening+"/"+tgl_awal+"/"+tgl_akhir

    window.location = url
}
</script>
<?= $this->endSection(); ?>