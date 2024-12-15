<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTabel extends Migration
{
    public function up()
    {
        //mebahkankan field untuk tabel user
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],

            'nisn' => [
                'type' => 'INT',
                'constraint' => 18,
                'null' => true, //hanya untuk siswa
            ],

            'nip' => [
                'type' => 'INT',
                'constraint' => 18,
                'null' => true, //hanya untuk guru
            ],

            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true //jadi email haru unik
            ],

            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],

            'role' => [
                'type' => 'ENUM',
                'constraint' => ['siswa', 'guru', 'admin', 'kepala_sekolah'],
                'default' => 'siswa',
            ],

            'status' => [
                'type' => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default' => 'nonaktif',
            ],

            'class' => [
                'type' => 'ENUM',
                'constraint' => ['X', 'XI', 'XII'],
                'null' => true, //hanya untuk siswa
            ],
            
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],

            'created_at' => [
                'type' => 'DATETIME',
            ],

            'updated_at' => [
                'type' => 'DATETIME',
            ]
        ]);

        //menambahkan primary key
        $this->forge->addPrimaryKey('id_user');

        //membuat tabel user
        $this->forge->createTable('user');
    }

    public function down()
    {
        // menghapus tabel user
        $this->forge->dropTable('user');
    }
}
