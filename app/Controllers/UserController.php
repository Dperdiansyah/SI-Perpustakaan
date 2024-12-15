<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    // Menampilkan halaman utama pengguna
    public function index()
    {
        $userModel = new UserModel();
        $data['page_title'] = 'Kelola User';

        // Ambil data user yang aktif dan nonaktif
        $data['aktif'] = $userModel->where('status', 'aktif')->findAll();
        $data['nonaktif'] = $userModel->where('status', 'nonaktif')->findAll();
        
        return view('user/index', $data);
    }

    // Mengaktifkan status pengguna
    public function aktif($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        $userModel->update($id, ['status' => 'aktif']);
        return redirect()->back()->with('message', 'User berhasil diaktifkan');
    }

    // Menonaktifkan status pengguna
    public function nonaktif($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, ['status' => 'nonaktif']);
        return redirect()->back()->with('message', 'User berhasil dinonaktifkan');
    }

    // Menampilkan form tambah pengguna
    public function new()
    {
        $data['page_title'] = 'Tambah User';
        return view('user/create', $data);
    }

    // Proses pembuatan pengguna baru
    public function create()
    {
        $data = $this->request->getPost();
        $errors = $this->validateUserData($data);

        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('error', $errors);
        }

        $userModel = new UserModel();
        $userModel->insert($this->prepareUserData($data));

        session()->setFlashdata('message', 'Registrasi berhasil. Silakan menunggu konfirmasi dari admin.');
        return redirect()->to('/user');
    }

    // Menampilkan detail pengguna
    public function detail($id)
    {
        $userModel = new UserModel();
        $data['page_title'] = 'Detail User';
        
        $data['user'] = $userModel->find($id);
        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengguna dengan ID $id tidak ditemukan.");
        }

        return view('user/detail', $data);
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        return view('user/edit', ['user' => $user]);
    }

    // Proses update data pengguna
    public function update($id_user)
    {
        $userModel = new UserModel();
        $data = $this->request->getPost();
        $errors = $this->validateUserData($data, $id_user);

        if (!empty($errors)) {
            return redirect()->to('/user/edit/' . $id_user)->withInput()->with('error', $errors);
        }

        $updatedData = $this->prepareUserData($data, $id_user);
        if ($userModel->update($id_user, $updatedData)) {
            session()->setFlashdata('message', 'Pengguna berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui pengguna.');
        }

        return redirect()->to(base_url('user'));
    }

    // Menghapus pengguna berdasarkan ID
    public function delete($id_user)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id_user);

        if ($userModel->delete($id_user)) {
            session()->setFlashdata('message', 'Data pengguna berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data pengguna');
        }

        return redirect()->to('/user');
    }

    // Validasi data pengguna
    private function validateUserData($data, $id_user = null)
    {
        $errors = [];

        // Validasi nama, email, password, dan lainnya
        if (empty($data['name'])) {
            $errors['name'] = 'Nama harus diisi.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Email harus diisi.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Format email tidak valid.';
        } elseif ($this->isEmailTaken($data['email'], $id_user)) {
            $errors['email'] = 'Email sudah terdaftar.';
        }

        if (empty($data['password']) && !$id_user) {
            $errors['password'] = 'Password harus diisi.';
        } elseif (!empty($data['password']) && strlen($data['password']) < 8) {
            $errors['password'] = 'Password harus memiliki minimal 8 karakter.';
        }

        if (!empty($data['password']) && $data['password'] !== $data['confirm_password']) {
            $errors['confirm_password'] = 'Konfirmasi password tidak sesuai.';
        }

        // Validasi berdasarkan role
        if ($data['role'] === 'siswa') {
            $errors = array_merge($errors, $this->validateSiswa($data));
        } elseif (in_array($data['role'], ['guru', 'admin', 'kepala_sekolah'])) {
            $errors = array_merge($errors, $this->validateNip($data));
        }

        return $errors;
    }

    // Validasi khusus untuk siswa
    private function validateSiswa($data)
    {
        $errors = [];
        if (empty($data['nisn'])) {
            $errors['nisn'] = 'NISN harus diisi untuk siswa.';
        } elseif (!is_numeric($data['nisn']) || strlen($data['nisn']) != 10) {
            $errors['nisn'] = 'NISN harus berupa 10 digit angka.';
        }

        if (empty($data['class'])) {
            $errors['class'] = 'Kelas harus diisi untuk siswa.';
        }

        return $errors;
    }

    // Validasi NIP untuk guru, admin, kepala sekolah
    private function validateNip($data)
    {
        $errors = [];
        if (empty($data['nip'])) {
            $errors['nip'] = 'NIP harus diisi untuk guru, admin, atau kepala sekolah.';
        }

        return $errors;
    }

    // Cek apakah email sudah terdaftar
    private function isEmailTaken($email, $id_user)
    {
        $userModel = new UserModel();
        return $userModel->where('email', $email)->where('id_user !=', $id_user)->first() !== null;
    }

    // Persiapkan data untuk penyimpanan atau pembaruan
    private function prepareUserData($data, $id_user = null)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'role' => $data['role'],
            'status' => $data['status'] ?? 'aktif',
            'nisn' => $data['role'] === 'siswa' ? $data['nisn'] : null,
            'class' => $data['role'] === 'siswa' ? $data['class'] : null,
            'nip' => in_array($data['role'], ['guru', 'admin', 'kepala_sekolah']) ? $data['nip'] : null,
            'updated_at' => Time::now(),
        ];

        if (!empty($data['password'])) {
            $userData['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        return $userData;
    }
}
