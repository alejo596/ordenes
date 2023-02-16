<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'year';
	  protected $fillable = [
                      'id',
                     'year',
                     'estado'
                     ];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


}
