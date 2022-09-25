<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'              => 'INT',
                'auto_increment'    => true
            ],
            'email'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'unique'            => true
            ],
            'password'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'rank'     => [
                'type'              => 'INT'
            ],
            'erp'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'company_name'  => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'status'     => [
                'type'              => 'ENUM',
                'constraint'        => ['Active', 'Inactive'],
                'default'           => 'Active'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default NULL'
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('rank', 'rank', 'id');

        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
