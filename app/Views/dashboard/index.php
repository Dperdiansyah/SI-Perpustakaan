<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $activeUserCount; ?></h3> <!-- Menampilkan jumlah User Aktif -->
                    <p>Jumlah User Aktif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i> <!-- Ikon user -->
                </div>
                <a href="<?= base_url('/user'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $bookCount; ?></h3> <!-- Menampilkan jumlah stok Buku Keseluruhan -->
                    <p>Jumlah Buku</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bookmark"></i> <!-- Ikon buku -->
                </div>
                <a href="<?= base_url('/books'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $borrowedBookCount; ?></h3> <!-- Menampilkan jumlah Buku yang Dipinjam -->
                    <p>Buku yang Dipinjam</p>
                </div>
                <div class="icon">
                    <i class="ion ion-arrow-return-left"></i> <!-- Ikon buku yang dipinjam -->
                </div>
                <a href="<?= base_url('/returns'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
</section>
<?= $this->endSection(); ?>
