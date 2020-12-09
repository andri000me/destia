<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Form Cetak Laporan
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="transaksi">Laporan Transaksi</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input value="barang_masuk" type="radio" id="barang_masuk" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="barang_masuk">Aset Masuk</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="barang_keluar" type="radio" id="barang_keluar" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="barang_keluar">Aset Dipinjam</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="barang_rusak" type="radio" id="barang_rusak" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="barang_rusak">Aset Rusak</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="barang_kembali" type="radio" id="barang_kembali" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="barang_kembali">Aset Kembali</label>
                        </div>
                        <?= form_error('transaksi', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-3 text-lg-right" for="tanggal">Tanggal</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="text" class="form-control" placeholder="Periode Tanggal">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-9 offset-lg-3">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-print"></i>
                            </span>
                            <span class="text">
                                Cetak
                            </span>
                        </button>
                    </div>
                </div>
                <small style="color:red">*Saat akan save nanti, gunakan ektensi file (.pdf) di akhir nama file</small>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

