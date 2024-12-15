<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Formulir untuk mengedit data pengguna -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Pengguna</h3>
                        <!-- Tombol kembali ke daftar pengguna -->
                        <a href="<?= base_url('user'); ?>" class="btn btn-secondary float-right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan pesan kesalahan jika ada -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong>
                                <!-- Menampilkan daftar error -->
                                <ul>
                                    <?php foreach (session()->getFlashdata('error') as $field => $error): ?>
                                        <li><?= esc($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Formulir untuk mengedit pengguna -->
                        <form action="<?= base_url('user/update/' . $user['id_user']); ?>" method="post">
                            <?= csrf_field(); ?>
                            
                            <!-- Dropdown untuk memilih role pengguna -->
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="siswa" <?= ($user['role'] == 'siswa') ? 'selected' : ''; ?>>Siswa</option>
                                    <option value="guru" <?= ($user['role'] == 'guru') ? 'selected' : ''; ?>>Guru</option>
                                    <option value="kepala_sekolah" <?= ($user['role'] == 'kepala_sekolah') ? 'selected' : ''; ?>>Kepala Sekolah</option>
                                </select>
                            </div>

                            <!-- Input untuk nama pengguna -->
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= old('name', esc($user['name'])); ?>" required>
                            </div>

                            <!-- Input untuk email pengguna -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email', esc($user['email'])); ?>" required>
                            </div>

                            <!-- Dropdown untuk memilih jenis kelamin pengguna -->
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="L" <?= ($user['gender'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?= ($user['gender'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>

                            <!-- Input untuk alamat pengguna -->
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required><?= old('address', esc($user['address'])); ?></textarea>
                            </div>

                            <!-- Input untuk NISN (hanya untuk siswa) -->
                            <div class="form-group" id="nisn-group" style="display: none;">
                                <label for="nisn">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="<?= old('nisn', esc($user['nisn'])); ?>">
                            </div>
 
                            <!-- Input untuk kelas (hanya untuk siswa) -->
                            <div class="form-group" id="class-group" style="display: none;">
                                <label for="class">Kelas</label>
                                <select name="class" id="class" class="form-control">
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <option value="X" <?= old('class', esc($user['class'])) == 'X' ? 'selected' : ''; ?>>10</option>
                                    <option value="XI" <?= old('class', esc($user['class'])) == 'XI' ? 'selected' : ''; ?>>11</option>
                                    <option value="XII" <?= old('class', esc($user['class'])) == 'XII' ? 'selected' : ''; ?>>12</option>
                                </select>
                            </div>

                            <!-- Input untuk NIP (hanya untuk guru, kepala sekolah, dan admin) -->
                            <div class="form-group" id="nip-group" style="display: none;">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= old('nip', esc($user['nip'])); ?>">
                            </div>

                            <!-- Dropdown untuk memilih status pengguna -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="aktif" <?= ($user['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="nonaktif" <?= ($user['status'] == 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                                </select>
                            </div>

                            <!-- Input untuk password baru (jika ingin mengganti password) -->
                            <div class="form-group">
                                <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <!-- Input untuk konfirmasi password -->
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>

                            <!-- Tombol untuk menyimpan perubahan -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mengambil elemen-elemen yang diperlukan
        const role = document.getElementById('role');
        const nisnGroup = document.getElementById('nisn-group');
        const classGroup = document.getElementById('class-group');
        const nipGroup = document.getElementById('nip-group');

        // Fungsi untuk menampilkan/menyembunyikan field sesuai dengan role
        function toggleFields() {
            if (role.value === 'siswa') {
                // Menampilkan field untuk NISN dan kelas, sembunyikan NIP
                nisnGroup.style.display = 'block';
                classGroup.style.display = 'block';
                nipGroup.style.display = 'none';
            } else if (['guru', 'admin', 'kepala_sekolah'].includes(role.value)) {
                // Menampilkan field untuk NIP, sembunyikan NISN dan kelas
                nisnGroup.style.display = 'none';
                classGroup.style.display = 'none';
                nipGroup.style.display = 'block';
            } else {
                // Menyembunyikan semua field
                nisnGroup.style.display = 'none';
                classGroup.style.display = 'none';
                nipGroup.style.display = 'none';
            }
        }

        // Menambahkan event listener ketika role berubah
        role.addEventListener('change', toggleFields);
        toggleFields(); // Inisialisasi awal
    });
</script>

<?= $this->endSection(); ?>
