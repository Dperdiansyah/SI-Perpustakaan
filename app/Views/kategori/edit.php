<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card untuk Form Edit Kategori -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Kategori Buku</h3>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan Notifikasi jika ada pesan -->
                        <?php if (session()->get('validation')): ?>
                            <div class="alert alert-danger">
                                <?php foreach (session()->get('validation') as $error): ?>
                                    <p><?= $error ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form Edit Kategori -->
                        <form action="<?= base_url('categories/update/' . $category['id_category']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama kategori" value="<?= old('name', $category['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi kategori"><?= old('description', $category['description']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
