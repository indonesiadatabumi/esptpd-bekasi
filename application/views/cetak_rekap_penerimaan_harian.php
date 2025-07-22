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

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($penerimaanharian as $row) {
                    $jml_bayar = $row->tagihan + $row->denda;
                ?>
                    <tr class="gradeA">
                        <td align="center"><?= $no++ ?></td>
                        <td align="center"><?= $row->npwprd  ?></td>
                        <td align="center"><?= $row->kode_billing  ?>'</td>
                        <td align="center"><?= $row->tahun_pajak ?></td>
                        <td align="right"><?= $row->tagihan ?></td>
                        <td align="right"><?= $row->denda  ?></td>
                        <td align="right"><?= $jml_bayar  ?></td>
                        <td align="center"><?= $row->tgl_pembayaran ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</div>