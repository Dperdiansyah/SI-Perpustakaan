<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id_book';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'category_id',
        'rack_id',
        'isbn',
        'stock',
        'description',
        'photo',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Judul buku wajib diisi.',
                'max_length' => 'Judul buku tidak boleh lebih dari 255 karakter.',
            ],
        ],
        'author' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Nama penulis wajib diisi.',
                'max_length' => 'Nama penulis tidak boleh lebih dari 255 karakter.',
            ],
        ],
        'publisher' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Nama penerbit wajib diisi.',
                'max_length' => 'Nama penerbit tidak boleh lebih dari 255 karakter.',
            ],
        ],
        'publication_year' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tahun terbit wajib diisi.',
                'numeric' => 'Tahun terbit harus berupa angka.',
            ],
        ],
        'category_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori wajib dipilih.',
            ],
        ],
        'rack_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Rak wajib dipilih.',
            ],
        ],
        'isbn' => [
            'rules' => 'permit_empty|max_length[20]',
            'errors' => [
                'max_length' => 'ISBN tidak boleh lebih dari 20 karakter.',
            ],
        ],
        'stock' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Jumlah stok buku wajib diisi.',
                'numeric' => 'Jumlah stok harus berupa angka.',
            ],
        ],
        'description' => [
            'rules' => 'permit_empty',
        ],
        'photo' => [
            'rules' => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
            'errors' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Foto harus berformat jpg, jpeg, atau png.',
                'max_size' => 'Ukuran foto tidak boleh lebih dari 2 MB.',
            ],
        ],
    ];
    protected $validationMessages   = [];
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
