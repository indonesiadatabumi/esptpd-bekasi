<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bars"></i>
                    Menu E-SPTPD
                </h3>
                <div class="text-right">

                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="location.href='<?php echo base_url('esptpd/tambah_data_group'); ?>'"><i class="fas fa-plus"></i> Tambah Data Grup</button>
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="location.href='<?php echo base_url('esptpd/print_billing_group'); ?>'" title="Print Kode Billing"><i class="fas fa-print"></i> Print Kode Billing</button>
                    <!-- <a href="<?php echo base_url('user/download') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="dwn_user" title="Download"><i class="fas fa-download"></i> Download</a> -->
                </div>
            </div>
            <div class="card-body">
                <!--menu LIst -->
                <table class="table table-striped  table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>NOPD</th>
                            <th>NAMA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        foreach ($esptpd as $row) {
                            // echo "<tr><td> 1 </td>
                            //             <td>" . $row->npwpd . "</td>
                            //             <td>" . $row->nama . "</td>
                            //             <td align='center'>
                            //             <a href=" . base_url('esptpd/billing/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                            //             <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                            //             </td>
                            //         </tr>";
                            $cek_masa_pajak = $Mod_esptpd->cek_masa_terakhir($row->npwpd);
                            if ($cek_masa_pajak == null) {
                                echo "<tr><td> 1 </td>
                                        <td>" . $row->npwpd . "</td>
                                        <td>" . $row->nama . "</td>
                                        <td align='center'>
                                        <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                        <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                                        </td>
                                    </tr>";
                            }else{
                                $cek_lapor = $Mod_esptpd->cek_lapor($cek_masa_pajak->spt_periode_jual1, $cek_masa_pajak->spt_id);
                                $wp_catering = substr($row->npwpd, 4, -14);
                                
                                if ($cek_lapor->tgl_lapor == null) {
                                    if ($wp_catering == '02') {
                                        echo "<tr><td> 1 </td>
                                            <td>" . $row->npwpd . "</td>
                                            <td>" . $row->nama . "</td>
                                            <td align='center'>
                                            <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                            <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                                            </td>
                                        </tr>";
                                    }else{
                                        echo "<tr><td> 1 </td>
                                            <td>" . $row->npwpd . "</td>
                                            <td>" . $row->nama . "</td>
                                            <td align='center'>
                                            <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                            Anda belum melakukan pelaporan masa pajak sebelumnya
                                            </td>
                                        </tr>";
                                    }
                                }else {
                                    echo "<tr><td> 1 </td>
                                            <td>" . $row->npwpd . "</td>
                                            <td>" . $row->nama . "</td>
                                            <td align='center'>
                                            <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                            <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                                            </td>
                                        </tr>";
                                }
                            }
                        }
                        $no = 2;
                        foreach ($menu as $row) {
                            // echo "<tr><td>" . $no++ . "</td>
                            //             <td>" . $row->npwpd . "</td>
                            //             <td>" . $row->nama . "</td>
                            //             <td align='center'>
                            //             <a href=" . base_url('esptpd/billing/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                            //             <a href=" . base_url() . "esptpd/add/" . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "   class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Input SPTPD</a>
                            //             <!--<a href=" . base_url('esptpd/delete_menu/') . $row->noid . " class='btn btn-sm btn-outline-danger'><i class='fas fa-trash'></i> Delete Grup</a>-->
                            //             <a class=\"btn btn-sm btn-outline-danger\" id=\"delete\" href=\"javascript:void(0)\" title=\"delete\" data-href=" . $row->noid . "><i class=\"fas fa-trash\"> </i>Delete Grup</a>
                            //             </td>
                            //         </tr>";
                            $cek_masa_pajak = $Mod_esptpd->cek_masa_terakhir($row->npwpd);
                            if ($cek_masa_pajak == null) {
                                echo "<tr><td> 1 </td>
                                        <td>" . $row->npwpd . "</td>
                                        <td>" . $row->nama . "</td>
                                        <td align='center'>
                                        <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                        <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                                        </td>
                                    </tr>";
                            }else{
                                $cek_lapor = $Mod_esptpd->cek_lapor($cek_masa_pajak->spt_periode_jual1, $cek_masa_pajak->spt_id);
                                $wp_catering = substr($row->npwpd, 4, -14);
                            
                                if ($cek_lapor->tgl_lapor == null) {
                                    if ($wp_catering == '02') {
                                        echo "<tr><td> 1 </td>
                                            <td>" . $row->npwpd . "</td>
                                            <td>" . $row->nama . "</td>
                                            <td align='center'>
                                            <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                            <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                                            </td>
                                        </tr>";
                                    }else{
                                        echo "<tr><td> 1 </td>
                                            <td>" . $row->npwpd . "</td>
                                            <td>" . $row->nama . "</td>
                                            <td align='center'>
                                            <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                            Anda belum melakukan pelaporan masa pajak sebelumnya
                                            </td>
                                        </tr>";
                                    }
                                }else {
                                    echo "<tr><td> 1 </td>
                                            <td>" . $row->npwpd . "</td>
                                            <td>" . $row->nama . "</td>
                                            <td align='center'>
                                            <a href=" . base_url('esptpd/billing_new/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . " class='btn btn-sm btn-outline-success _lapor'><i class='fa fa-info'></i> Detail </a>&nbsp;
                                            <button   onclick=\"window.location='" . base_url('esptpd/add/') . $row->wp_wr_bidang_usaha . "/" . $row->wp_wr_no_urut . "'\"  class='btn btn-sm btn-outline-info _lapor'><i class='fa fa-edit'></i> Generate Billing</button>
                                            </td>
                                        </tr>";
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>

<script>
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        Swal.fire({
            title: 'Apakah anda Yakin?',
            text: "akan menghapus Grup ID: " + data,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            $.ajax({
                type: "post",
                url: "<?= site_url('esptpd/delete_menu') ?>",
                data: {
                    noid: data
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {

                        Swal.fire(
                            'Deleted!',
                            'Menu Grup berhasil di hapus.',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr, thrownError) {
                    Swal(
                        'Billing Gagal dihapus!.',
                        'error'
                    )
                }
            });

        })

    });
</script>