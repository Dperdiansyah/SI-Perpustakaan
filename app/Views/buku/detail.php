<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card untuk Detail Buku -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $page_title ?></h3>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan Notifikasi jika ada pesan -->
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

                        <!-- Menampilkan detail buku -->
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label">Judul Buku</label>
                            <div class="col-md-8">
                                <p><?= $book['title']; ?></p> <!-- Menampilkan Judul Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label">Penulis</label>
                            <div class="col-md-8">
                                <p><?= $book['author']; ?></p> <!-- Menampilkan Penulis Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="publisher" class="col-md-4 col-form-label">Penerbit</label>
                            <div class="col-md-8">
                                <p><?= $book['publisher']; ?></p> <!-- Menampilkan Penerbit Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="publication_year" class="col-md-4 col-form-label">Tahun Terbit</label>
                            <div class="col-md-8">
                                <p><?= $book['publication_year']; ?></p> <!-- Menampilkan Tahun Terbit -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label">Kategori Buku</label>
                            <div class="col-md-8">
                                <p><?= $book['category_name']; ?></p> <!-- Menampilkan Kategori Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rack_id" class="col-md-4 col-form-label">Rak Buku</label>
                            <div class="col-md-8">
                                <p><?= $book['rack_name']; ?></p> <!-- Menampilkan Rak Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="isbn" class="col-md-4 col-form-label">Nomor ISBN</label>
                            <div class="col-md-8">
                                <p><?= $book['isbn']; ?></p> <!-- Menampilkan ISBN Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label">Jumlah Buku</label>
                            <div class="col-md-8">
                                <p><?= $book['stock']; ?></p> <!-- Menampilkan Stok Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label">Deskripsi</label>
                            <div class="col-md-8">
                                <p><?= $book['description']; ?></p> <!-- Menampilkan Deskripsi Buku -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label">Foto Buku</label>
                            <div class="col-md-8">
                                <!-- Menampilkan foto buku jika ada -->
                                <?php if ($book['photo']): ?>
                                    <img src="<?= base_url('uploads/' . $book['photo']); ?>" alt="Foto Buku" class="img-fluid" width="200">
                                <?php else: ?>
                                    <p>Foto tidak tersedia.</p> <!-- Menampilkan pesan jika foto tidak ada -->
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Tombol Kembali -->
                        <div class="form-group">
                            <a href="<?= base_url('books'); ?>" class="btn btn-secondary">Kembali</a> <!-- Tombol untuk kembali ke halaman daftar buku -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
