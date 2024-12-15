<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card untuk Form Edit Rak -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Rak Buku</h3>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan notifikasi jika ada pesan -->
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

                        <!-- Form Edit Rak -->
                        <form action="<?= base_url('racks/update/' . $rack['id_rack']); ?>" method="post">
                            <?= csrf_field(); ?>

                            <div class="form-group">
                                <label for="rack_name">Nama Rak</label>
                                <input type="text" name="rack_name" id="rack_name" class="form-control" placeholder="Masukkan nama rak" value="<?= old('rack_name', $rack['rack_name']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi rak"><?= old('description', $rack['description']); ?></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="<?= base_url('racks'); ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
