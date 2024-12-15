<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePinaltiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penalties' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_borrowing' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'penalty_amount' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'note' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'penalty_date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id_penalties', true);
        $this->forge->addForeignKey('id_borrowing', 'borrowings', 'id_borrowing', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penalties');
    }

    public function down()
    {
        $this->forge->dropTable('penalties');
    }
}
