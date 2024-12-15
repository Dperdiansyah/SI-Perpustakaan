<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pengguna</h3>
                        <!-- Tombol kembali ke daftar pengguna -->
                        <a href="<?= base_url('user'); ?>" class="btn btn-secondary float-right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan detail pengguna dalam bentuk daftar -->
                        <dl class="row">
                            <!-- Menampilkan nama pengguna -->
                            <dt class="col-sm-3">Nama</dt>
                            <dd class="col-sm-9"><?= esc($user['name']); ?></dd>

                            <!-- Menampilkan email pengguna -->
                            <dt class="col-sm-3">Email</dt>
                            <dd class="col-sm-9"><?= esc($user['email']); ?></dd>

                            <!-- Menampilkan jenis kelamin pengguna -->
                            <dt class="col-sm-3">Jenis Kelamin</dt>
                            <dd class="col-sm-9"><?= $user['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></dd>

                            <!-- Menampilkan alamat pengguna -->
                            <dt class="col-sm-3">Alamat</dt>
                            <dd class="col-sm-9"><?= esc($user['address']); ?></dd>

                            <!-- Menampilkan role pengguna -->
                            <dt class="col-sm-3">Role</dt>
                            <dd class="col-sm-9"><?= ucfirst($user['role']); ?></dd>

                            <!-- Menampilkan status pengguna -->
                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9"><?= ucfirst($user['status']); ?></dd>

                            <!-- Kondisi khusus untuk menampilkan informasi tambahan berdasarkan role -->
                            <?php if ($user['role'] === 'siswa'): ?>
                                <!-- Menampilkan NISN dan Kelas hanya untuk role siswa -->
                                <dt class="col-sm-3">NISN</dt>
                                <dd class="col-sm-9"><?= esc($user['nisn']); ?></dd>

                                <dt class="col-sm-3">Kelas</dt>
                                <dd class="col-sm-9"><?= esc($user['class']); ?></dd>
                            <?php elseif (in_array($user['role'], ['guru', 'admin', 'kepala_sekolah'])): ?>
                                <!-- Menampilkan NIP hanya untuk role guru, admin, dan kepala sekolah -->
                                <dt class="col-sm-3">NIP</dt>
                                <dd class="col-sm-9"><?= esc($user['nip']); ?></dd>
                            <?php endif; ?>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
