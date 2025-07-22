<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>:: SIMPATDA-BEKASI ::</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" media="all" type="text/css" href="<?= base_url('assets/styles/main.css') ?>" />

    <link rel="stylesheet" media="all" type="text/css" href="<?= base_url('assets/styles/jquery/jquery-ui.css') ?>" />
    <link rel="stylesheet" media="all" type="text/css" href="<?= base_url(); ?>assets/styles/jquery/jquery.cssmenu.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/jquery/jquery.autocomplete.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/templates/khepri/css/template.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles/templates/khepri/css/rounded.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/styles/jquery/flexigrid.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/styles/greybox.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css" type="text/css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" type="text/css" />

    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery-ui-1.9.0.custom.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.bgiframe.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/supersubs.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.autotab.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.hotkeys.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery-enter2tab.js"></script>
    <!-- <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.maskedinput-1.2.2.min.js"></script> -->
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.dateentry.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.download.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.numeric.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.form.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.chainedSelects.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/flexigrid.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/ajaxfileupload.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/greybox/greybox.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var GLOBAL_SESSION_VARS = new Array();
        GLOBAL_SESSION_VARS["USER_ID"] = "<?= $this->session->userdata('USER_ID'); ?>";
        GLOBAL_SESSION_VARS["USER_JABATAN"] = "<?= $this->session->userdata('USER_JABATAN'); ?>";
        GLOBAL_SESSION_VARS["USER_SPT_CODE"] = "<?= $this->session->userdata('USER_SPT_CODE'); ?>";

        GLOBAL_MAIN_VARS = new Array();
        GLOBAL_MAIN_VARS["BASE_URL"] = "<?= base_url(); ?>";
        GLOBAL_MAIN_VARS["LIST_KECAMATAN"] = "<?= base_url(); ?>common/get_kecamatan";
        GLOBAL_MAIN_VARS["LIST_KELURAHAN"] = "<?= base_url(); ?>common/get_kelurahan";
        GLOBAL_MAIN_VARS["NEXT_NO_SPTPD"] = "<?= base_url(); ?>common/get_next_nomor_sptpd";
    </script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/private/main.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/scripts/jquery/jquery.cssmenu.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/scripts/main.js') ?>"></script>

    <style>
        .border {
            border-radius: 16px
        }
    </style>
</head>

<body>