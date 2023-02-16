<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    
    protected $connection = 'facturacion';
    protected $table = 'observaciones';

    protected $fillable = [
        'id',
        'detalle',
        'responsable',
        'id_docuento',
        'id_tipo_obs'
      
    ];

    public $timestamps = false;
}
