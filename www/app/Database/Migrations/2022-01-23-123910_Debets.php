<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Debets extends Migration
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
            'invoice_id' => [
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
        $this->forge->createTable('debets');


        $data = array(
            array(
                'user_id' => 100,
                'invoice_id' => 1,
                'amount' => 10000,

            ),
            array(
                'user_id' => 3,
                'invoice_id' => 2,
                'amount' => 10000,

            ),
            array(
                'user_id' => 102,
                'invoice_id' => 3,
                'amount' => 10000,

            ),

        );
        $this->db->table("debets")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('debets');
    }
}
