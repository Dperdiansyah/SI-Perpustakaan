<?php

namespace App\Models;

use CodeIgniter\Model;

class BorrowingModel extends Model
{
    protected $table            = 'borrowings';
    protected $primaryKey       = 'id_borrowing';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'book_id',
        'user_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'book_id' => 'required|is_not_unique[books.id_book]',
        'user_id' => 'required|is_not_unique[user.id_user]',
        'borrow_date' => 'required|valid_date',
        'return_date'  => 'required|valid_date',
    ];
    protected $validationMessages   = [
        'book_id' => [
            'required' => 'Judul buku wajib dipilih.',
            'is_not_unique' => 'Buku yang dipilih tidak valid.',
        ],
        'user_id' => [
            'required' => 'Nama peminjam wajib dipilih.',
            'is_not_unique' => 'Peminjam yang dipilih tidak valid.',
        ],
        'borrow_date' => [
            'required' => 'Tanggal pinjam wajib diisi.',
            'valid_date' => 'Format tanggal pinjam tidak valid.',
        ],
        'return_date' => [
            'required' => 'Tanggal Pengembalian wajib diisi.',
            'valid_date' => 'Format tanggal kembali tidak valid.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

}
