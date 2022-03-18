<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AutoRenewals extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'service_id' => [
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
        $this->forge->createTable('autorenewals');



    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('autorenewals');
    }
}
