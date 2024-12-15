<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Card untuk menampilkan detail peminjaman -->
        <div class="card shadow-sm border-0">
            
            <!-- Header Card: Menampilkan judul halaman -->
            <div class="card-header">
                <h3 class="card-title"><?= $page_title; ?></h3>
            </div>

            <div class="card-body">
                <!-- Menampilkan pesan flash jika ada (misalnya, pesan berhasil atau gagal) -->
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <!-- Tabel Detail Peminjaman -->
                <table class="table table-striped table-bordered">
                    <tbody>
                        <!-- Menampilkan informasi peminjaman secara rinci -->
                        <tr>
                            <th>Nama Peminjam</th>
                            <td><?= $borrowing['user_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Role Peminjam</th>
                            <td><?= $borrowing['user_role']; ?></td>
                        </tr>
                        <tr>
                            <th>Judul Buku</th>
                            <td><?= $borrowing['book_title']; ?></td>
                        </tr>
                        <tr>
                            <th>Kategori Buku</th>
                            <td><?= $borrowing['category_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Rak Buku</th>
                            <td><?= $borrowing['rack_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <td><?= $borrowing['borrow_date']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kembali</th>
                            <td><?= $borrowing['return_date'] ?: 'Belum dikembalikan'; ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol Aksi untuk Setujui Peminjaman dan Kembali ke Daftar Peminjaman -->
                <div class="row mt-2">
                    <!-- Tombol Setujui Peminjaman -->
                    <div class="col-md-6 mb-3">
                        <form action="<?= base_url('borrowings/approve/' . $borrowing['id_borrowing']); ?>" method="POST">
                            <button type="submit" class="btn btn-success btn-lg btn-block shadow-sm" style="font-size: 18px; padding: 12px 24px; border-radius: 5px;">
                                Setujui Peminjaman
                            </button>
                        </form>
                    </div>

                    <!-- Tombol Kembali ke Daftar Peminjaman -->
                    <div class="col-md-6 mb-3">
                        <a href="<?= base_url('borrowings'); ?>" class="btn btn-secondary btn-lg btn-block shadow-sm" style="font-size: 18px; padding: 12px 24px; border-radius: 5px;">
                            Kembali ke Daftar Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
