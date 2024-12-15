<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjaman</h3>
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
            </div>
            <div class="card-body">
                <!-- Tombol untuk menambah peminjaman baru -->
                <a href="<?= base_url('borrowings/new'); ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus m-1"></i>Tambah Peminjam</a>
                
                <!-- Tabel Daftar Peminjaman -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Looping untuk menampilkan data peminjaman -->
                        <?php $no = 1; foreach ($borrowings as $borrowing): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $borrowing['book_title']; ?></td>
                                <td><?= $borrowing['user_name']; ?></td>
                                <td><?= $borrowing['borrow_date']; ?></td>
                                <td><?= $borrowing['return_date'] ?: '-'; ?></td> <!-- Tanggal kembali, jika tidak ada tampilkan tanda '-' -->
                                <td><?= ucfirst($borrowing['status']); ?></td> <!-- Mengubah status menjadi kapital awal -->
                                <td>
                                    <!-- Tombol Aksi untuk melihat detail peminjaman -->
                                    <a href="<?= base_url('borrowings/detail/' . $borrowing['id_borrowing']); ?>" class="btn btn-success btn-sm">Setujui</a>
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
