<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invoices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'invoice_num' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'amount' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'status' => [
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
            ]
        ]);


        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('role_id','user_roles','id');
        $this->forge->createTable('invoices');

        $data = array(
            array(

                'invoice_num' => 1,
                'user_id' => 3,
                'amount' => 300,
                'status' => "new",

            ),
            array(
                'invoice_num' => 1,
                'user_id' => 100,
                'amount' => 9000,
                'status' => "paid",

            ),
            array(
                'invoice_num' => 1,
                'user_id' =>102,
                'amount' => 3000,
                'status' => "partially paid",

            ),
            array(
                'invoice_num' => 1,
                'user_id' => 103,
                'amount' => 4000,
                'status' => "paid",

            ),
            array(
                'invoice_num' => 1,
                'user_id' => 104,
                'amount' => 4000,
                'status' => "new",

            ),

        );
        $this->db->table("invoices")->insertBatch($data);
    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('invoices');
    }
}
