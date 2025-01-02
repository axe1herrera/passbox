<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'login';
    protected $primaryKey = 'login_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['entrada_id','usuario', 'contrasenia','url', 'notas', 'pregunta_clave'];

    public function getLogin($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['login_id' => $slug])->first();
    }

}
