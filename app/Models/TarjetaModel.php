<?php

namespace App\Models;

use CodeIgniter\Model;

class TarjetaModel extends Model
{
    protected $table      = 'tarjeta';
    protected $primaryKey = 'tarjeta_id';
    protected $useAutoIncrement   = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';
    protected $allowedFields = ['entrada_id','nombre_tarjeta', 'marca', 'numero','exp_fecha', 'cvv', 'notas','pregunta_clave' ];

    public function getTarjeta($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['tarjeta_id' => $slug])->first();
    }

}
