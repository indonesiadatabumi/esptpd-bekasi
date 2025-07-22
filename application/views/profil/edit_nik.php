        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow card-outline card-primary">
                    <div class="card-header">
                        <a class="btn btn-sm btn-secondary" href="<?= base_url(); ?>/profil">
                            <i class="fa fa-backward"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>/profil/update_nik" method="post">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $this->session->userdata['id_wp_wr']; ?>">  
                            <div class="form-group">
                                <label for="wp_wr_nik">NIK</label>
                                <input type="text" class="form-control" id="wp_wr_nik" name="wp_wr_nik">
                            </div>
                            <div class="form-group">
                                <label for="wp_wr_nib">NIB</label>
                                <input type="text" class="form-control" id="wp_wr_nib" name="wp_wr_nib">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->