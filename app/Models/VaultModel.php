<?php

namespace App\Models;

use CodeIgniter\Model;

class VaultModel extends Model
{
    protected $table      = 'caja_fuerte';
    protected $primaryKey = 'vault_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['usuario_id','nombre'];

    public function getVault($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['vault_id' => $slug])->first();
    }

}