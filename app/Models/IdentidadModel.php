<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentidadModel extends Model
{
    protected $table      = 'identidad';
    protected $primaryKey = 'identidad_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['titulo','primer_nombre', 'segundo_nombre', 'apellidos','empresa', 'nss', 'pasaporte', 'licencia','email','telefono','direccion_1','direccion_2','ciudad_pueblo','estado','codigo_postal','pais','notas','pregunta_clave', 'entrada_id' ];

    public function getIdentidad($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['identidad_id' => $slug])->first();
    }

}
