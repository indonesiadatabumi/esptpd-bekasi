<!-- Content Wrapper. Contains page content -->

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Info</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h5>Silahkan cek laporan spt anda pada tombol di bawah ini</h5>
                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Jumlah Spt Pending <?= $count_pending_spt ?>
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <table id="tbl_kategori" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Kode Billing</th>
                                        <th>Masa Pajak</th>
                                        <th>Periode SPT</th>
                                        <th>Pajak</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pending_spt as $row) :
                                    ?>
                                        <tr>
                                            <td><?= $row->id_billing; ?></td>
                                            <td><?= $row->masa_awal; ?> - <?= $row->masa_akhir; ?></td>
                                            <td><?= $row->periode_spt; ?></td>
                                            <td><?= "Rp " . number_format($row->spt_pajak); ?></td>
                                            <td><?= $row->keterangan; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12">
                            <!-- <h4>Recent Activity</h4> -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?php echo base_url(); ?>assets/dist/img/avatar5.png">
                                    <span class="username">
                                        <a href="#">Administrator.</a>
                                    </span>
                                    <span class="description">Posting - 7:45 AM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Selamat datang di Sistem Informasi Pelaporan Pajak Daerah Kota Bekasi, pastikan untuk memperbaharui data anda secara berkala.
                                    <br> Untuk Informasi bantuan dapat menghubungi nomor 0812-9495-1645 atau 0818-0656-5995.
				     <br>Terimakasih.
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Create by Admin</a>
                                </p>
                            </div>


                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?php echo base_url(); ?>assets/foto/logo/LOGO_KOTA_BEKASI.png">
                                                                      
                                </div>
                                <!-- /.user-block -->
                                <a href="<?php echo base_url(); ?>assets/download.php?file=contoh format pelaporan sptpd.xls" target="_blank"><img src="<?php echo base_url(); ?>assets/foto/logo/icnexcel.png" width="35px">Download</a>
                                <p>
                                    Format Dokumen upload Pelaporan
                                </p>

                                
                            </div>

                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?php echo base_url(); ?>assets/foto/logo/LOGO_KOTA_BEKASI.png">
                                                                      
                                </div>
                                <!-- /.user-block -->
                               
                               <a href="<?php echo base_url(); ?>assets/download.php?file=SE PEMBAYARAN PAJAK DAERAH.pdf" target="_blank"><img src="<?php echo base_url(); ?>assets/foto/logo/iconpdf.png" width="35px" height="40px">Download</a>
                                <p>
                                    Surat Edaran Wali Kota Bekasi<br>
                                    tentang Pembayaran Pajak Daerah Kota bekasi
                                </p>

				<a href="<?php echo base_url(); ?>assets/download.php?file=Perda Nomor 1 Tahun 2024.pdf" target="_blank"><img src="<?php echo base_url(); ?>assets/foto/logo/iconpdf.png" width="35px" height="40px">Download</a>
                                <p>
                                    Peraturan Daerah Kota Bekasi Nomor 1 Tahun 2024<br>
                                    Tentang Pajak Daerah dan Retribusi Daerah
                                </p>

 				<a href="<?php echo base_url(); ?>assets/download.php?file=Perwal Nomor 19 Tahun 2021 ttg Pengelolaan pajak daerah secara online.pdf" target="_blank"><img src="<?php echo base_url(); ?>assets/foto/logo/iconpdf.png" width="35px" height="40px">Download</a>
                                <p>
                                    Peraturan Walikota Bekasi Nomor 19 Tahun 2021<br>
                                    Tentang Pengelolaan Pajak Daerah Secara Online
                                </p>
				
				<a href="<?php echo base_url(); ?>assets/download.php?file=skema va bapenda.pdf" target="_blank"><img src="<?php echo base_url(); ?>assets/foto/logo/iconpdf.png" width="35px" height="40px">Download</a>
                                <p>
                                    Tata Cara Penggunaan Virtual Account<br>
                                
                                </p>
				
				                                
                            </div>

                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?php echo base_url(); ?>assets/foto/logo/LOGO_KOTA_BEKASI.png">
                                 </div>
                                <!-- /.user-block -->
                                 <a href="https://www.youtube.com/watch?v=s3VrdMN6ebc" target="_blank"> Video tutorial cara Generate Billing (sipdah.bekasikota.go.id)  </a> <br>
                              	 <a href="https://www.youtube.com/watch?v=9_DE_F-rRes" target="_blank"> Video tutorial cara Pelaporan Pajak (sipdah.bekasikota.go.id)  </a>
                                
                            </div>

                            <!-- <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                    <span class="username">
                                        <a href="#">Sarah Ross</a>
                                    </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                </div> 
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                </p>
                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                                </p>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<script>
$( document ).ready(function() {
    Swal.fire({
        imageUrl: '../assets/foto/pembayaran.jpg',
        imageWidth: 20000,
        imageHeight: 700,
        imageAlt: 'Custom image',
        showConfirmButton: false,
    })
});
</script>