<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Portal Pembayaran</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/logo_pemda.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- main style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- hero area -->
    <!-- <div class="hero-area hero-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-2 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <img src="assets/img/logo_pemda.png" alt="" width="250px">
                            <h1>Selamat Datang di Portal Pembayaran Pajak</h1>
                            <h1>Kota Bekasi</h1>
                            <p class="text-white">Scroll ke bawah >>></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- end hero area -->

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Pilihan Jenis Pajak</h3>
                        <p>Silahkan pilih jenis pajak terlebih dahulu.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <a href="pbb" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/PBB.png);">
                    </a>
                    <h4 class="text-center mb-5">Pajak PBB</h4>
                </div>
                <div class="col-md-4">
                    <a href="bphtb" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/bphtb.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak BPHTB</h4>
                </div>
                <div class="col-md-4">
                    <a href="pdl?jp=1" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/hotel.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak Hotel</h4>
                </div>
                <div class="col-md-4">
                    <a href="pdl?jp=2" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/restoran.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak Restoran</h4>
                </div>
                <div class="col-md-4">
                    <a href="pdl?jp=3" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/hiburan.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak Hiburan</h4>
                </div>
                <div class="col-md-4">
                    <a href="retribusi/" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/minerba.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Retribusi Daerah</h4>
                </div>
                <div class="col-md-4">
                    <a href="pdl?jp=7" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/parkir.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak Parkir</h4>
                </div>
                <div class="col-md-4">
                    <a href="pdl?jp=8" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/air_tanah.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak Air Tanah</h4>
                </div>
                <div class="col-md-4">
                    <a href="pdl?jp=4" class="card cover-tax mb-4" style="background-image: url(assets/img/cover/reklame.jpg);">
                    </a>
                    <h4 class="text-center mb-5">Pajak Reklame</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- end product section -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <p>Copyrights &copy; <?= date('Y') ?> - Bapenda Kota Bekasi, All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- owl carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>

</body>

</html>