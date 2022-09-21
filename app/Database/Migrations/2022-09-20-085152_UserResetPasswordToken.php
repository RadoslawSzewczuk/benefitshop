<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserResetPasswordToken extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'              => 'INT',
                'auto_increment'    => true
            ],
            'id_user'           => [
                'type'              => 'INT',
            ],
            'token'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 50
            ],
            'used'              => [
                'type'              => 'INT',
                'constraint'        => 1,
                'default'           => 0
            ],
            'expiration_date'   => [
                'type'              => 'datetime'
            ],
            'updated_at datetime default null on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user', 'user', 'id');

        $this->forge->createTable('user_reset_password_token');
    }

    public function down()
    {
        $this->forge->dropTable('user_reset_password_token');
    }
}
