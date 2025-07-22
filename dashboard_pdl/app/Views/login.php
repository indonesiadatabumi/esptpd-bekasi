<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- Favicons -->
    <link href="<?= base_url()?>/assets/img/logo.png" rel="icon">
    <link href="<?= base_url()?>/assets/img/logo.png" rel="logo">

    <!-- ================== BEGIN core-css ================== -->
    <link href="<?= base_url() ?>/assets/css/vendor.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/css/facebook/app.min.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

    <!-- Plugins CSS Files -->
    <link href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
</head>

<body class='pace-top'>
    <div id="flash" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
    <div id="flashfail" data-flash="<?= session()->getFlashdata('fail'); ?>"></div>
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->


    <!-- BEGIN #app -->
    <div id="app" class="app">
        <!-- BEGIN login -->
        <div class="login login-v2 fw-bold">
            <!-- BEGIN login-cover -->
            <div class="login-cover">
                <div class="login-cover-img" style="background-image: url(assets/img/login-bg-17.jpg)" data-id="login-cover-image"></div>
                <div class="login-cover-bg"></div>
            </div>
            <!-- END login-cover -->

            <!-- BEGIN login-container -->
            <div class="login-container">
                <div class="text-center">
                <img src="<?= base_url()?>/assets/img/logo.png" alt="" width="100px">
                </div>
                <!-- BEGIN login-header -->
                <div class="login-header">
                    <div class="brand">
                        <div class="d-flex align-items-center">
                            Pajak Daerah Lainnya <br> Kota Bekasi
                        </div>
                        <small>Selamat datang, silahkan login</small>
                    </div>
                    <!-- <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div> -->
                </div>
                <!-- END login-header -->

                <!-- BEGIN login-content -->
                <div class="login-content">
                    <form action="<?= base_url() ?>/auth/login" method="POST">
                        <div class="form-floating mb-20px">
                            <input type="text" class="form-control fs-13px h-45px border-0" placeholder="Username" id="username" name="username" />
                            <label for="username" class="d-flex align-items-center text-gray-600 fs-13px">Username</label>
                        </div>
                        <div class="form-floating mb-20px">
                            <input type="password" class="form-control fs-13px h-45px border-0" placeholder="Password" id="password" name="password" />
                            <label for="password" class="d-flex align-items-center text-gray-600 fs-13px">Password</label>
                        </div>
                        <div class="mb-20px">
                            <button type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">Login</button>
                        </div>
                    </form>
                </div>
                <!-- END login-content -->
            </div>
            <!-- END login-container -->
        </div>
        <!-- END login -->

        <!-- BEGIN scroll-top-btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
        <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->

    <!-- ================== BEGIN core-js ================== -->
    <script src="<?= base_url() ?>/assets/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.min.js"></script>
    <!-- ================== END core-js ================== -->

    <!-- Plugins JS Files -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Alert Success
        let flash = $('#flash').data('flash')
        if (flash) {
            Swal.fire({
                icon: 'success',
                // title: 'Berhasil',
                showConfirmButton: false,
                timer: 1400,
                text: flash,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }

        //Alert Fail
        let flashfail = $('#flashfail').data('flash')
        if (flashfail) {
            Swal.fire({
                icon: 'error',
                // title: 'Gagal',
                showConfirmButton: false,
                timer: 1400,
                text: flashfail,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }
    </script>
</body>

</html>