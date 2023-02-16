<template>
<div class="container-fluid">
	<div class="card border-primary">
		<div class="card-header text-center text-white bg-primary">Asignar Solicitud de Trabajo o Compra </div>
		<div class="card-body">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a  @click="listarOT(1)" class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">DIRECCION <span class="badge " :class="bag_direcion == 0 ? 'badge-success' : 'badge-danger'">{{bag_direcion}}</span></a>
					<a  @click="listarOT(2)" class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">SDRYF <span class="badge " :class="bag_sdryf == 0 ? 'badge-success':'badge-danger'">{{bag_sdryf}}</span></a>
					<a @click="listarOT(3)" class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">SDGA <span class="badge " :class="bag_sdga == 0 ? 'badge-success':'badge-danger'">{{bag_sdga}}</span></a>
					<a @click="listarOT(4)" class="nav-link" id="nav-sdr-tab" data-toggle="tab" href="#nav-sdr" role="tab" aria-controls="nav-contact" aria-selected="false">SDRRHH <span class="badge " :class="bag_sdrrhh == 0 ? 'badge-success':'badge-danger'">{{bag_sdrrhh}}</span></a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

					<v-client-table class="mt-2" :columns="columns_direccion" v-model="data_direccion" :options="options_direccion">
						<div slot="id" slot-scope="props">
							{{props.index}}
						</div>
						<div slot="acciones" slot-scope="props">
							<a href="#" @click="editarot(props.row.compra_id,props.row.compra_numero,props.row.compra_amio,props.row.compra_telefono,props.row.compra_jefatura_sub_aprueba_fecha,props.row.compra_convenio,props.row.cc_nombre,props.row.per_nombre,props.row.cr_nombre,props.row.id_historial,props.row.compra_correo)"> <i class="fas fa-edit"></i></a>

						</div>

					</v-client-table>

				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					
					<v-client-table class="mt-2" :columns="columns_direccion" v-model="data_direccion" :options="options_direccion" >
						<div slot="id" slot-scope="props">
							{{props.index}}
						</div>
						<div slot="acciones" slot-scope="props">
							<a href="#" @click="editarot(props.row.compra_id,props.row.compra_numero,props.row.compra_amio,props.row.compra_telefono,props.row.compra_jefatura_sub_aprueba_fecha,props.row.compra_convenio,props.row.cc_nombre,props.row.per_nombre,props.row.cr_nombre,props.row.id_historial,props.row.compra_correo)"> <i class="fas fa-edit"></i></a>

						</div>

					</v-client-table>
				</div>
				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

					<v-client-table  class="mt-2" :columns="columns_direccion" v-model="data_direccion" :options="options_direccion">
						<div slot="id" slot-scope="props">
							{{props.index}}
						</div>
						<div slot="acciones" slot-scope="props">
							<a href="#" @click="editarot(props.row.compra_id)"> <i class="fas fa-edit"></i></a>

						</div>

					</v-client-table>
				</div>
				<div class="tab-pane fade" id="nav-sdr" role="tabpanel" aria-labelledby="nav-sdr-tab">
					
					<v-client-table  class="mt-2" :columns="columns_direccion" v-model="data_direccion" :options="options_direccion">
						<div slot="id" slot-scope="props">
							{{props.index}}
						</div>
						<div slot="acciones" slot-scope="props">
							<a href="#" @click="editarot(props.row.compra_id,props.row.compra_numero,props.row.compra_amio,props.row.compra_telefono,props.row.compra_jefatura_sub_aprueba_fecha,props.row.compra_convenio,props.row.cc_nombre,props.row.per_nombre,props.row.cr_nombre,props.row.id_historial,props.row.compra_correo)"> <i class="fas fa-edit"></i></a>

						</div>

					</v-client-table>
				</div>
			</div>

		</div>

	</div>
	<!-- Modal -->
	<div class="modal fade" id="asignarot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
		<div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1550px !important;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Solicitud de Compra N° {{nuot}} Año {{yeot}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-6">
								<div class="card border-primary">
									<div class="card-header bg-primary text-white text-center">Orden de Compra N° {{nuot}}</div>
									<div class="card-body">
										<div class="row">
											<div class="col-6">
												<label >Nombre Usuario:</label>

											</div>
											<div class="col-6">
												<label>{{edit_persona}} </label>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<label>CC:</label>

											</div>
											<div class="col-6">
												<label>{{edit_centro}}</label>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<label>Telefono:</label>

											</div>
											<div class="col-6">
												<label>{{edit_fono}}</label>
											</div>

										</div>
										<div class="row mt-2">
											<div class="col-6">
												<label >Sub Dirección:</label>

											</div>
											<div class="col-6">
												<label>{{edit_cr_nombre}} </label>
											</div>

										</div>
										<div class="row">
											<div class="col-6">
												<label>	Feche :</label>

											</div>
											<div class="col-6">
												<label>{{edit_fecha}}</label>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<label>Convenio:</label>

											</div>
											<div class="col-6">

												<!-- <toggle-button @change="onChangeEventHandler($event)" :value="valor_check" :labels="{checked: 'SI', unchecked: 'NO'}" :color="{checked: '#38c172', unchecked: '#FF0000', disabled: '#CCCCCC'}"    /> -->
												<div class="alert alert-primary" role="alert" v-show="ocultarmensaje">
                                                     Con Convenios
                                               </div>
                                               <div class="alert alert-warning" role="alert" v-if="ocultarmensaje ==false">
                                                     Sin Convenios
                                               </div>
											</div>

										</div>

									</div>

								</div>
								
							</div>
							<div class="col-6">
								<div class="card border-primary">
									<div class="card-header text-center text-white bg-primary">Firmas</div>
									<div class="card-body">
										<table class="table table-hover">
											<thead>
												<tr>

													<th scope="col">Id</th>
													<th scope="col" style="font-size: 12px">Unidad/Dep./Sub. Direccion</th>
													<th scope="col" style="font-size: 12px">Nombre</th>
													<th scope="col" style="font-size: 12px">Fecha</th>
													
												</tr>
											</thead>
											<tbody>
												<tr v-for="(f,index) in firmas" :key="index">
													<th scope="row">{{index+1}}</th>
													<td style="font-size: 16px"><em>{{f.servicio}}</em></td>
													<td style="font-size: 16px"><em>{{f.nombre}}</em></td>
													<td style="font-size: 16px"><em>{{f.fecha}}</em></td>
													
												</tr>
												
											</tbody>
										</table>
									</div>

								</div>
								
							</div>
							
						</div>

						<div class="row mt-2">
							<div class="col-12">
								<div class="card border-success">

									<div class="card-header bg-success text-center text-white"><h3>Productos</h3></div>
									<div class="card-body">
										<div class="row offset-6">
											<div class="col-4">
												<label class="mt-1">Asignar a todos los productos </label>
												
											</div>
											<div class="col-4">
												<input type="" name=""  class="form-control" v-model="funcionarios_compra"  placeholder="buscar comprador" @blur="visblelista == false" @keyup="buscarfuncionario()">
												<div style="background-color: #ffff;z-index: 1;width: 100%;position: absolute;height: 110px;overflow: scroll;" v-show="visblelista">
													<div v-for="li in listapersonas1">
														<span class="elecciondeproducto" @click="seleccionpersona1(li.per_id,li.per_nombre,li.id)"> {{li.per_nombre}} </span>
													</div>
													<input type="hidden" name="" v-model="id_persona1">
													
												</div>
												
											</div>
											<div class="col-2">
												<button class="btn btn-success" @click="agregarcheck()" >Aceptar</button>
												
											</div>
											<div class="col-2">
												<button class="btn btn-info"  @click="limpiareleccion">Limpiar</button>
												
											</div>
										</div>
										<table class="table table-hover mt-2">
											<thead>
												<tr>
													<th scope="col" style="font-size: 12px">N°</th>
													<th scope="col" style="font-size: 12px">Nombre Producto</th>
													<th scope="col" style="font-size: 12px">Cantidad</th>
													<th scope="col" style="font-size: 12px">Precio</th>
													<th scope="col" style="font-size: 12px">Descripcion</th>
													<th scope="col" style="font-size: 12px">Justificacion</th>
													<th scope="col" style="font-size: 12px">Adjunto</th>
													<th scope="col" style="font-size: 12px">Check</th>
													<th scope="col" style="font-size: 12px">Asignar</th>
													<th scope="col" style="font-size: 12px">Eliminar</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="(p,index) in productos" :key="p.pro_id" :class="p.pro_comprador != null ?'table-primary' : ''" :ref="'color'+p.pro_id">
											
													<td>{{index+1}}</td>
													<td style="font-size: 12px">{{p.pro_nombre}}</td>
													<td>{{p.pro_cantidad}}</td>
													<td>{{formatPrice(p.pro_precio)}}</td>
													<td style="font-size: 12px">
														<textarea v-model="p.pro_descripcion" cols="40" class="form-control" rows="5" :disabled="p.pro_comprador != null">

														</textarea>
													</td>
													<td style="font-size: 12px">
														<textarea v-model="p.pro_justificacion"  class="form-control" cols="40" rows="5" :disabled="p.pro_comprador != null">
															
														</textarea>

														
													</td>
													<td>

														
														<VDropdown
														:triggers="['hover']"
														:popperTriggers="['hover']"
														:autoHide="false"
														>

														<a href="#"><img :src="'assets/img/pdf.png'" width="50" height="50" ></a>

														<!-- This will be the content of the popover -->
														<template #popper>
															<input type="hidden" class="tooltip-content" v-model="msg2" placeholder="Adjuntos" />
															<div class="card border-warning">
																<div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{nuot}} </div>
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

													<a href="#"> </a>


													


												</td>
												<td >

													<input v-if="p.pro_comprador == null" 
													:name="p.pro_id"
													type="checkbox"
													v-model="checkboxVal"
													:checked="booleanValue"
													:value="p.pro_id"
													@change="updateCheckall()"
													/>

													<i class="fas fa-check-circle" v-if="p.pro_comprador != null" ></i>

												</td>
												
												<td> 


													<input style="font-size: 12px" type=""  :name="`productos[${index}][pro_comprador]`" v-model="p.nombre_comprador" class="form-control" :disabled="p.pro_comprador != null" @keyup="buscarfuncionario2(p.nombre_comprador,index)">
													<div style="background-color: #ffff;width: 40%;z-index: 1;position: absolute; height: 110px;overflow: scroll;" v-show="visblelista2[index]">
														<div   v-for="per in  personal2[index]">

															<span class="elecciondeproducto" @click="seleccion2(per.per_id,per.per_nombre,index,per.id,p.pro_id)" style="font-size: 12px">{{per.per_nombre}}</span>
														</div>

													</div>

													<input type="hidden" name="" v-model="id_persona2[index]">
													<input type="hidden" name="" v-model="rut_comprador1[index]">
												</td>
												<td><a v-if="p.pro_comprador == null" href="#" @click="anularot(1,p.pro_nombre,index,p.pro_id)"><i class="fas fa-trash"></i></a></td>

											</tr>

										</tbody>
									</table>

								</div>

							</div>

						</div>

					</div>




				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-danger" @click="anularot(0,nuot,0,0,0)">Anular</button>
				<button type="button" class="btn btn-primary" @click="agegarComprador()">Agregar Comprador</button>
			</div>
		</div>
	</div>
</div>
<BlockUI :message="msg"  v-if="bloqueo">
	<img :src="'assets/img/745.gif'">

</BlockUI>
<div class="modal fade" id="anular" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ANULAR</h5>
				<button type="button" class="close" @click="cerrarmodal"aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card border-primary">
					<div class="card-header text-center text-white bg-primary">{{tituloeliminar}}</div>
					<div class="card-body">
						<div class="row">
							<div class="col-2">
								<label>Para:</label>										
							</div>
							<div class="col-10">
								<input type="" name="" class="form-control" v-model="correoremitente">
							</div>

						</div>
						<div class="row mt-2">
							<div class="col-2">
								<label>Asunto:</label>

							</div>
							<div class="col-10">
								<input type="" name="" class="form-control" v-model="asunto" readonly="readonly">

							</div>

						</div>
						<div class="row mt-2">
							<div class="col-12">
								<textarea class="form-control">

								</textarea>

							</div>

						</div>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" @click="cerrarmodal()">Cerrar</button>
				<button type="button" class="btn btn-primary">Grabar</button>
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
</style>
<script >
export default
{
	props: ['id_session'],

	data(){

		return {
			ocultarmensaje:false,
			checked:true,
			cuentapro_bd:0,
			cuentapro_sel:0,
			estado_compra:0,
			lista_add_comprador:[],
			rut_comprador:'',
			rut_comprador1:[],
			msg2:[],
			archivos:[],
			hist:'',
			elecioncr:'',
			flag_up:'',
			up_id:'',
			up_nombre:'',
			up_index:'',
			asunto:'',
			correoremitente:'',
			tituloeliminar:'',
			id_persona2:[],
			visblelista2:[],
			personal2:[],
			funcionario2:[],
			bloqueofuncionario:false,
			isCheckAll: false,
			checkboxVal:[],
			booleanValue:[],

			id_persona1:'',
			visblelista:false,
			listapersonas1:[],
			adjuntos:[],
			checked2:[],
			productos:[],
			firmas:[{
				servicio:null,
				nombre:null,
				fecha:null,

			},{
				servicio:null,
				nombre:null,
				fecha:null,
			}
			],
			funcionarios_compra_id:'',
			funcionarios_compra:'',
			valor_check:false,
			valor_check_convenio:0,
			edit_cr_nombre:'',
			edit_persona:'',
			edit_id:'',
			edit_centro:'',
			edit_fecha:'',
			edit_convenio:'',
			edit_fono:'',
			nuot:'',
			yeot:'',
			msg: 'Espere un Momento...',
			bloqueo:false,

			bag_direcion:'',
			bag_sdryf:'',
			bag_sdga:'',
			bag_sdrrhh:'',
			columns:['id','centro','nombre','fecha','hora'],
			data:[],
			option:
			{				
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
					id: 'Id',
					centro: 'Centrosde Costos',                 
					nombre: 'Nombbre', 						
					fecha :'Fecha' ,
					hora:'Hora'                    

				},
				sortable:  ['compra_numero', 'compra_amio','id'],
				filterable: ['compra_numero', 'compra_amio','id'],
			},
			columns_direccion:['id','compra_numero','compra_amio','estado_nombre','cc_nombre','acciones'],
			data_direccion:[],
			options_direccion:{				
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
					id: 'Id',
					compra_numero: 'OC',                 
					compra_amio: 'Año', 						
					cc_nombre :'Centros de Costos' ,
					estado_nombre:'Estado',
					accion:'Acciones'                    

				},
				sortable:  ['compra_numero', 'compra_amio','id'],
				filterable: ['compra_numero', 'compra_amio','id'],
			},

		}
	} ,
	created:function()
	{
		
	},
	watch:{

	},
	mounted()
	{
		
		this.listarOT(1);
		this.bloqueo=true;
		for (var i = 1; i <= 4; i++) {

			if(i == 1)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_direcion=response.data.length;

				}).catch(err=>{

				}); 
			}else if(i == 2)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_sdryf=response.data.length;

				}).catch(err=>{

				}); 
			}else if(i == 3)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_sdga=response.data.length;

				}).catch(err=>{

				});
			}else if(i == 4)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_sdrrhh=response.data.length;
					this.bloqueo=false;
				}).catch(err=>{

				});
			}

		}

	},
	methods:
	{
		getarchivos(id)
		{
			axios.get('adjuntosots_bd/'+id).then(response=>{
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
		cerrarmodal(){
			if(this.flag_up== 0){
				$("#asignarot").modal();
				$("#anular").modal('hide');

			}else{
				$("#asignarot").modal();
				$("#anular").modal('hide');
			}


		},
		anularot(flag,numero,inx,id){
			if(flag == 0){
				this.flag_up=flag;
				this.tituloeliminar="Mensaje de Correo (Anular O.T. N° "+numero+")";
				this.asunto="Rechazo de O.T. N°"+numero;

				$("#asignarot").modal('hide');
				$("#anular").modal();

			}else{
				this.flag_up=flag;
				this.up_id=id;
				this.up_nombre=numero;
				this.up_index=inx;
				this.tituloeliminar="Mensaje de Correo (Anular producto N° "+numero+")";
				this.asunto="Rechazo de producto N°"+id;
				$("#asignarot").modal('hide');
				$("#anular").modal();	
			}

		},
		anularotcompleta(id)
		{
			this.bloqueo=true;
			var url='compra/'+id;
			var url2='actualizarporot/'+id;
			var d={
				_method:'patch',
				compra_estado:8,
				compra_id:id
			}
			var da={
				_method:'patch',
				pro_estado_producto:9

			}

			axios.post(url,d).then(response=>{
				axios.post(url2,da).then(res=>{

				}).catch(err=>{});
			}).catch(errr=>{
				this.bloqueo=false;
			});

		},
		elimnarproducto()
		{				

			this.bloqueo=true;
			var url='productos/'+this.up_id;
			var d={
				pro_estado_producto:9,
				pro_id:this.up_id,
				_method:'patch'
			}
			this.productos.splice(this.up_index,1)
			axios.post(url,d).then(response=>{
				this.flag_up='';
				this.up_id='';
				this.up_nombre='';
				this.up_index='';
				this.bloqueo=false;
			}).catch(erro=>{
				this.bloqueo=false;
			});



		},

		seleccion2(id,nombre,index,id2,id_pro)
		{
			console.log(id2)
			this.productos[index].pro_comprador=id2
			this.checkboxVal.push(id_pro);
			this.rut_comprador1[index]=id;
			this.id_persona2[index]=id2;
			this.productos[index].nombre_comprador=nombre;
			this.$set(this.visblelista2,index,false);

		},
		buscarfuncionario2(nombre,index)
		{
			
			if(nombre.length >3)
			{
				axios.get('comprador/'+nombre).then(response=>{
					this.$set(this.personal2,index,response.data);
					this.$set(this.visblelista2,index,true);
				}).catch(err=>{

				});
			}
		},
		updateCheckall()
		{
			if(this.productos.length == this.checkboxVal.length )
			{
				this.isCheckAll = true;
				

			}else{
				this.isCheckAll = false;
			}
		},
		agregarcheck()
		{
			if(this.id_persona1 == ''){
				return this.dulcealert('Debe ingresar un comprador para marcar todas','error');

			}

			Swal.fire({
				title: 'Desea Agregar Todas Solicitudes?',          
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) => {
				if (result.isConfirmed) {
					this.isCheckAll = !this.isCheckAll;

					if(this.isCheckAll){

						for (var i = 0; i < this.productos.length; i++) 
						{
							this.checkboxVal.push(this.productos[i].pro_id);   
							this.productos[i].nombre_comprador=this.funcionarios_compra;
							this.productos[i].pro_comprador=this.id_persona1
							this.id_persona2[i]=this.id_persona1;
							this.rut_comprador1[i]=this.rut_comprador;
						}
						this.bloqueofuncionario=true;

					}

					console.log(this.checkboxVal.length)

				}

			});


			
			
		},
		crearhistoria(id,estado,actividad){
			var d=new FormData();
			d.append('id_compra',id)
			d.append('estado',estado)
			d.append('actividad',actividad)
			d.append('usuario',this.id_session)
			axios.post('historialdecompras2',d).then(response=>{

			}).catch(err=>{

			});


		},
		agegarComprador(array)
		{
			

			if(this.checkboxVal.length == 0){
				return this.dulcealert('Debe ingresar Un Producto','error');

			}

			Swal.fire({
				title: 'Desea Agregar Comprador?',          
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
					const mes = fecha.getMonth(); 
					const year = fecha.getFullYear();
					const hora=fecha.getHours();
					const minuto=fecha.getMinutes();
					const segundo=fecha.getSeconds();

					const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
					console.log(this.checkboxVal)
					for (var i = 0; i < this.productos.length; i++) {
						if(this.productos[i].crud == 1){
							this.cuentapro_bd++
						}
						if(this.productos[i].crud == 0){
							this.cuentapro_sel++	
						}


						console.log(this.productos[i].crud);
						console.log(this.cuentapro_sel);

						if(this.productos[i].crud == 0){

							if(this.productos[i].pro_comprador != null  ){

								this.addasignar(this.productos[i].pro_id,this.productos[i].pro_comprador,this.edit_id)
								var url='productos/'+this.productos[i].pro_id;
								var p ={
									_method:'patch',
									pro_descripcion:this.productos[i].pro_descripcion,
									pro_comprador:this.productos[i].pro_comprador,
									pro_justificacion:this.productos[i].pro_justificacion,
									pro_id:this.productos[i].pro_id,
									pro_estado_producto:1
								}
								axios.post(url,p).then(response=>{
									this.bloqueo=false;

								}).catch(err=>{
									this.bloqueo=false;

								});



							}


						}
					}//fin del for
					var suma =this.cuentapro_bd+this.cuentapro_sel
					console.log('suma +++',suma)
					console.log('largo',this.productos.length)
					if(suma < this.productos.length){
						console.log('comprador parcial')
                        this.getProductos(this.edit_id);// compador parcail
                        this.cambiolineadetiempo(this.hist,8)

                        this.crearhistoria(this.edit_id,8,4);
                        this.updacompra(this.edit_id,8,0);
                        this.listarOT(this.elecioncr)
                        this.listarContadortreal(this.elecioncr)
                        $("#asignarot").modal('hide');
                    }else{
                    	console.log('comprador Completo')
                    	this.crearhistoria(this.edit_id,8,3);
                    	this.cambiolineadetiempo(this.hist,8)
                    	this.updacompra(this.edit_id,8,1);
                    	this.listarOT(this.elecioncr)
                        this.listarContadortreal(this.elecioncr)
                        $("#asignarot").modal('hide');

                    }


					/*for (var i = 0; i < this.productos.length; i++) {
						if(this.lista_add_comprador.length > 0 ){
						   	   if(this.lista_add_comprador[i] != this.productos[i].pro_id ){// cuando existe un datos y necesita agragar los demas 
						   	   	console.log(this.productos[i].pro_id)

						   	   	var url='productos/'+this.productos[i].pro_id;
						   	   	var p ={
						   	   		_method:'patch',
						   	   		pro_descripcion:this.productos[i].pro_descripcion,
						   	   		pro_comprador:this.id_persona2[i],
						   	   		pro_justificacion:this.productos[i].pro_justificacion,
						   	   		pro_id:this.productos[i].pro_id,
						   	   		pro_estado_producto:1
						   	   	}
						   	   	this.addasignar(this.productos[i].pro_id,this.id_persona2[i],this.edit_id)
						   	   	axios.post(url,p).then(response=>{
                                   this.bloqueo=false;

						   	   	}).catch(err=>{
						   	   		this.bloqueo=false;

						   	   	});



						   	   }
						   	  

						   	   this.bloqueo=false;

						   	}else if(this.lista_add_comprador.length==0 ){

                                if(this.checkboxVal[i] == this.productos[i].pro_id)
                                {
                                		var url='productos/'+this.productos[i].pro_id;
						   	   	var p ={
						   	   		_method:'patch',
						   	   		pro_descripcion:this.productos[i].pro_descripcion,
						   	   		pro_comprador:this.id_persona2[i],
						   	   		pro_justificacion:this.productos[i].pro_justificacion,
						   	   		pro_id:this.productos[i].pro_id,
						   	   		pro_estado_producto:1
						   	   	}
						   	   	this.addasignar(this.productos[i].pro_id,this.id_persona2[i],this.edit_id)

						   	   	axios.post(url,p).then(response=>{
                                       this.bloqueo=false;

						   	   	}).catch(err=>{
						   	   		this.bloqueo=false;

						   	   	});


                                }
						   	}

						   }// findel for*/
					 //  var total= parseInt(this.lista_add_comprador.length)+parseInt(this.checkboxVal.length)

					 // if(total < this.productos.length){


					 	
					 // 		var url="compras/"+this.edit_id;

						// 	var oc={
						// 		compra_id:this.edit_id,
						// 		compra_estado:8,
						// 		_method:'patch'
						// 	}  
						// 	this.crearhistoria(this.edit_id,8,3);// asignada compradro completo        					
						// 	axios.post(url,oc).then(response=>{
						// 		this.bloqueo=false;
						// 		this.getProductos();
						// 		this.cambiolineadetiempo(this.hist,8)
						// 	}).catch(errr=>{
						// 		this.bloqueo=false;

						// 	});


						// }else if(total == this.productos.length){
						// 	var url="compras/"+this.edit_id;

						// var oc={
						// 	compra_id:this.edit_id,
						// 	compra_estado:8,
						// 	_method:'patch'
						// } 
						// this.crearhistoria(this.edit_id,8,4);// asignada compradro parcial         					
						// axios.post(url,oc).then(response=>{
						// 	this.bloqueo=false;
						// 	this.getProductos(this.edit_id);
						// 	this.cambiolineadetiempo(this.hist,6)

						// }).catch(errr=>{
						// 	this.bloqueo=false;

						// });


						// }

                }//fin alert

            });





},
updacompra(id,estado,actividad){

var url="compras/"+id;

var oc={
	compra_id:id,
	compra_estado:estado,
	id_actividad:actividad,
	_method:'patch'
} 
		    //this.crearhistoria(this.edit_id,8,4);// asignada compradro parcial         					
		    axios.post(url,oc).then(response=>{

		    }).catch(err=>{

		    });

		},
		addasignar(id,comprador,ot)
		{

			var d=new FormData();
			d.append('usuario',this.id_session)
			d.append('ot',ot)
			d.append('pro_id',id)
			d.append('id_comprador',comprador)

			axios.post('proasignar',d).then(response=>{

			}).catch(err=>{});

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
		agregartodassinpreguntar()
		{
			this.isCheckAll =false;

			if(this.isCheckAll){

				for (var i = 0; i < this.productos.length; i++) 
				{
					this.checkboxVal.push(this.productos[i].pro_id);   
				}

			}else{
				this.checkboxVal=[];
				this.bloqueofuncionario=false;
				this.funcionarios_compra=''
				this.id_persona1=''
				for (var i = 0; i < this.productos.length; i++) {
					this.productos[i].nombre_comprador='';
					this.productos[i].id_persona2='';
				}
			}
		},
		buscarfuncionario()
		{
			if(this.funcionarios_compra.length > 4){
				axios.get('comprador/'+this.funcionarios_compra).then(response=>{
					this.listapersonas1=response.data;
					this.visblelista=true;
				}).catch(err=>{

				});
			}
		},
		seleccionpersona1(id,nombre,id2)
		{
			this.id_persona1=id2;
			this.funcionarios_compra='';
			this.funcionarios_compra=nombre;
			this.rut_comprador=id;
			this.visblelista=false;

		},
		limpiareleccion()
		{
			this.isCheckAll = false;
			this.agregartodassinpreguntar();
		},
		getadjuntosot()
		{
			axios.get('adjuntosots_bd/'+this.edit_id).then(response=>{
				this.adjuntos=response.data;

			}).catch(err=>{

			});
		},
		handleClick() {

			this.$refs.poppernav.click();
		},
		formatPrice(value) {
			let val = (value/1).toFixed(0).replace('.', '.')
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		},
		getProductos()
		{  


			axios.get('productos/'+this.edit_id).then(response=>{


				this.productos=response.data;

				this.lista_add_comprador=[]
				for (var i = 0; i < this.productos.length; i++) {
					this.getarchivos(this.productos[i].pro_id);
					if(this.productos[i].pro_comprador != null)
					{
						console.log(this.productos.length)
						this.lista_add_comprador.push(this.productos[i].pro_id);

					}


				}
				this.bloqueo=false;
			}).catch(err=>{
				this.dulcealert('_Error','error');
				this.bloqueo=false;
			});


		},
		getFirmas(id)
		{
			axios.get('historials/'+id).then(response=>{
				console.log(response.data['fecha_cc']);

				if(response.data['firma_cc'] != null)
				{
					this.gestpersonas(response.data['firma_cc']);
					this.firmas[0].fecha=response.data['fecha_cc'];
				}
				if(response.data['firma_sub'] != null)
				{
					this.gestpersonas2(response.data['firma_sub']);
					this.firmas[1].fecha=response.data['fecha_sub'];
				}



			}).catch(err=>{
				this.bloqueo=false;
			});
		},
		async gestpersonas2(id)
		{
			await axios.get('persona/'+id).then(response=>{
				console.log(response.data[0].per_nombre);
				this.firmas[1].nombre=response.data[0].per_nombre;


			}).catch(err=>{
				this.dulcealert('Error','error');

			});
		},
		async gestpersonas(id)
		{
			await axios.get('persona/'+id).then(response=>{
				console.log(response.data[0].per_nombre);
				this.firmas[0].nombre=response.data[0].per_nombre;


			}).catch(err=>{
				this.dulcealert('Error','error');

			});
		},
		dulcealert(text,icono)
		{
			Swal.fire({
				icon: icono,

				text: text,

			})


		},
		editarot(id,numero,year,fono,fecha,convenio,centro,per_nombre,cr_nombre,id_historial,correo)
		{
          
			this.bloqueo=true;
			this.getFirmas(id_historial);
			this.correoremitente=correo;
			this.firmas[0].servicio=centro;
			this.firmas[1].servicio=cr_nombre;
			this.hist=id_historial;


			this.edit_id=id;
			this.edit_fono=fono;
			this.edit_fecha=fecha;
			this.edit_convenio=convenio;
			this.edit_centro=centro;
			this.nuot=numero;
			this.yeot=year;
			this.edit_persona=per_nombre;
			this.edit_cr_nombre=cr_nombre;
			this.getProductos();
			if(convenio == 0)
			{
				this.ocultarmensaje=false;
			}else{
				this.ocultarmensaje=true;
			}
			$('#asignarot').modal();
		},
		listarOT(id)
		{
			this.elecioncr=id;
			axios.get('listaotcompradores/'+id).then(response=>{
				this.data_direccion=[];
				this.data_direccion=response.data;

			}).catch(err=>{

			});
		},
		listarOTcount(id)
		{
			axios.get('listaotcompradores/'+id).then(response=>{
				return response.data.length;

			}).catch(err=>{

			});
		},
		listarContadortreal(i)
		{

			if(i == 1)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_direcion=response.data.length;

				}).catch(err=>{

				}); 
			}else if(i == 2)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_sdryf=response.data.length;

				}).catch(err=>{

				}); 
			}else if(i == 3)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_sdga=response.data.length;

				}).catch(err=>{

				});
			}else if(i == 4)
			{
				axios.get('listaotcompradores/'+i).then(response=>{
					this.bag_sdrrhh=response.data.length;
					this.bloqueo=false;
				}).catch(err=>{

				});
			}


		},
		onChangeEventHandler(event)
		{
			if(event.value == true)
			{
				this.dulcealert('Se ha marcado el convenio','success')
				this.valor_check_convenio=1;
			}else{
				this.valor_check_convenio=0;
			}

		},	
	},


}	      

</script> 