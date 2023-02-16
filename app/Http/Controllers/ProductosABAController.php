<?php

namespace App\Http\Controllers;
use App\ProductosABA;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductosABAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '6000');


         $productos=DB::connection('aba')->select('SELECT
            ssalud.persona.per_rut,
            aba.producto.produCodInt,
            aba.producto.produNombre,
            aba.producto.produFecIng,
            aba.producto.umediCod,
            aba.producto.produPrecio,
            aba.producto.produParti,
            aba.producto.produDuracion,
            aba.producto.produTempMin,
            aba.producto.produTempMax,
            aba.producto.grupoCod,
            aba.producto.produTransito,
            aba.producto.produUltSolFec,
            aba.producto.produUltSolNum,
            aba.producto.secciCod,
            aba.producto.produAAFonasaC,
            aba.producto.produAAFonasaD,
            aba.producto.produACFonasaC,
            aba.producto.produACFonasaD,
            aba.producto.produEstado,
            aba.producto.produNombreCompleto,
            aba.producto.produAPF,
            aba.producto.produGES,
            aba.producto.produCentroOrigen,
            aba.producto.produEstadoIntegra,
            aba.producto.produBenef,
            aba.producto.produPrestacionPPV,
            aba.producto.produPAD,
            ssalud.persona.per_Aba
            FROM
            aba.producto
            LEFT JOIN  ssalud.persona ON  ssalud.persona.per_Aba =aba.producto.produUsuarCod  COLLATE utf8_spanish_ci');

         


      
        return $productos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $producto=ProductosABA::where('produNombre','like','%'.$id.'%')
        ->OrWhere('produCodInt','like','%'.$id.'%')
        ->get();
        return $producto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
