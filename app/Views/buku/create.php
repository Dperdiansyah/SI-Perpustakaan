<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Buku</h3>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan Pesan Validasi jika ada kesalahan input -->
                        <?php if (session()->get('validation')): ?>
                            <div class="alert alert-danger">
                                <?php foreach (session()->get('validation') as $error): ?>
                                    <p><?= $error ?></p> <!-- Menampilkan setiap pesan error -->
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Form untuk menambah buku -->
                        <form action="<?= base_url('books/create'); ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?> <!-- Token CSRF untuk keamanan -->

                            <!-- Input Judul Buku -->
                            <div class="form-group">
                                <label for="title">Judul Buku</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul buku" value="<?= old('title'); ?>" required>
                            </div>

                            <!-- Input Penulis -->
                            <div class="form-group">
                                <label for="author">Penulis</label>
                                <input type="text" name="author" id="author" class="form-control" placeholder="Masukkan penulis buku" value="<?= old('author'); ?>" required>
                            </div>

                            <!-- Input Penerbit -->
                            <div class="form-group">
                                <label for="publisher">Penerbit</label>
                                <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Masukkan penerbit buku" value="<?= old('publisher'); ?>" required>
                            </div>

                            <!-- Input Tahun Terbit -->
                            <div class="form-group">
                                <label for="publication_year">Tahun Terbit</label>
                                <input type="number" name="publication_year" id="publication_year" class="form-control" placeholder="Masukkan tahun terbit buku" value="<?= old('publication_year'); ?>" required>
                            </div>

                            <!-- Pilih Kategori Buku -->
                            <div class="form-group">
                                <label for="category_id">Kategori Buku</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id_category']; ?>" <?= old('category_id') == $category['id_category'] ? 'selected' : ''; ?>>
                                            <?= $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Pilih Rak Buku -->
                            <div class="form-group">
                                <label for="rack_id">Rak Buku</label>
                                <select name="rack_id" id="rack_id" class="form-control" required>
                                    <option value="">Pilih Rak</option>
                                    <?php foreach ($racks as $rack): ?>
                                        <option value="<?= $rack['id_rack']; ?>" <?= old('rack_id') == $rack['id_rack'] ? 'selected' : ''; ?>>
                                            <?= $rack['rack_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Input Nomor ISBN -->
                            <div class="form-group">
                                <label for="isbn">Nomor ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Masukkan nomor ISBN" value="<?= old('isbn'); ?>">
                            </div>

                            <!-- Input Jumlah Buku -->
                            <div class="form-group">
                                <label for="stock">Jumlah Buku</label>
                                <input type="number" name="stock" id="stock" class="form-control" placeholder="Masukkan jumlah buku" value="<?= old('stock'); ?>" required>
                            </div>

                            <!-- Input Deskripsi Buku -->
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi buku"><?= old('description'); ?></textarea>
                            </div>

                            <!-- Input Foto Buku (Opsional) -->
                            <div class="form-group">
                                <label for="photo">Foto Buku (Opsional)</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>

                            <!-- Tombol Submit dan Batal -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                                <a href="<?= base_url('books'); ?>" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
