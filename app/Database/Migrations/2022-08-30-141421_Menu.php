<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
                'constraint'        => 30
            ],
            'icon'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 30
            ],
            'roles'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 30
            ],
            'logged_only'      => [
                'type'              => 'INT',
                'constraint'        => 1
            ],
            'route'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 50
            ],
//            'parent'    => [
//                'type'              => 'INT'
//            ],
//            'tab'       => [
//                'type'              => 'ENUM("Administrator", "Użytkownik")',
//                'default'           => 'Użytkownik',
//                'null' => FALSE
//            ],
            'active'    => [
                'type'              => 'INT',
                'constraint'        => 1
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
