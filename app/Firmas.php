<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmas extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'aprobar_nivel1';
	public $timestamps = false;
}
