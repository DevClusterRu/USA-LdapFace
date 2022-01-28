<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'role_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
            'company_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'invite_hash' => [
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
        $this->forge->createTable('users');

        $data = array(
            array(
                'username' => "superadmin",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 4,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
            array(
                'username' => "admin",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 3,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
            array(
                'username' => "director",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 2,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
            array(
                'username' => "worker",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 1,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
        );
        $this->db->table("users")->insertBatch($data);

    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('users');
    }
}
