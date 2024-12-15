<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RackModel;

class RackController extends BaseController
{
    protected $rackModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->rackModel = new RackModel();
    }

    // Menampilkan daftar rak
    public function index()
    {
        $data = [
            'page_title' => 'Kelola Rak',
            'racks'      => $this->rackModel->findAll()
        ];

        return view('rak/index', $data);
    }

    // Menampilkan form tambah rak
    public function new()
    {
        $data = [
            'page_title'  => 'Tambah Rak',
            'validation'  => session()->get('validation')
        ];

        return view('rak/create', $data);
    }

    // Menyimpan rak baru ke database
    public function create()
    {
        $data = $this->request->getPost();

        if (!$this->rackModel->save($data)) {
            return redirect()->back()
                             ->withInput()
                             ->with('validation', $this->rackModel->errors());
        }

        return redirect()->to('racks')->with('message', 'Rak berhasil ditambahkan!');
    }

    // Menampilkan form edit rak
    public function edit($id)
    {
        $rack = $this->rackModel->find($id);

        if (!$rack) {
            return redirect()->to('racks')->with('error', 'Rak tidak ditemukan');
        }

        $data = [
            'page_title'  => 'Edit Rak',
            'validation'  => session()->get('validation'),
            'rack'        => $rack
        ];

        return view('rak/edit', $data);
    }

    // Memperbarui data rak
    public function update($id)
    {
        $data = $this->request->getPost();

        // Validasi data input
        if (empty($data['rack_name']) || empty($data['description'])) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Nama Rak dan Deskripsi tidak boleh kosong');
        }

        // Validasi unikasi untuk nama rak
        $this->rackModel->setValidationRule('rack_name', 'is_unique[racks.rack_name,id_rack,' . $id . ']');

        if (!$this->rackModel->update($id, $data)) {
            return redirect()->back()
                             ->withInput()
                             ->with('validation', $this->rackModel->errors());
        }

        return redirect()->to('racks')->with('message', 'Rak berhasil diubah!');
    }

    // Menghapus data rak
    public function delete($id)
    {
        $rack = $this->rackModel->find($id);

        if (!$rack) {
            session()->setFlashdata('error', 'Rak tidak ditemukan');
            return redirect()->to('racks');
        }

        $this->rackModel->delete($id);
        session()->setFlashdata('message', 'Rak berhasil dihapus');
        return redirect()->to('racks');
    }
}
