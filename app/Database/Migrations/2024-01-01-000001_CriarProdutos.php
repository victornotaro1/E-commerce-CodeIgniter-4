<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarProdutos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nome'       => ['type' => 'VARCHAR', 'constraint' => 150],
            'descricao'  => ['type' => 'TEXT', 'null' => true],
            'preco'      => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'estoque'    => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produtos');
    }

    public function down()
    {
        $this->forge->dropTable('produtos');
    }
}
