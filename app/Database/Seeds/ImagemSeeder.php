<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ImagemSeeder extends Seeder
{
    public function run()
    {
        $mapa = [
            'Camiseta Básica'           => 'assets/produtos/camiseta-basica.png',
            'Caneca de Cerâmica'        => 'assets/produtos/caneca-ceramica.png',
            'Mochila Casual'            => 'assets/produtos/mochila-casual.png',
            'Fone de Ouvido Bluetooth'  => 'assets/produtos/fone-bluetooth.png',
            'Garrafa Térmica'           => 'assets/produtos/garrafa-termica.png',
        ];

        foreach ($mapa as $nome => $imagem) {
            $this->db->table('produtos')
                ->where('nome', $nome)
                ->update(['imagem' => $imagem]);
        }
    }
}
