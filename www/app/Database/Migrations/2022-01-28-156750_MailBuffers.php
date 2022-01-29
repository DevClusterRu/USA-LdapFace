<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MailBuffers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'email_buff' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'letter' => [
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
              $this->forge->createTable('mail_buffers');
    }

    public function down()
    {
              $this->forge->dropTable('mail_buffers');
    }
}
