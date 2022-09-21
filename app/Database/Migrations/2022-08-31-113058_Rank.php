<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => [
                'type'              => 'INT',
                'auto_increment'    => true
            ],
            'title'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 50
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('rank');
    }

    public function down()
    {
        $this->forge->dropTable('rank');
    }
}
