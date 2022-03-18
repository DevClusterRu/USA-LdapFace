<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'log' => [
                'type' => 'TEXT',

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
        $this->forge->createTable('logs');

        $data = array(

            array(
                'log' => "пользователь worker1 зашел в систему",
        ),
        array(
            'log' => "пользователь worker2 вышел из системы",
        ),
            array(
                'log' => "пользователь admin зумировался под worker",
            ),
        );
        $this->db->table("logs")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('logs');
    }
}
