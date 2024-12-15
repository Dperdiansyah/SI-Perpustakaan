<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Controllers\BaseController;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        // Inisialisasi model kategori
        $this->categoryModel = new CategoryModel();
    }

    // Tampilkan semua kategori
    public function index()
    {
        $data = [
            'page_title' => 'Kelola Kategori',
            'categories' => $this->categoryModel->findAll()
        ];
        return view('kategori/index', $data);
    }

    // Tampilkan form tambah kategori
    public function new()
    {
        $data = [
            'page_title' => 'Tambah Kategori',
            'validation' => session()->get('validation')
        ];
        return view('kategori/create', $data);
    }

    // Proses tambah kategori
    public function create()
    {
        $data = $this->request->getPost();

        // Validasi dan simpan data
        if (!$this->categoryModel->save($data)) {
            return redirect()->back()->withInput()->with('validation', $this->categoryModel->errors());
        }

        return redirect()->to('/categories')->with('message', 'Kategori berhasil ditambahkan.');
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/categories')->with('error', 'Kategori tidak ditemukan.');
        }

        $data = [
            'page_title' => 'Edit Kategori',
            'category' => $category,
            'validation' => session()->get('validation')
        ];
        return view('kategori/edit', $data);
    }

    // Proses update kategori
    public function update($id)
    {
        $data = $this->request->getPost();

        // Validasi input manual untuk mencegah duplikasi nama kategori
        $this->categoryModel->setValidationRule('name', 'is_unique[categories.name,id_category,' . $id . ']');

        if (!$this->categoryModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('validation', $this->categoryModel->errors());
        }

        return redirect()->to('/categories')->with('message', 'Kategori berhasil diubah.');
    }

    // Hapus kategori
    public function delete($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/categories')->with('error', 'Kategori tidak ditemukan.');
        }

        $this->categoryModel->delete($id);
        return redirect()->to('/categories')->with('message', 'Kategori berhasil dihapus.');
    }
}
