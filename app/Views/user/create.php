<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card Form Tambah Pengguna -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Pengguna Baru</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form Tambah Pengguna -->
                        <form action="<?= base_url('user/create'); ?>" method="post">
                            <?= csrf_field(); ?>
                            
                            <!-- Dropdown Role -->
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="form-control" required onchange="toggleFields()">
                                    <option value="siswa">Siswa</option>
                                    <option value="guru">Guru</option>
                                    <option value="kepala_sekolah">Kepala Sekolah</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            
                            <!-- Kolom Nama -->
                            <div class="form-group">
                                <?php if (isset(session('error')['name'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['name'] ?></div>
                                <?php endif ?>
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama" value="<?= old('name'); ?>" required>
                            </div>

                            <!-- Kolom Email -->
                            <div class="form-group">
                                <?php if (isset(session('error')['email'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['email'] ?></div>
                                <?php endif ?>
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" value="<?= old('email'); ?>" required>
                            </div>

                            <!-- Kolom Gender -->
                            <div class="form-group">
                                <?php if (isset(session('error')['gender'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['gender']; ?></div>
                                <?php endif ?>
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="Laki-laki" <?= old('gender') == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= old('gender') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>

                            <!-- Kolom Alamat -->
                            <div class="form-group">
                                <?php if (isset(session('error')['address'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['address']; ?></div>
                                <?php endif ?>
                                <label for="address">Alamat</label>
                                <textarea id="address" name="address" class="form-control" placeholder="Masukkan alamat" rows="3" required><?= old('address'); ?></textarea>
                            </div>

                            <!-- Kolom Password -->
                            <div class="form-group">
                                <?php if (isset(session('error')['password'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['password'] ?></div>
                                <?php endif ?>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>

                            <!-- Kolom Konfirmasi Password -->
                            <div class="form-group">
                                <?php if (isset(session('error')['confirm_password'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['confirm_password']; ?></div>
                                <?php endif ?>
                                <label for="confirm_password">Konfirmasi Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Konfirmasi password" required>
                            </div>

                            <!-- Kolom Role Khusus -->
                            <div id="nipField" class="form-group" style="display: none;">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control" placeholder="Masukkan NIP" value="<?= old('nip'); ?>">
                            </div>

                            <div id="nisnField" class="form-group" style="display: none;">
                                <?php if (isset(session('error')['nisn'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['nisn'] ?></div>
                                <?php endif ?>
                                <label for="nisn">NISN</label>
                                <input type="text" id="nisn" name="nisn" class="form-control" placeholder="Masukkan NISN" value="<?= old('nisn'); ?>">
                            </div>

                            <div id="kelasField" class="form-group" style="display: none;">
                                <?php if (isset(session('error')['class'])): ?>
                                    <div class="alert alert-danger"><?= session('error')['class']; ?></div>
                                <?php endif ?>
                                <label for="id_kelas">Kelas</label>
                                <select name="class" id="id_kelas" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="X" <?= old('class') == 'X' ? 'selected' : ''; ?>>X</option>
                                    <option value="XI" <?= old('class') == 'XI' ? 'selected' : ''; ?>>XI</option>
                                    <option value="XII" <?= old('class') == 'XII' ? 'selected' : ''; ?>>XII</option>
                                </select>
                            </div>

                            <!-- Tombol Simpan dan Batal -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('user'); ?>" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk Mengontrol Kolom Berdasarkan Role -->
<script>
    function toggleFields() {
        const role = document.getElementById('role').value;

        // Ambil referensi elemen form
        const nipField = document.getElementById('nipField');
        const nipInput = document.getElementById('nip');
        const nisnField = document.getElementById('nisnField');
        const nisnInput = document.getElementById('nisn');
        const kelasField = document.getElementById('kelasField');
        const kelasInput = document.getElementById('id_kelas');

        // Reset tampilan dan atribut
        nipField.style.display = 'none';
        nisnField.style.display = 'none';
        kelasField.style.display = 'none';
        nipInput.removeAttribute('required');
        nisnInput.removeAttribute('required');
        kelasInput.removeAttribute('required');

        // Tampilkan dan tambahkan atribut sesuai role
        if (role === 'siswa') {
            nisnField.style.display = 'block';
            kelasField.style.display = 'block';
            nisnInput.setAttribute('required', 'required');
            kelasInput.setAttribute('required', 'required');
        } else if (role === 'guru' || role === 'kepala_sekolah' || role === 'admin') {
            nipField.style.display = 'block';
            nipInput.setAttribute('required', 'required');
        }
    }

    // Panggil fungsi toggleFields() saat pertama kali halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        toggleFields();
    });
</script>

<?= $this->endSection(); ?>
