<!-- Content Wrapper. Contains page content -->

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Pendaftaran Objek Pajak Baru</h3>

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
            <form class="form-horizontal" name="sptpdForm" id="form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="text-danger"><b>DATA OP</b></p>
                            <hr>
                            <div class="form-group row">
                                <label class="control-label col-md-3">No. Registrasi Pendaftaran <font color="red">*</font></label>
                                <div class="col-md-6">
                                    <div class="input">
                                        <input class="form-control" name="no_register" id="no_register" value="<?= $no_register ?>" style="background-color:bisque;" required />
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <span style="vertical-align:middle; "><img src="<?= base_url('assets/images/reload.png') ?>" title="refresh spt" style="cursor:pointer; " id="btnRefresh"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3"><b>Jenis Pajak</b></label>
                                <div class="col-md-9">
                                    <div class="input state-disabled">
                                        <!-- <select name="input-jns_pajak" id="input-jns_pajak" class="form-control" onChange="getkegus(this.value);" required> -->
                                        <select name="input-jns_pajak" id="input-jns_pajak" class="form-control" required>
                                            <option value="" selected></option>
                                            <option value="1"> Hotel </option>
                                            <option value="2"> Restoran </option>
                                            <option value="3"> Hiburan </option>
                                            <option value="4"> Reklame </option>
                                            <option value="5"> Penerangan Jalan Non PLN</option>
                                            <option value="6"> Penerangan Jalan PLN </option>
                                            <option value="7"> Parkir </option>
                                            <option value="8"> Air Tanah </option>
                                            <!-- <option value="9"> Sarang Burung Walet </option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3"><b>Kegiatan Usaha</b></label>
                                <div class="col-md-9">
                                    <div class="input state-disabled">
                                        <select name="input-kegus" id="input-kegus" class="form-control" required>
                                            <option value="" selected></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Nama <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-nama" id="input-nama" value="" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Alamat <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <textarea class="form-control" name="input-alamat" id="input-alamat" rows="2" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Kecamatan <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input state-disabled">
                                        <select name="input-kecamatan" id="input-kecamatan" class="form-control" required>
                                            <option value="" selected></option>
                                            <?php foreach ($list_kecamatan as $row) : ?>
                                                <option value="<?= $row->camat_id . '|' . $row->camat_nama ?>"> <?= $row->camat_kode . ' | ' . $row->camat_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Kelurahan <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input state-disabled">
                                        <select class="form-control" name="input-kelurahan" id="input-kelurahan" required>
                                            <option value="" selected>- Silahkan pilih Kecamatan lebih dulu -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Kota</label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-kota" id="input-kota" value="Bekasi" readonly style="background-color:bisque;" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Kode Pos</label>
                                <div class="col-md-4">
                                    <div class="input">
                                        <input class="form-control" name="input-kode_pos" id="input-kode_pos" size='5' maxlength='5' value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">No. Telepon <font color="red">*</font></label>
                                <div class="col-md-4">
                                    <div class="input">
                                        <input class="form-control" name="input-no_telepon" id="input-no_telepon" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- LEFT END -- START RIGHT -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <p class="text-danger"><b>DATA WP</b></p>
                            <hr>
                            <div class="form-group row">
                                <label class="control-label col-md-3"><b>Jenis Wajib Pajak</b></label>
                                <div class="col-md-9">
                                    <!-- <div class="input state-disabled">
                                        <select name="input-jns_wajib_pajak" id="input-jns_wajib_pajak" class="form-control">
                                            <option value="2" selected> Badan Usaha</option>
                                            <option value="1"> Pribadi </option>
                                        </select>
                                    </div> -->
                                    <input type="hidden" class="form-control" name="input-jns_wajib_pajak" id="input-jns_wajib_pajak" value="<?= $data_wp->JNS_PEMILIK ?>" required />
                                    <input class="form-control" value="<?= $data_wp->nama_jenis_pemilik ?>" readonly style="background-color:bisque;"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Nama Pemilik <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-nama_pemilik" id="input-nama_pemilik" value="<?= $data_wp->NAMA ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Nomor KTP / NIB <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-nik_pemilik" id="input-nik_pemilik" value="<?= $data_wp->WP_ID ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Alamat email <font color="red">*</font></label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input type="email" class="form-control" name="input-email_pemilik" id="input-email_pemilik" value="<?= $data_wp->EMAIL ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">No. HP <font color="red">*</font></label>
                                <div class="col-md-4">
                                    <div class="input">
                                        <input class="form-control" name="input-no_hp" id="input-no_hp" value="<?= $data_wp->NO_HP ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Alamat Pemilik</label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <textarea class="form-control" name="input-alamat_pemilik" id="input-alamat_pemilik" rows="2" required><?= $data_wp->JALAN." Blok ".$data_wp->BLOK." RT ".$data_wp->RT." RW ".$data_wp->RW; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Kecamatan Pemilik </label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-kecamatan_pemilik" id="input-kecamatan_pemilik" value="<?= $data_wp->KECAMATAN ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Kelurahan Pemilik </label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-kelurahan_pemilik" id="input-kelurahan_pemilik" value="<?= $data_wp->KELURAHAN ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Kota Pemilik</label>
                                <div class="col-md-9">
                                    <div class="input">
                                        <input class="form-control" name="input-kota_pemilik" id="input-kota_pemilik" value="<?= $data_wp->KOTA ?>" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control datetimepicker-input input-tgl_form_kembali" name="input-tgl_form_kembali" id="input-tgl_form_kembali" value="<?= date('Y-m-d') ?>"/>
                            <input type="hidden" class="form-control datetimepicker-input input-tgl_bts_kirim" name="input-tgl_bts_kirim" id="input-tgl_bts_kirim" value="<?= date('Y-m-d') ?>"/>
                            <input type="hidden" class="form-control datetimepicker-input input-tgl_daftar" name="input-tgl_daftar" id="input-tgl_daftar" value="<?= date('Y-m-d') ?>"/>

                            <!-- <div class="form-group row">
                                <label class="control-label col-md-3">Tgl. Terima <font color="red">*</font></label>
                                <div class="input-group date col-md-4" id="tgl_form_kembali" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input input-tgl_form_kembali" name="input-tgl_form_kembali" id="input-tgl_form_kembali" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#tgl_form_kembali" />
                                    <div class="input-group-append" data-target="#tgl_form_kembali" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Tgl. Batas Kirim <font color="red">*</font></label>
                                <div class="input-group date col-md-4" id="tgl_bts_kirim" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input input-tgl_bts_kirim" name="input-tgl_bts_kirim" id="input-tgl_bts_kirim" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#tgl_bts_kirim" />
                                    <div class="input-group-append" data-target="#tgl_bts_kirim" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Tgl. Pendaftaran <font color="red">*</font></label>
                                <div class="input-group date col-md-4" id="tgl_daftar" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input input-tgl_daftar" name="input-tgl_daftar" id="input-tgl_daftar" maxlength="12" placeholder="yyyy-mm-dd" style="background-color:bisque;" data-target="#tgl_daftar" />
                                    <div class="input-group-append" data-target="#tgl_daftar" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- RIGHT END -->
                </div>
                <!-- DETIL WP  -->
                <div class="row detil-hotel" id='detil-hotel'>
                    <div class="col-md-12" style="text-align: center;">
                        <h5 style="text-align:left"> <b>Detil Objek Pajak Hotel</b></h5>
                        </hr>
                        <div class='row'>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless" id="invoiceItem">
                                        <thead>
                                            <tr>
                                                <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                                <th style="text-align:center">
                                                    Jenis Kamar
                                                </th>
                                                <th style="text-align:center">
                                                    Jumlah Kamar
                                                </th>
                                                <th style="text-align:center">
                                                    Tarif (Rp)
                                                </th>
                                                <th style="text-align:center">
                                                    Jumlah
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input class="itemRow" type="checkbox"></td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <select class="form-control form-control-sm" name="golongan_kamar[]" id="golongan_kamar_1" autofocus>
                                                                <option value="" disabled selected>-Pilih Jenis Kamar-</option>
                                                                <?php
                                                                foreach ($jenis_kamar as $jenis_kamar) :
                                                                ?>
                                                                    <option id="kamar"><?= $jenis_kamar->jenis_martel ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="jumlah_kamar_1" name="jumlah_kamar[]" style="text-align:right" required>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="tarif_kamar_1" name="tarif_kamar[]" style="text-align:right" required>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="jumlah_1" name="jumlah[]" style="text-align:right" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="text-right">
                                                <button class="btn btn-sm btn-danger delete" id="removeRows" type="button">Hapus</button>
                                                <button class="btn btn-sm btn-success" id="addRows" type="button">Tambah</button>
                                            </div>
                                        </tbody>
                                    </table>
                                    <hr class="divider">
                                    <table class="table table-sm table-borderless">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center"></th>
                                                <th style="text-align:center"></th>
                                                <th style="text-align:center"></th>
                                                <th style="text-align:center"></th>
                                                <th style="text-align:center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="totaljumlahkamar" class="col-sm col-form-label" style="text-align:right">Jumlah Kamar</label>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="totaljumlahkamar" name="totaljumlahkamar" style="text-align:right" onkeyup="calculateTotal()" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <label for="input-golongan_hotel" class="col-sm col-form-label" style="text-align:right"> Golongan Hotel <font color='red'>*</font></label>
                                                </td>
                                                <td>
                                                    <div class='form-group'>
                                                        <div class='col-md-12'>
                                                            <div class='input state-disabled'>
                                                                <select name='input-golongan_hotel' id='input-golongan_hotel' class='form-control' required>
                                                                    <option value='' selected></option>
                                                                    <?php
                                                                    foreach ($golongan_hotel as $golongan_hotel) :
                                                                    ?>
                                                                        <option id="kamar" value="<?= $golongan_hotel->ref_kode ?>"><?= $golongan_hotel->ref_nama ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DETIL HOTEL -->
                <!-- Input Detil Resto  -->


                <div class="row detil-resto" id='detil-resto'>
                    <div class="col-md-12" style="text-align: center;">
                        <h5 style="text-align:left"> <b>Detil Objek Pajak Restoran</b></h5>
                        </hr>
                        <div class='row'>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless" id="invoiceItem">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">
                                                    Jumlah Meja
                                                </th>
                                                <th style="text-align:center">
                                                    Jumlah Kursi
                                                </th>
                                                <th style="text-align:center">
                                                    Kapasitas pengunjung
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="jml_meja" name="jml_meja" style="text-align:right" autofocus required>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="jml_kursi" name="jml_kursi" style="text-align:right" required>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="kapasitas_pengunjung" name="kapasitas_pengunjung" style="text-align:right" required>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="jml_karyawan" class="col-sm col-form-label" style="text-align:left">Jumlah Karyawan</label>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control form-control-sm" id="jml_karyawan" name="jml_karyawan" style="text-align:right">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <label for="input-jns_restoran" class="col-sm col-form-label" style="text-align:left"> Jenis Restoran <font color='red'>*</font></label>
                                                    <div class='form-group'>
                                                        <div class='col-md-12'>
                                                            <div class='input state-disabled'>
                                                                <select name="input-jns_restoran" id="input-jns_restoran" class="form-control">
                                                                    <option value="0" selected> Rumah Makan & Catering</option>
                                                                    <option value="1"> Rumah Makan </option>
                                                                    <option value="2"> Catering </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DETIL RESTO -->

                <!-- Detil Op Parkir -->
                <div class="row detil-parkir" id='detil-parkir'>
                    <div class="col-md-12" style="text-align: center;">
                        <h5 style="text-align:left"> <b>Detil Objek Pajak Parkir</b></h5>
                        </hr>
                        <div class='row'>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" id="invoiceItem">
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align:center">
                                                    Kapasitas / Daya Tampung
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Mobil</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" id="kap_mobil" name="kap_mobil" value="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Motor</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" id="kap_motor" name="kap_motor" value="0">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" id="invoiceItem">
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align:center">
                                                    Tarif
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Jam Pertama</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" id="tarif_pertama" name="tarif_pertama" value="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tiap Jam Berikut</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" id="tarif_selanjutnya" name="tarif_selanjutnya" value="0">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DETIL PARKIR -->

                <!-- Detil Op Hiburan -->
                <div class="row detil-hiburan" id='detil-hiburan'>
                    <div class="col-md-12" style="text-align: center;">
                        <h5 style="text-align:left"> <b>Detil Objek Pajak Hiburan</b></h5>
                        </hr>
                        <div class='row'>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="jenis_hiburan" class="col-sm-2 col-form-label">Jenis Hiburan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jenis_hiburan" name="jenis_hiburan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sifat_pertunjukan" class="col-sm-2 col-form-label">Sifat Pertunjukan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sifat_pertunjukan" id="inlineRadio1" value="1" checked>
                                        <label class="form-check-label" for="inlineRadio1">Rutin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sifat_pertunjukan" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Insidentil</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jam" class="col-sm-2 col-form-label">Jam Pertunjukan</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control" id="jam" name="jam">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DETIL Hiburan -->
                <hr class="divider">
                <!-- END DETIL WP -->

                <div class=" col-md-12">
                    <div class="card-footer">
                        <!-- <button type="reset" class="btn btn-secondary back">Batal</button> -->
                        <input type="submit" name="submit" class="btn btn-info  btn-block" id="btnSave" onclick="save()" value="Simpan"></input>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<script type="text/javascript">
    $("#detil-hotel").hide();
    $("#detil-resto").hide();
    $("#detil-parkir").hide();
    $("#detil-hiburan").hide();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    var date = new Date();
    var day = date.getDate();

    $('#tgl_daftar, #tgl_bts_kirim, #tgl_form_kembali ').datetimepicker({
        timepicker: false,
        format: 'YYYY-MM-DD'
    });
    $('#input-tgl_daftar, #input-tgl_form_kembali').val("<?= date('Y-m-d') ?>");
    $('#input-tgl_bts_kirim').val("<?php echo date("Y-m-d", strtotime(date('Y-m-d') . "+7 day")) ?>");

    $("#dialog").dialog({
        autoOpen: false,
        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        }
    });

    $("#opener").on("click", function() {
        $("#dialog").dialog("open");
    });

    $(document).ready(function() {

        $('#input-jns_pajak').on('change', function(e) {

            let val = this.value;

            if (val == '1') {
                e.preventDefault();
                $("#detil-hotel").show();
                $("#detil-resto").hide();
                $("#detil-parkir").hide();
                $("#detil-hiburan").hide();
            } else if (val == '2') {
                e.preventDefault();
                $("#detil-resto").show();
                $("#detil-hotel").hide();
                $("#detil-parkir").hide();
                $("#detil-hiburan").hide();
            } else if(val == '7'){
                e.preventDefault();
                $("#detil-parkir").show();
                $("#detil-hotel").hide();
                $("#detil-resto").hide();
                $("#detil-hiburan").hide();
            } else if(val == '3'){
                e.preventDefault();
                $("#detil-parkir").hide();
                $("#detil-hotel").hide();
                $("#detil-resto").hide();
                $("#detil-hiburan").show();
            } else {
                e.preventDefault();
                $("#detil-parkir").hide();
                $("#detil-hotel").hide();
                $("#detil-resto").hide();
                $("#detil-hiburan").hide();
            }

            $.ajax({
                type: "POST",
                url: "<?= site_url('pendaftaran_op/get_kegus') ?>",
                data: {
                    "pajakid": val
                },
                success: function(response) {
                    $('#input-kegus').html(response);
                }
            });

        });

        $('#input-kecamatan').on('change', function(e) {
            e.preventDefault();
            let val = this.value;
            $.ajax({
                type: "POST",
                url: "<?= site_url('pendaftaran_op/get_kelurahan') ?>",
                data: {
                    "kdkec": val
                },
                success: function(response) {
                    $('#input-kelurahan').html(response);
                }
            });
        });
    });

    // DETIL HOTEL
    $(document).ready(function() {
        $(document).on("click", "#checkAll", function() {
            $(".itemRow").prop("checked", this.checked);
        });
        $(document).on("click", ".itemRow", function() {
            if ($(".itemRow:checked").length == $(".itemRow").length) {
                $("#checkAll").prop("checked", true);
            } else {
                $("#checkAll").prop("checked", false);
            }
        });
        var count = $(".itemRow").length;
        const kamar = document.getElementById('golongan_kamar_1').innerHTML;

        $(document).on("click", "#addRows", function() {

            count++;
            var htmlRows = "";
            htmlRows += "<tr>";
            htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
            htmlRows +=
                '<td><div class="form-group"><div class="col-sm-12"> <select class="form-control form-control-sm" name="golongan_kamar[]" id="golongan_kamar_' + count + '"><option value="" disabled selected>' + kamar + '</option></select></div></div></td>';
            htmlRows +=
                '<td><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control form-control-sm" id="jumlah_kamar_' + count + '" name="jumlah_kamar[]" style="text-align:right" required></div></div></td>';
            htmlRows +=
                '<td><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control form-control-sm" id="tarif_kamar_' + count + '" name="tarif_kamar[]" style="text-align:right" required></div></div></td>';
            htmlRows +=
                '<td><div class="form-group"><div class="col-sm-12"><input type="text" class="form-control form-control-sm" id="jumlah_' + count + '" name="jumlah[]" style="text-align:right" readonly></div></div></td>';
            htmlRows += "</tr>";
            $("#invoiceItem").append(htmlRows);
        });
        $(document).on("click", "#removeRows", function() {
            $(".itemRow:checked").each(function() {
                $(this).closest("tr").remove();
            });
            $("#checkAll").prop("checked", false);
            calculateTotal();
        });
        $(document).on("keyup", "[id^=jumlah_kamar_]", function() {
            calculateTotal();
        });
        $(document).on("keyup", "[id^=tarif_kamar_]", function() {
            calculateTotal();
        });
    });


    $(document).ready(function() {
        $("#btnRefresh").click(function() {
            $.ajax({
                type: "POST",
                url: "<?= site_url('pendaftaran_op/get_next_number_wp') ?>",
                dataType: "JSON",
                cache: false,
                success: function(data) {
                    console.log(data);
                    $('#no_register').val(data);
                }
            });
        });


    });

    var isSaving = false; // Global flag

    function save() {
        if (isSaving) return false; // Cegah dobel klik

        // Validasi manual sebelum kirim
        if ($('#input-nama').val() == '') {
            alert('nama tidak boleh null');
            return false;
        }
        if ($('#input-nik').val() == '') {
            alert('nik tidak boleh null');
            return false;
        }
        if ($('#input-email_pemilik').val() == '') {
            alert('email tidak boleh null');
            return false;
        }
        if ($('#input-no_hp').val() == '') {
            alert('no hp tidak boleh null');
            return false;
        }

        // Set status "sedang menyimpan"
        isSaving = true;

        // Ubah tombol jadi loading & disable
        $('#btnSave')
            .html('<i class="fa fa-spinner fa-spin"></i> Saving...')
            .attr('disabled', true);

        var url = "<?php echo site_url('pendaftaran_op/insert_data') ?>";
        var formdata = new FormData($('#form')[0]);

        $.ajax({
            url: url,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                isSaving = false; // reset flag
                $('#btnSave')
                    .html('Save')
                    .attr('disabled', false);

                if (data.status == true) {
                    Swal.fire({
                        title: 'Save!',
                        text: 'Pendaftaran Objek Pajak Berhasil',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        showConfirmButton: true
                    }).then((result) => {
                        window.location.assign("<?php echo site_url('esptpd_devel') ?>");
                    });

                } else if (data.error == true) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.msg,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        showConfirmButton: false,
                        timer: 1500
                    });

                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                isSaving = false; // reset flag
                $('#btnSave')
                    .html('Save')
                    .attr('disabled', false);

                console.log(jqXHR);
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
            }
        });
    }

    function calculateTotal() {
        var totalAmount = 0;
        var totalkamar = 0;
        $("[id^='tarif_kamar_']").each(function() {
            var id = $(this).attr("id");
            id = id.replace("tarif_kamar_", "");
            var tarif_kamar = $("#tarif_kamar_" + id).val();
            var jumlah_kamar = $("#jumlah_kamar_" + id).val();
            if (!jumlah_kamar) {
                jumlah_kamar = 1;
            }
            var total = tarif_kamar * jumlah_kamar;
            $("#jumlah_" + id).val(parseInt(total));
            totalAmount += total;
            totalkamar += parseInt(jumlah_kamar);
        });
        $('#totaljumlahkamar').val(parseInt(totalkamar));
    }
</script>