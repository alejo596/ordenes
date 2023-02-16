<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
session_start();
function activeMenu($uri = '') {
    $active = '';
    if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
        $active = 'active';
    }
    return $active;
}
function volverlogin(){
return redirect()->route('sinlogin');
}

function mensajes()
{

$run=$_SESSION['rut'];


    try{ 
    $run=$_SESSION['rut'];
    $mensaje= DB::connection('ordenes_de_compras')->table('notificaciones')->select('id','observacion')->where('estado',1)->where('usuario','=',$run)->get();
    return $mensaje;
    }catch(Exception $e){
     dd($e->getMessage()); 
     // $mensaje =array();
     // return redirect()->route('sinlogin',['id' => 1]);
   }

}

function current_user()
{  	

    try{
      return  $_SESSION['nom']; // output yes
        }catch(Exception $e){
          
        }



}

function run_session()
{     

    try{
        return  $_SESSION['rut']; 
    }catch(Exception $e){

    }


    // output yes
}

function getCompras(){
    try{
         $run=$_SESSION['rut'];
          $contador=0;

    $funcionario_en= DB::connection('ordenes_de_compras')->table('encargados_cc')->where('rut_encargado',$run)->get();
    $result = json_decode($funcionario_en, true);

    for ($i=0; $i < count($result) ; $i++) { 
        $cantidad= DB::connection('ordenes_de_compras')->table('solicitudes')
        ->where('cc',$result[$i]['id_cc'])
        ->where('estado','=',3)
        ->where('tipo','=',1)
        ->count();

        $contador=$cantidad+$contador;

    }



    return  $contador;
    }catch(Exception $e){

    }

   


}
function getViaticos(){

   try{
         $run=$_SESSION['rut'];
           $contador=0;

    $funcionario_en= DB::connection('ordenes_de_compras')->table('encargados_cc')->where('rut_encargado',$run)->get();
    $result = json_decode($funcionario_en, true);
    for ($i=0; $i < count($result) ; $i++) { 
        $cantidad= DB::connection('ordenes_de_compras')->table('solicitudes')
        ->where('cc',$result[$i]['id_cc'])
        ->where('estado','=',3)
        ->where('tipo','=',2)
        ->count();

        $contador=$cantidad+$contador;

    }



    return  $contador;
    }catch(Exception $e){

    }
  

}
function getSolicitudFondoFijo(){
try{
         $run=$_SESSION['rut'];
          $contador=0;

 $funcionario_en= DB::connection('ordenes_de_compras')->table('encargados_cc')->where('rut_encargado',$run)->get();
 $result = json_decode($funcionario_en, true);
 for ($i=0; $i < count($result) ; $i++) { 
    $cantidad= DB::connection('ordenes_de_compras')->table('solicitudes')
    ->where('cc',$result[$i]['id_cc'])
    ->where('estado','=',3)
    ->where('tipo','=',3)
    ->count();
    $contador=$cantidad+$contador;

}
return  $contador;
    }catch(Exception $e){

    }


}
