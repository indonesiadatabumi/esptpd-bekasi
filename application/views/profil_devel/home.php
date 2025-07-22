        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col">
            <div class="card mb-3 shadow" style="max-width: 540px;">
              <div class="row g-0">
                  <div class="col-md-8">
                      <div class="card-body">
                        <?php if (!empty($notif)): ?>
                          <div class="alert alert-success"><?= $notif; ?></div>
                        <?php endif; ?>
                          <h5 class="card-text">Profil User</h5>
                          <p class="card-text">Username: <?= $this->session->userdata['username']; ?></p>
                          <p class="card-text">Nama Lengkap: <?= $this->session->userdata['full_name']; ?></p>
                          <!-- <p class="card-text">Email: <?= $this->session->userdata['email']; ?></p> -->
                          <div class="row">
                              <!-- <div class="col">
                                  <a href="<?= base_url(); ?>profil/editprofil">Edit Foto</a>
                              </div> -->
                              <!-- <div class="col">
                                  <a href="<?= base_url(); ?>profil_devel/editnik">Edit Profil</a>
                              </div> -->
                              <div class="col-ms">
                                  <a href="<?= base_url(); ?>profil_devel/changepassword">Ganti Password</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
