<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'role_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'role_id' => [
                'type' => 'SMALLINT',
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
        $this->forge->createTable('roles');

        $data = array(
            array('role_name' => "Клиент", 'role_id' => "1"),
            array('role_name' => "Супервайзер", 'role_id' => "2"),
            array('role_name' => "Администартор ИТЛ", 'role_id' => "3"),
            array('role_name' => "Суперадминистратор", 'role_id' => "4"),
        );
        //$this->db->insert('user_group', $data); I tried both
        $x=$this->db->table("roles")->insertBatch($data);

        var_dump($x);

    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('roles');
    }
}
