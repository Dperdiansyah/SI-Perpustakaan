<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;
use App\Models\BorrowingModel;
use App\Controllers\BaseController;

class DashboardController extends BaseController
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
        // Hitung jumlah user aktif
        $activeUserCount = $this->userModel
            ->where('status', 'aktif')
            ->countAllResults();

        // Hitung total stok buku
        $bookCount = $this->bookModel
            ->selectSum('stock')
            ->first();

        // Hitung jumlah buku yang sedang dipinjam (status 'approved')
        $borrowedBookCount = $this->borrowingModel
            ->where('status', 'approved')
            ->countAllResults();

        // Kirim data ke view
        return view('dashboard/index', [
            'activeUserCount'   => $activeUserCount,
            'bookCount'         => $bookCount['stock'] ?? 0,
            'borrowedBookCount' => $borrowedBookCount,
        ]);
    }
}
