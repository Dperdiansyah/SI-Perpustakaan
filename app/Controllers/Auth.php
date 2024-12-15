<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function proseslogin()
    {
        //ambil dari inputan
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        //validasi inputan
        if (empty($email) || empty($password)) {
            session()->setFlashdata('error', 'Email dan Password tidak boleh kosong');
            return redirect()->to('auth');
        }

        //Query ke model user untuk mencari user berdasarkan email
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        //cek apakah user ada dam status aktif
        if ($user) {
            if ($user['status'] == 'nonaktif') {
                session()->setFlashdata('error', 'Akun Anda belum diaktifkan');
                return redirect()->to('auth');
            }
                //jika status aktif dan password benar
                if (password_verify($password, $user['password'])) {
                    //simpan session
                    session()->set([
                        'id_user' => $user['id_user'],
                        'name' => $user['name'],
                        'role' => $user['role'],
                        'isLoggedIn' => true,
                    ]);
                    //diarahkan ke dashboar kalau benar
                    return redirect()->to('dashboard');
                } else {
                    //jika password salah
                    session()->setFlashdata('error', 'Password salah');
                    return redirect()->to('auth');
                }
            } else {
                session()->setFlashdata('error', 'Email dan Password salah');
                return redirect()->to('auth');
            }
    }

    public function register()
    {
        return view('auth/register');
    }

    
    public function prosesRegister() 
    {
        //ambil data dari inputan
        //ambil data langsung semua pakai array

        $data = $this->request->getPost();
        $errors = [];

        //validasi untuk setiap field inputan

        // validasi name
        if (empty($data['name'])) {
            $errors['name'] = 'Nama harus diisi';
        }

        //validasi nisn
        if (empty($data['nisn'])) {
            $errors['nisn'] = 'NISN harus diisi';
        } elseif (strlen($data['nisn']) != 10) {
            $errors['nisn'] = 'NISN harus 10 digit';
        }

        //validasi email
        if (empty($data['email'])) {
            $errors['email'] = 'Email harus diisi';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email tidak valid';
        } elseif ((new UserModel())->find($data['email'])) {
            $errors['email'] = 'Email sudah terdaftar';
        }

        //validasi password
        if (empty($data['password'])) {
            $errors['password'] = 'Password harus diisi';
            } elseif (strlen($data['password']) < 8) {
                $errors['password'] = 'Password harus lebih dari 8 karakter';
            }
        
        //validasi konfirmasi password
        if (empty($data['confirm_password'])) {
            $errors['confirm_password'] = 'Konfirmasi password harus diisi';
            } elseif ($data['password'] != $data['confirm_password']) {
                $errors['confirm_password'] = 'Password tidak sama dengan konfirmasi password';
                }

        //jenis kelamin
        if (empty($data['gender'])) {
            $errors['gender'] = 'Jenis kelamin harus diisi';
        }

        //validasi alamat
        if (empty($data['address'])) {
            $errors['address'] = 'Alamat harus diisi';
            }

        //validasi kelas
        if (empty($data['class'])) {
            $errors['class'] = 'Kelas harus diisi';
            }

        // var_dump($errors);
        // die();
        //jika ada erros, kembalikan dengan data yang telah dimasukan dan pesan error
        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('error', $errors);
        }

        //membuat intance model usermodel untuk menyimpan data pengguna baru
        $userModel = new UserModel();
        //menyimpan data penguna baru ke dalam database
        $userModel->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'nisn' => $data['nisn'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'gender' => $data['gender'],
            'address' => $data['address'],
            'class' => $data['class'],
            'status' => 'nonaktif', //status default baru nonaktif
            ]);

        //menampilkan pesan sukses setelah registrasi berhasil
        session()->setFlashdata('success', 'Registrasi berhasil dibuat dan menunggu konfirmasi dari admin');
        return redirect()->to('auth');


    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }


}
