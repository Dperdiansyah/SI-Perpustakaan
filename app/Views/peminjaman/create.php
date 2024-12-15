<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Peminjaman</h3>
            </div>
            <div class="card-body">
                <!-- Menampilkan pesan validasi error jika ada -->
                <?php if (session()->get('validation')): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- Menampilkan semua error yang ada -->
                        <?php foreach (session()->get('validation') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Form untuk menambah peminjaman -->
                <form action="<?= base_url('borrowings/create'); ?>" method="post">
                    <?= csrf_field(); ?>

                    <!-- Dropdown untuk memilih Buku -->
                    <div class="form-group">
                        <label for="book_id">Judul Buku</label>
                        <select name="book_id" id="book_id" class="form-control" required>
                            <option value="">Pilih Buku</option>
                            <!-- Menampilkan daftar buku yang memiliki stok lebih dari 0 -->
                            <?php foreach ($books as $book): ?>
                                <?php if ($book['stock'] > 0): ?>
                                    <option value="<?= $book['id_book']; ?>"><?= $book['title']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Dropdown untuk memilih Peminjam -->
                    <div class="form-group">
                        <label for="user_id">Nama Peminjam</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Pilih Peminjam</option>
                            <!-- Menampilkan daftar pengguna yang dapat meminjam -->
                            <?php foreach ($user as $user): ?>
                                <option value="<?= $user['id_user']; ?>"><?= $user['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Input untuk Tanggal Pinjam -->
                    <div class="form-group">
                        <label for="borrow_date">Tanggal Pinjam</label>
                        <input type="date" name="borrow_date" id="borrow_date" class="form-control" required>
                    </div>

                    <!-- Input untuk Tanggal Kembali -->
                    <div class="form-group">
                        <label for="return_date">Tanggal Kembali</label>
                        <input type="date" name="return_date" id="return_date" class="form-control" required>
                    </div>

                    <!-- Tombol untuk submit form -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <!-- Tombol untuk kembali ke daftar peminjaman -->
                        <a href="<?= base_url('borrowings'); ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
