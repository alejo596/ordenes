<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mantenedores;
use App\Refrendacio_envios;
use App\Productos;
use App\LogRefrendacion;
use Illuminate\Support\Facades\DB;
use App\Refrendacionporcc;
use App\Compromisos;
use App\Refrendacion;
use App\Gastos;


class MantenedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     public function eliminargastos(Request $request)
    {
        Gastos::find($request->id)->delete();
   
     }   

    public function restarcc(Request $request)
    {


       $nuevo=DB::connection('ordenes_de_compras')->select('SELECT
        Sum(producto_compra.pro_total) AS total,
        producto_compra.pro_id_cpp,
        producto_compra.pro_cc,
        producto_compra.sigfe_item
        FROM
        producto_compra
        where producto_compra.pro_amio='.$request->year.' and producto_compra.pro_cc='.$request->ccnuevo.' and pro_estado_producto >=5         
        GROUP BY producto_compra.pro_cc,producto_compra.sigfe_item
        ');
       if($request->ccnuevo != $request->cc){


        $elimnar = Refrendacionporcc::where('cc',$request->cc)->where('year','=',$request->year)->where('sigfe',$request->sigfe_antiguo)->first();
        if(!empty($elimnar)){
           $totalcc=$elimnar->monto - $request->total;
           if($totalcc < 0){
              $totalcc=0;
          }
          Refrendacionporcc::find($elimnar->id)->update(['monto'=>$totalcc]);

      }



      $antiguo=Refrendacio_envios::where('cc',$request->cc)->where('year','=',$request->year)->where('sigfe',$request->sigfe_antiguo)->where('id_refrendacion',$request->refrendacion)->first();
      if(!empty($antiguo)){
        $totaldetalle= $antiguo->monto - $request->total;
        if($totaldetalle< 0){
            $totaldetalle=0;

        }
        Refrendacio_envios::find($antiguo->id)->update(['monto'=>$totaldetalle]);

    }


}



$total=0; 

$refr_env=Refrendacio_envios::where('cc',$request->ccnuevo)->where('year','=',$request->year)->where('sigfe',$request->sigfe)->where('id_refrendacion',$request->refrendacion)->first();


if (!empty($refr_env))
{
    $totalenvios=$refr_env->monto+$request->precionuevo;

    Refrendacio_envios::find($refr_env->id)->update(['monto'=>$totalenvios]);

}else{

    $ren=new Refrendacio_envios();
    $ren->id_refrendacion=$request->refrendacion;
    $ren->monto=$request->precionuevo;
    $ren->cc=$request->ccnuevo;
    $ren->sigfe=$request->sigfe;
    $ren->year=$request->year;
    $ren->save();


}
foreach ($nuevo as $key ) {

    $re=Refrendacionporcc::where('cc',$request->ccnuevo)->where('year','=',$request->year)->where('sigfe',$request->sigfe)->first();

    if(!empty($re)){
       $total=$key->total+$re->monto;

       $r=Refrendacionporcc::where('id',$re->id)->update(['monto'=>$total]);
   }else{

    $r=new Refrendacionporcc();         
    $r->cc=$key->pro_cc;        
    $r->monto=$key->total;          
    $r->year=$request->year;
    $r->sigfe=$key->sigfe_item;
    $r->save();

}


}





}

public function updatecpp(Request $request)
{
    $sqlcpp=DB::connection('ordenes_de_compras')->select('SELECT
        Sum(producto_compra.pro_total) AS total,
        producto_compra.pro_id_cpp
        FROM
        producto_compra

        where producto_compra.pro_id_cpp='.$request->cpp);

    foreach ($sqlcpp as $key1) {
       Compromisos::find($request->cpp)->update(['total'=>$key1->total,'total_neto'=>$key1->total]);
       Refrendacion::find($request->refrendacion)->update(['monto'=>$key1->total]);
   }

}

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
        //
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
