<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengecekan Pengembalian Buku</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td><strong>Nama Peminjam:</strong></td>
                        <td><?= $borrowing['name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Judul Buku:</strong></td>
                        <td><?= $borrowing['title']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Pinjam:</strong></td>
                        <td><?= $borrowing['borrow_date']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Kembali:</strong></td>
                        <td><?= $borrowing['return_date'] ?: 'Belum dikembalikan'; ?></td>
                    </tr>
                    <tr>
                        <tr>
                        <td><strong>Denda:</strong></td>
                        <td>
                        <?= $penalty > 0 ? "Rp. " . number_format($penalty, 0, ',', '.') : "Tidak ada denda"; ?>
                        </td>
                    </tr>

                    </tr>
                </table>

                <div class="mb-3">
                    <form action="<?= base_url('borrowings/return_action/' . $borrowing['id_borrowing']); ?>" method="POST">
                        <button type="submit" class="btn btn-success">Kembalikan Buku</button>
                    </form>
                </div>

                <a href="<?= base_url('returns'); ?>" class="btn btn-secondary">Kembali ke Daftar Peminjaman</a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
