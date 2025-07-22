    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>

    <head>
        <title>&nbsp;</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="shortcut icon" type="images/x-icon" href="images/fav.ico" />
    </head>

    <body>
        <div style="border:1px solid #000000; padding:10px; width:100%; ">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <table>
                            <tr>
                                <td><img src="assets/images/logo.png" width="80"></td>
                                <td valign="top" style="font-size:14px; font-weight:bold; ">PEMERINTAH KOTA BEKASI</td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" valign="top" style="border-left:1px solid #000; ">
                        <table>
                            <tr>
                                <td width="100">No. SPTPD</td>
                                <td>: <?= $spt_nomor ?></td>
                            </tr>
                            <tr>
                                <td>Masa Pajak</td>
                                <td>: <?= $bln_masapajak ?> <?= $spt_tahun_pajak ?></td>
                            </tr>
                            <tr>
                                <td>Tahun Lapor</td>
                                <td>: <?= $spt_periode ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <hr />
            <div style="text-align:center; font-weight:bold; "><span style="font-size:20px; ">SPTPD</span> <br />
                (SURAT PEMBERITAHUAN PAJAK DAERAH) <br />
                PAJAK HIBURAN
            </div>
            <div style="margin-top:20px; ">&nbsp;</div>
            <table border="0" width="100%" align="center">
                <tr>
                    <td valign="top">
                        Kepada Yth. <br />
                        Badan Pendapatan Daerah <br />
                        Kota Bekasi <br />
                        Jl. Ir.H.Juanda No. 100
                    </td>
                </tr>
            </table>
            <hr />
            <table width="100%">
                <tr>
                    <td>NAMA WAJIB PAJAK</td>
                    <td>: <?= $spt_nama ?></td>
                </tr>
                <tr>
                    <td width="40%">N. P. W. P. D</td>
                    <td>:
                        <input type="text" size="4" maxlength="2" value="P">
                        <input type="text" size="4" maxlength="2" value="<?= $spt_golongan ?>">
                        <input type="text" size="6" maxlength="2" value="<?= $spt_jenispajak ?>">
                        <input type="text" size="15" maxlength="2" value="<?= $spt_noreg ?>">
                        <input type="text" size="6" maxlength="4" value="<?= $spt_camat ?>">
                        <input type="text" size="6" maxlength="2" value="<?= $spt_lurah ?>">
                    </td>
                </tr>
                <tr>
                    <td>KODE BILLING </td>
                    <td>: <?= $billing_id ?></td>
                </tr>
                <tr>
                    <td colspan="2" height="10" style="border-bottom:1px solid #000; "></td>
                </tr>

                <tr>
                    <td valign="top">Kegiatan yang diselenggarakan: </td>
                    <!-- <td>: <?= $spt_korek_nama ?></td> -->
                </tr>

                <?php 
                foreach ($list as $row) :
                ?>
                <tr>
                    <td>- <?= $row->korek_nama ?></td>
                </tr>      
                <?php endforeach; ?>
            </table>
            <hr />
            <table border="1" border="1" cellpadding="2" cellspacing="0" style="width:700px; ">
                <tr align="center">
                    <td width="300">&nbsp;</td>
                    <td width="200">Jumlah Pajak Terhutang</td>
                </tr>
                <tr>
                    <td>a. Masa Pajak</td>
                    <td><?= $bln_masapajak ?></td>
                </tr>
                <tr>
                    <td>b. Dasar Pengenaan (Jumlah Pembayaran)</td>
                    <td>
                        Rp. <?= number_format($spt_dt_jumlah, 2, ",", ".") ?>
                    </td>
                </tr>
                <tr>
                    <td>c. Tarif Pajak (Sesuai Perda)</td>
                    <td>
                        <?= $spt_korek_persen_tarif ?> % <br />
                    </td>
                </tr>
                <tr>
                    <td>d. Pajak Terhutang (bxc)</td>
                    <td>Rp. <?= number_format($pajakdibayar, 2, ",", ".") . "&nbsp;" . $nihil; ?>
                    </td>
                </tr>

            </table>
            <hr />
            <div>
                Dengan menyadari sepenuhnya akan segala akibat termasuk sanksi-sanksi sesuia dengan ketentuan perundanga-undangan yang berlaku, saya atau yang saya beri kuasa
                menyatakan apa yang telah kami beritahukan tersebut diatas beserta lampiran lampirannya adalah benar, lengkap dan jelas.
            </div>
            <br />
            <div align="right">
                <table>
                    <tr>
                        <td>Bekasi, <?= $spt_tgl_entry ?> </td>
                    </tr>
                    <tr>
                        <td align="center">Wajib Pajak</td>
                    </tr>
                    <tr>
                        <td height="50" valign="bottom" colspan="2">(<?= $spt_nama  ?>)</td>
                    </tr>
                </table>
            </div>
            <div>&nbsp;</div>
            <div>* LEMBAR INI ADALAH BUKTI PELAPORAN PAJAK YANG SAH</div>
        </div>
        <div style="height:100%; ">&nbsp;</div>

    </body>

    </html>