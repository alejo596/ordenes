<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenesdeCompras extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'compra';
	public $timestamps = false;
}
