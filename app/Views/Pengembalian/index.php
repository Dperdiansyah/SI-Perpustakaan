<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Card untuk menampilkan daftar peminjaman -->
        <div class="card">
            
            <!-- Header Card: Menampilkan judul halaman dan pesan notifikasi -->
            <div class="card-header">
                <h3 class="card-title">Daftar Peminjaman</h3>

                <!-- Pesan notifikasi jika ada -->
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
                <!-- Tabel Daftar Peminjaman -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan setiap data peminjaman -->
                        <?php $no = 1; foreach ($borrowings as $borrowing): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $borrowing['book_title']; ?></td>
                                <td><?= $borrowing['user_name']; ?></td>
                                <td><?= $borrowing['borrow_date']; ?></td>
                                <td><?= $borrowing['return_date'] ?: '-'; ?></td>
                                
                                <!-- Tampilkan denda jika ada, format mata uang -->
                                <td style="text-align: center;">
                                    <?= $borrowing['penalty'] > 0 ? "Rp. " . number_format($borrowing['penalty'], 0, ',', '.') : "-"; ?>
                                </td>
                                
                                <td><?= ucfirst($borrowing['status']); ?></td>

                                <!-- Tombol untuk mengecek pengembalian buku -->
                                <td>
                                    <a href="<?= base_url('borrowings/check-return/' . $borrowing['id_borrowing']); ?>" class="btn btn-info btn-sm">Kembalikan</a>
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
