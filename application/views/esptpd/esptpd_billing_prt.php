<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title><?= $pajak ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="shortcut icon" type="images/x-icon" href="images/fav.ico" />
</head>

<body>

    <table border=0 style="width: 400px; font-family:">
        <tr>
            <td align="right" width="75"><img src="assets/images/logo.png" width=" 55" height="50"></td>
            <td valign="top" style="font-weight:bold; text-align:center;">
                <span style="font-size:12px; ">PEMERINTAH KOTA BEKASI</span> <br />
                <span style="font-size:10px; ">BADAN PENDAPATAN DAERAH</span> <br />
                <div style="font-size:8px; ">Jl. Ir. H.Juanda No. 100 <br />
                    Telp. (021)88397963/64 Fax. (021)88397965</div>
            </td>
            <!-- <td width="100" valign="top"><img src="images/logo-bank.jpg" width="90" height="50"></td> -->
        </tr>
    </table>
    <div style="width:400px; border-bottom:1px solid; "></div>
    <table border=0 style="width: 400px; font-size:10px;">
        <tr>
            <td style="width:100px; ">No. SPTPD</td>
            <td colspan="2" width="300">: <?= $spt_nomor ?></td>
        </tr>
        <tr>
            <td>WAJIB PAJAK</td>
            <td colspan="2">: <?= $spt_nama ?></td>
        </tr>
        <tr>
            <td>NPWPD</td>
            <td>: <?= $npwpd ?></td>
            <td rowspan="4" valign="top" style="width:150px; ">
                <table border=1 align="right" cellpadding="2" cellspacing="0">
                    <tr>
                        <td align="center">KODE BILLING</td>
                    </tr>
                    <tr>
                        <td style="width:120px; text-align:center; font-size:14px; font-weight:bold; "><?= $billing_id ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>JENIS PAJAK</td>
            <td>: <?php echo $pajak; ?></td>
        </tr>
        <tr>
            <td>Masa Pajak</td>
            <td>: <?= $bln_masapajak ?> <?= $spt_tahun_pajak ?></td>
        </tr>
        <tr>
            <td>Pokok Pajak</td>
            <td>: Rp. <?= number_format($pokok_pajak, 2, ",", ".")  ?> </td>

        </tr>
        <tr>
            <td>Denda</td>
            <td>: Rp. <?= number_format($jml_denda, 2, ",", ".")  ?> </td>

        </tr>
        <!-- <tr>
            <td>Sanksi Lapor</td>
            <td>: Rp. <?= number_format($sanksi_lapor, 2, ",", ".") ?> </td>

        </tr> -->
        <tr>
            <td>JUMLAH</td>
            <td>: Rp. <?= number_format($pajakdibayar, 2, ",", ".") . "&nbsp;"; ?> </td>

        </tr>
    </table>
    <table>
        <tr>
            <td style="font-size:8px; ">Tanggal Cetak : <?= date("d-m-Y h:i:s") ?> </td>
        </tr>
    </table>
    <div style="font-size:8px; width:400px; font-weight:bold; ">** Keterlambatan Pembayaran melewati tanggal jatuh tempo akan dikenakan sanksi administrasi berupa bunga
        sebesar 1% (satu persen) setiap bulannya </div>
    <div>&nbsp;</div>
    <div style="font-weight:bold; text-align:center; width:400px; font-size:10px; ">"PAJAK ANDA MEMBANGUN KOTA BEKASI" <br />-- TERIMA KASIH --</div>
    </div>
</body>

</html>