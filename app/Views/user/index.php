<?= $this->extend('layouts/master'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <!-- Card untuk menampilkan user yang belum aktif -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User yang Belum Aktif</h3>

                <!-- Menampilkan pesan flashdata sukses atau error -->
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
                <!-- Tabel Daftar User yang Belum Aktif -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan data user yang belum aktif -->
                        <?php $no = 1; ?>
                        <?php foreach ($nonaktif as $user): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['nisn']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td>
                                    <!-- Tombol untuk mengaktifkan user -->
                                    <a href="<?= base_url('user/aktif/' . $user['id_user']); ?>" class="btn btn-primary">Aktifkan</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Card untuk menampilkan user yang aktif -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User yang Aktif</h3>
            </div>
            <div class="card-body">
                <div class="card-tools mb-3">
                    <!-- Tombol untuk menambah user baru -->
                    <a href="<?= base_url('user/new'); ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>

                <!-- Tabel Daftar User yang Aktif -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th class="text-center">Aktifasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk menampilkan data user yang aktif -->
                        <?php $no = 1; ?>
                        <?php foreach ($aktif as $user): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['role']; ?></td>
                                <td class="text-center">
                                    <!-- Tombol untuk menonaktifkan user -->
                                    <a href="<?= base_url('user/nonaktif/' . $user['id_user']); ?>" class="btn btn-danger btn-sm">Nonaktifkan</a>
                                </td>
                                <td class="text-center">
                                    <!-- Tombol untuk melihat detail, mengedit, dan menghapus user -->
                                    <a href="<?= base_url('user/detail/' . $user['id_user']); ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('user/edit/' . $user['id_user']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('user/delete/' . $user['id_user']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
