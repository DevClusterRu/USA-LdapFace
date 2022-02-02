<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Credits extends Migration
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
            'service_id' => [
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
        $this->forge->createTable('credits');

        $data = array(

            array(
                'user_id' => 3,
                'service_id' => 1,
                'amount' => 200,

            ),
            array(
                'user_id' => 100,
                'service_id' => 2,
                'amount' => 200,

            ),
            array(
                'user_id' => 102,
                'service_id' => 3,
                'amount' => 200,

            ),
        );
        $this->db->table("credits")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('credits');
    }
}
