<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBorrowingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_borrowing' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'book_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'borrow_date' => [
                'type' => 'DATE',
            ],
            'return_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'returned'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_borrowing', true);
        $this->forge->addForeignKey('book_id', 'books', 'id_book', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('borrowings');
    }

    public function down()
    {
        $this->forge->dropTable('borrowings');
    }
}
