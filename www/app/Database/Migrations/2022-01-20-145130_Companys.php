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
            ),
        );
        $this->db->table("companys")->insertBatch($data);


    }

    public function down()
    {
        $this->forge->dropTable('companys');
    }
}
