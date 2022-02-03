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
                'id'=>1,
                'username' => "superadmin",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 4,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
            array(
                'id'=>2,
                'username' => "admin",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 3,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
            array(
                'id' => 100,
                'username' => "director",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 2,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),
            array(
                'id' => 102,
                'username' => "director2",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 2,
                'company_id' => 2,
                'invite_hash' => "NULL",
            ),
            array(
                'id' => 103,
                'username' => "director3",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 2,
                'company_id' => 3,
                'invite_hash' => "NULL",
            ),
            array(
                'id' => 104,
                'username' => "director4",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 2,
                'company_id' => 4,
                'invite_hash' => "NULL",
            ),
            array(
                'id'=>4,
                'username' => "worker",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 1,
                'company_id' => 1,
                'invite_hash' => "NULL",
            ),

            array(
                'id'=>5,
                'username' => "worker2",
                'password' => password_hash("123",PASSWORD_BCRYPT),
                'email' => "mail@mail.ru",
                'phone' => "+7",
                'role_id' => 1,
                'company_id' => 2,
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
