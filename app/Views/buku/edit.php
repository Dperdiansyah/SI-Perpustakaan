<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Buku</h3>
            </div>
            <div class="card-body">
                <!-- Form untuk mengupdate data buku -->
                <form action="<?= base_url('books/update/' . $book['id_book']); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); // Menambahkan token CSRF untuk keamanan form ?>

                    <!-- Input untuk Judul Buku -->
                    <div class="form-group">
                        <label for="title">Judul Buku</label>
                        <input type="text" name="title" id="title" class="form-control <?= (isset($validation['title'])) ? 'is-invalid' : ''; ?>" value="<?= old('title', $book['title']); ?>">
                        <div class="invalid-feedback">
                            <?= isset($validation['title']) ? $validation['title'] : ''; ?> <!-- Menampilkan pesan error jika ada -->
                        </div>
                    </div>

                    <!-- Input untuk Penulis Buku -->
                    <div class="form-group">
                        <label for="author">Penulis</label>
                        <input type="text" name="author" id="author" class="form-control <?= (isset($validation['author'])) ? 'is-invalid' : ''; ?>" value="<?= old('author', $book['author']); ?>">
                        <div class="invalid-feedback">
                            <?= isset($validation['author']) ? $validation['author'] : ''; ?>
                        </div>
                    </div>

                    <!-- Dropdown untuk memilih kategori buku -->
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control <?= (isset($validation['category_id'])) ? 'is-invalid' : ''; ?>">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($categories as $category): ?>
                                <!-- Memilih kategori yang sesuai dengan data yang ada -->
                                <option value="<?= $category['id_category']; ?>" <?= ($category['id_category'] == old('category_id', $book['category_id'])) ? 'selected' : ''; ?>><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= isset($validation['category_id']) ? $validation['category_id'] : ''; ?>
                        </div>
                    </div>

                    <!-- Dropdown untuk memilih rak buku -->
                    <div class="form-group">
                        <label for="rack_id">Rak</label>
                        <select name="rack_id" id="rack_id" class="form-control <?= (isset($validation['rack_id'])) ? 'is-invalid' : ''; ?>">
                            <option value="">-- Pilih Rak --</option>
                            <?php foreach ($racks as $rack): ?>
                                <!-- Memilih rak yang sesuai dengan data yang ada -->
                                <option value="<?= $rack['id_rack']; ?>" <?= ($rack['id_rack'] == old('rack_id', $book['rack_id'])) ? 'selected' : ''; ?>><?= $rack['rack_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= isset($validation['rack_id']) ? $validation['rack_id'] : ''; ?>
                        </div>
                    </div>

                    <!-- Input untuk Stok Buku -->
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" name="stock" id="stock" class="form-control <?= (isset($validation['stock'])) ? 'is-invalid' : ''; ?>" value="<?= old('stock', $book['stock']); ?>">
                        <div class="invalid-feedback">
                            <?= isset($validation['stock']) ? $validation['stock'] : ''; ?>
                        </div>
                    </div>

                    <!-- Input untuk foto buku -->
                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <?php if ($book['photo']): ?>
                            <!-- Menampilkan gambar buku jika ada -->
                            <div class="mb-3">
                                <img src="<?= base_url('uploads/' . $book['photo']); ?>" alt="Foto Buku" width="100">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="photo" id="photo" class="form-control <?= (isset($validation['photo'])) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= isset($validation['photo']) ? $validation['photo'] : ''; ?>
                        </div>
                    </div>

                    <!-- Tombol untuk menyimpan perubahan -->
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>

                    <!-- Tombol untuk kembali ke halaman sebelumnya -->
                    <a href="<?= base_url('books'); ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
