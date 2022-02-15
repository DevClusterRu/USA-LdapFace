<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupPolicy extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'group_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'company_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'dn' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'group_description' => [
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
        $this->forge->createTable('group_policy');

        $data = array(
            array(
                'id'=>1,
                'group_name' => "accounting",
                'company_id' => 1,
                'dn' => "CN=Users,DC=test,DC=lab",
                'group_description' => "accounting",
            ),
            array(
                'id'=>2,
                'group_name' => "engineers",
                'company_id' => 2,
                'dn' => "CN=Users,DC=test,DC=lab",
                'group_description' => "engineers",
            ),
            array(
                'id' => 3,
                'group_name' => "constructors",
                'company_id' => 2,
                'dn' => "CN=Users,DC=test,DC=lab",
                'group_description' => "constructors",
            ),
            array(
                'id' => 4,
                'group_name' => "accounting",
                'company_id' => 2,
                'dn' => "CN=Users,DC=test,DC=lab",
                'group_description' => "accounting",
            ),
        );
        $this->db->table("group_policy")->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('group_policy');
    }
}
