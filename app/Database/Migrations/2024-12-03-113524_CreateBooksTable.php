<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_book' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'publisher' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'publication_year' => [
                'type'       => 'YEAR',
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'rack_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'isbn' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'stock' => [ 
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
        ]);

        // Primary Key
        $this->forge->addKey('id_book', true);

        // Foreign Keys
        $this->forge->addForeignKey('category_id', 'categories', 'id_category', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rack_id', 'racks', 'id_rack', 'CASCADE', 'CASCADE');

        // Create Table
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
