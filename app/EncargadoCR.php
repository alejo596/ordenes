<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncargadoCR extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'encargado_cr';
	public $timestamps = false;
    protected $fillable = [
		
		'id_cr', 'rut_cr_encargado'
	];
}
