<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserSelectedServices extends Migration
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
        $this->forge->createTable('user_selected_services');

        $data = array(
            array(
                'user_id' => 3,
                'service_id' => 1,

            ),
            array(
                'user_id' => 102,
                'service_id' => 2,

            ),
            array(
                'user_id' => 103,
                'service_id' => 3,

            ),
        );
        $this->db->table("user_selected_services")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('user_selected_services');
    }
}
