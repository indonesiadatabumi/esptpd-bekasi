<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Info Rinci WP</title>
    <style>
        hr, td {
            border: 0.5px solid black;
        }
        td{
            padding-left: 4px;
        }
    </style>
  </head>
  <body>
    <h3 class="text-center mt-3">Informasi Rinci Wajib Pajak</h3>
    <div class="container mt-5">
        <div class="row">
            <div class="col md-6 border border-dark">
                <h5 class="text-center"><b><u>Informasi Wajib Pajak</u></b></h5>
                <hr>
                <table width="100%">
                    <tr>
                        <td width="30%">
                            <p><b>Nama WP</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_nama_milik?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Alamat WP</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_almt_milik?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Kelurahan WP</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_lurah_milik?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Kecamatan WP</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_camat_milik?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Kabupaten WP</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_kabupaten_milik?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>Nomor NIK/NIB WP</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_nik?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><b>No. Telp</b></p>
                        </td>
                        <td>
                            <p><?= $wp->wp_wr_telp_milik?></p>
                        </td>
                    </tr>
                </table>
                <hr>
            </div>
            <div class="col md-6 border border-dark">
                <h5 class="text-center"><b><u>Informasi Objek Pajak</u></b></h5>
                <hr>
                <?php foreach ($wp_detail as $row) : ?>
                    <table width="100%">
                        <tr>
                            <td width="30%">
                                <p><b>Jenis Pajak</b></p>
                            </td>
                            <td>
                                <p><?= $row->ref_kodus_nama?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>Nama OP</b></p>
                            </td>
                            <td>
                                <p><?= $row->wp_wr_nama?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>Alamat OP</b></p>
                            </td>
                            <td>
                                <p><?= $row->wp_wr_almt?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>Kelurahan OP</b></p>
                            </td>
                            <td>
                                <p><?= $row->wp_wr_lurah?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>Kecamatan OP</b></p>
                            </td>
                            <td>
                                <p><?= $row->wp_wr_camat?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>Kabupaten OP</b></p>
                            </td>
                            <td>
                                <p><?= $row->wp_wr_kabupaten?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b>No. Telp</b></p>
                            </td>
                            <td>
                                <p><?= $row->wp_wr_telp?></p>
                            </td>
                        </tr>
                    </table>
                    <hr>
                <?php endforeach ?>
            </div>
        </div>
    </div>
  </body>
</html>