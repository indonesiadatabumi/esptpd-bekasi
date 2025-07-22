<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Portal Pembayaran | Pajak PBB</title>

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
                            <li class="breadcrumb-item active" aria-current="page">Pajak PBB</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Pajak PBB</h3>
                        <p>Silahkan input nop anda terlebih dahulu.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="nop" class="col-sm-2 col-form-label"><b>NOP</b></label>
                        <div class="col-sm-6 mb-3">
                            <input type="text" class="form-control form-search" id="nop" maxlength="24" placeholder="200001002016202023">
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
        $('#nop').keypress(function(e) {
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

        // cari tagihan pbb
        function cari_tagihan() {
            nop_val = $('#nop').val()
            // alert('xx'+nop_val);
            switch (nop_val) {
                case "": //apabila input kode billing tidak diisi
                    alert_gagal('NOP Tidak Boleh Kosong')
                    break;
                case nop_val:
                    $.ajax({
                        url: "https://esppt.bekasikota.go.id/api/epbb/inquiry_multi",
                        type: 'post',
                        data:JSON.stringify({
                            Nop: nop_val
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
                            $('#loading_tagihan').html(`
                                <button type="button" class="btn btn-success btn-search" onclick="cari_tagihan()"><i class="bi bi-search"></i> Cari</button>`)
                            if (response.Status.ResponseCode != '00') {
                                alert_gagal(response.Status.ErrorDesc)
                            }else{
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
                                                <b>Kelurahan</b>
                                            </div>
                                            <div class="col-md-4">
                                                ` + response.Kelurahan + `
                                            </div>
                                        </div>
                                    </div>
                                </div>`)
                                $('#hasil2').html(`
                                <div class="card shadow-sm form-search">
                                    <div class="card-header bg-info">
                                        <h4 class="text-center text-white"><i class="bi bi-cash"></i> Data Tagihan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr align="center">
                                                        <th>Tahun</th>
                                                        <th>Pokok</th>
                                                        <th>Diskon</th>
                                                        <th>Denda</th>
                                                        <th>Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tagihan-list">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>`)
                                let tagihan = response.Tagihan
                                tagihan.forEach(function(val) {
                                    let Pokok = val.Pokok.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                                    let Diskon = val.Diskon.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                                    let Denda = val.Denda.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                                    let Total = val.Total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                                    let list = ""
                                    if (val.Total > 10000000) {
                                        list = `
                                        <tr>
                                            <td align="center">${val.Tahun}</td>
                                            <td align="right">${Pokok}</td>
                                            <td align="right">${Diskon}</td>
                                            <td align="right">${Denda}</td>
                                            <td align="right">${Total}</td>
                                            <td align="center">
                                            <button type="button" class="btn btn-primary btn-sm" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + response.Nop + `', '` + val.Pokok + `', '` + val.Diskon + `', '` + val.Denda + `', '` + val.Tahun + `')">VA</button>
                                            </td>
                                        </tr>`
                                    }else{
                                        list = `
                                        <tr>
                                            <td align="center">${val.Tahun}</td>
                                            <td align="right">${Pokok}</td>
                                            <td align="right">${Diskon}</td>
                                            <td align="right">${Denda}</td>
                                            <td align="right">${Total}</td>
                                            <td align="center">
                                            <button type="button" class="btn btn-primary btn-sm" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + response.Nop + `', '` + val.Pokok + `', '` + val.Diskon + `', '` + val.Denda + `', '` + val.Tahun + `')">VA</button>
                                            <button type="button" class="btn btn-danger btn-sm" id="qris" href="javascript:void(0)" title="Qris" onclick="bayar_qris('` + response.Nop + `', '` + val.Pokok + `', '` + val.Diskon + `', '` + val.Denda + `', '` + val.Tahun + `')">Qris</button>
                                            </td>
                                        </tr>`
                                    }

                                    $('#tagihan-list').append(list);
                                });
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
        function bayar_va(nop, pokok, diskon, denda, tahun) {
            $.ajax({
                url: "request_va.php",
                data: {
                    nop: nop,
                    pokok: pokok,
                    diskon: diskon,
                    denda: denda,
                    tahun: tahun
                },
                dataType: "json",
                // beforeSend: function() {
                //     $('#loading_va').html(`
                //     <div class="spinner-border text-primary" role="status">
                //         <span class="sr-only">Loading...</span>
                //     </div>`)
                // },
                success: function(response) {
                    // $('#loading_va').html(`
                    //     <a class="card cover-va mb-3" id="va" href="javascript:void(0)" title="VA" onclick="bayar_va('` + kode_billing + `')" style="background-image: url(../assets/img/Virtualaccount.png);"></a>`)
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
                            <p><strong>NOP:</strong> ` + response.nop + `</p>
                            <p><strong>Nomor Virtual Account:</strong></p>
                            <p class="va-number">` + response.va_number + `</p>
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
        }

        // generate qris
        function bayar_qris(nop, pokok, diskon, denda, tahun) {
            let btn = $(this);
            btn.html(`
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`
            )
            $.ajax({
                type: "post",
                url: "http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris_pbb/request_qris",
                data: {
                    nop: nop,
                    pokok: pokok,
                    diskon: diskon,
                    denda: denda,
                    tahun: tahun
                },
                dataType: "json",
                // beforeSend: function() {
                //     $('#loading_qris').html(`
                //     <div class="spinner-border text-primary" role="status">
                //         <span class="sr-only">Loading...</span>
                //     </div>`)
                // },
                success: function(response) {
                    $('#loading_qris').html(`
                        <button type="button" class="btn btn-danger btn-sm" id="qris" href="javascript:void(0)" title="Qris" onclick="bayar_qris('` + nop + `', '` + pokok + `', '` + diskon + `', '` + denda + `', '` + tahun + `')">Qris</button>`)
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
                                    <img src="http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris_pbb/assets/qris/` + response.qris_name + `.png" alt="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <a class = "btn btn-primary btn-search" href = "http://simpatda.bekasikota.go.id/simpatda_bekasi/api_qris_pbb/assets/qris/` + response.qris_name + `.png" title = "Download" download><i class="bi bi-download"></i> Download</a>
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
                        <button type="button" class="btn btn-danger btn-sm" id="qris" href="javascript:void(0)" title="Qris" onclick="bayar_qris('` + nop + `', '` + pokok + `', '` + diskon + `', '` + denda + `', '` + tahun + `')">Qris</button>`)
                }
            });
        }

        function copyToClipboard(va_number) {
            const textToCopy = va_number;

            // Fallback untuk HTTP: menggunakan textarea sementara
            const textarea = $('<textarea>').val(textToCopy).appendTo('body').select();
            try {
                document.execCommand('copy');
                alert('Text copied: ' + textToCopy);
            } catch (err) {
                console.error('Failed to copy text:', err);
            }
            textarea.remove(); // Hapus elemen textarea sementara
        }
    </script>

</body>

</html>