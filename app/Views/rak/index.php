<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Card untuk Daftar Rak Buku -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Rak Buku</h3>
                <!-- Pesan Notifikasi -->
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> <?= session()->getFlashdata('message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> <?= session()->getFlashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <div class="card-body">
                <a href="<?= base_url('racks/new'); ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus m-1"></i>Tambah Rak Buku</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Rak</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($racks as $rack): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $rack['rack_name']; ?></td>
                                <td><?= $rack['description']; ?></td>
                                <td>
                                    <a href="<?= base_url('racks/edit/' . $rack['id_rack']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('racks/delete/' . $rack['id_rack']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus rak ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
