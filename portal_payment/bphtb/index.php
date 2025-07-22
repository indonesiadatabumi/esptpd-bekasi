<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Portal Pembayaran | Pajak BPHTB</title>

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

    <!-- css VA -->
    <style>
        .va-container {
            width: 400px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .bank-logo {
            width: 100px;
            margin-bottom: 10px;
        }

        .va-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .info-container {
            text-align: left;
            margin-bottom: 20px;
        }

        .info-container p {
            margin: 5px 0;
            font-size: 14px;
        }

        .va-number {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        .amount {
            font-size: 18px;
            font-weight: bold;
            color: #27ae60;
            margin: 10px 0;
        }

        .instructions {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-align: left;
        }

        .instructions ul {
            padding-left: 20px;
        }

        .instructions ul li {
            margin-bottom: 10px;
        }

        .copy-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .copy-button:hover {
            background-color: #2980b9;
        }
    </style>

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
                            <li class="breadcrumb-item active" aria-current="page">Pajak BPHTB</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Pajak BPHTB</h3>
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
                            <input type="hidden" id="jenis_pajak" value="<?= $get_jenis_pajak ?>">
                            <input type="text" class="form-control form-search" id="kode_billing" maxlength="18" placeholder="350510211069976421">
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
            alert(kode_billing_val);
            let masa = ''
            let Pokok = ''
            let Denda = ''
            let Total = ''
            switch (kode_billing_val) {
                case "": //apabila input kode billing tidak diisi
                    alert_gagal('Kode Billing Kosong')
                    break;
                case kode_billing_val:
                    $.ajax({
                        url: "https://esppt.bekasikota.go.id/api/ebphtb/inquiry",
                        type: 'post',
                        data:JSON.stringify({
                            IdBilling: kode_billing_val
                        }),
                        dataType: "json",
                        beforeSend: function() {
                            $('#loading_tagihan').html(`
                                <button class="btn btn-success" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                                </button>`)
                        },
                        success: function(response) {
                            switch (response.Masa) {
                                case '01':
                                    masa = "Januari"
                                    break;
                                case '02':
                                    masa = "Februari"
                                    break;
                                case '03':
                                    masa = "Maret"
                                    break;
                                case '04':
                                    masa = "April"
                                    break;
                                case '05':
                                    masa = "Mei"
                                    break;
                                case '06':
                                    masa = "Juni"
                                case '07':
                                    masa = "Juli"
                                case '08':
                                    masa = "Agustus"
                                case '09':
                                    masa = "September"
                                case '10':
                                    masa = "Oktober"
                                case '11':
                                    masa = "November"
                                case '12':
                                    masa = "Desember"
                                default:
                                    masa = ""
                                    break;
                            }
                            Pokok = parseInt(response.Pokok).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                            Denda = parseInt(response.Denda).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                            Total = parseInt(response.Total).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                            $('#loading_tagihan').html(`
                                    <button type="button" class="btn btn-success btn-search" onclick="cari_tagihan()"><i class="bi bi-search"></i> Cari</button>`)
                            if (response.Status.ResponseCode != '00') { //apabila respon gagal
                                alert_gagal(response.Status.ErrorDesc)
                            } else {
                                $('#hasil').html(`
                                    <div class="card shadow-sm form-search">
                                        <div class="card-header bg-info">
                                            <h4 class="text-center text-white"><i class="bi bi-person"></i> Data WP</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <b>NOP</b>
                                                </div>
                                                <div class="col">
                                                    ` + response.Nop + `
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <b>Nama</b>
                                                </div>
                                                <div class="col">
                                                    ` + response.Nama + `
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <b>Alamat</b>
                                                </div>
                                                <div class="col-md-4">
                                                    ` + response.Alamat + `
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
                                if (response.Total > 1000000000) {
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
                                                            ` + response.Tahun + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Masa Pajak</b>
                                                        </div>
                                                        <div class="col">
                                                            ` + masa + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Pajak</b>
                                                        </div>
                                                        <div class="col">
                                                            ` + Pokok + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Denda</b>
                                                        </div>
                                                        <div class="col">
                                                            ` + Denda + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Total Bayar</b>
                                                        </div>
                                                        <div class="col mb-3">
                                                            ` + Total + `
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="loading_va">
                                                    <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="alert_gagal('Dalam Tahap Pengembangan')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
                                }else{
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
                                                            ` + response.Tahun + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Masa Pajak</b>
                                                        </div>
                                                        <div class="col">
                                                            ` + masa + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Pajak</b>
                                                        </div>
                                                        <div class="col">
                                                            ` + Pokok + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Denda</b>
                                                        </div>
                                                        <div class="col">
                                                            ` + Denda + `
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <b>Total Bayar</b>
                                                        </div>
                                                        <div class="col mb-3">
                                                            ` + Total + `
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="loading_va">
                                                    <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + kode_billing_val + `', '`+ response.Nop +`', '` + response.Pokok + `', '` + response.Denda + `', '` + response.Tahun + `')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>
                                                </div>
                                                <div class="col" id="loading_qris">
                                                    <a class="card cover-qris mb-3" id="qris" href="javascript:void(0)" title="QRIS" onclick="bayar_qris('` + kode_billing_val + `', '` + response.Pokok + `', '` + response.Denda + `', '` + response.Tahun + `')" style="background-image: url(../assets/img/QRIS.png);"></a>
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
        function bayar_va(kode_billing, nop, pokok, denda, tahun) {
            switch (kode_billing) {
                case "": //apabila kode billing tidak ada
                    alert_gagal('Kode Billing Kosong')
                    break;
                case kode_billing:
                    $.ajax({
                        url: "request_va.php",
                        data: {
                            kode_billing: kode_billing,
                            nop: nop,
                            pokok: pokok,
                            denda: denda,
                            tahun: tahun
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#loading_va').html(`
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`)
                        },
                        success: function(response) {
                            $('#loading_va').html(`
                                <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + kode_billing + `', '` + nop + `', '` + pokok + `', '` + denda + `', '` + tahun + `')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>`)
                            if (response.status == 'Create VA Gagal') { //apabila respon gagal
                                alert_gagal(response.status)
                            } else {
                                // Swal.fire({
                                //     icon: 'info',
                                //     html: `
                                //     <div class="row mb-3">
                                //         <div class="col text-center">
                                //             <h5>No. Virtual Account Anda</h5>
                                //         </div>
                                //     </div>
                                //     <div class="row mb-3">
                                //         <div class="col text-center">
                                //             <h3 class="text-va">` + response.va_number + `</h3>
                                //         </div>
                                //     </div>`,
                                //     showCloseButton: true,
                                //     showConfirmButton: false,
                                // })
                                Swal.fire({
                                icon: 'info',
                                html: `
                                            <!-- Logo Bank -->
                                    <img src="../assets/img/logo_bjb.png" alt="Bank Logo" class="bank-logo">

                                    <!-- Title -->
                                    <p class="va-title">Pembayaran Virtual Account</p>

                                    <!-- Virtual Account Details -->
                                    <div class="info-container">
                                        <p class="text-center"><strong>Nomor Virtual Account:</strong></p>
                                        <h2 class="va-number text-center">` + response.va_number + `</h2>
                                    </div>

                                    <!-- Copy Button -->
                                    <a href="#" class="copy-button" onclick="copyToClipboard('` + response.va_number + `')">Salin Nomor VA</a>

                                    <!-- Instructions -->
                                    <div class="instructions">
                                        <p><strong>Panduan Pembayaran:</strong></p>
                                        <ul>
                                            <li>Buka aplikasi mobile banking atau ATM Bank BJB.</li>
                                            <li>Pilih menu "Pembayaran" dan pilih "Virtual Account".</li>
                                            <li>Masukkan nomor Virtual Account <strong>` + response.va_number + `</strong>.</li>
                                            <li>Masukkan nominal sesuai tagihan.</li>
                                            <li>Ikuti langkah-langkah hingga transaksi berhasil.</li>
                                        </ul>
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
                    alert_gagal('Gagal Generate Virtual Account')
                    break;
            }
        }

        // generate qris
        function bayar_qris(kode_billing, pokok, denda, tahun) {
            switch (kode_billing) {
                case "": //apabila kode billing tidak ada
                    alert_gagal('Kode Billing Kosong')
                    break;
                case kode_billing:
                    $.ajax({
                        type: "post",
                        url: "http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris_bphtb/request_qris",
                        data: {
                            kode_billing: kode_billing,
                            pokok: pokok,
                            denda: denda,
                            tahun: tahun
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
                                <a class = "card cover-qris mb-3" id = "qris" href = "javascript:void(0)" title = "QRIS" onclick = "bayar_qris('` + kode_billing + `', '` + pokok + `', '` + denda + `', '` + tahun + `')" style = "background-image: url(../assets/img/QRIS.png);"></a>`)
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
                                            <img src="http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris_bphtb/assets/qris/` + response.qris + `.png" alt="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <a class = "btn btn-primary btn-search" href = "http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris_bphtb/assets/qris/` + response.qris + `.png" title = "Download" download><i class="bi bi-download"></i> Download</a>
                                        </div>
                                    </div>`,
                                    showCloseButton: true,
                                    showConfirmButton: false,
                                })
                            }
                        },
                        error: function(xhr, thrownError) {
                            alert_gagal(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            $('#loading_qris').html(`
                                <a class = "card cover-qris mb-3" id = "qris" href = "javascript:void(0)" title = "QRIS" onclick = "bayar_qris('` + kode_billing + `', '` + pokok + `', '` + denda + `', '` + tahun + `')" style = "background-image: url(../assets/img/QRIS.png);"></a>`)
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