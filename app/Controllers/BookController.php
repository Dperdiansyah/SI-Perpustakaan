<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\RackModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BookController extends BaseController
{
    protected $bookModel;

    // Inisialisasi model buku saat controller dipanggil
    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    // Menampilkan daftar buku
    public function index()
    {
        $data['page_title'] = 'Kelola Buku';
        $data['books'] = $this->bookModel
                            ->select('books.*, categories.name as category_name, racks.rack_name')
                            ->join('categories', 'categories.id_category = books.category_id', 'left')
                            ->join('racks', 'racks.id_rack = books.rack_id', 'left')
                            ->findAll();

        return view('buku/index', $data);
    }

    // Menampilkan halaman tambah buku
    public function new()
    {
        $categoryModel = new CategoryModel();
        $rackModel = new RackModel();

        $data['categories'] = $categoryModel->findAll();
        $data['racks'] = $rackModel->findAll();
        $data['page_title'] = 'Tambah Buku';
        $data['validation'] = session()->get('validation');

        return view('buku/create', $data);
    }

    // Menyimpan data buku baru
    public function create()
    {
        $data = $this->request->getPost();

        // Proses file gambar yang di-upload
        if ($this->request->getFile('photo')->isValid() && !$this->request->getFile('photo')->hasMoved()) {
            $file = $this->request->getFile('photo');
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $data['photo'] = $newName;
        }

        // Validasi dan simpan data buku
        if (!$this->bookModel->save($data)) {
            return redirect()->back()->withInput()->with('validation', $this->bookModel->errors());
        }

        return redirect()->to('/books')->with('message', 'Buku berhasil ditambahkan');
    }

    // Menampilkan detail buku
    public function detail($id)
    {
        $book = $this->bookModel
                    ->select('books.*, categories.name as category_name, racks.rack_name')
                    ->join('categories', 'categories.id_category = books.category_id', 'left')
                    ->join('racks', 'racks.id_rack = books.rack_id', 'left')
                    ->find($id);

        $data = [
            'page_title' => 'Detail Buku',
            'book' => $book,
        ];

        return view('buku/detail', $data);
    }

    // Menampilkan halaman edit buku
    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $rackModel = new RackModel();

        $book = $this->bookModel->find($id);

        if (!$book) {
            session()->setFlashdata('error', 'Buku tidak ditemukan.');
            return redirect()->to('/books');
        }

        $data = [
            'page_title' => 'Edit Buku',
            'book' => $book,
            'categories' => $categoryModel->findAll(),
            'racks' => $rackModel->findAll(),
            'validation' => session()->get('validation'),
        ];

        return view('buku/edit', $data);
    }

    // Menyimpan perubahan data buku
    public function update($id)
    {
        $data = $this->request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'rack_id' => 'required',
            'stock' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        // Proses file baru jika ada
        $file = $this->request->getFile('photo');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $data['photo'] = $newName;
        }

        if (!$this->bookModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('validation', $this->bookModel->errors());
        }

        session()->setFlashdata('message', 'Buku berhasil diperbarui.');
        return redirect()->to('/books');
    }

    // Menghapus data buku
    public function delete($id)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            session()->setFlashdata('error', 'Buku tidak ditemukan');
            return redirect()->to('/books');
        }

        $this->bookModel->delete($id);
        session()->setFlashdata('message', 'Buku berhasil dihapus');
        return redirect()->to('/books');
    }
}
