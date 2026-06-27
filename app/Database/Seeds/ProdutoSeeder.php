<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run()
    {
        $agora = date('Y-m-d H:i:s');

        $produtos = [
            ['nome' => 'Camiseta Básica', 'descricao' => 'Camiseta 100% algodão, unissex.', 'imagem' => 'assets/produtos/camiseta-basica.png', 'preco' => 49.90, 'estoque' => 30],
            ['nome' => 'Caneca de Cerâmica', 'descricao' => 'Caneca 300ml para café ou chá.', 'imagem' => 'assets/produtos/caneca-ceramica.png', 'preco' => 29.90, 'estoque' => 50],
            ['nome' => 'Mochila Casual', 'descricao' => 'Mochila resistente com compartimento para notebook.', 'imagem' => 'assets/produtos/mochila-casual.png', 'preco' => 159.90, 'estoque' => 12],
            ['nome' => 'Fone de Ouvido Bluetooth', 'descricao' => 'Fone sem fio com cancelamento de ruído.', 'imagem' => 'assets/produtos/fone-bluetooth.png', 'preco' => 199.00, 'estoque' => 8],
            ['nome' => 'Garrafa Térmica', 'descricao' => 'Mantém a temperatura por até 12h, 500ml.', 'imagem' => 'assets/produtos/garrafa-termica.png', 'preco' => 79.90, 'estoque' => 4],
        ];

        foreach ($produtos as &$p) {
            $p['created_at'] = $agora;
            $p['updated_at'] = $agora;
        }

        $this->db->table('produtos')->insertBatch($produtos);
    }
}
