<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'usuario_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['nombre','correo','clave_maestra','pista_clave'];

    public function getUsuario($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['usuario_id' => $slug])->first();
    }

}