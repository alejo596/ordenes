<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargados extends Model
{   
	 protected $connection = 'ordenes_de_compras';
    protected $table = 'encargados_cc';
	public $timestamps = false;
    protected $fillable = [
		
		'id_cc', 'rut_encargado'
	];

}
