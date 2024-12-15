<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 offset-md-0">
                <!-- Card untuk Form Tambah Kategori -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kategori Buku</h3>
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
                    
                        <!-- Form Tambah Kategori -->
                        <form action="<?= base_url('categories/create'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama kategori" value="<?= old('name'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi kategori"><?= old('description'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('categories'); ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
