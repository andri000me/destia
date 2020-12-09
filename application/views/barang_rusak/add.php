<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Input Aset Rusak
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('barangrusak') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['id_barang_rusak' => $id_barang_rusak, 'user_id' => $this->session->userdata('login_session')['user']]); ?>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_barang_rusak">ID Transaksi Aset Rusak</label>
                    <div class="col-md-4">
                        <input value="<?= $id_barang_rusak; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_barang_rusak', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggal_rusak">Tanggal Rusak</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('tanggal_rusak', date('Y-m-d')); ?>" name="tanggal_rusak" id="tanggal_rusak" type="text" class="form-control date" placeholder="Tanggal Rusak...">
                        <?= form_error('tanggal_rusak', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="barang_id">Aset</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="barang_id" id="barang_id" class="custom-select">
                                <option value="" selected disabled>Pilih Aset</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b['id_barang'] ?>"><?= $b['id_barang'] . ' | ' . $b['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('barang/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="stok">Stok</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="stok" type="number" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_rusak">Jumlah Rusak</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('jumlah_rusak'); ?>" name="jumlah_rusak" id="jumlah_rusak" type="number" class="form-control" placeholder="Jumlah Rusak...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_rusak', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="total_stok">Total Stok</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="total_stok" type="number" class="form-control">
                    </div>
                </div> -->
                <div class="row form-group">
                <label class="col-md-4 text-md-right" for="keterangan">Keterangan</label>
                    <div class="col-md-5">
                        <textarea value="<?= set_value('keterangan'); ?>" name="keterangan" id="keterangan" type="desc" class="form-control" required>
                        <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col offset-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>