<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Balances extends Migration
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
                'type' => 'INT',
                'unsigned' => true,
            ],
            'amount' => [
                'type' => 'INT',
                'unsigned' => true,
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
            ]
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('role_id','user_roles','id');
        $this->forge->createTable('balances');

        $data=array(
            array(
                'user_id' => 3,
                'amount' => 600,
            ),
            array(
                'user_id' => 100,
                'amount' => 600,
            ),
            array(
                'user_id' => 103,
                'amount' => 600,
            ),

        );
        $this->db->table("balances")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('balances');
    }
}
