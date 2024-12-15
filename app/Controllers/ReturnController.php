<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;
use App\Models\BorrowingModel;
use App\Controllers\BaseController;

class ReturnController extends BaseController
{
    protected $bookModel;
    protected $borrowingModel;
    protected $userModel;

    public function __construct()
    {   
        // Inisialisasi model
        $this->borrowingModel = new BorrowingModel();
        $this->bookModel      = new BookModel();
        $this->userModel      = new UserModel();
    }
    
    public function index()
    {
        // Ambil data peminjaman beserta buku dan user
        $borrowings = $this->borrowingModel
            ->select('borrowings.*, books.title as book_title, user.name as user_name')
            ->join('books', 'books.id_book = borrowings.book_id')
            ->join('user', 'user.id_user = borrowings.user_id')
            ->where('borrowings.status', 'approved')
            ->findAll();

        // Definisikan tarif denda per hari
        $penaltyPerDay = 1000;
        $now           = new \DateTime();

        // Hitung denda untuk setiap peminjaman
        foreach ($borrowings as &$borrowing) {
            $borrowing['penalty'] = $this->calculatePenalty($borrowing['return_date'], $now, $penaltyPerDay);
        }

        // Kirimkan data ke view
        $data = [
            'page_title' => 'Peminjaman Buku',
            'borrowings' => $borrowings,
        ];

        return view('pengembalian/index', $data);
    }

    /**
     * Menghitung denda keterlambatan pengembalian buku.
     *
     * @param string|null $returnDate   Tanggal pengembalian seharusnya
     * @param \DateTime   $currentDate  Tanggal sekarang
     * @param int         $penaltyPerDay Tarif denda per hari
     * @return int
     */
    private function calculatePenalty($returnDate, $currentDate, $penaltyPerDay)
    {
        // Jika tidak ada tanggal pengembalian, tidak ada denda
        if (!$returnDate) {
            return 0;
        }

        $dueDate = new \DateTime($returnDate);

        // Cek jika sudah melewati tanggal pengembalian
        if ($currentDate > $dueDate) {
            $interval = $dueDate->diff($currentDate);
            $daysLate = $interval->days;

            return $daysLate * $penaltyPerDay; // Hitung denda
        }

        return 0; // Tidak ada keterlambatan
    }
}
