<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Servers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'domain' => [
                'type' => 'VARCHAR',
                'constraint' => 255,

            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,

            ],
            'login' => [
                'type' => 'VARCHAR',
                'constraint' => 255,

            ],
            'password' => [
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
        // $this->forge->addForeignKey('role_id','user_roles','id');
        $this->forge->createTable('servers');


        $data = array(

            array(
                'domain' => "server2",
                'url' => "https//server1",
                'login' => "login1",
                'password' => "password",

            ),
            array(
                'domain' => "server2",
                'url' => "https//server2",
                'login' => "login2",
                'password' => "password",

            ),
            array(
                'domain' => "server3",
                'url' => "https//server3",
                'login' => "login3",
                'password' => "password",

            ),
            array(
                'domain' => "server4",
                'url' => "https//server4",
                'login' => "login4",
                'password' => "password",

            ),
        );
        $this->db->table("servers")->insertBatch($data); //вставка данных в бд

    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('servers');
    }
}
