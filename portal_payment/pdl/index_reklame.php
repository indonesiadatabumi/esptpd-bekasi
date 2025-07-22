<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Portal Pembayaran | Pajak Reklame</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/img/logo_pemda.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <!-- main style -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="../assets/sweetalert2/sweetalert2.min.css">
    <!-- bootstrap icon -->
    <link href="../assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- product section -->
    <div class="product-section mt-5 mb-150">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pajak Reklame</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Pajak Reklame</h3>
                        <p>Silahkan isi kode billing terlebih dahulu.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="kode_billing" class="col-sm-2 col-form-label"><b>Kode Billing</b></label>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-search" id="kode_billing" maxlength="18" placeholder="3505104220100143">
                        </div>
                        <div class="col-sm-2" id="loading_tagihan">
                            <button type="button" class="btn btn-success btn-search" onclick="cari_tagihan()"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col" id="hasil">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col" id="hasil2">
                </div>
            </div>
        </div>
    </div>
    <!-- end product section -->

    <!-- jquery -->
    <script src="../assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- owl carousel -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <!-- main js -->
    <script src="../assets/js/main.js"></script>
    <!-- SwweetAlert -->
    <script src="../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        // tekan enter input kode billing
        $('#kode_billing').keypress(function(e) {
            var charCode = (e.which) ? e.which : event.keyCode

            if (String.fromCharCode(charCode).match(/[^0-9]/g))

                return false;

            if (e.which == 13) {
                cari_tagihan()
            }
        })

        // alert gagal
        function alert_gagal(data) {
            Swal.fire({
                icon: 'error',
                text: data,
            })
        }

        // cari tagihan pdl
        function cari_tagihan() {
            kode_billing_val = $('#kode_billing').val()
            switch (kode_billing_val) {
                case "": //apabila input kode billing tidak diisi
                    alert_gagal('Kode Billing Kosong')
                    break;
                case kode_billing_val:
                    $.ajax({
                        url: "get_tagihan_reklame.php",
                        data: {
                            kode_billing: kode_billing_val,
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#loading_tagihan').html(`
                                <button class="btn btn-success" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                                </button>`)
                        },
                        success: function(response) {
                            $('#loading_tagihan').html(`
                                    <button type="button" class="btn btn-success btn-search" onclick="cari_tagihan()"><i class="bi bi-search"></i> Cari</button>`)
                            if (response.status == 'Gagal') { //apabila respon gagal
                                alert_gagal(response.data)
                            } else {
                                $('#hasil').html(`
                                    <div class="card shadow-sm form-search">
                                        <div class="card-header bg-info">
                                            <h4 class="text-center text-white"><i class="bi bi-person"></i> Data WP</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <b>Npwpd</b>
                                                </div>
                                                <div class="col-md-3">
                                                    ` + response.data_tagihan['npwprd'] + `
                                                </div>
                                                <div class="col-md-2">
                                                    <b>Nama</b>
                                                </div>
                                                <div class="col-md-4">
                                                    ` + response.data_tagihan['nama'] + `
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <b>Alamat</b>
                                                </div>
                                                <div class="col-md-3">
                                                    ` + response.data_tagihan['alamat'] + `
                                                </div>
                                                <div class="col-md-2">
                                                    <b>Kelurahan</b>
                                                </div>
                                                <div class="col-md-4">
                                                    ` + response.data_tagihan['kelurahan'] + `
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <b>Kecamatan</b>
                                                </div>
                                                <div class="col-md-3">
                                                    ` + response.data_tagihan['kecamatan'] + `
                                                </div>
                                                <div class="col-md-2">
                                                    <b>Jenis Pajak</b>
                                                </div>
                                                <div class="col-md-4">
                                                    ` + response.data_tagihan['ket'] + `
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <b>Jenis Kegiatan Usaha</b>
                                                </div>
                                                <div class="col-md-3">
                                                    ` + response.data_tagihan['nama_kegus'] + `
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
                                if (response.data_tagihan['total_bayar'] >= 10000000) { //apabila total bayar lebih dari 10 jt
                                    $('#hasil2').html(`
                                        <div class="card shadow-sm form-search">
                                            <div class="card-header bg-info">
                                                <h4 class="text-center text-white"><i class="bi bi-cash"></i> Data Tagihan</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Tahun Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                ` + response.data_tagihan['tahun_pajak'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Masa Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                ` + response.data_tagihan['masa_pajak1'] + ` - ` + response.data_tagihan['masa_pajak2'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['pajak'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Denda</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['denda'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Total Bayar</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['total_bayar'] + `
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" id="loading_va">
                                                        <img src="../assets/img/logo_bni.png" alt="logo bni" width="100px">
                                                        <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + response.data_tagihan['kode_billing'] + `')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`);
                                } else if (response.data_tagihan['pajak'] < 1) {
                                    $('#hasil2').html(`
                                        <div class="card shadow-sm form-search">
                                            <div class="card-header bg-info">
                                                <h4 class="text-center text-white"><i class="bi bi-cash"></i> Data Tagihan</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Tahun Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                ` + response.data_tagihan['tahun_pajak'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Masa Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                ` + response.data_tagihan['masa_pajak1'] + ` - ` + response.data_tagihan['masa_pajak2'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['pajak'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Denda</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['denda'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Total Bayar</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['total_bayar'] + `
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`);
                                } else {
                                    $('#hasil2').html(`
                                        <div class="card shadow-sm form-search">
                                            <div class="card-header bg-info">
                                                <h4 class="text-center text-white"><i class="bi bi-cash"></i> Data Tagihan</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Tahun Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                ` + response.data_tagihan['tahun_pajak'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Masa Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                ` + response.data_tagihan['masa_pajak1'] + ` - ` + response.data_tagihan['masa_pajak2'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Pajak</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['pajak'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Denda</b>
                                                            </div>
                                                            <div class="col">
                                                                Rp ` + response.data_tagihan['denda'] + `
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <b>Total Bayar</b>
                                                            </div>
                                                            <div class="col mb-3">
                                                                Rp ` + response.data_tagihan['total_bayar'] + `
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" id="loading_va">
                                                        <img src="../assets/img/logo_bni.png" alt="logo bni" width="100px">
                                                        <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + response.data_tagihan['kode_billing'] + `')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>
                                                    </div>
                                                    <div class="col" id="loading_qris">
                                                        <img src="../assets/img/logo_bank_jatim.png" alt="logo bank jatim" width="150px">
                                                        <a class="card cover-qris mb-3" id="qris" href="javascript:void(0)" title="QRIS" onclick="bayar_qris('` + response.data_tagihan['kode_billing'] + `')" style="background-image: url(../assets/img/QRIS.png);"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`);
                                }
                            }
                        },
                        error: function(xhr, thrownError) {
                            alert_gagal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    break;
                default:
                    alert_gagal('Gagal Eksekusi')
                    break;
            }
        }

        // generate va
        function bayar_va(kode_billing) {
            alert_gagal('pembayaran masih dalam tahap pengembangan')
            // switch (kode_billing) {
            //     case "": //apabila kode billing tidak ada
            //         alert_gagal('Kode Billing Kosong')
            //         break;
            //     case kode_billing:
            //         $.ajax({
            //             url: "request_va_bni.php",
            //             data: {
            //                 kode_billing: kode_billing,
            //             },
            //             dataType: "json",
            //             beforeSend: function() {
            //                 $('#loading_va').html(`
            //                 <div class="spinner-border text-primary" role="status">
            //                     <span class="sr-only">Loading...</span>
            //                 </div>`)
            //             },
            //             success: function(response) {
            //                 $('#loading_va').html(`
            //                     <img src="../assets/img/logo_bni.png" alt="logo bni" width="100px">
            //                     <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + kode_billing + `')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>`)
            //                 if (response.status == 'Gagal') { //apabila respon gagal
            //                     alert_gagal(response.data)
            //                 } else {
            //                     var url = 'http://e-pada.blitarkab.go.id/portal_payment/pdl/invoice_va_bni.php?va_number='+response.va_number; 
            //                     window.open(url, '_blank');
            //                 }
            //             },
            //             error: function(xhr, thrownError) {
            //                 alert_gagal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            //             }
            //         });
            //         break;
            //     default:
            //         alert_gagal('Gagal Generate Virtual Account')
            //         break;
            // }
        }

        // generate qris
        function bayar_qris(kode_billing) {
            switch (kode_billing) {
                case "": //apabila kode billing tidak ada
                    alert_gagal('Kode Billing Kosong')
                    break;
                case kode_billing:
                    $.ajax({
                        url: "request_qris_reklame.php",
                        data: {
                            kode_billing: kode_billing,
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#loading_qris').html(`
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`)
                        },
                        success: function(response) {
                            $('#loading_qris').html(`
                                <img src="../assets/img/logo_bank_jatim.png" alt="logo bank jatim" width="150px">
                                <a class = "card cover-qris mb-3" id = "qris" href = "javascript:void(0)" title = "QRIS" onclick = "bayar_qris('` + response.qris + `')" style = "background-image: url(../assets/img/QRIS.png);"></a>`)
                            if (response.status == 'Gagal') { //apabila respon gagal
                                alert_gagal(response.data)
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    html: `
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <div class="alert alert-success" role="alert">
                                                Silahkan Scan Qris di Bawah Ini
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <img src="../assets/img/logo_qris.png" alt="" width="150px">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <img src="../assets/img/qris/` + response.qris + `.png" alt="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <a class = "btn btn-primary btn-search" href = "../assets/img/qris/` + response.qris + `.png" title = "Download" download><i class="bi bi-download"></i> Download</a>
                                        </div>
                                    </div>`,
                                    showCloseButton: true,
                                    showConfirmButton: false,
                                })
                            }
                        },
                        error: function(xhr, thrownError) {
                            alert_gagal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                    break;
                default:
                    alert_gagal('Gagal Generate QRIS')
                    break;
            }
        }
    </script>

</body>

</html>