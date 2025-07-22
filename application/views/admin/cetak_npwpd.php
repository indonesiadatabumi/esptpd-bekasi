<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.css">
<style>
    table {
        border-collapse: collapse;
    }

    .kota {
        font-size: 12;
        font-weight: bold;
        padding: 0;
    }

    .dispenda {
        font-size: 14;
        font-weight: bold;
        padding: 0;
    }

    .kartu {
        font-size: 11;
        font-weight: bold;
        padding: 0;
    }

    .garis {
        border-top: 1.2 solid #000;
        width: 240;
    }

    .register {
        font-size: 8;
        font-weight: normal;
        padding: 0;
        text-align: center;
    }

    .ttd {
        font-size: 10;
        font-weight: normal;
        padding: 0;
        text-align: center;
    }

    .garis_kecil {
        border-bottom: 0.8 solid #000;
    }
</style>

<body onload="window.print()">

    <table style='font-family:Arial, Verdana; padding: 0; font-size: 10;font-weight:bold;' cellspacing="1">
        <tr>
            <td valign="top" width="50">
                <img style="vertical-align: top" src="<?= base_url('assets/images/logo.png') ?>" width=" 58" height="60" />
            </td>
            <td>
                <table style="text-align: center; padding: 0;border-collapse: collapse;">
                    <tr>
                        <td class="kota">PEMERINTAH KOTA BEKASI</td>
                    </tr>
                    <tr>
                        <td class="dispenda">BADAN PENDAPATAN DAERAH</td>
                    </tr>
                    <tr>
                        <td class="kartu">KARTU N P W P D</td>
                    </tr>
                    <tr>
                        <td class="garis">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td class="register">No. Register :<?= $wp_wr_id ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table cellspacing="1" style="width: 300;border-collapse: collapse;">
                    <tr class="kota">
                        <td width="50" valign="top">NAMA</td>
                        <td width="10" valign="top">:</td>
                        <td><?= $nama; ?></td>
                    </tr>
                    <tr class="kota">
                        <td width="50" valign="top">ALAMAT</td>
                        <td width="10" valign="top">:</td>
                        <td><?= $alamat; ?></td>
                    </tr>
                    <tr class="kota">
                        <td width="50" valign="top">NPWPD</td>
                        <td width="10" valign="top">:</td>
                        <td><?= $npwprd ?></td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <!-- <p> Silakan Aktivasi via email dan lakukan Registrasi user untuk pelaporan Online </p> -->
                <!-- $(".demo").printThis(); -->
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table cellspacing="1" style="border-collapse: collapse;">
                    <tr>
                        <td width="157"></td>
                        <td class="register">
                            Bekasi, <?= $tanggal_kartu ?><br />
                            a.n Walikota Bekasi <br />
                            Kepala Badan Pendapatan Daerah<br /><br /><br /><br /><br /><br />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div style="position: absolute; top: 58mm; left: 52mm;">
                                <img style="WIDTH:105px; HEIGHT:25px;" opacity="0.9" src="<?= base_url('assets/images/ttd_kaban_baru.jpg') ?>">
                            </div>
                            <div style="position: absolute; top: 55mm; left: 40mm;">
                                <img style="WIDTH:50px; HEIGHT:50px;" opacity="10" src="<?= base_url('assets/images/stempel_new.jpg') ?>">
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center"><span class="ttd garis_kecil"> <?= $pejabat->pejda_nama ?></u></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="register"><?= $pejabat->ref_pangpej_ket ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="register">NIP. <?= $pejabat->pejda_nip ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- <div class="row">
    <div class="one-half column">
        <a id="basic" href="#nada" class="button button-primary">Print container</a>
    </div>
</div> -->
</body>