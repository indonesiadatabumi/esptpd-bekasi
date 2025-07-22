<!-- Main content -->


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> INFORMASI SPTPD WAJIB PAJAK <?= $wp_wr_nama ?> </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="infowp" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>No. Reg. SPT</th>
                                    <th>Tanggal Input</th>
                                    <th>Periode</th>
                                    <th>Masa Pajak</th>
                                    <th>Nilai Pajak</th>
                                    <th>Kode Billing</th>
                                    <th>Sts. bayar</th>
                                    <th width="80">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $stat_arr = array(
                                    "0" => "<i class='far fa-times-circle' style='color:red;'></i> <span class='text-danger'>Blm Lunas</span>",
                                    "1" => "<i class='far fa-check-circle' style='color:green;'></i><span class='text-success'> Lunas</span>",
                                    "2" => "<span class='text-secondary'> Nihil</span>"
                                );
                                foreach ($data_spt as $row) {
                                ?>
                                    <tr>
                                        <td align="center"><?= $row->spt_nomor ?></td>
                                        <td align="center"><?= $row->spt_tgl_entri ?></td>
                                        <td align="center"><?= $row->spt_periode ?></td>
                                        <td align="center"><?= $row->spt_periode_jual1 . " s/d " . $row->spt_periode_jual2 ?></td>
                                        <td align="right"><?= number_format($row->spt_pajak, 2, ',', '.'); ?></td>
                                        <td><?= $row->spt_kode_billing ?></td>
                                        <td><?= $stat_arr[$row->status_bayar] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>esptpd/espt_print/<?= $row->spt_id ?>/<?= $row->spt_jenis_pajakretribusi ?>" class="btn btn-danger btn-sm" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>