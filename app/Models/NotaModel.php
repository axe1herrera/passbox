<?php

namespace App\Models;

use CodeIgniter\Model;

class NotaModel extends Model
{
    protected $table      = 'nota';
    protected $primaryKey = 'nota_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['contenido','pregunta_clave', 'entrada_id'];

    public function getNota($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['nota_id' => $slug])->first();
    }

}
