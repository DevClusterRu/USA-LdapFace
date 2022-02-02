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

        $data = array(
            array(
                'email_buff' => "superadmin@qwe.ru",
                'letter' => "localhost:85/invite/e9f85eac0c22aeedd7ac6d2b6555f9da",

        ),

        array(
            'email_buff' => "superadmin1@qwe.ru",
            'letter' => "localhost:85/invite/e9f85eac0c22aeedd7ac6d2b6555f9da",

        ),
        array(
            'email_buff' => "superadmin3@qwe.ru",
            'letter' => "localhost:85/invite/e9f85eac0c22aeedd7ac6d2b6555f9da",

        ),
    );
        $this->db->table("mail_buffers")->insertBatch($data);
    }

    public function down()
    {
              $this->forge->dropTable('mail_buffers');
    }
}
