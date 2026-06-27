<?php

namespace App\Models;

use CodeIgniter\Model;

class VendaItemModel extends Model
{
    protected $table            = 'venda_itens';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['venda_id', 'produto_id', 'produto_nome', 'quantidade', 'preco_unitario', 'subtotal'];

    protected $useTimestamps = false;
}
