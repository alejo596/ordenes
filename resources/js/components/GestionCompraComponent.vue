<template>
  <div class="container-fluid">
    <div class="card border-success">
      <div class="card-header text-white text-center bg-success"><h5>GESTIÓN DE COMPRAS</h5></div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" @click="verproductosyservicios()">Productos/servicios <i class="fas fa-file"></i></a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="getproductosetapa">Procesos de Compra <i class="fas fa-money-bill"></i></a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Crear CPP</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="busqueda-tab" data-toggle="tab" href="#busqueda" role="tab" aria-controls="busqueda" aria-selected="false">Busqueda CPP</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="listaprocesos-tab" data-toggle="tab" href="#listaprocesos" role="tab" aria-controls="listaprocesos" aria-selected="false">Lista de Procesos</a>
          </li>

        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="row mt-4">
              <div class="col-md-1">
                <label>Tipo de Compra :</label>

              </div>
              <div class="col-3">
                <select class="form-control" v-model="elegiretapa" >
                  <option v-for="e in etapas" :value="e.id">{{e.nombre}} - <span style="color:#FF0000"> dias:{{e.total}}</span></option>


                </select>

              </div>
              <div class="col-2">
                <button class="btn btn-primary" @click="agregaretapa()">Agregar</button>


              </div>
              <div class="col-2  text-right">

                <div class="btn-group btn-group-toggle" data-toggle="button">
                  <label  class="btn btn-success">
                   <input type="checkbox" name="" @click="marcartodas($event)">Marcar Todas
                 </label>
               </div>

             </div>
             <div class="col-4 ">
              <button class="btn btn-info" @click="limpiar()">Limpiar</button>

            </div>

          </div>
          <div class="row">
            <div class="col-12">
              <table class="table table-hover table-bordered mt-4 table-responsive">
                <thead>
                  <tr>
                    <th scope="col">N°</th>
                    <th scope="col">OT</th>
                    <th scope="col">Año</th>
                    <th scope="col">PDF</th>
                    <th scope="col">Nombre Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Valor Unit.</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Justificacion</th>
                    <th scope="col">C.C</th>
                    <th scope="col">C.R.</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Fecha asig.</th>
                    <th scope="col">Adjuntos</th>
                    <th scope="col">Tiempo</th>
                    <th scope="col">Crear Proceso</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="productos.length == 0">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><label>Sin Datos</label></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                  </tr>

                  <tr v-for="(p,index) in productos" :key="index" :class="cambios[index] == 1 ? 'table-success' :''" ref="tr">

                    <td style="font-size: 12px">{{index+1}}</td>
                    <td style="font-size: 12px">{{p.compra_numero}}</td>
                    <td style="font-size: 12px">{{p.pro_amio}}</td>
                    <td style="font-size: 12px"> <a href="#" @click="verpdfs(p.pro_id_oc)"><i class="fas fa-file-pdf fa-4x"></i></a></td>
                    <td style="font-size: 12px">{{p.pro_nombre}}</td>
                    <td style="font-size: 12px">{{formatPrice(p.pro_cantidad)}}</td>
                    <td style="font-size: 12px">{{formatPrice(p.pro_precio)}}</td>
                    <td style="font-size: 12px">{{p.pro_descripcion}}</td>
                    <td style="font-size: 12px">{{p.pro_justificacion}}</td>
                    <td style="font-size: 12px">{{p.cc_nombre}}</td>
                    <td style="font-size: 12px">{{p.cr_nombre}}</td>
                    <td style="font-size: 12px">{{p.usuario}}</td>
                    <td style="font-size: 12px">{{p.fecha_asignar}}</td>
                    <td>
                     <VDropdown >


                      <a href="#" @click="getarchivos(p.pro_id)" ><img :src="'assets/img/pdf.png'" width="50" height="50" ></a>

                      <!-- This will be the content of the popover -->
                      <template #popper>
                        <input type="hidden" class="tooltip-content" v-model="msg2" placeholder="Adjuntos" />
                        <div class="card border-warning">
                          <div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{modal_n_ot}} </div>
                          <div class="card-body">
                            <div class="col-12 container">

                              <carousel>
                                <slide v-for="(ar,index) in archivos" :key="index" v-if="ar.id_producto == p.pro_id">
                                  <a target="_blank" :href="'../storage/app'+ar.url"><img :src="'assets/img/pdf.png'" width="30" height="40" data-toggle="tooltip" data-placement="top"  :title="ar.nombre" ></a>
                                </slide>


                              </carousel>

                            </div>


                          </div>

                        </div>
                        <!-- You can put other components too -->

                      </template>
                    </VDropdown>
                  </td>
                  <td style="font-size: 12px"></td>
                  <td style="font-size: 12px" ><input

                    :name="p.pro_id"
                    type="checkbox"
                    v-model="checkboxVal"
                    :checked="booleanValue"
                    :value="p.pro_id"
                    @click="updateCheckallTABLE($event,p.pro_id_oc,p.pro_id,p.id_historial,index,booleanValue,checkboxVal)"
                    />


                    
                  </td>
                </tr>

              </tbody>
            </table>


          </div>

        </div>



      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

        <div class="card">
          <div  class="card-header text-center text-white"><h5>Procesos de Compra</h5></div>
          <div class="card-body">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">Id</th>  
                  <th scope="col">OT</th>   
                  <th scope="col">Año</th>               
                  <th scope="col">Situacion</th>
                  <th scope="col">Etapa</th>
                  <th scope="col">Fecha</th>

                  <th scope="col" class="col-2">Fecha Limite</th>
                  <th scope="col">Cantidad Productos</th>
                  <th scope="col">N Licitacion</th>
                  <th scope="col">Fecha Inicio</th>
                  <th scope="col">Fecha Termino</th>
                  <th scope="col">Estado</th>
                </tr>
              </thead>

              <tbody>


                <tr v-for="(etapa,index) in eletapas"  v-if="etapa.cantidad != 0" :class="fechahoy > calcularDiastotal2(etapa.created_at,etapa.etapa) ? 'table-danger': '' " @click="procesos(etapa.id,etapa.year,etapa.estado,etapa.observacion,etapa.etapa,etapa.created_at,etapa.compra_numero,etapa.compra_id,etapa.id_licitacion)">


                  <td>{{etapa.id}}</td> 
                  <td>{{etapa.compra_numero}}</td>  
                  <td>{{etapa.year}}</td>               
                  <td>{{verestado(etapa.estado)}}</td>
                  <td>{{getetapas_id(etapa.etapa)}}</td>
                  <td>{{etapa.created_at}}</td>                  
                  <td><div class="row"><div class="col-9">{{calcularDiastotal(etapa.created_at,etapa.etapa)}}</div> <div class="col-1" v-if="fechahoy > calcularDiastotal(etapa.created_at,etapa.etapa)"><i class="fas fa-exclamation-circle"></i></div></div> </td>
                  <td>{{etapa.cantidad}}</td>
                  <td>{{etapa.nombre}}</td>
                  <td>{{etapa.fecha}}</td>
                  <td>{{etapa.fecha_termino}}</td>
                  <td>{{etapa.nombre_estado_licitacion}}</td>
                </tr>
                <tr v-if="eletapas.length == 0">
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td><label>No existen datos </label></td>
                 <td></td>
                 <td></td>
                 <td></td>




               </tr>
             </tbody>
           </table>
           <div class="row">
            <div class="col-4">
              <div class="card">
                <div class="card-header text-white text-center bg-primary">
                  <h5>Leyendas</h5>

                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                      <div style="  width: 30px;
                      height: 30px;
                      -moz-border-radius: 50%;
                      -webkit-border-radius: 50%;
                      border-radius: 50%;
                      background: #f5b7b1;"></div>
                    </div>
                    <div class="col-10">
                      <label>Fuera de la Plazo </label>

                    </div>

                  </div>
                </div>

              </div>

            </div>

          </div>

        </div>

      </div>


    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><crear-cpp :id_session="id_session"></crear-cpp></div>
    <div class="tab-pane fade" id="busqueda" role="tabpanel" aria-labelledby="busqueda-tab"><buscar-cpp :id_session="id_session"></buscar-cpp></div>   
    <div class="tab-pane fade" id="listaprocesos" role="tabpanel" aria-labelledby="listaprocesos-tab"><listar-procesos :id_session="id_session"></listar-procesos></div> 

  </div>

</div>

</div>

<BlockUI :message="msg"  v-if="bloqueo">
  <img :src="'assets/img/745.gif'">

</BlockUI>
<div class="modal fade" id="procesos_modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Procesos de Compras (Detalle de la Compra)  OT N° {{modal_n_ot}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      
       <div class="card border-success">
        <div class="card-header text-white text-center bg-success">
          <h5>Procesos de Compras  </h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-7">
              <div class="card border-primary" >
                <div class="card-header text-white text-white bg-primary"> <h5>Datos Procesos</h5></div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-1">
                      <label>N°</label>

                    </div>
                    <div class="col-1">
                     <label>{{modal_id}}</label>
                   </div>
                   <div class="col-5 text-right">
                    <label >Creacion de Compra</label>

                  </div>
                  <div class="col-5">
                    <label>{{modal_fecha}}</label>
                  </div>

                </div>
                <div class="row mt-3">
                  <div class="col-1">
                    <label>Año</label>

                  </div>
                  <div class="col-1">
                    <label>{{modal_year}}</label>
                  </div>
                  <div class="col-5 text-right">
                    <label >Estado</label>

                  </div>
                  <div class="col-5">
                    <label>{{modal_estado}}</label>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-5">
                    <label>Tipo de Compra:</label>

                  </div>
                  <div class="col-9">
                    <select class="form-control" v-model="elegiretapa2"  disabled="disabled">
                      <option v-for="etp in  etapas" :value="etp.id" :selected="etp.id == elegiretapa2 ? 'selected':''">{{etp.nombre}}</option>
                    </select>
                  </div>

                </div>
                <div class="row mt-3">
                  <div class="col-12">
                    <textarea class="form-control" placeholder="Observacion" v-model="modal_observacion"></textarea>

                  </div>

                </div>

              </div>

            </div>
          </div>
          <div class="col-5">
            <div class="card border-primary">
              <div class="card-header text-center text-white bg-primary"><h5>Licitacion</h5></div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label >N° Licitacion</label>

                  </div>
                  <div class="col-6">
                    <input type="" name="" class="form-control" v-model="modal_licitacion">

                  </div>
                  <div class="col-2">
                    <a @click="buscarlicitacion"><i class="fas fa-search"></i></a>
                  </div>

                </div>
                <div class="row mt-2">
                  <div class="col-4">
                    <label >Estado</label>

                  </div>
                  <div class="col-8">
                    <select class="form-control" v-model="modal_licitacion_estado">
                      <option v-for="esli in estadolic" :value="esli.codigos"  :selected="modal_licitacion_estado == esli.codigos ? 'selected':''">{{esli.nombre}}</option>

                    </select>


                  </div>

                </div>
                <div class="row mt-2">
                  <div class="col-4">
                    <label >Fecha Creacion</label>

                  </div>
                  <div class="col-8">
                    <input type="text" name="" class="form-control" v-model="modal_licitacion_fecha">

                  </div>

                </div>




              </div>

            </div>



          </div>




        </div>

        <div class="row mt-4">
          <div class="col-12">
            <div class="card border-primary">
              <div class="card-header text-white text-center bg-primary"><h5>Lista de Procesos</h5></div>
              <div class="progress mt-2">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" :style="{width:progress +'%'}" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>

              </div>
              <div class="row">
                <div class="col-6">
                  <label class="text-left"><b>Fecha de Inicio: {{modal_fecha_i}}</b></label>
                </div>
                <div class="col-6 text-right">
                  <label ><b> {{progress}} %</b></label>
                </div>

              </div>


              <div class="card-body mt-2">
                <div class="row" >


                  <div class="col-4" v-for="(de_eta,key) in detalle_etapas" >

                   <div class="row mt-2">
                    <div class="col-6">
                      <div class="row">
                        <div class="col-10">
                         <label style="font-size: 12px">{{de_eta.nombre}}</label>
                       </div>
                       <div class="col-2">
                        <input
                        :disabled="disa != key"
                        :name="de_eta.id"
                        type="checkbox"
                        v-model="checkboxValetapa"
                        :checked="booleanValue2"
                        :value="de_eta.id"
                        @change="updateCheckallestapas(de_eta.dias,de_eta.id,de_eta.nombre,key)"
                        />
                      </div>

                    </div>

                  </div>
                  <div class="col-6">
                    <div class="row">
                      <div class="col-12 border border-primary rounded" v-show="de_eta.verificar !=1">
                        <label style="font-size: 12px"> <b>Realizado: </b>{{fecha_realizado[key]}} </label>
                      </div>
                      <div class="col-12 border border-warning rounded mt-2" v-show="de_eta.verificar ==1">
                        <label style="font-size: 12px"> <b>Enviado: </b> {{f_envio}}</label>
                      </div>
                      <div class="col-12 border border-info rounded mt-2" v-show="de_eta.verificar ==1">
                        <label style="font-size: 12px"> <b>Aprobado: </b>{{f_aprobado}}</label>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-12 border border-success rounded">
                        <label style="font-size: 12px"><b> Hasta: </b>{{totaldias[key]}}</label>


                      </div>

                    </div>


                  </div>

                </div> 





              </div>
              <div class="col-2">

              </div>

            </div>

          </div>
        </div>
      </div>

    </div>

    <div class="row mt-2">
      <div class="col-12">
        <div class="card border-primary">
          <div class="card-header text-center text-white bg-primary"><h5>Productos</h5> </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <button class="btn btn-success" @click="crearcpp" v-if="ocultarcpp">Crear CPP</button>
              </div>

            </div>
            <table class="table table-hover mt-2">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Total</th>
                  <th scope="col">Observacion</th>
                  <th scope="col">CPP</th>
                  <th scope="col">Adjuntos</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>

                <tr v-for="(p_cpp,index) in modal_productoscpp" :key="index" :class="p_cpp.pro_estado_producto == 5 ? 'table-success':''">
                  <td>{{index+1}}</td>
                  <td style="font-size: 12px">{{p_cpp.pro_nombre}}</td>
                  <td style="font-size: 12px">{{formatPrice(p_cpp.pro_precio)}}</td>
                  <td style="font-size: 12px">{{formatPrice(p_cpp.pro_cantidad)}}</td>
                  <td style="font-size: 12px">{{formatPrice(p_cpp.pro_total)}}</td>
                  <td style="font-size: 12px">{{p_cpp.pro_justificacion}}</td>
                  <td style="font-size: 12px">{{p_cpp.numero}}</td>
                  <td>

                    <VDropdown >


                      <a href="#" @click="getarchivos(p_cpp.pro_id)" ><img :src="'assets/img/pdf.png'" width="30" height="30" ></a>

                      <!-- This will be the content of the popover -->
                      <template #popper>
                        <input type="hidden" class="tooltip-content" v-model="msg2" placeholder="Adjuntos" />
                        <div class="card border-warning">
                          <div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{modal_n_ot}} </div>
                          <div class="card-body">
                            <div class="col-12 container">
                              <carousel>
                                <slide v-for="(ar,index) in archivos" :key="index" v-if="ar.id_producto == p_cpp.pro_id">
                                  <a target="_blank" :href="'../storage/app'+ar.url"><img :src="'assets/img/pdf.png'" width="30" height="40" data-toggle="tooltip" data-placement="top"  :title="ar.nombre" ></a>
                                </slide>


                              </carousel>

                            </div>


                          </div>

                        </div>
                        <!-- You can put other components too -->

                      </template>
                    </VDropdown>

                    <a href="#"> </a>


                  </td>

                  <td>

                    <div class="row" v-show="p_cpp.pro_estado_producto < 5">
                      <div class="col-4" v-show=" p_cpp.estadocreado == 0">
                       <input
                       :name="p_cpp.pro_id"
                       type="checkbox"
                       v-model="checkboxVal_modal"
                       :checked="booleanValue"
                       :value="p_cpp.pro_id"
                       @change="updateCheckall()"
                       />

                     </div>
                     <div class="col-2" v-show=" p_cpp.estadocreado == 0">
                      <a href="#" @click="eliminarproducto(p_cpp.pro_id,p_cpp.pro_nombre,p_cpp.pro_id_oc,p_cpp.compra_rut_enviar,p_cpp.compra_numero,p_cpp.id_proceso,p_cpp.id_historial)" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fas fa-trash"></i></a>
                    </div>
                    <div class="col-2" v-show=" p_cpp.estadocreado == 0">
                      <a href="#" @click="devolverproducto(p_cpp.pro_id,p_cpp.pro_nombre,p_cpp.id_proceso,p_cpp.pro_id_oc)" data-toggle="tooltip" data-placement="bottom" title="Devolver"><i class="fas fa-undo"></i></a>
                    </div>
                    <div class="col-2">
                      <a href="#"><i class="fas fa-ticket"></i></a>
                    </div>


                  </div>

                  <div v-show="p_cpp.pro_estado_producto == 5 ">
                    <label style="font-size: 12px"><i class="fas fa-exclamation"></i> El Producto se encuentra en estado de refrendacion no se puede devolver o eliminar</label>
                  </div>


                </td>                     
              </tr>                    
            </tbody>
          </table>
          <div class="row">
            <div class="col-3">
              <div class="card border border-primary">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12"><label>LEYENDA</label></div>

                  </div>
                  <div class="row">
                    <div class="col-3">
                      <div class="alert alert-success" role="alert">

                      </div>
                    </div>
                    <div class="col-9">
                      <label>En Refrendacion</label>
                    </div>

                  </div>

                </div>
              </div>

            </div>

          </div>


        </div>  
      </div>

    </div>
  </div>
</div>

</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

  <button type="button" class="btn btn-danger" @click="anulardatosmodal(modal_id)">Anular Proceso</button>
  <button type="button" class="btn btn-primary" @click="guardardatosmodal">Guardar</button>
</div>
</div>
</div>
</div>
<div class="modal fade" id="modal_crearcpp" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center bg-success text-white">
        <h5 class="modal-title " id="exampleModalLabel">CREAR CPP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row mt-2" v-show="modal_licitacion != ''">
        <div class="col-12">
          <div class="alert alert-dark" role="alert">
           <label>LICITACION : {{modal_licitacion}}</label>
         </div>

       </div>

     </div>
     <div class="row">
      <div class="col-12 offset-10">
        <button class="btn btn-warning" @click="crearproveedor()">Crear Proveedor</button>

      </div>

    </div>

    <div class="row mt-2" v-show="ocultarc_provvedor">
      <div class="col-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
          <div class="row">
            <div class="col-2">
              <label>Nombre:</label>
            </div>
            <div class="col-4">
              <input type="" name="" class="form-control" v-model="c_n_proveedor">
            </div>
            <div class="col-2">
              <label>RUN:</label>
            </div>
            <div class="col-4">
              <input type="" name="" class="form-control" v-model="c_r_proveedor" placeholder=" ejemplo 11111111-1" @keyup="validarrun(c_r_proveedor)">
              <div style="background-color:#red;width: 100% " v-show="errorrun">
                <div class="alert alert-danger" role="alert">Run o Rut Invalido</div>

              </div>
            </div>

          </div>
          <div class="row mt-2">
            <div class="col-12 offset-11">
              <button class="btn btn-primary" @click="guardarproveedorcreado()">Guardar Proveedor</button>

            </div>

          </div>
          <button type="button" class="close"  aria-label="Close" @click="ocultarc_proveedor">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="alert alert-warning alert-dismissible fade show" role="alert" v-show="success_proveedor">
          <strong>Proveedor Creado</strong> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

      </div>

    </div>
    <div class="row mt-4">
      <div class="col-2">
        <label>Proveedor</label>

      </div>
      <div class="col-4">
        <input type="" name="" v-model="buscarproveedor" @keyup="buscarpv(buscarproveedor)" class="form-control">
        <div style="z-index: 1;background-color: #fff;position: absolute;width: 100%" v-if="ocultarproveedor">
          <div v-for="lp in listproveedor">
            <span @click="seleccionarpro(lp.id,lp.nombre,lp.run)" class="elecciondeproducto">{{lp.nombre}}</span>
          </div>
        </div>

      </div>
      <div class="col-2">
        <label>Run o Rut:</label>

      </div>
      <div class="col-4">
        <label>{{runproveedor}}</label>

      </div>
      <div>

      </div>
      <input type="hidden" name="" v-model="id_proveedor">
    </div>

    <div  class="row mt-2">
      <div class="col-2">
        <label>observacion:</label>

      </div>
      <div class="col-10">
        <textarea class="form-control" v-model="cpp_observacion">

        </textarea>

      </div>

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" @click="cppcrear">Crear CPP</button>
  </div>
</div>
</div>
</div>

</div>
</template>
<style type="text/css">
  .left {
    position: absolute;
  }
  [v-cloak] {
    display: none;
  }
</style>
<script >
  export default
  {
    props: ['id_session','nombre'],

    data(){

      return {
        estadocreado:0,
        arrasave:[],
        f_envio:'',
        f_aprobado:'',
        progressupdate:0,
        id_etapaot:[],
        fecha_realizado:[],
        fecha_next:'',
        fecha_inicial:'',
        li_id:0,
        observacion_rechazo:'',
        cantidadtotalproducto:'',
        observacion_rechazo:'',
        success_proveedor:false,
        errorrun:false,
        c_n_proveedor:'',
        c_r_proveedor:'',
        ocultarc_provvedor:false,
        estadolic:[],
        fechahoy:'',
        ocultarcpp:false,
        disa:0,
        cpp_observacion:'',
        listproveedor:[],
        modal_licitacion:'',
        modal_licitacion_estado:'',
        modal_licitacion_fecha:'',
        modal_observacion:'',
        etapa_base:'',
        modal_fecha_i:'',
        cambio_tipo_c:0,
        elegidas:[],
        disabled_a:[],
        fecha_i:'',
        fecha_t:'',
        id_pro:'',
        archivos:[],
        modal_n_ot:'',
        checkboxVal_modal:[],
        modal_id_ot:'',
        modal_productoscpp:[],
        modal_year:'',
        modal_estado:'',
        modal_fecha:'',
        modal_id_etapa:'',
        modal_id:'',
        eletapas:[],
        historial:[],
        cambios:[],
        pro_id:'',
        id_oc:'',
        msg2:[],
        filelist: [],
        progress:0,
        totaldias:[],
        checkboxValetapa:[],
        elegiretapa2:'',
        detalle_etapas:[],
        myname2:'',
        newarray:[],
        elegiretapa:'',
        productos:[],
        msg: 'Espere un Momento...',
        bloqueo:false,
        etapas:[],
        checkboxVal:[],
        booleanValue:[],
        booleanValue2:[],
        feriados:[],
        id_comprador:'',
        estadoproceos:[],
        arrayfile:[],
        buscarproveedor:'',
        id_proveedor:'',
        runproveedor:'',
        ocultarproveedor:false,
        detalletapas:[],
        progressos:0,
        id_ots:0,
        l_estado:'',
        f_creacion:'',
        f_termino:'',
        licitacion_id:'',
        fecha1:'',
        fecha2:''

      }
    } ,
    created:function()
    {
      this.getProductos();
      this.getetapas();
      this.getCompador();
      this.getestadoprocesos();
      this.getestadoli();

    },
    mounted()
    {
      this.bloqueo=true;
      axios.get('https://apis.digital.gob.cl/fl/feriados',{ crossdomain: true }).then(response=>{
        this.feriados=response.data;
        console.log(response.data);
        this.bloqueo=false;
      }).catch(err=>{
       this.bloqueo=false;
     });

      const festivos = [[1, 7, 8],[27, 28],[],[],[1],[15],[9],[17, 18, 19],[10],[12, 23],[],[25]];



      const diaPedido = new Date(Date.now());

      const diaEntrega = this.calculaEntrega(diaPedido,11, festivos);

      console.log(`Dia de pedido: ${diaPedido.toString()}`);
      console.log(`Dia de entrega calculado: ${diaEntrega.toString()}`);
      var TuFecha = new Date();
      var fecha = new Date();
      const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString =  dia+ "-" + (mes + 1) + "-" + year;
          this.fechahoy=fecha



          axios.get('comprador/'+this.id_session).then(response=>{
           this.id_comprador=response.data[0].id;
           this.bloqueo=false;
         });



        },
        methods:
        {
         verificarfecha(){

          var d=new FormData();
          d.append('inicio',this.fecha1)
          d.append('dias',this.fecha2)

          axios.post('verificarfe',d).then(response=>{
          }).catch(errr=>{

          });

        },
        limpiar(){
          this.bloqueo=true
          for (var i = 0; i < this.productos.length; i++) {
           this.$set(this.checkboxVal,i,'');
           this.$set(this.cambios,i,0); 


         }
         this.bloqueo=false

       },
       getCompador(){
         axios.get('comprador/'+this.id_session).then(response=>{
           this.id_comprador=response.data[0].id;
         });
       },
       marcartodas(event){
        console.log(event.target.checked)
        for (var i = 0; i < this.productos.length; i++) {
          console.log(this.productos[i].pro_id)
          if(event.target.checked == true){
            this.$set(this.checkboxVal,i,this.productos[i].pro_id);
            this.cambios[i]=1
          }else{
           this.$set(this.checkboxVal,i,'');
           this.$set(this.cambios,i,0); 

         }

       }
       console.log(this.checkboxVal)
     },
     buscarlicitacion()
     {
      this.bloqueo=true
      var url='https://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?codigo='+this.modal_licitacion+'&ticket=73BA60B2-490B-4427-9EDE-3DAEAC8D8942'
      axios.get(url).then(response=>{
        console.log(response.data.Listado[0]['Estado']['Fechas'] ) 
        this.modal_licitacion_estado=response.data.Listado[0]['CodigoEstado']              


        this.modal_licitacion_fecha=this.formateofechasbd(response.data['Listado'][0]['Fechas']['FechaCreacion'])
        this.f_creacion=this.formateofechasbd2(response.data['Listado'][0]['Fechas']['FechaCreacion'])
        this.f_termino=this.formateofechasbd2(response.data['Listado'][0]['Fechas']['FechaCierre'])
        this.bloqueo=false

        console.log(fe)    

      }).catch(err=>{
       this.bloqueo=false
     });

    },
    formateofechasbd(fecha)
    {
     const d = new Date(fecha);
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
     return `${day}-${month}-${year} ${hora}:${minuto}:${segundo}`

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
    return `${year}-${month}-${day}`
  },
  formateofechasbd2(fecha)
  {
    const d = new Date(fecha);
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
  cambiaretapa(id,proceso)
  {
    axios.get('detalleetapas/'+id).then(response=>{
      console.log(response.data.length)

      var cantidad=100/response.data.length;
      this.progressos=this.progressos+cantidad;
      if( this.progressos >100){
       this.progressos=100
     }
     this.progressos=Math.round(this.progressos)
     this.detalletapas=response.data[0]
     this.calcularDias23(response.data[0]['dias'])

     var d=new FormData();
     d.append('detalle',proceso)                  
     d.append('etapa',response.data[0]['id_etapa'])
     d.append('fecha_i',this.fecha_i)
     d.append('detalle_etapa',response.data[0]['id'])
     d.append('fecha_t',this.fecha_t) 
     d.append('comprador',this.id_session)  
     d.append('proceso',this.progressos)
     d.append('estado',0)  

     axios.post('etapasot',d).then(response=>{

     }).catch(errr=>{

     });
   }).catch(errr=>{

   });
 },
 calcularDias23(numero) {


  var TuFecha = new Date();
  var fecha = new Date();
  const dia = fecha.getDate();
  const mes = fecha.getMonth(); 
  const year = fecha.getFullYear();
  const hora=fecha.getHours();
  const minuto=fecha.getMinutes();
  const segundo=fecha.getSeconds();

  const dateString = year + "-" + (mes + 1) + "-" + dia;


  var dias = parseInt(numero);
  this.fecha_i=dateString;

  TuFecha.setDate(TuFecha.getDate() + dias);

  var fechafinal= TuFecha.getDate() + '/' +
  (TuFecha.getMonth() + 1) + '/' + TuFecha.getFullYear();


  var fechafinal2= TuFecha.getFullYear()+ '-' +
  (TuFecha.getMonth() + 1) + '-' + TuFecha.getDate();
  console.log(fechafinal);
  this.fecha_t=fechafinal2;



},
getvalorfecha(fecha){
  return fecha.getTime()
},
anularprocesos(id,mensaje)
{
 var d=new FormData();
 d.append('estado',5)
 d.append('id',id)
 d.append('observacion',mensaje)


 axios.post('procesosu',d).then(response=>{

   var da =new FormData();
   da.append('estado',5);

   da.append('id',id);
   axios.post('etapasot4',da).then(response=>{
     this.anularproductos(id);
   });
 }).catch(err=>{


 }); 
},
anulardatosmodal(id)
{
  console.log(this.modal_observacion.length);


  Swal.fire({
    title: 'Desea Anular el proceso?',          
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
      this.observacion_rechazo=result.value

      var d=new FormData();
      d.append('estado',5)
      d.append('id',id)
      d.append('observacion',this.observacion_rechazo)


      axios.post('procesosu',d).then(response=>{

       var da =new FormData();
       da.append('estado',5);

       da.append('id',id);
       axios.post('etapasot4',da).then(response=>{
         this.anularproductos(id,this.observacion_rechazo);
       });
     }).catch(err=>{


     });

   }

 });

},
anularproductos(id,mensaje)
{
  for (var i = 0; i < this.modal_productoscpp.length; i++) {
    var url="productos/"+this.modal_productoscpp[i].pro_id;
    var d={

      id_proceso:0,
      pro_estado_producto:1,
      pro_observacion:mensaje,
      _method:'patch' 
    }
    axios.post(url,d).then(response=>{}).catch(err=>{});
  }

  this.getproductosetapa();
  $("#procesos_modal").modal('hide');

},
guardarproveedorcreado()
{
 if(this.c_r_proveedor.length == 0 || this.errorrun==true){
  return this.dulcealert('Ingrese un run correcto','error');

}

var d=new FormData();
d.append('nombre',this.c_n_proveedor);
d.append('run',this.c_r_proveedor);
axios.post('proveedores',d).then(response=>{
  this.ocultarc_provvedor=false;
  this.success_proveedor=true;
  this.buscarproveedor=this.c_n_proveedor;
  this.runproveedor=this.c_r_proveedor;
  this.id_proveedor=response.data;

}).catch(errr=>{});

},
validarrun(run){
  var c=this.validaRut(run);
  if(run.length >7)
  {
   if(c == true){
    this.errorrun=false;
  }else{
    this.errorrun=true;
  }
}
console.log(c);
},
validaRut: function(rutCompleto) 
{
  rutCompleto = rutCompleto.replace("‐","-");
  if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
    return false;
  var tmp     = rutCompleto.split('-');
  var digv    = tmp[1];
  var rut     = tmp[0];
  if ( digv == 'K' ) digv = 'k' ;

  return (this.dv(rut) == digv );
},
dv : function(T)
{
  var M=0,S=1;
  for(;T;T=Math.floor(T/10))
    S=(S+T%10*(9-M++%6))%11;
  return S?S-1:'k';
},
ocultarc_proveedor()
{
 this.ocultarc_provvedor=false;
},
crearproveedor(){
  this.ocultarc_provvedor=true;
},
getestadoli()
{
  axios.get('estadoli').then(response=>{
    this.estadolic=response.data
  }).catch(err=>{

  });
},
verpdfs(id)
{
  var d=new FormData();
  d.append('id',id);
  axios.post('encriptar',d).then(response=>{
    window.open("pdfs/"+response.data);
  }).catch(err=>{
  });
},
updatelicitacion(id)
{
  var url='licitacion/'+this.licitacion_id
  var d={
   cpp:id,
   _method:'patch'
 }
 axios.post(url,d).then(response=>{

 }).catch(err=>{});

},
cppcrear()
{

  console.log(this.checkboxVal_modal);
  var total=0;

  for (var i = 0; i < this.modal_productoscpp.length; i++) {
    if(this.modal_productoscpp[i].pro_id == this.checkboxVal_modal[i]){
     total=total+(this.modal_productoscpp[i].pro_precio*this.modal_productoscpp[i].pro_cantidad);
   }

 }
 this.bloqueo=true;
 var c=new FormData();
 c.append('year',this.modal_year);
 c.append('proveedor',this.id_proveedor);
 c.append('oc',0);
 c.append('total_neto',total);
 c.append('iva',0);
 c.append('total',total);
 c.append('descuento',0);
 c.append('despacho',0);
 c.append('impuesto',0);
 c.append('usuario',this.id_session);
 c.append('observacion',this.cpp_observacion);
 c.append('id_licitacion',this.licitacion_id)
 c.append('id_comprador', this.id_comprador)
 c.append('tipo',7);
 axios.post('compromiso',c).then(response=>{
   this.updatelicitacion(response.data)
   this.addproductos(response.data);
   this.getproductossincpp(this.modal_id);
   this.addarchivos(response.data);

   this.bloqueo=false;

   axios.get('compromiso/'+response.data).then(respocpp=>{
    this.dulcealert('Se creo el CPP N°'+respocpp.data.numero,'success')
    $("#modal_crearcpp").modal('hide');

  }).catch(err=>{});


 }).catch(err=>{
  this.bloqueo=false;
});


},
addarchivos(id){


  for (var i = 0; i < this.archivos.length; i++) {
   var a=new FormData();
            a.append('tipo',1);
            a.append('nombre',this.archivos[i].nombre);          
            a.append('url',this.archivos[i].url);
            a.append('id',id);
            axios.post('adjuntosdocu2',a).then(response=>{
              this.nuevos_archivos.splice(i,1)
            }).catch(err=>{

            });
          }

},
addproductos(id)
{


 console.log(this.modal_productoscpp);
 for (var i = 0; i < this.modal_productoscpp.length; i++) {
  var total=0;
  if(this.modal_productoscpp[i].pro_id == this.checkboxVal_modal[i]){
   total=total+(this.modal_productoscpp[i].pro_precio*this.modal_productoscpp[i].pro_cantidad);
   this.checkboxVal_modal.splice(i,1);

   this.modal_productoscpp[i].estadocreado=1

   var url='productos/'+this.modal_productoscpp[i].pro_id;
   var d={
    pro_id_cpp:id,
    pro_costo_unitario_incluye_todo:total,
    _method:'patch'
  }
  axios.post(url,d).then(response=>{

  }).catch(error=>{

  });
}

}
},
seleccionarpro(id,nombre,run)
{
 this.buscarproveedor=nombre;
 this.id_proveedor=id;
 this.ocultarproveedor=false;
 this.runproveedor=run;

},
buscarpv(id)
{
  if(id.length > 5){
    axios.get('proveedores/'+id).then(response=>{
      this.listproveedor=response.data;
      this.ocultarproveedor=true;

    }).catch(err=>{

    });


  }


},
crearcpp()
{
  if(this.checkboxVal_modal.length == 0)
  {
    return this.dulcealert('Debe ingresar un producto','error');

  }else{

    $("#modal_crearcpp").modal();

  }


},
eliminarproducto(id,nombre,compra_id,usuario_ot,compra_numero,id_proceso,id_historial)
{


 Swal.fire({
  title: 'Desea eliminar productos N°'+ id+ ' nombre:'+ nombre,  
  input:'textarea',        
  icon: 'warning',
  text:'Debe ingresar un motivo ',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',

  confirmButtonText: 'Aceptar',
  preConfirm: (login) => {}

}).then((result) => {
  if (result.isConfirmed) {
   console.log(result)
   this.observacion_rechazo=result.value;

   if(this.cantidadtotalproducto <= 1){

    Swal.fire({
      title: 'Si elimina el ultimo producto la OT se anulara',          
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
    }).then((result) => {
      if (result.isConfirmed) {
       var url="productos/"+id;
       var d={
        pro_estado_producto:9,
        pro_comprador:0,
        pro_observacion:this.observacion_rechazo,
        _method:'patch'
      }
      axios.post(url,d).then(response=>{
                  // var obsot=new FormData();
                  // obsot.append('ot',compra_id)
                  // obsot.append('observacion',result.value.login)
                  // axios.post('observacion_ot',obsot).then(responseobser=>{
       var fecha = new Date();
       const dia = fecha.getDate();
       const mes = fecha.getMonth(); 
       const year = fecha.getFullYear();
       const hora=fecha.getHours();
       const minuto=fecha.getMinutes();
       const segundo=fecha.getSeconds();

       const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
       var urlcompra="compras/"+compra_id
       var dar={
        compra_estado:8,
                    // id_observacion:responseobser.data,
        compra_anulada_por:this.id_session,
        compra_motivo_anulacion:this.modal,
        compra_fecha_anulacion:dateString,
        _method:'patch'


      }

      axios.post(urlcompra,dar).then(responseot=>{
        this.notificaciones(compra_id,this.observacion_rechazo,usuario_ot,nombre,compra_numero);
        this.anularprocesos(id_proceso,this.observacion_rechazo)
        this.getproductossincpp(compra_id);
        this.cerrarlineadetiempo(id_historial)
        $("procesos_modal").modal("hide")

      }).catch(err=>{

      })

                // }).catch(errot=>{

                // });

    }).catch(err=>{

    });

  }

});

  }else{
   var url="productos/"+id;
   var d={
    pro_estado_producto:9,
    pro_comprador:0,
    pro_observacion:this.observacion_rechazo,
    _method:'patch'
  }
  axios.post(url,d).then(response=>{
    this.getproductossincpp(compra_id);

  }).catch(err=>{

  });

}

}

});

},
cambiolineadetiempo(id,estado)
{
  var fecha = new Date();
  const dia = fecha.getDate();
  const mes = fecha.getMonth(); 
  const year = fecha.getFullYear();
  const hora=fecha.getHours();
  const minuto=fecha.getMinutes();
  const segundo=fecha.getSeconds();

  const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
  var url='historials/'+id;
  var d={
    id_estado_timeline:estado,
    _method:'patch',
    firma_jcompras:this.id_session,
    fecha_jcompras:dateString


  }

  axios.post(url,d).then(response=>{}).catch(err=>{});

},
cerrarlineadetiempo(id)
{
 var fecha = new Date();
 const dia = fecha.getDate();
 const mes = fecha.getMonth(); 
 const year = fecha.getFullYear();
 const hora=fecha.getHours();
 const minuto=fecha.getMinutes();
 const segundo=fecha.getSeconds();

 const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
 var url='historials/'+id;
 var d={
  id_estado_timeline:8,
  _method:'patch',
  fecha_anular:dateString
}

axios.post(url,d).then(response=>{}).catch(err=>{});

},

notificaciones(compra_id,modal_observacion,usuario_ot,nombre,compra_numero){
  var d=new FormData();
  d.append('ot',compra_numero);
  d.append('usuario_ot',usuario_ot);
  d.append('nombre_pro',nombre);
  d.append('observacion',modal_observacion)
  d.append('usuario',this.id_session)
  d.append('estado',1)
  d.append('accion','anulo')

  axios.post('notificaciones',d).then(response=>{}).catch(errr=>{});

},
devolverproducto(id,nombre,id_proceso,compra_id)
{


  Swal.fire({
    title: 'Desea devolver productos N°'+ id+ ' nombre:'+ nombre,          
    input:'textarea',        
    icon: 'warning',
    text:'Debe ingresar un motivo ',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',         
    confirmButtonText: 'Aceptar',
    preConfirm: (login) => {}

  }).then((result) => {
    if (result.isConfirmed) {
     this.observacion_rechazo=result.value
     var url="productos/"+id;
     var d={
      pro_estado_producto:1,
      pro_comprador:0,
      pro_observacion:this.observacion_rechazo,
      _method:'patch'
    }
    axios.post(url,d).then(response=>{
      this.getproductossincpp(compra_id);

      if(this.modal_productoscpp.length <= 1){
        this.anularprocesos(id_proceso,this.observacion_rechazo)
        $("#procesos_modal").modal('hide')
      }

    }).catch(err=>{

    });
  }

});

},

verestado(id)
{
  for (var i = 0; i < this.estadoproceos.length; i++) {
    if(this.estadoproceos[i].id == id)
    {
      return this.estadoproceos[i].nombre
    }
  }

},
getestadoprocesos()
{
 axios.get('estadoproceso').then(response=>{
   this.estadoproceos=response.data;
 });
},
getetapas_id(id)
{
  for (var i = 0; i < this.etapas.length; i++) {
    if(this.etapas[i].id == id){
     return this.etapas[i].nombre;
   }
 }

},

calculaEntrega(diaPedido, diasPactados, festivos) {

  let diaPropuesto = new Date(diaPedido.getFullYear(), diaPedido.getMonth(), diaPedido.getDate());


  let i = 1;


  while (diasPactados > 0 ) {

    let festivo = false;

    diaPropuesto = new Date(diaPedido.getFullYear(), diaPedido.getMonth(), diaPedido.getDate() + i);


    if (diaPropuesto.getDay() > 0 && diaPropuesto.getDay() < 6) {


      let m = diaPropuesto.getMonth();
      let dia = diaPropuesto.getDate();


      for (let d in festivos[m]) {
        if (dia === festivos[m][d]) {
          festivo = true;

          break;
        }
            } // Fin bucle for

            if (!festivo) {

              diasPactados--;
            }
          }


          i++;
    } // Fin de bucle while

    return diaPropuesto;

  } ,
  updateetapa()
  {
    var urlh='etapasot/'+this.modal_id_ot;
    var da={
      etapa:this.etapa_base,
      estado:1,
      _method:'patch'
    }
    axios.post(urlh,da).then(resp=>{ 

    }).catch(er=>{

    });




  },
  guardardatosmodal()
  {
    if(this.cambio_tipo_c == 1 ){
     this.updateetapa();
   }

   if(this.modal_licitacion.length == 0){
     this.addlicitacion(this.modal_id)
   }else if(this.li_id != 0){
    this.updatelictacion(this.li_id)

  }

  
  if(this.modal_observacion.length == 0){
    this.bloqueo=true
    var url="procesosu"
    var d=new FormData();
    d.append('observacion',this.modal_observacion)
    d.append('etapa',this.elegiretapa2)
    d.append('id',this.modal_id)

    axios.post(url,d).then(response=>{
      this.bloqueo=false
    }).catch(err=>{
      this.bloqueo=false
    });

  }else{
    this.bloqueo=true
    var url="procesosu"
    var d=new FormData();
    d.append('observacion',this.modal_observacion)
    d.append('etapa',this.elegiretapa2)
    d.append('id',this.modal_id)

    axios.post(url,d).then(response=>{
      this.bloqueo=false
    }).catch(err=>{
      this.bloqueo=false
    });

  }



},
updatelictacion(id)
{
  this.bloqueo=true
  var url="licitacion/"+id
  var d={
    nombre:this.modal_licitacion,
    fecha:this.f_creacion,
    fecha_termino:this.f_termino,
    codigo:this.modal_licitacion_estado,
    _method:'patch'

  }
  axios.get(url,d).then(response=>{
   this.bloqueo=false
 }).catch(err=>{
  this.bloqueo=false
});

},
addlicitacion(proceso)
{

  this.bloqueo=true;

  var d=new FormData();
  d.append('oc',this.modal_n_ot)
  d.append('cpp',0)
  d.append('nombre',this.modal_licitacion)
  d.append('termino',this.f_termino)
  d.append('inicio',this.f_creacion)
  d.append('codigo',this.modal_licitacion_estado)
  axios.post('licitacion',d).then(response=>{
   var url='procesosu';
   var da=new FormData()
   da.append('id_licitacion',response.data);
   da.append('id',proceso);



   axios.post(url,da).then(response1=>{
     this.dulcealert('Datos Guardados','success');
     this.bloqueo=false;
   }).catch(errr=>{
     this.bloqueo=false;
   });

 }).catch(err=>{
   this.bloqueo=false;
 });

},
postproceso(id)
{


  var d=new FormData();
  d.append('id',id)
  d.append('estado',2);
  axios.post('procesosu',d).then(response=>{
    this.modal_estado=this.verestado(2);

  }).catch(err=>{});
},
async verificarprocesos(id,index)
{
  this.bloqueo=true
  await axios.get('procesos5/'+id).then(responsepo=>{

    this.f_envio=responsepo.data.fecha_envio
    this.f_aprobado=responsepo.data.fecha_jefatura
    if(this.f_aprobado != null){
     this.checkboxValetapa.push(this.detalle_etapas[index].id)
     this.bloqueo=false
   }else{
    this.disa=this.elegidas.length-1
  }
  this.bloqueo=false


}).catch( err=>{
  this.bloqueo=false
});


},
getetapasots(id,id2)
{

  axios.get('detalleetapas/'+id2).then(response1=>{
    this.detalle_etapas=response1.data;

    this.totaldias=[];
    this.checkboxValetapa=[]
    this.progress=0;
    this.id_etapaot=[]
    this.fecha_realizado=[]
    var d=new FormData();
    d.append('id',id)
    d.append('etapa',id2)
    axios.post('etapasot6',d).then(response=>{
     if(response.data.length > 0){
      this.ocultarcpp=true

    }

    this.elegidas=response.data
    this.disa=this.elegidas.length

    for (var i = 0; i < this.detalle_etapas.length; i++) {
      for (var j = 0; j < this.elegidas.length; j++) {
        if(this.elegidas[j].detalle_etapa ==this.detalle_etapas[i].id)
        {

          this.fecha_i=this.elegidas[0].fecha_inicio;
          if(this.elegidas[j].proceso != 0){
            if(this.detalle_etapas[i].verificar ==1){
             this.verificarprocesos(id,i)
             

           }else{
             this.checkboxValetapa.push(this.detalle_etapas[i].id)
           }
         }
         
         this.progress=this.progress+this.elegidas[j].proceso;
         if(this.progress >100){
        this.progress=100
         }
         this.totaldias[i]=this.elegidas[j].fecha_termino;
         this.id_etapaot[i]=this.elegidas[j].id;
         this.fecha_realizado[i]=this.elegidas[j].fecha_realizado;

       }
     }
   }

 }).catch(err=>{

 });

}).catch(err=>{

});


},
getarchivos(id)
{
  axios.get('adjuntosots_bd/'+id).then(response=>{
    this.archivos=response.data;
  }).catch(err=>{});
},
updateCheckall()
{

},
getproductossincpp(id){
  this.bloqueo=true;
  this.modal_productoscpp=[]
  axios.get('productos_comprador_scpp/'+id).then(response=>{
   this.modal_productoscpp=response.data

   for (var i = 0; i < this.modal_productoscpp.length; i++) {
    if( this.modal_productoscpp[i].pro_id_cpp != 0 ){
     this.modal_productoscpp[i].estadocreado=1
   }else{
     this.modal_productoscpp[i].estadocreado=0
   }

   axios.get('adjuntosots_bd/'+response.data[i].pro_id).then(reponsearchivo=>{
    this.archivos.push(reponse.data);
    this.arrayfile[i].archivos=this.archivos;

    console.log('files',this.arrayfile);

  }).catch(err=>{

  });
}



 // for (var i = 0; i < this.modal_productoscpp.length; i++) {
 //   this.getarchivos(this.modal_productoscpp[i].pro_id);
 // }

this.bloqueo=false;
}).catch(err=>{
  this.bloqueo=false;

});

},
getproductosetapa()
{
  this.bloqueo=true;

  if(this.id_comprador != null || this.id_comprador == ''){
   axios.get('procesos/'+this.id_comprador).then(response=>{

    this.eletapas=response.data;
    this.bloqueo=false;
  }).catch(err=>{
    this.bloqueo=false;

  });

}else{
 location.reload();
}


},
formatPrice(value) {
  let val = (value/1).toFixed(0).replace('.', '.')
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
},
verproductosyservicios()
{
 this.getProductos(); 
},
onChange() {
  this.filelist = [this.$refs.file.files];
},
remove(i) {
  this.filelist.splice(i, 1);
},
dragover(event) {
  event.preventDefault();
      // Add some visual fluff to show the user can drop its files
  if (!event.currentTarget.classList.contains('bg-green-300')) {
    event.currentTarget.classList.remove('bg-gray-100');
    event.currentTarget.classList.add('bg-green-300');
  }
},
dragleave(event) {
      // Clean up
  event.currentTarget.classList.add('bg-gray-100');
  event.currentTarget.classList.remove('bg-green-300');
},
drop(event) {
  event.preventDefault();
  this.$refs.file.files = event.dataTransfer.files;
      this.onChange(); // Trigger the onChange event manually
      // Clean up
      event.currentTarget.classList.add('bg-gray-100');
      event.currentTarget.classList.remove('bg-green-300');
    },
    calcularDiastotal2(inicial,etapa){
      for (var i = 0; i < this.etapas.length; i++) {
        if(this.etapas[i].id ==etapa)
        {
          var total=this.etapas[i].total
        }
      }
      var TuFecha = new Date(inicial);
  //dias a sumar
      var dias = parseInt(total);
      for (var i = 0; i < dias; i++) {

      }
      console.log('fecha cambia',TuFecha.setDate(TuFecha.getDate() + dias));
  //nueva fecha sumada

      TuFecha.setDate(TuFecha.getDate() + dias);
  //formato de salida para la fecha
      var fechafinal= TuFecha.getDate() + '/' +
      (TuFecha.getMonth() + 1) + '/' + TuFecha.getFullYear();


      var fechafinal2= TuFecha.getFullYear()+ '-' +
      (TuFecha.getMonth() + 1) + '-' + TuFecha.getDate();
      var fecha_aux = fechafinal.split("/");
      var Fecha1 = new Date(parseInt(fecha_aux[2]),parseInt(fecha_aux[1]-1),parseInt(fecha_aux[0]));
      console.log('fecha total2',Fecha1);
      return Fecha1

    },
    calcularDiastotal(inicial,etapa){
      for (var i = 0; i < this.etapas.length; i++) {
        if(this.etapas[i].id ==etapa)
        {
          var total=this.etapas[i].total
        }
      }
      var TuFecha = new Date(inicial);
  //dias a sumar
      var dias = parseInt(total);
      for (var i = 0; i < dias; i++) {

      }
      console.log('fecha cambia',TuFecha.setDate(TuFecha.getDate() + dias));
  //nueva fecha sumada
      TuFecha.setDate(TuFecha.getDate() + dias);
  //formato de salida para la fecha
      var fechafinal= TuFecha.getDate() + '-' +
      (TuFecha.getMonth() + 1) + '-' + TuFecha.getFullYear();


      var fechafinal2= TuFecha.getFullYear()+ '-' +
      (TuFecha.getMonth() + 1) + '-' + TuFecha.getDate();
      console.log('fecha total',fechafinal);
      return fechafinal

    },
    async  calcularDias(numero,index) {
     var TuFecha = new Date();
     var fecha = new Date();
     const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia;
          var dias = parseInt(numero);
          this.fecha_i=dateString;
          this.fecha_realizado[index]=dateString

          var d=new FormData();
          d.append('inicio',dateString)
          d.append('dias',numero)

          await axios.post('verificarfe',d).then(response=>{
           this.fecha_t=response.data

         }).catch(err=>{

         });
/*

  //la fecha
      var TuFecha = new Date();
      var fecha = new Date();
      const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia;

  //dias a sumar
          var dias = parseInt(numero);
          this.fecha_i=dateString;
          this.fecha_realizado[index]=dateString
  //nueva fecha sumada
          TuFecha.setDate(TuFecha.getDate() + dias);
  //formato de salida para la fecha
          var fechafinal= TuFecha.getDate() + '-' +
          (TuFecha.getMonth() + 1) + '-' + TuFecha.getFullYear();


          var fechafinal2= TuFecha.getFullYear()+ '-' +
          (TuFecha.getMonth() + 1) + '-' + TuFecha.getDate();
          console.log(fechafinal);
          this.fecha_t=fechafinal2;

          this.$set(this.totaldias,index+1,fechafinal);*/

       },
       calcular(id,fecha)
       {
  //la fecha
        var TuFecha = new Date(fecha);

  //dias a sumar
        var dias = parseInt(id);

  //nueva fecha sumada
        TuFecha.setDate(TuFecha.getDate() + dias);
  //formato de salida para la fecha
        return TuFecha.getDate() + '/' +
        (TuFecha.getMonth() + 1) + '/' + TuFecha.getFullYear();
      },

      updateCheckallestapas(dias,id,nombre,index)
      {

        Swal.fire({
          title: 'Desea ingresar  la etapa de :'+ nombre+'?',
          showDenyButton: true,
          confirmButtonText: 'Agregar',
          denyButtonText: `Cancelar`,
        }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
           this.disa=index+1;

           Swal.fire('Agregado!', '', 'success')
           var cantidad=100/this.detalle_etapas.length;
           this.progressupdate=cantidad;
           if( this.progressupdate >100){
             this.progressupdate=100
           }
           if(index >=0){
            this.ocultarcpp=true

          }

          this.progress=this.progress+this.progressupdate
          if( this.progress >100){
           this.progress=100
         }
         this.progress=Math.round(this.progress)
         this.progressupdate=Math.round(this.progressupdate)
         console.log(cantidad);
         var TuFecha = new Date();
         var fecha = new Date();
         const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia;
          var dias = parseInt(this.detalle_etapas[index].dias);
          this.fecha_i=dateString;
          this.fecha_realizado[index]=dateString

          var d=new FormData();
          d.append('inicio',dateString)
          d.append('dias',this.detalle_etapas[index].dias)


          /*this.calcularDias(this.detalle_etapas[index].dias,index);*/
        axios.post('verificarfe',d).then(response=>{
                 this.fecha_t=response.data
          var d=new FormData();
          d.append('detalle',this.modal_id)  
          d.append('oc',this.modal_id_ot)       
          d.append('etapa',this.elegiretapa2)
          d.append('fecha_i',this.fecha_i)
          d.append('detalle_etapa',this.detalle_etapas[index].id)
          d.append('fecha_t',this.fecha_t) 
          d.append('comprador',this.id_session)  
          d.append('proceso',   this.progressupdate)
          d.append('estado',0)  

          axios.post('etapasot',d).then(response=>{
            this.postproceso(this.modal_id);
            var urlh='etapasot5';


            const dateString =this.formateofechasbdhoy()
            var da=new FormData();

            da.append('fecha_realizado',dateString)
            da.append('proceso',this.progressupdate)

            da.append('id',this.id_etapaot[index])

            axios.post(urlh,da).then(resp=>{
             this.getetapasots(this.modal_id,this.elegiretapa2)
           }).catch(er=>{

           });
           if(this.cambio_tipo_c == 1){        

             var urlhtic="historialtcompra/"+this.modal_id;
             var datos={
              tipo_compra:this.elegiretapa2,
              fecha_inicio:dateString,
              _method:'patch'
            }
            axios.post(urlhtic,datos).then(r=>{
              this.cambio_tipo_c=0;


            }).catch(err=>{

            });

          }
          this.disabled_a[index]=true;
        }).catch(err=>{});
            }).catch(err=>{

          });
        } else if (result.isDenied) {
          this.checkboxValetapa.splice(index,1);
        }
      })

      },
      sumardias(hoy,dias)
      {
        hoy.setDate(hoy.getDate() + dias);
        return hoy;
      },
      calcularDiasmas(numero,index,fecha) {
  //la fecha
        var TuFecha = new Date();
        var fecha = new Date();
        const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia;

  //dias a sumar
          var dias = parseInt(numero);
          this.fecha_i=dateString;
          this.fecha_inicial=new Date(fecha);
  //nueva fecha sumada
          this.fecha_inicial.setDate(this.fecha_inicial.getDate() + dias);
  //formato de salida para la fecha
          var fechafinal= this.fecha_inicial.getDate() + '/' +
          (this.fecha_inicial.getMonth() + 1) + '/' + this.fecha_inicial.getFullYear();


          var fechafinal2= this.fecha_inicial.getFullYear()+ '-' +
          (this.fecha_inicial.getMonth() + 1) + '-' + this.fecha_inicial.getDate();
          console.log(fechafinal);
          this.fecha_t=fechafinal2;
          this.fecha_next=fechafinal2;
          this.$set(this.totaldias,index,fechafinal);

        },
        seleeatapa(){
          this.bloqueo=true;
          axios.get('detalleetapas/'+this.elegiretapa2).then(response=>{
            this.detalle_etapas=response.data;
            this.totaldias=[];
            this.checkboxValetapa=[]
            this.fecha_termino=[]
            this.fecha_realizado=[]
            this.f_aprobado=''
            this.f_envio=''
            this.progress=0;
            this.disa=''

            this.cambio_tipo_c=1;
            if(this.etapa_base == this.elegiretapa2){
              this.cambio_tipo_c=0;
              this.getetapasots(this.modal_id,this.etapa_base);
              this.bloqueo=false
            }else{
              this.bloqueo=false
            }
          }).catch(err=>{
            this.bloqueo=false
          });

        },
        procesos(id,year,estado,observacion,etapa,fecha,numero,oc,id_licitacion)
        {
          if(oc =='undefined'){
            location.reload()

          }
          this.licitacion_id=id_licitacion
          this.getetapasots(id,etapa)
          this.modal_n_ot=oc;
          this.modal_year=year;
          this.modal_estado=this.verestado(estado);
          this.modal_fecha=fecha;
          this.elegiretapa2=etapa;
          this.etapa_base=etapa;
          this.modal_id=id;
          this.modal_id_ot=oc;
  // this.id_pro=id_pro;
          this.modal_fecha_i=fecha;
          this.modal_observacion=observacion
          this.getproductossincpp(id);
          if(id_licitacion != null){
            this.getlictacion(id_licitacion);
          }


          axios.get('productoscantidad/'+this.modal_id_ot).then(response=>{
            this.cantidadtotalproducto=response.data[0]['TOTAL'];
          }).catch(err=>{

          });
  // this.getarchivos(id_pro);

          $('#procesos_modal').modal();
        },
        agregaretapaproductos()
        {

        },
        getlictacion(id){
          axios.get('licitacion/'+id).then(response=>{
            this.modal_licitacion=response.data.nombre
            this.modal_licitacion_estado=response.data.codigo
            this.modal_licitacion_fecha=response.data.fecha
            this.li_id=response.data.id
          }).catch(err=>{});

        },
        agregaretapa()
        {
    // var index = this.checkboxVal.indexOf(5);
  // console.log(index);

          if(this.checkboxVal.length == 0){
            return this.dulcealert('Debe seleccionar un producto','error');

          }
          if(this.elegiretapa == ''){
           return this.dulcealert('Debe seleccionar un tipo de compra','error');

         }
         if(this.checkboxVal.length == 1){
          console.log('solo');
          console.log(this.checkboxVal[0]);
          this.pro_id=this.checkboxVal[0];
          var fecha = new Date();
          const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
          var d=new FormData();    
          d.append('etapa',this.elegiretapa);          

          d.append('estado',1);
          d.append('id_comprador',this.id_comprador);
          d.append('year',year);

          this.bloqueo=true;
          axios.post('procesos',d).then(response=>{
            this.cambiaretapa(this.elegiretapa,response.data);
            var url='productos/'+this.pro_id  
            
            var da={
              pro_id:this.pro_id,
              pro_estado_producto:2,
              id_proceso:response.data,
              _method:'patch'
            }
            this.addloghistorial(response.data,this.pro_id);
            axios.post(url,da).then(respomse=>{

             this.checkboxVal.splice(0, 1);
             this.dulcealert('Se creo el proceso','success');
             this.getProductos();

           }).catch(err=>{
            this.bloqueo=false;
          });


         }).catch(err=>{
          this.bloqueo=false;
        });

       }else{

        var d=new FormData();
        var fecha = new Date();
        const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          d.append('etapa',this.elegiretapa);    
          d.append('estado',1);
          d.append('id_comprador',this.id_comprador);
          d.append('year',year);
          axios.post('procesos',d).then(response=>{           

            for (var i = 0; i < this.checkboxVal.length; i++) {
              this.pro_id=this.checkboxVal[i];


              const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
              this.bloqueo=true; 
              var url='productos/'+this.pro_id      
              var d={
                pro_id:this.pro_id,
                pro_estado_producto:2,
                id_proceso:response.data,
                _method:'patch'
              }
              this.addloghistorial(response.data,this.pro_id);
              axios.post(url,d).then(respomse=>{

                this.checkboxVal.splice(i,1);
                if(i == this.checkboxVal.length){
                  this.dulcealert('Se agrego al comprador','success');
                  this.getProductos();
                  this.bloqueo=false;

                }


              }).catch(err=>{
                this.bloqueo=false;
              });



            }// fin del for
          }).catch(err=>{
            this.bloqueo=false;
          });

        }



      },
      addloghistorial(proceso,idproducto)
      {
        var d=new FormData();
        d.append('proceso',proceso)
        d.append('id_producto',idproducto)
        d.append('estado',0)
        axios.post('loghistorial',d).then(response=>{

        }).catch(err=>{});

      },
      updateCheckallTABLE(event,id,id2,historial_,index,booleanValue,arra)
      {
        console.log(this.arrasave);
        if( event.target.checked == true){
         this.$set(this.cambios,index,1); 
       }else{
        this.$set(this.cambios,index,0); 
      }
      console.log(this.arrasave)
      console.log(event.target.value, event.target.checked)   
    },
    handleClick() {

      this.$refs.poppernav.click();
    },
    getProductos()
    {
      this.bloqueo=true;
      axios.get('productos_comprador/'+this.id_session).then(response=>{
        this.productos=response.data;
        for (var i = 0; i < this.productos.length; i++) {
          this.cambios[i]=0
          this.arrasave.push(this.productos[i].pro_id);
        }
        this.bloqueo=false;
      }).catch(err=>{
        this.dulcealert('Error de carga de productos','error');
        this.bloqueo=false;

      });
    },
    getetapas()
    {
      axios.get('etapas').then(response=>{
        this.etapas=response.data;

      }).catch(err=>{

      });
    },
    dulcealert(text,icono)
    {
      Swal.fire({
        icon: icono,

        text: text,

      })


    },
    formatoFecha(fecha, formato) {
      const map = {
        dd: fecha.getDate(),
        mm: fecha.getMonth() + 1,
        yy: fecha.getFullYear().toString().slice(-2),
        yyyy: fecha.getFullYear()
      }

      return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched])
    }
  }

}      

</script>