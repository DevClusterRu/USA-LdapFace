<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Companys extends Migration
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
            'inn' => [
                'type' => 'VARCHAR',
                'constraint' => 12,

            ],
            'kpp' => [
                'type' => 'VARCHAR',
                'constraint' => 9,
            ],
            'server_id' => [
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
        $this->forge->createTable('companys');

        $data = array(
            array(
                'id' => 1,
                'name' => "ITL",
                'inn' => "1",
                'kpp' => "1",
                'server_id' => "1"
            ),

            array(
                'id' => 2,
                'name' => "Audi",
                'inn' => "1",
                'kpp' => "1",
                'server_id' => "3"
            ),
            array(
                'id' => 3,
                'name' => "Sosiski",
                'inn' => "1",
                'kpp' => "1",
                'server_id' => "4"
            ),
            array(
                'id' => 4,
                'name' => "ItTech",
                'inn' => "1",
                'kpp' => "1",
                'server_id' => "2"
            ),
        );
        $this->db->table("companys")->insertBatch($data);


    }

    public function down()
    {
        $this->forge->dropTable('companys');
    }
}
