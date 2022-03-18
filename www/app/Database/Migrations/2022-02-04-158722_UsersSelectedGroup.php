<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersSelectedGroup extends Migration
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
            'group_id' => [
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
             $this->forge->createTable('user_selected_group');

        $data = array(
            array(
                'user_id' => 100,
                'group_id' => 1,
            ),
            array(
                'user_id' => 5,
                'group_id' => 2,
            ),
            array(
                'user_id' => 5,
                'group_id' => 3,
            ),
            array(
                'user_id' => 102,
                'group_id' => 4,
            ),
        );
        $this->db->table("user_selected_group")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('user_selected_group');
    }
}
