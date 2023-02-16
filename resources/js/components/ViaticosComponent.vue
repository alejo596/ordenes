<template>
<div class="container-fluid">
  <div class="row ">
    <div class="col-md-12">
      <div class="card  border-primary">
        <div class="card-header text-center text-white bg-primary">
         <h5>Solicitudes Centro de Costos(Ordenes de Compras)</h5>
       </div>

       <input type="hidden" name="" v-model="ct_l">
       <div class="card-body">
        <div class="table-responsive">
          <div v-cloak class="mt-4">
           <v-client-table :columns="columns" v-model="data" :options="options">
            <a slot="id" slot-scope="row">

             {{row.index}}
           </a>                                            

           <a slot="accion" slot-scope="props">


            <button class="btn btn-success" @click="visualizarnuevo(props.row.id_doc,props.row.tipo,props.row.cc,props.row.id)">Visualizar</button>

          </a>


        </v-client-table>

      </div>
    </div>


  </div>


</div>

</div>
<div class="col-4">

</div>
</div>
<div class="modal"  role="dialog" id="modalaceptar">
<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1400px !important;">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">{{titulomodal}}   </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
     <div class="row">
      <div class="col-6">
       <h5>{{titulomodal}}</h5>

     </div>
     <div class="col-2">
       <h5> N° {{numero}}</h5>

     </div>
     <div class="col-2">
      <h5>Año:{{year}}</h5>
    </div>

  </div>
  <div class="row mt-1">
    <div class="col-3">
      <label>Nombre Usuario:</label>
    </div>
    <div class="col-3">
      <input type="" name="" class="form-control" v-model="nombre_usuario" readonly="readonly">

    </div>
    <div class="col-3">
      <label>Fecha Orden De Compra:</label>
    </div>
    <div class="col-3">
      <input type="" name="" class="form-control" v-model="fecha_orden" readonly="readonly">

    </div>


  </div>
  <div class="row mt-1">
    <div class="col-3">
      <label>Centro de Responsabilidad:</label>
    </div>
    <div class="col-3">
      <input type="" name="" class="form-control" v-model="centro_res" readonly="readonly">

    </div>
    <div class="col-3">
      <label>Telefono]/Contacto:</label>
    </div>
    <div class="col-3">
      <input type="" name="" class="form-control" v-model="contacto" readonly="readonly">

    </div>


  </div>
  <div class="row mt-2">
    <div class="col-3">
      <label>Centro de Costo:</label>
    </div>
    <div class="col-3">
      <input type="" name="" class="form-control" v-model="centro_costo" readonly="readonly">

    </div>
    <div class="col-3">
      <label>Precio Total O.T. (Referencial):</label>
    </div>
    <div class="col-3">
      <input type="" name="" class="form-control" v-model="precio_total" readonly="readonly">

    </div>


  </div>
  <div class="row mt-2">
    <div class="col-5">
      <div class="card border-success" >
        <div class="card-header text-white bg-success" ><h5>Firmas</h5></div>
        <div class="card-body">
          <div class="row">
            <div class="col-2">
             <label>Centros</label>  
           </div>
           <div class="col-2">
            <label>Firma</label>
          </div>
          <div class="col-6">
           <label> Nombre/Fecha /Hora</label>
         </div>  
         <div class="col-2">
           <label> Accion</label>
         </div>                         

       </div>
       <div class="row mt-2">
        <div class="col-2">
         <label>C.C.</label>  
       </div>
       <div class="col-2">
        <label>{{modal_array.cc_nombre}}</label>
      </div>
      <div class="col-6">
       <input type="" name="" class="form-control input-sm" v-model="firma_cc" readonly="readonly">
     </div>   
     <div class="col-2">
       <a href="#"><img :src="'../assets/img/cruzado.png'" width="30" height="30"></a>
     </div>  


   </div>

   <div class="row mt-2">
    <div class="col-2">
     <label>C.R.</label>  
   </div>
   <div class="col-2">
    <label>{{modal_array.cr_nombre}}</label>
  </div>
  <div class="col-6">
   <input type="" name="" class="form-control input-sm" v-model="firma_cr" readonly="readonly">
 </div>  
 <div class="col-2">
  <a href="#"><img :src="'../assets/img/cruzado.png'" width="30" height="30"></a>

</div>  



</div>



</div>
<br>

</div>


</div>
<div class="col-7">
<div class="card border-primary">
  <div class="card-header text-white bg-primary"><h5>Presupuesto</h5></div>
  <div class="card-body">
    <div class="row">
     <div class="col-2">
       <label class="text-center">CENTROS</label>  
     </div>
     <div class="col-2">
       <label class="text-center">PPTO</label>  
     </div>
     <div class="col-3">
      <label class="text-center">GASTOS COMPRO</label>
    </div>
    <div class="col-2">
     <label class="text-center"> SALDO</label>
   </div>  
   <div class="col-2 text-center">
     <label > GASTADO</label>
   </div>                         

 </div>
 <div class="row">
  <div class="col-2">
   <label>C.C.</label>  
 </div>
 <div class="col-2">
   {{formatPrice(presupuesto_cc)}}
 </div>
 <div class="col-3">
  {{formatPrice(totalcentros)}}
</div>   
<div class="col-2">
 {{formatPrice(saldo_cc)}}
</div>  
<div class="col-2 text-center">
 {{porcentaje_cc}}
</div>  
</div>

<div class="row mt-2">
<div class="col-2">
 <label>C.R.</label>  
</div>
<div class="col-2">
 {{formatPrice(presucentros)}}
</div>
<div class="col-3">
{{formatPrice(gastocentros)}}
</div>   
<div class="col-2">
{{formatPrice(saldo_cr)}}
</div> 
<div class="col-2 text-center">
{{porcentaje_gastado_cr}} 
</div>   
</div>
<div class="row">
<div class="col-12">
  <label class="text-danger">* Nota: Los montos presentados, pertenecen a las cuentas del subtitulo {{sigfe_id}}.</label>

</div>

</div>
<input type="hidden" name=""  v-model="idcomprar">

</div>

</div>

</div>



</div>
<div class="row mt-2" v-show="viewproductos">
<div class="col-12">
  <div class="card border-info" >
    <div class="card-header text-white bg-info text-center" ><h5>Productos</h5></div>
    <div class="card-body">


      <div class="row mt-2">
        <div class="col-12">
          <v-client-table :columns="columns_productos" v-model="data_productos" :options="options_productos">


            <a slot="pro_id" slot-scope="props" >
              {{props.index}}
            </a>  
            <a slot="pro_descripcion"  slot-scope="{row, update, setEditing, isEditing, revertValue}">
              <span @click="setEditing(true)" v-if="!isEditing()">

                {{row.pro_descripcion}}


              </span>
              <span v-else>
                <textarea v-model="row.pro_descripcion" class="form-control" cols="400" rows="15">

                </textarea>

                <button type="button" class="btn btn-info btn-xs" @click="updatedescripcion1(row.pro_id,row.pro_descripcion,row.pro_id_oc); setEditing(false)">Actualizar</button>
                <button type="button" class="btn btn-default btn-xs" @click="revertValue(); setEditing(false)">Cancelar</button>

              </span>

            </a>

            <a slot="pro_justificacion"  slot-scope="{row, update, setEditing, isEditing, revertValue}">
              <span @click="setEditing(true)" v-if="!isEditing()">

                {{row.pro_justificacion}}

                <div v-if="row.pro_justificacion == null">
                  ingrese datos

                </div>


              </span>
              <span v-else>
                <textarea v-model="row.pro_justificacion" class="form-control" cols="500" rows="15">

                </textarea>

                <button type="button" class="btn btn-info btn-xs" @click="updatedescripcion2(row.pro_id,row.pro_justificacion,row.pro_id_oc); setEditing(false)">Actualizar</button>
                <button type="button" class="btn btn-default btn-xs" @click="revertValue(); setEditing(false)">Cancelar</button>

              </span>

            </a>


            <a slot="accionnes" slot-scope="props">
              <a @click="eliminarproducto(props.row.pro_id,props.row.pro_nombre_producto,props.row.pro_id_oc)"><img :src="'../assets/img/eliminar.png'" width="30" height="30"></a>

            </a>
            <a slot="adjunto" slot-scope="props" >
              <VDropdown
              :triggers="['hover']"
              :popperTriggers="['hover']"
              :autoHide="false"
              >

              <a href="#"><img :src="'../assets/img/pdf.png'" width="50" height="50" ></a>

              <!-- This will be the content of the popover -->
              <template #popper>
                <input type="hidden" class="tooltip-content" v-model="msg2" placeholder="Adjuntos" />
                <div class="card border-warning">
                  <div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{numero}} </div>
                  <div class="card-body">

                    <div class="col-12 container">

                      <carousel>
                        <slide v-for="(ar,index) in archivos" :key="index" v-if="ar.id_producto == props.row.pro_id">
                          <a target="_blank" :href="'../../storage/app'+ar.url"><img :src="'../assets/img/pdf.png'" width="30" height="40" data-toggle="tooltip" data-placement="top"  :title="ar.nombre" ></a>
                        </slide>


                      </carousel>

                    </div>


                  </div>

                </div>
                <!-- You can put other components too -->

              </template>
            </VDropdown>

            <a href="#"> </a>


          </a>


        </v-client-table>

      </div>

    </div>



  </div>
</div>


</div>



</div>
<div class="card border-primary mt-2" v-show="viewviaticos">
<div class="card-header text-center text-white bg-primary">
  <h5>Datos Del Viatico</h5>
  
</div>
<div class="card-body">
  <div class="row">
    <div class="col-3">
      <label>Beneficiario</label>
    </div>
    <div class="col-3">
     <input type="" name="" class="form-control" v-model="v_beneficiario">
   </div>
   <div class="col-3">
    <label>Derecho de Pasaje</label>
  </div>
  <div class="col-3">
    <input type="" name="" class="form-control" v-model="v_pasaje">
  </div>

</div>
<div class="row mt-2">
  <div class="col-3">
    <label>Lugar del cometido</label>
  </div>
  <div class="col-9">
    <input type="" name="" class="form-control" v-model="v_lugar">

  </div>

</div>
<div class="row mt-2">
  <div class="col-3">
    <label>Fecha Inicio Viatico</label>
  </div>
  <div class="col-3">
    <input type="" name="" class="form-control" v-model="v_fecha_inicio">
  </div>
  <div class="col-3">
    <label>Fecha Termino Viatico</label>
  </div>
  <div class="col-3">
    <input type="" name="" class="form-control" v-model="v_fecha_termino">
  </div>

</div>
<div class="row mt-2">
  <div class="col-3">
    <label>Motivo</label>

  </div>
  <div class="col-9">
    <textarea class="form-control" v-model="v_motivo"></textarea>

  </div>

</div>
<div class="row">
  <div class="col-3">
 
    <a href="#" @click="verpdfviatico(idcomprar)"><img :src="'../assets/img/pdf.png'" width="40" height="30"></a>

  </div>

</div>

</div>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" @click="autorizarot(s_tipo)">Autorizar</button>
<button type="button" class="btn btn-danger" @click="rechazar()">Rechazar</button>
<button type="button" class="btn btn-success" v-if="s_tipo ==1">Actualizar</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_fondo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Solicitud de Fondos Fijos</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-2">
          <label>Monto:</label>
        </div>
        <div class="col-2">
          <input type="" name="" class="form-control" v-model="monto_f" readonly="readonly">
        </div>
        <div class="col-2">
          <label>Fecha:</label>
        </div>
        <div class="col-2">
          <input type="" name="" class="form-control" v-model="fecha_f" readonly="readonly">
        </div>
        <div class="col-2">
          <label>Centro:</label>
        </div>
        <div class="col-2">
          <input type="" name="" class="form-control" v-model="cc_f" readonly="readonly">
        </div>
        
      </div>
      <div class="row mt-2">
        <div class="col-2">
          <label>Estado:</label>
        </div>
        <div class="col-2">
          <input type="" name="" class="form-control" v-model="estado_f" readonly="readonly">
        </div>
        <div class="col-2">
          <label>Fiador:</label>
        </div>
        <div class="col-2">
          <input type="" name="" class="form-control" v-model="fiador_f" readonly="readonly">
        </div>
        <div class="col-2">
          <label>Adjunto:</label>
        </div>
        <div class="col-2">
          <a :href="'../'+url_f"><img :src="'../assets/img/pdf.png'" width="40" height="30"></a>
        </div>
        
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" @click="autorizarot(s_tipo)">Autorizar</button>
      <button type="button" class="btn btn-danger">Rechazar</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

    </div>
  </div>
</div>
</div>
<BlockUI :message="msg"  v-if="bloqueo">
<img :src="'../assets/img/745.gif'">

</BlockUI>
</div>
</template>

<script>
export default {
props: ['id_session'],

data(){

  return {
    url_f:'',
    monto_f:'',
    fecha_f:'',
    cc_f:'',
    estado_f:'',
    fiador_f:'',
    id_so:'',
    s_tipo:'',
    v_lugar:'',
    v_pasaje:'',
    v_motivo:'',
    v_beneficiario:'',
    v_fecha_inicio:'',
    v_fecha_termino:'',
    viewviaticos:false,
    viewproductos:false,
    modal_array:[],
    msg2:[],
    archivos:[],
    id_h:'',
    firma_cc:'',
    firma_cr:'',
    firmas:'',
    sigfe_id:'',
    porcentaje_cc:'',
    saldo_cc:'',
    totalcentros:'',
    presupuesto_cc:'',
    totalcentros_1:'',
    presupuesto_cc_1:'',
    bloqueo:false,
    msg: 'Espere un Momento...',
    isLoading: false,
    fullPage: true,
    porcentaje_gastado_cr:'',
    saldo_cr:'',
    gastocentros_1:'',
    presucentros_1:'',
    gastocentros:'',
    presucentros:'',
    id_cc_cr:'',
    idcomprar:'',
    precio_total:'',
    nombre_usuario:'',
    fecha_orden:'',
    centro_res:'',
    contacto:'',
    centro_costo:'',
    year:'',
    numero:'',
    ct_l:0,
    columns_productos: ['pro_id', 'pro_nombre_producto', 'pro_uindad_medida','pro_cantidad','pro_precio','pro_descripcion','pro_justificacion','adjunto','accionnes'],
    data_productos:[],
    options_productos: {
      perPage: 15,
      texts: {
        count: "Mostrando {from} a {to} de {count} registros|{count} registros|Un registro",
        first: 'Primero',
        last: 'Ultimo',
        filter: "Busqueda:",
        filterPlaceholder: "Registro a Buscar",
        limit: "Limite de registros:",
        page: "Pagina:",
        noResults: "No hay registros coincidentes",
        filterBy: "Filtrado por {column}",
        loading: 'Cargando...',
        defaultOption: 'Seleccionar {column}',
        columns: 'Columnas',
      },
      sortIcon: {
        is: "glyphicon-sort",
        base: "glyphicon",
        up: "glyphicon-chevron-up",
        down: "glyphicon-chevron-down"
      },
      headings: {
        pro_id: 'N°',
        pro_nombre_producto: 'Producto',                 
        pro_uindad_medida: 'U.M', 
        pro_cantidad:'Cantidad' ,
        pro_precio:'Precio',
        pro_descripcion:'Descripcion',
        pro_justificacion:'Justificacion',
        adjunto:'Adjunto',
        acciones:'Accion'


      },
      sortable:  ['pro_id', 'pro_nombre_producto'],
      filterable: ['pro_id', 'pro_nombre_producto'],
      editableColumns:['pro_descripcion','pro_justificacion']
    },
    titulomodal:'',
    devol:[],
    viaticos_jt:'',
    id_categoria:'',
    categoria:'',
    columns: ['id','cc_nombre', 'compra_numero', 'compra_amio','fondo','accion'],
    data: [],
    options: {
      perPage: 15,
      texts: {
        count: "Mostrando {from} a {to} de {count} registros|{count} registros|Un registro",
        first: 'Primero',
        last: 'Ultimo',
        filter: "Busqueda:",
        filterPlaceholder: "Registro a Buscar",
        limit: "Limite de registros:",
        page: "Pagina:",
        noResults: "No hay registros coincidentes",
        filterBy: "Filtrado por {column}",
        loading: 'Cargando...',
        defaultOption: 'Seleccionar {column}',
        columns: 'Columnas',
      },
      sortIcon: {
        is: "glyphicon-sort",
        base: "glyphicon",
        up: "glyphicon-chevron-up",
        down: "glyphicon-chevron-down"
      },
      headings: {
        id:'Id',
        cc_nombre: 'Centro de Costo',
        compra_numero: 'N°',                 
        compra_amio: 'Año', 
        fondo:'Categoria',
        accion:'Acciones'                    

      },
      sortable:  ['cc_nombre', 'nombre'],
      filterable: ['cc_nombre', 'nombre'],
    },

  }

},
methods:{
  verpdfviatico(id){
var d=new FormData()
d.append('id',id);
  axios.post('../encriptar',d).then(response=>{
    window.open('../visorpdfarchivos/'+response.data);
  }).catch(err=>{});

  },
  rechazar()
  {
   Swal.fire({
    title: 'Desea rechzar viatico?',          
    icon: 'warning',
    input:'textarea',     

    text:'Debe ingresar un motivo ',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',

    confirmButtonText: 'Aceptar',
    preConfirm: (login) => {}
  }).then((result) => {
    if (result.isConfirmed) {

       this.rechazarSolicitud(this.id_so,result.value)
       this.rechazarfirma(this.id_so)
       this.rechzarviatico(result.value);



    }

  });

},
formateofechasbdhoy()
      {
        const d = new Date();
        var day = d.getDate()
        var month = d.getMonth() + 1
        let year = d.getFullYear()
        var hora=d.getHours();
        var  minuto=d.getMinutes();
        var segundo=d.getSeconds();
        minuto=minuto > 9 ? minuto : '0' + minuto;
        segundo=segundo > 9 ? segundo : '0' + segundo;
        hora=hora > 9 ? hora : '0' + hora;
        month=month > 9 ? month : '0' + month;
        day=day > 9 ? day : '0' + day;
        return `${year}-${month}-${day} ${hora}:${minuto}:${segundo}`
      },
rechzarviatico(obs){

  var url="../viaticos_jt/"+this.numero
  var d={
    v_rechazo_run:this.id_session,
    v_rechazo_fecha:this.formateofechasbdhoy(),
    v_rechazo_obs:obs,
    _method:'patch'
  }
  axios.post(url,d).then(response=>{

  }).catch(err=>{

  });

},
rechazarSolicitud(id,obs)
{
  var url="../solicitudes/"+id
  var d={
    _method:'patch',
    observacion:obs,
    estado:7
  }
  axios.post(url,d).then(response=>{

  }).catch(err=>{

  });

},
rechazarfirma(id)
{
  var d=new FormData();
d.append('solicitud',id)
d.append('usuario',this.id_session)
d.append('estado',7)
axios.post('../firmasolicitudes',d).then(response=>{
 $("#modal_fondo").modal('hide');
        this.getCentroCosto();

}).catch(err=>{

});


},
getarchivos(id)
{
axios.get('../adjuntosots_bd/'+id).then(response=>{
  console.log(response.data);
      //  this.archivos=response.data
      for (var i = 0; i < response.data.length; i++) {

        var d={
          id:response.data[i].id,
          id_producto:response.data[i].id_producto,
          nombre:response.data[i].nombre,
          oc:response.data[i].oc,
          url:response.data[i].url

        }
        this.archivos.push(d);
      }
      
    }).catch(err=>{});
},
autorizarot(tipo)
{
var tipos
if(tipo == 1){
 tipos="OT"
}else if(tipo == 2){
tipos="viatico"
}else if(tipo == 3){
tipos="fondos fijos"

}

Swal.fire({
title: 'Desea autorizar el (la) '+tipos+' N°'+this.numero+'?',          
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Aceptar'
}).then((result) => {
if (result.isConfirmed) {
  this.bloqueo=true;
  var fecha = new Date();
  const dia = fecha.getDate();
        const mes = fecha.getMonth(); // Be careful! January is 0, not 1
        const year = fecha.getFullYear();
        const hora=fecha.getHours();
        const minuto=fecha.getMinutes();
        const segundo=fecha.getSeconds();

        const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
        if(tipo == 1){
         var url="../historials/"+this.id_h;
         var d={
          id:this.id_h,          
          firma_cc:this.id_session,
          fecha_cc:dateString,
          id_estado_timeline:3,
          _method:'patch'
        }
        axios.post(url,d).then(response=>{
          var url2='../compras/'+this.idcomprar;
          var da={
            compra_id:this.idcomprar,
            compra_encargado_cc_rut:this.id_session,
            compra_encargado_cc_aprueba_fecha:dateString,
            compra_estado:3,
            _method:'patch'
          }
          axios.post(url2,da).then(resp=>{
            this.bloqueo=false;
            
            this.updatedsolicitud(this.id_so);
            this.addfirmassolicitud(this.id_so);
            this.getCentroCosto();


          }).catch(err=>{});


          $("#modalaceptar").modal('hide');
        }).catch(err=>{
          this.bloqueo=false;
        });

      }else if(tipo == 2){
        this.updatedsolicitud(this.id_so);
        this.addfirmassolicitud(this.id_so);
        this.getCentroCosto();
            $("#modalaceptar").modal('hide');

      }else if(tipo == 3){
        this.updatedsolicitud(this.id_so);
        this.addfirmassolicitud(this.id_so);
        this.updatesolicitud();
        $("#modal_fondo").modal('hide');
        this.getCentroCosto();

      }



    }

  });

},
updatesolicitud()
{
var url="../fondo_j/"+this.numero;
var d={
  estado:2,
  _method:'patch'
}
axios.post(url,d).then(response=>{

}).catch(err=>{

});
},
updatedsolicitud(id)
{
var url="../solicitudes/"+id
var d={
  estado:4,
  _method:'patch'

}

axios.post(url,d).then(response=>{

}).catch(err=>{

});


},
addfirmassolicitud(id)
{
var d=new FormData();
d.append('solicitud',id)
d.append('usuario',this.id_session)
d.append('estado',3)
axios.post('../firmasolicitudes',d).then(response=>{

}).catch(err=>{

});

},
formatoFecha(fecha, formato) {


},
eliminarproducto(id,nombre,id_cc){
axios.get('../productos/'+id_cc).then(response1=>{
  console.log(response1.data.length);

  if(response1.data.length > 1){
   Swal.fire({
    title: 'Desea Eliminar El Producto '+nombre+'?',          
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar'
  }).then((result) => {
    if (result.isConfirmed) {
      this.bloqueo=true;

      axios.post('../productoupdate',id).then(response=>{
        this.getProductos(id_cc);
        this.bloqueo=false;
        Swal.fire(
          'Excelente !',
          'Se Elimino el producto!',
          'success'
          )




      });

    }

  });


}else{
 Swal.fire({
  title: 'Si Eliminar El Producto se Anular La OT '+ this.numero,          
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Aceptar'
}).then((result) => {
  if (result.isConfirmed) {
    this.bloqueo=true;
    axios.post('../productoupdate',id).then(response=>{

     var da={
      compra_id:id_cc,
      compra_estado:8

    }
    var url2='ordenesdecompra/'+id_cc;
    axios.put(url2,da).then(response2=>{
     $("#modalaceptar").modal('hide');
     this.bloqueo=false;
     this.getCentroCosto();

   });
  });

  }

});




}


});





},
getFirmas(id)
{
axios.get('../firmaot/'+id).then(response=>{
  this.firmas=response.data;

  if(this.firmas.length == 0){
    this.firma_cc="sin firma";
    this.firma_cr="sin firma";

  }
}).catch(err=>{
  this.bloqueo=false;
});
},
updatedescripcion2(id,descripcion,id_cc){
var d={
  pro_id:id,
  pro_justificacion:descripcion,
  _method:'patch'

}
var url='../productos/'+id;
this.bloqueo=true;
axios.post(url,d).then(response=>{
  this.getProductos(id_cc);
  this.bloqueo=false;

});
},
updatedescripcion1(id,descripcion,id_cc){

var d={
  pro_id:id,
  pro_descripcion:descripcion,
  _method:'patch'

}
var url='../productos/'+id;
this.bloqueo=true;
axios.post(url,d).then(response=>{
  this.getProductos(id_cc);
  this.bloqueo=false;

});

},
formatPrice(value) {
let val = (value/1).toFixed(0).replace('.', '.')
return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
},
getPresupuesto(id,id_cc,sigfe){
this.sigfe_id=sigfe;
var cc_pre=new FormData();
cc_pre.append('cc',id_cc);
cc_pre.append('cr',id);
cc_pre.append('sigfe',sigfe);
axios.post('../presupuestoanual',cc_pre).then(response2=>{
 this.presupuesto_cc=response2.data.presupuestocc;
 this.totalcentros=response2.data.g_refrendado;
 this.saldo_cc= this.presupuesto_cc-  this.totalcentros;
 this.porcentaje_cc='% '+Math.round(this.getCalculo_2(this.presupuesto_cc,this.totalcentros) );

 this.presucentros=response2.data.presucr;
 this.gastocentros=response2.data.gastadoot;
 this.saldo_cr=this.presucentros-this.gastocentros;
 this.porcentaje_gastado_cr = this.getCalculo_2(this.presucentros,this.gastocentros);
 this.porcentaje_gastado_cr='% '+ Math.round(this.porcentaje_gastado_cr);

});


},
getGasto(id){

},
getCalculo_2(id,id2){
console.log('id',id)
console.log('id2',id2)
if(id != 0 && id2 !=0){
  var cal=(id2/id)*100;

  console.log('calculo',cal)

}else{
  var cal =0
}



return cal;

},

getCalculo_1(id,id2){

var cal=id-id2;

return cal;

},
verPdf(idpro){
axios.get('../ajuntos_ot/'+this.idcomprar).then(response=>{
  console.log(response.data);

  if(response.data.length === 0){
    Swal.fire(
      'No existe!',
      'No existe documentos adjuntos!',
      'error'
      )

  }else{

    for (var i = 0; i < response.data.length; i++) {

     var fecha=response.data[i].adj_fecha.split("-");
     var y=fecha[0];
     var m=fecha[1];

     var nombre= response.data[i].adj_nombre;
   }
   window.open('../../PDFS/'+y+'/'+m+'/'+nombre,'_blank');

 }

});

},
visualizarnuevo(id,tipo,cc,id_s)
{
this.s_tipo=tipo;
this.id_so=id_s;
this.bloqueo=true;
switch(tipo) {
  case 1:
  this.getordenes(id)
  break;
  case 2:
  this.getViaticos(id)
  break;
  case 3:
  this.getFondo(id_s)
  break;
  default:
  // code block
}



},
getordenes(id,sigfe){
axios.get('../ordenesdecompra/'+id).then(response=>{

  this.titulomodal='Solicitud de Compra';
  this.id_h=response.data[0].id_historial;
  this.year=response.data[0].compra_amio;
  this.numero=response.data[0].compra_numero;
  this.centro_costo=response.data[0].cc_nombre;
  this.centro_res=response.data[0].cr_nombre;
  this.nombre_usuario=response.data[0].per_nombre;
  this.contacto=response.data[0].compra_telefono;
  this.fecha_orden=response.data[0].compra_fecha_enviar;
  this.idcomprar=response.data[0].compra_id;
  this.getFirmas(response.data[0].compra_id);
  this.getProductos(response.data[0].compra_id);
  this.buscarprespuestos(response.data[0].compra_cc,response.data[0].sigfe_presupuesto);
  this.id_cc_cr=id_cc_cr;      
  this.bloqueo=false
  this.viewviaticos=false
}).catch(err=>{
  this.bloqueo=false
});
$("#modalaceptar").modal();

},
visualizar(array,numero,id,year,nombre,usuario,cr_nombre,contacto,fecha,id_compra,id_cc_cr,id_cc,sigfe,historial){
console.log(array);
this.modal_array=array;
this.bloqueo=true;
setTimeout(()=>{

  if(this.ct_l == 0){
    this.titulomodal='Solicitud de Compra';
    this.id_h=historial;
    this.year=year;
    this.numero=numero;
    this.centro_costo=nombre;
    this.centro_res=cr_nombre;
    this.nombre_usuario=usuario;
    this.contacto=contacto;
    this.fecha_orden=fecha;
    this.idcomprar=id_compra;
    this.getFirmas(this.idcomprar);
    this.id_cc_cr=id_cc_cr;


  }

      //this.getPresupuesto(id_cc_cr,id_cc,sigfe);   
      this.buscarprespuestos(id_cc,sigfe);   

      this.getProductos(id_compra);



      ;} , 3000);

$("#modalaceptar").modal();





},
getProductos(id){
this.bloqueo=true
axios.get('../productos/'+id).then(response=>{
  this.viewproductos=true;
  this.precio_total=0;
  this.data_productos=response.data;
  for (var i = 0; i < this.data_productos.length; i++) {
    this.precio_total=parseInt(this.precio_total)+parseInt(this.data_productos[i].pro_total);
    this.getarchivos(this.data_productos[i].pro_id);
  }
  this.precio_total=this.formatPrice(this.precio_total);

  if(this.data_productos.length ==0)
  {
   this.precio_total=0;
 }
 this.bloqueo=false;

});

},
getEncargados_cc(){
axios.get('../encargados_cc/'+this.id_session).then(response=>{
 return this.devol=response.data;

});


},
elegircategoria(event){
this.data=[];
if(this.id_categoria == 1){
  this.ct_l=0;
  this.getCentroCosto();

}else if(this.id_categoria == 2){
 this.ct_l=1;
 this.getViaticos();


}else if(this.id_categoria == 3){
 this.ct_l=2;
 this.getFondo();

}else if(this.id_categoria == 4){
 this.ct_l=3;
 this.getFondo_rendicion();

}

},
getViaticos(id){
var d=new FormData();
d.append('run',this.id_session);
d.append('id',id);
axios.post('../viaticos_jt',d).then(response=>{
 this.viewviaticos=true

 this.titulomodal='Solicitud de Viaticos';
 this.v_motivo=response.data[0].v_motivo;
 this.v_fecha_inicio=response.data[0].v_fecha_inicio;
 this.v_fecha_termino=response.data[0].v_fecha_final;
 this.v_beneficiario=response.data[0].v_nombre;
 this.contacto=response.data[0].per_email;
 if(response.data[0].v_derecho_psje == 2){
  this.v_pasaje="NO";
}else{
 this.v_pasaje="SI";
}
this.v_lugar=response.data[0].prov_nombre+','+response.data[0].reg_nombre;
this.year=response.data[0].v_year;
this.numero=response.data[0].v_num;
this.centro_costo=response.data[0].cc;
this.centro_res=response.data[0].cr;
this.nombre_usuario=response.data[0].per_nombre;
this.precio_total=this.formatPrice(response.data[0].v_d_total)    
this.fecha_orden=response.data[0].v_sistema_fecha;
this.idcomprar=response.data[0].id_doc;
this.getFirmas(response.data[0].id_doc);
this.viewproductos=false;
    //this.getProductos(response.data[0].compra_id);
    this.buscarprespuestos(response.data[0].v_cc,21);
    $("#modalaceptar").modal();
    this.bloqueo=false
  }).catch(eer=>{
    this.bloqueo=false
  }); 

},
getFondo(id){
 axios.get('../fondo_j/'+id).then(response=>{
  this.numero=response.data.id;
  this.s_tipo=response.data.tipo;
  this.monto_f=response.data.monto;
  this.fecha_f=response.data.fecha_ingresada;
  this.cc_f=response.data.nombre;
  this.estado_f='Ingresada'
  this.fiador_f=response.data.nombre_fiador;
  this.url_f=response.data.url;
  $("#modal_fondo").modal();
  this.bloqueo=false


});
},
getgasta(cr,estado,sigfe){
var today = new Date();
var year = today.getFullYear(); 
var d=new FormData();
d.append('year',year)
d.append('familia',sigfe)
d.append('cr',cr)
d.append('estado',estado)
axios.post('../gasta',d).then(response=>{
  this.gastocentros=response.data;
  this.saldo_cr=this.presucentros -this.gastocentros;
  this.porcentaje_gastado_cr='% '+Math.round(this.getCalculo_2(this.presucentros,this.gastocentros) );
}).catch(err=>{});

},  
buscarprespuestos(id,sigfe,cr){
var today = new Date();
var year = today.getFullYear(); 
var d=new FormData();
d.append('cc',id);
d.append('sigfe',sigfe);
d.append('amio',year)
axios.post('../nuevoprespuesto',d).then(response=>{
  if(response.data == ''){
    this.presupuesto_cc=0
    this.sigfe_id=sigfe  
    this.buscartotalprespuestocr(cr)
    this.buscarrefrendacioncc(id,this.sigfe_id);
    this.getgasta(cr,2,this.sigfe_id);


  }else{
    this.presupuesto_cc=response.data.monto;
    this.sigfe_id=response.data.sigfe
    this.buscartotalprespuestocr(response.data.cr)
    this.buscarrefrendacioncc(id,this.sigfe_id);
    this.getgasta(response.data.cr,2,this.sigfe_id);

  }
  

}).catch(err=>{

});

},  
buscarrefrendacioncc(id,sigfe)
{
var today = new Date();
var year = today.getFullYear();   
var d=new FormData();
d.append('cc',id);
d.append('year',year);
d.append('sigfe',sigfe);
axios.post('../refrendacionesgasto',d).then(response=>{
  this.totalcentros=response.data;
  this.saldo_cc=this.presupuesto_cc-this.totalcentros;
  this.porcentaje_cc='% '+Math.round(this.getCalculo_2(this.presupuesto_cc,this.totalcentros));



}).catch(err=>{

});

},  
buscartotalprespuestocr(cr)
{
var today = new Date();
var year = today.getFullYear();  
var d=new FormData();
d.append('cr',cr);
d.append('year',year);
axios.post('../totalcrprespuesto',d).then(response=>{
  this.presucentros=response.data
}).catch(err=>{});

},

getCentroCosto(){
var fecha = new Date();
const dia = fecha.getDate();
        const mes = fecha.getMonth(); // Be careful! January is 0, not 1
        const year = fecha.getFullYear();
        var d=new FormData();
        d.append('run',this.id_session)
        d.append('year',year);
        d.append('estado',3);
        d.append('tipo',2);
        this.bloqueo=true;
        axios.post('../solicitudes2',d).then(response=>{
          this.data=response.data;
          this.bloqueo=false;
          console.log(response.data[0].id_cc);

        }).catch(err=>{
          this.bloqueo=false;
        });
      }
    },
    created:function(){

      this.getCentroCosto();

    },

  }
</script>
