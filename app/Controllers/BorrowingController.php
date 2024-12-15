<?php

namespace App\Controllers;

use DateTime;
use App\Models\BookModel;
use App\Models\UserModel;
use App\Models\BorrowingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BorrowingController extends BaseController
{
    protected $bookModel;
    protected $borrowingModel;
    protected $userModel;
    public function __construct()
    {   
        $this->borrowingModel = new BorrowingModel();
        $this->bookModel = new BookModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Peminjaman Buku',
            'borrowings' => $this->borrowingModel
                ->select('borrowings.*, books.title as book_title, user.name as user_name')
                ->join('books', 'books.id_book = borrowings.book_id')
                ->join('user', 'user.id_user = borrowings.user_id')
                ->where('borrowings.status', 'pending') 
                ->findAll(),
        ];

        return view('peminjaman/index', $data);
    }

    public function new()
    {
        $data = [
            'page_title' => 'Peminjaman Buku',
            'books' => $this->bookModel->findAll(),
            'user' => $this->userModel->findAll(),
            'validation' => session()->get('validation'),
        ];
        return view('peminjaman/create', $data);
    }

    public function create()
    {
        // Ambil data dari form
        $data = $this->request->getPost();

        // Menetapkan status langsung menjadi 'approved'
        $data['status'] = 'approved';

        // Validasi data menggunakan model
        if (!$this->borrowingModel->save($data)) {
            // Jika validasi gagal, kembali ke form dengan input dan pesan kesalahan
            return redirect()->back()->withInput()->with('validation', $this->borrowingModel->errors());
        }

        // Proses setelah validasi berhasil, misalnya update stok buku
        $book = $this->bookModel->find($data['book_id']);
        if ($book['stock'] <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
        }
        $this->bookModel->update($data['book_id'], ['stock' => $book['stock'] - 1]);

        return redirect()->to('/returns')->with('message', 'Peminjaman berhasil ditambahkan.');
    }

    public function detail($id)
    {
        // Ambil data peminjaman berdasarkan ID
        $borrowing = $this->borrowingModel
        ->select('borrowings.id_borrowing, borrowings.borrow_date, borrowings.return_date, borrowings.status, 
                user.name AS user_name, user.role AS user_role, 
                books.title AS book_title, 
                categories.name AS category_name, 
                racks.rack_name AS rack_name')
        ->join('books', 'books.id_book = borrowings.book_id')
        ->join('user', 'user.id_user = borrowings.user_id')
        ->join('categories', 'categories.id_category = books.category_id')
        ->join('racks', 'racks.id_rack = books.rack_id')
        ->find($id);
    
        if (!$borrowing) {
            return redirect()->to('/borrowings')->with('error', 'Peminjaman tidak ditemukan');
        }

        // Ambil data peminjaman dan terkait
        $data = [
            'page_title' => 'Detail Peminjaman',
            'borrowing' => $borrowing
        ];

        return view('peminjaman/detail', $data);
    }

    public function approve($id)
    {
        // Ambil data peminjaman berdasarkan ID
        $borrowing = $this->borrowingModel->find($id);

        // Cek apakah peminjaman ditemukan dan statusnya masih 'pending'
        if (!$borrowing) {
            return redirect()->to('/borrowings')->with('error', 'Peminjaman tidak ditemukan.');
        }

        if ($borrowing['status'] == 'approved') {
            return redirect()->to('/borrowings')->with('error', 'Peminjaman sudah disetujui.');
        }

        // Update status peminjaman menjadi 'approved'
        $this->borrowingModel->update($id, ['status' => 'approved']);

        // Perbarui stok buku yang dipinjam
        $book = $this->bookModel->find($borrowing['book_id']);
        if ($book['stock'] <= 0) {
            return redirect()->to('/borrowings')->with('error', 'Stok buku tidak mencukupi.');
        }

        // Mengurangi stok buku setelah peminjaman disetujui
        $this->bookModel->update($borrowing['book_id'], ['stock' => $book['stock'] - 1]);

        // Berikan notifikasi sukses
        return redirect()->to('/borrowings')->with('message', 'Peminjaman berhasil disetujui.');
    }

    public function checkReturn($id)
    {
        // Ambil data peminjaman beserta buku, kategori, dan rak
        $borrowing = $this->borrowingModel
            ->join('books', 'books.id_book = borrowings.book_id')
            ->join('user', 'user.id_user = borrowings.user_id')
            ->join('categories', 'categories.id_category = books.category_id')
            ->join('racks', 'racks.id_rack = books.rack_id')
            ->find($id);
 
        // Pastikan data peminjaman ditemukan
        if (!$borrowing) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Peminjaman tidak ditemukan.');
        }

        // Definisikan tarif denda per hari
        $penalty_per_day = 1000;
        $penalty = 0;

        // Cek apakah tanggal pengembalian yang seharusnya ada
        if ($borrowing['return_date']) {
            // Tanggal pengembalian yang seharusnya
            $due_date = new \DateTime($borrowing['return_date']);

            // Tanggal sekarang
            $now = new \DateTime();

            // Debugging: Cek apakah tanggal sekarang lebih besar dari tanggal pengembalian yang seharusnya
            // echo "Tanggal Pengembalian yang Seharusnya: " . $due_date->format('Y-m-d') . "<br>";
            // echo "Tanggal Sekarang: " . $now->format('Y-m-d') . "<br>";

            // Jika tanggal sekarang lebih besar dari tanggal pengembalian yang seharusnya, hitung denda
            if ($now > $due_date) {
                // Hitung selisih hari keterlambatan
                $interval = $due_date->diff($now);
                $days_late = $interval->days;

                // Hitung denda
                $penalty = $days_late * $penalty_per_day;
            }
        }

        // Debugging: Tampilkan denda
        // echo "Denda: " . $penalty . "<br>";

        return view('peminjaman/return_check', [
            'borrowing' => $borrowing,
            'penalty' => $penalty,
        ]);
    } 


    public function returnAction($id)
    {
        // Ambil data peminjaman
        $borrowing = $this->borrowingModel->find($id);
        if (!$borrowing) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Peminjaman tidak ditemukan.');
        }
    
        // Perbarui status peminjaman menjadi 'returned' dan set tanggal pengembalian
        $data = [
            'status' => 'returned',
            'return_date' => date('Y-m-d')
        ];
    
        // Simpan perubahan status peminjaman
        $this->borrowingModel->update($id, $data);
    
        // Perbarui stok buku
        $book = $this->bookModel->find($borrowing['book_id']);
        $this->bookModel->update($borrowing['book_id'], ['stock' => $book['stock'] + 1]);
    
        // Jika perlu, bisa menambahkan logika untuk pembayaran denda atau pengelolaan lainnya
    
        return redirect()->to('/returns')->with('message', 'Buku berhasil dikembalikan.');
    }

}
