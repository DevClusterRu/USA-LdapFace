<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentPers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'type_of_service' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'current_service' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'price' => [
                'type' => 'FLOAT',

            ],
            'get_bills' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'payment_before' => [
                'type' => 'TIMESTAMP',

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
        $this->forge->createTable('PaymentPers');
    }

    public function down()
    {
        //  $this->forge->dropForeignKey('users','role_id');
        $this->forge->dropTable('PaymentPers');
    }
}
