<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Notificaciones extends Model
{
   protected $connection = 'ordenes_de_compras';
    protected $table = 'notificaciones';
    protected $fillable = [
     'estado',
     'usuario',
     'observacion',
    
     

     ];
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected function serializeDate(DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
}
}
