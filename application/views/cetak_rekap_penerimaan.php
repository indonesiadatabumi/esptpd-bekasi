<?php
error_reporting(~E_NOTICE);
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=Rekap_Penerimaan.xls");
header("Expires:0");
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Pragma: public");
?>
<div class="panel-body">
    <div class="table-responsive">
        <table border="1" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th width="150">NPWPD</th>
                    <th width="150">Kode Billing</th>
                    <th width="80">Tahun </th>
                    <th width="100">Jml. Pajak</th>
                    <th width="80">Denda</th>
                    <th width="100">Jumlah Bayar</th>
                    <th width="150">Tgl dan Wkt Bayar</th>
                    <th>Sts Byr SPT</th>
                    <th>Metode Bayar</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $stat_arr = array(
                    "0" => "Blm Bayar",
                    "1" => "Sudah Bayar",
                    "2" => "Nihil"
                );

                foreach ($penerimaan as $row) {
                    $cek_bayar = $model->metode_bayar($row->kode_billing);
                    if ($cek_bayar != null) {
                        $metode_bayar = $cek_bayar->jns_billing;
                    }else{
                        $metode_bayar = 'Billing';
                    }
                    $i++;
                    $jml_bayar = $row->tagihan + $row->denda;
                    $total += $jml_bayar;
                ?>
                    <tr class="gradeA">
                        <td align="center"><?= $i ?></td>
                        <td><?= $row->npwprd  ?></td>
                        <td>'<?= $row->kode_billing  ?>'</td>
                        <td align="center"><?= $row->tahun_pajak ?></td>
                        <td align="right"><?= number_format($row->tagihan, 0, ",", ".") ?></td>
                        <td align="right"><?= number_format($row->denda, 0, ",", ".")  ?></td>
                        <td align="right"><?= number_format($jml_bayar, 0, ",", ".")  ?></td>
                        <td align="center"><?= $row->tgl_pembayaran ?></td>
                        <td align="center"><?= $stat_arr[$row->status_bayar]  ?>
                        </td>
                        <td align="center"><?= $metode_bayar  ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" align="right">Total</th>
                    <th align="right"><?= number_format($total, 0, ",", ".")  ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>