<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImagemProdutos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('produtos', [
            'imagem' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'descricao',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('produtos', 'imagem');
    }
}
