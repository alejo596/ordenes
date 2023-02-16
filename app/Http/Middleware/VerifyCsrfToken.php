<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [        
        
        'http://localhost/gestion_ordenes/public/crearcpp',
        'http://localhost/gestion_ordenes/public/crearproductos',
        'http://localhost/gestion_ordenes/public/crearadjuntos',
        'http://localhost/gestion_ordenes/public/crearsolicitudes',
        'http://localhost/gestion_ordenes/public/convenioscpp',
        'http://localhost/gestion_ordenes/public/convenios',
        'http://localhost/gestion_ordenes/public/convenios2',
        'http://localhost/gestion_ordenes/public/centros',
        'http://localhost/gestion_ordenes/public/convenioscpp',
        'http://localhost/gestion_ordenes/public/proveedores'
        

    ];
}
