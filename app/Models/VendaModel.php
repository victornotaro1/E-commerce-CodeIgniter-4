<?php

namespace App\Models;

use CodeIgniter\Model;

class VendaModel extends Model
{
    protected $table            = 'vendas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cliente', 'total'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
