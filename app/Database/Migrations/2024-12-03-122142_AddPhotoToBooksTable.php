<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPhotoToBooksTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('books', [
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('books', 'photo');
    }
}
