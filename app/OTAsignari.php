<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OTAsignari extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'compra';
}
