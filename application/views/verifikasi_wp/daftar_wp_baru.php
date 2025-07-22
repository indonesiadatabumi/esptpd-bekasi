<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Verifikasi WP Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabelwpbaru" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>No</th>
                                    <th>NIK/NIB</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan </th>
                                    <th>Jenis Kepemilikan</th>
                                    <th>Status</th>
                                    <th>Kasubid</th>
                                    <th>Kabid</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
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

<script type="text/javascript">
    var save_method; //for save method string
    var table;

    // $('#noreg').change(function() {
    //     table.draw();
    // });

    $(document).ready(function() {

        //datatables
        table = $('#tabelwpbaru').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "emptyTable": "Data Kosong"
            },
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                url: '<?php echo site_url('verifikasi_wp/ajax_list') ?>',
                type: 'post'
            },
        });
    });



    $(document).on('click', '#verifikasi', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('verifikasi_wp/aksi_verifikasi_admin') ?>/" + data;
        window.location.href = url;

    });

    $(document).on('click', '#verifikasi_kasubid', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('verifikasi_wp/aksi_verifikasi_kasubid') ?>/" + data;
        window.location.href = url;

    });

    $(document).on('click', '#verifikasi_kabid', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        var url = "<?php echo site_url('verifikasi_wp/aksi_verifikasi_kabid') ?>/" + data;
        window.location.href = url;

    });

    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var data = $(this).data('href');

        Swal.fire({
            title: 'Apakah anda Yakin?',
            text: "akan menghapus permohonan dengan NIK: " + data,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            $.ajax({
                type: "post",
                url: "<?= site_url('verifikasi_wp/hapus_verifikasi') ?>",
                data: {
                    wp_id: data
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {

                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }else{
                        Swal.fire(
                            'Gagal',
                            response.message,
                            'error'
                        )
                    }
                },
                error: function(xhr, thrownError) {
                    Swal(
                        'Permohonan Gagal dihapus!',
                        'error'
                    )
                }
            });

        })

    });


    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>