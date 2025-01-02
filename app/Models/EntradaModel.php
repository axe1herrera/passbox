<?php

namespace App\Models;

use CodeIgniter\Model;

class EntradaModel extends Model
{
    protected $table      = 'entrada';
    protected $primaryKey = 'entrada_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['nombre','tipo'];

    public function getEntrada($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['entrada_id' => $slug])->first();
    }

}
