<?php

namespace App\Models;

use CodeIgniter\Model;

class RackModel extends Model
{
    protected $table            = 'racks';
    protected $primaryKey       = 'id_rack';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'rack_name',
        'description',
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
        'rack_name' => [
            'rules' => 'required|is_unique[racks.rack_name,id_rack,{id_rack}]',
            'errors' => [
                'required' => 'Nama Rak wajib diisi.',
                'is_unique' => 'Nama Rak sudah digunakan.'
            ]
        ],

        'description' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi Lokasi Rak wajib diisi.'
            ]
        ]
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
