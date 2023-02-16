<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos_Base;
use App\Productos;
use Illuminate\Support\Facades\DB;

class Productos_BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p=Productos_Base::all();
       return $p;
  //     ini_set('memory_limit', '1024M');
  //     ini_set('max_execution_time', '10000');
  //     $productos=DB::connection('aba')->select('SELECT
  //       ssalud.persona.per_rut,
  //       aba.producto.produCodInt,
  //       aba.producto.produNombre,
  //       aba.producto.produFecIng,
  //       aba.producto.umediCod,
  //       aba.producto.produPrecio,
  //       aba.producto.produParti,
  //       aba.producto.produDuracion,
  //       aba.producto.produTempMin,
  //       aba.producto.produTempMax,
  //       aba.producto.grupoCod,
  //       aba.producto.produTransito,
  //       aba.producto.produUltSolFec,
  //       aba.producto.produUltSolNum,
  //       aba.producto.secciCod,
  //       aba.producto.produAAFonasaC,
  //       aba.producto.produAAFonasaD,
  //       aba.producto.produACFonasaC,
  //       aba.producto.produACFonasaD,
  //       aba.producto.produEstado,
  //       aba.producto.produNombreCompleto,
  //       aba.producto.produAPF,
  //       aba.producto.produGES,
  //       aba.producto.produCentroOrigen,
  //       aba.producto.produEstadoIntegra,
  //       aba.producto.produBenef,
  //       aba.producto.produPrestacionPPV,
  //       aba.producto.produPAD,
  //       ssalud.persona.per_Aba
  //       FROM
  //       aba.producto
  //       LEFT JOIN  ssalud.persona ON  ssalud.persona.per_Aba =aba.producto.produUsuarCod  COLLATE utf8_spanish_ci');
  //     if(!empty($productos))
  //     {


  //      foreach ($productos as $key1 ) 
  //      {


  //       $p=DB::connection('ordenes_de_compras')->select("SELECT
  //         presupuesto.gasto_presupuestario.gasto_pre_sigfe AS presupuesto_id_codigo_sigfe,
  //         presupuesto.gasto_presupuestario.gasto_pre_sub_sigfe AS presupuesto_sub_item_sigfe,
  //         presupuesto.cuentas_sigfe.sigfe_nombre AS presupuesto_nombre_sigfe,
  //         presupuesto.gasto_presupuestario.gasto_pre_sub_sigfe_familia AS item
  //         FROM
  //         ordenes_de_compras.producto_compra,
  //         presupuesto.gasto_presupuestario
  //         INNER JOIN presupuesto.cuentas_sigfe ON presupuesto.cuentas_sigfe.sigfe_id = presupuesto.gasto_presupuestario.gasto_pre_sigfe1
  //         WHERE
  //         ordenes_de_compras.producto_compra.pro_id_aba ='".$key1->produCodInt."'
  //         AND ordenes_de_compras.producto_compra.pro_estado_producto = 6
  //         AND ordenes_de_compras.producto_compra.pro_id = presupuesto.gasto_presupuestario.gasto_pre_id_producto3
  //         ORDER BY
  //         ordenes_de_compras.producto_compra.pro_id_oc DESC
  //         LIMIT 1");
  //       if(!empty($p))
  //       {


  //        foreach ($p as $key ) 
  //        {
  //          $cuenta_sigfe=$key->presupuesto_id_codigo_sigfe;
  //          $sub_item_sigfe=$key->presupuesto_sub_item_sigfe;
  //          $nombre_sigfe=$key->presupuesto_nombre_sigfe;
  //          $familia_sigfe=$key->item;
  //        }
  //        $pb=new Productos_Base();
  //        $pb->cuenta_sigfe=$cuenta_sigfe;
  //        $pb->sub_item_sigfe=$sub_item_sigfe;
  //        $pb->nombre_sigfe= $nombre_sigfe;
  //        $pb->familia_sigfe=$familia_sigfe;
  //        $pb->usuario_ingresa=$key1->per_rut;
  //        $pb->estado=1;
  //        $pb->seccion=$key1->secciCod;
  //        $pb->codigo_grupo=$key1->grupoCod;
  //        $pb->precio=$key1->produPrecio;
  //        $pb->unidad_medida=$key1->umediCod;
  //        $pb->nombre=$key1->produNombre;
  //        $pb->codigo=$key1->produCodInt;
  //        $pb->save();



  //      }else{
  //       $pb=new Productos_Base();               
  //       $pb->usuario_ingresa=$key1->per_rut;
  //       $pb->estado=1;
  //       $pb->seccion=$key1->secciCod;
  //       $pb->codigo_grupo=$key1->grupoCod;
  //       $pb->precio=$key1->produPrecio;
  //       $pb->unidad_medida=$key1->umediCod;
  //       $pb->nombre=$key1->produNombre;
  //       $pb->codigo=$key1->produCodInt;
  //       $pb->save();
  //     }


  //   }

  // }
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
        $co=Productos_Base::max('id');
        $co2=Productos_Base::select('codigo')->where('id',$co)->first();
        $codigo=intval($co2->codigo)+1;
   
        $p=new Productos_Base();
        $p->codigo=$codigo;
        $p->nombre=$request->nombre;
        $p->unidad_medida=$request->unidad_medida;
        $p->usuario_ingresa=$request->usuario;
        $p->cuenta_sigfe=$request->cuenta_sigfe;
        $p->nombre_sigfe=$request->nombre_sigfe;
        $p->sub_item_sigfe=$request->sub_item_sigfe;
        $p->save();

        return $p->id;

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
      $productos=Productos_Base::where('codigo','like','%'.$id.'%')->OrWhere('nombre','like','%'.$id.'%')->get();
      return $productos;
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
        $p=Productos_Base::find($id)->update($request->except('_method', '_token'));
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
