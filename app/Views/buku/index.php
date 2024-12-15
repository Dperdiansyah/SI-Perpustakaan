<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Buku</h3>
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
                <a href="<?= base_url('books/new'); ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus m-1"></i>Tambah Buku</a>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Rak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php if ($book['photo']): ?>
                                            <img src="<?= base_url('uploads/' . $book['photo']); ?>" alt="Foto Buku" class="img-fluid" width="50">
                                        <?php else: ?>
                                            <p>Tidak ada gambar</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $book['title']; ?></td>
                                    <td><?= $book['author']; ?></td>
                                    <td><?= $book['category_name']; ?></td>
                                    <td><?= $book['stock']; ?></td>
                                    <td><?= $book['rack_name']; ?></td>
                                    <td>
                                        <a href="<?= base_url('books/detail/' . $book['id_book']); ?>" class="btn btn-info btn-sm">Detail</a>
                                        <a href="<?= base_url('books/edit/' . $book['id_book']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                        
                                        <!-- Form Delete dengan CSRF -->
                                        <form action="<?= base_url('books/delete/' . $book['id_book']); ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
