<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Aset Kembali
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('barangkembali/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Aset Kembali
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <!-- <th>No Transaksi</th> -->
                    <th>Tanggal Kembali</th>
                    <th>Nama Aset</th>
                    <th>Pemilik</th>
                    <th>Jumlah Kembali</th>
                    <th>User Input</th>
                    <!-- <th>Keterangan</th> -->
                    <th>Nama Peminjam</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($barangkembali) :
                    foreach ($barangkembali as $bb) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <!-- <td><?= $bb['id_barang_masuk']; ?></td> -->
                            <td><?= $bb['tanggal_masuk']; ?></td>
                            <td><?= $bb['nama_barang']; ?></td>
                            <td><?= $bb['nama_supplier']; ?></td>
                            <td><?= $bb['jumlah_masuk'] . ' ' . $bb['nama_satuan']; ?></td>
                            <td><?= $bb['nama']; ?></td>
                            <!-- <td><?= $bb['keterangan']; ?></td> -->
                            <td><?= $bb['nama_karyawan']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barangkembali/delete/') . $bb['id_barang_kembali'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>