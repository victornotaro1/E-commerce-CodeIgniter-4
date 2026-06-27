<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarVendas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'cliente'    => ['type' => 'VARCHAR', 'constraint' => 150],
            'total'      => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('vendas');
    }

    public function down()
    {
        $this->forge->dropTable('vendas');
    }
}
