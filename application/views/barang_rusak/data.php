<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Aset Rusak
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('barangrusak/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Aset Rusak
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
                    <th>Tanggal Rusak</th>
                    <th>Nama Aset</th>
                    <th>Jumlah Rusak</th>
                    <th>User Input</th>
                    <th>Keterangan</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($barangrusak) :
                    foreach ($barangrusak as $br) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <!-- <td><?= $br['id_barang_rusak']; ?></td> -->
                            <td><?= $br['tanggal_rusak']; ?></td>
                            <td><?= $br['nama_barang']; ?></td>
                            <td><?= $br['jumlah_rusak'] . ' ' . $br['nama_satuan']; ?></td>
                            <td><?= $br['nama']; ?></td>
                            <td><?= $br['keterangan']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barangrusak/delete/') . $br['id_barang_rusak'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>