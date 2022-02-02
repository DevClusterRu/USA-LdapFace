<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,

            ],
            'type_service' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cost' => [
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
            ],
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('role_id','user_roles','id');
        $this->forge->createTable('services');

        $data = array(
            array(
                'name' => "Переустановить систему",
                'type_service' => "once",
                'cost' => "2000",

            ),
            array(
                'name' => "Обжать провода",
                'type_service' => "once",
                'cost' => "1500",

            ),
            array(
                'name' => "Переустановить систему",
                'type_service' => "once",
                'cost' => "390",

            ),
            array(
                'name' => "Базовое обслуживание",
                'type_service' => "notonce",
                'cost' => "3000",

            ),
        );
        $this->db->table("services")->insertBatch($data);
    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('services');
    }
}
