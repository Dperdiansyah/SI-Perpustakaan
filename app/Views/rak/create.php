<?= $this->extend('layouts/master'); ?>
 
<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card untuk Form Tambah Rak -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Rak Buku</h3>
                    </div>
                    <div class="card-body">
                        <?php if (session()->get('validation')): ?>
                            <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                <?php foreach (session()->get('validation') as $error): ?>
                                    <p><?= $error ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Form untuk tambah rak -->
                        <form action="<?= base_url('racks/create'); ?>" method="POST">
                            <?= csrf_field(); ?> <!-- Untuk keamanan, menambahkan token CSRF -->

                            <div class="form-group">
                                <label for="rack_name">Nama Rak</label>
                                <input type="text" class="form-control" id="rack_name" name="rack_name" placeholder="Masukkan nama rak buku" value="<?= old('rack_name'); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Masukkan deskripsi rak buku"><?= old('description'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
