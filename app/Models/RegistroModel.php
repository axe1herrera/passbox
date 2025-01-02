<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroModel extends Model
{
    protected $table      = 'registro';
    protected $primaryKey = 'registro_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['vault_id','entrada_id'];

    public function getRegistro($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['registro_id' => $slug])->first();
    }

}
