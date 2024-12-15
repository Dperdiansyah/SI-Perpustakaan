<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGenderToUsers extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('user', [
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['laki_laki', 'perempuan',]
            ]
        ]);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('user', 'gender');
    }
}
