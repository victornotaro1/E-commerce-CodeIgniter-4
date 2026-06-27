<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table            = 'produtos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nome', 'descricao', 'imagem', 'preco', 'estoque'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nome'    => 'required|min_length[2]|max_length[150]',
        'preco'   => 'required|decimal|greater_than_equal_to[0]',
        'estoque' => 'required|is_natural',
    ];

    protected $validationMessages = [
        'nome' => [
            'required'   => 'O nome do produto é obrigatório.',
            'min_length' => 'O nome deve ter ao menos 2 caracteres.',
        ],
        'preco' => [
            'required' => 'O preço é obrigatório.',
            'decimal'  => 'Informe um preço válido.',
        ],
        'estoque' => [
            'required'   => 'O estoque é obrigatório.',
            'is_natural' => 'O estoque deve ser um número inteiro igual ou maior que zero.',
        ],
    ];
}
