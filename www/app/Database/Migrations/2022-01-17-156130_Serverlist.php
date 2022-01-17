<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Serverlist extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'domain' => [
                'type' => 'VARCHAR',
                'constraint' => 255,

            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => 15,

            ],
            'login' => [
                'type' => 'VARCHAR',
                'constraint' => 255,

            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('role_id','user_roles','id');
        $this->forge->createTable('serverList');
    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('serverList');
    }
}
