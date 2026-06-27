<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarVendaItens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'venda_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'produto_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'produto_nome'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'quantidade'     => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'preco_unitario' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'subtotal'       => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('venda_id', 'vendas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('venda_itens');
    }

    public function down()
    {
        $this->forge->dropTable('venda_itens');
    }
}
