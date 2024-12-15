<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRacksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rack' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rack_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'  => 'TEXT',
                'null'  => true,
            ],
        ]);

        $this->forge->addKey('id_rack', true);
        $this->forge->createTable('racks');
    }

    public function down()
    {
        $this->forge->dropTable('racks');
    }
}
