<template>
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-12">
				<button class="btn btn-primary text-left" @click="enviarlink()"> Atras</button>

			</div>
		</div>
		<div class="card border-success mt-1">
			<div class="card-header">{{titulo}}</div>
			<div :class="ocultarconvenio === true ? 'card-title text-white text-center bg-primary' :'card-title text-white text-center bg-success'"><h5><b>1. - Gestion de compra (O.T. N° {{numeroot}}) <p v-show="ocultarconvenio">  {{conveniosmensaje}}
             </p></b></h5></div>
			<div class="card-body">	
				<div class="row" v-show="ot_anulada">
					<div class="col-12">
						<div class="alert alert-danger text-center" role="alert">
							OT ANULADA FECHA : {{otfecha_anula}}
						</div>

					</div>

				</div>	

				<button v-show="ocularboton" id="toggleButton">Toggle</button>
				<div class="container-fluid">
					
					<ul class="timeline2" id="timeline">
						<li class="li complete" v-for="(h,index) in header" :key="index">
							<div class="timestamp">
								<div class="row">
									<div class="col-12 text-center">

										<span style="font-size:12px" rel="author" v-if="h.firma != null"><b>{{h.firma}}</b></span><span v-if="h.firma == null" style="font-size:12px" rel="author" class="text-center">11111111-1</span>
										
									</div>
									<div class="col-12 text-center">
										<span class="date" v-if="h.fecha != null" style="font-size: 12px"><b>{{new Date(h.fecha).toLocaleString() }}</b></span>
										<span class="date" v-if="h.fecha == null" style="font-size: 12px">00/00/0000 00:00:00</span>
										
									</div>

									
								</div>
								

							</div>
							<div class="status">
								<div class="row">
									<div class="col-12 text-center">
										<label style="font-size:12px" class="mt-4">{{h.titulo}} </label>
									</div>
									<div class="col-12 text-center">
										<label style="font-size:12px" >{{h.actividad}}</label>
									</div>
									
								</div>
								

							</div>
						</li>					

					</ul>   
				</div> 
				<div class="row">
					
					<div class="col-6">
						<div class="card  col-12 offset-2 border-left-danger border border-danger" >

							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col-10">
										<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										Firmas </div>
										<div class="h5 mb-0 font-weight-bold text-gray-800" style="text-transform: uppercase;">ENCARGADOS</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800" v-if="firmas.length == 0"></div>
										<div style="font-size: 12px" class=" mb-0 font-weight-bold text-gray-800" v-if="listftercero.length != 0" v-for="f in listftercero" :key="f.id"><em>{{f.per_nombre}}</em> {{f.created_at}}
											<i class="fas fa-times-circle fa-2x" v-if="f.actividad == 0"><img v-if="f.prioridad == 1" data-toggle="tooltip" data-placement="right" title="Firma Prioritaria" :src="'../../assets/img/priority.png'" width="30" height="30"></i>
											<i class="fas fa-check-circle fa-2x" v-if="f.actividad == 1"><img v-if="f.prioridad == 1"  data-toggle="tooltip" data-placement="right" title="Firma Prioritaria":src="'../../assets/img/priority.png'" width="30" height="30"></i>

										</div>
									</div>
									<div class="col-2">
										<i class="fa fa-signature fa-2x text-gray-300"></i>
									</div>
								</div>								
							</div>

						</div>
						<div class="card mt-2 col-12 offset-2 border-left-warning border border-warning" >

							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col-10">
										<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										Firmas </div>
										<div class="h5 mb-0 font-weight-bold text-gray-800" style="text-transform: uppercase;">QUIMICOS</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800" v-if="firmas.length == 0"></div>
										<div style="font-size: 12px" class=" mb-0 font-weight-bold text-gray-800" v-if="listfquimico.length != 0" v-for="f in listfquimico" :key="f.id"><em>{{f.per_nombre}}</em> {{f.created_at}}
											<i class="fas fa-times-circle fa-2x" v-if="f.actividad == 0"></i>
											<i class="fas fa-check-circle fa-2x" v-if="f.actividad == 1"></i></div>
										</div>
										<div class="col-2">
											<i class="fa fa-signature fa-2x text-gray-300"></i>
										</div>
									</div>								
								</div>

							</div>


						</div>

						<div class="col-5">
							<div class="card  col-12 offset-2 border-left-info border border-info" >

								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
											Centros de Costos</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800" style="text-transform: uppercase;">{{nombre_cc}} </div>
										</div>
										<div class="col-auto">
											<i class="fas fa-calendar fa-2x text-gray-300"></i>
										</div>
									</div>								
								</div>

							</div>
							<div class="card  col-12 offset-2 mt-2 border-left-primary p-2 border border-primary" >

								<div class="card-body">	

									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
											SubDirección</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800" style="text-transform: uppercase;">{{nombre_cr}}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-calendar fa-2x text-gray-300"></i>
										</div>
									</div>

								</div>

							</div>


						</div>
						

					</div>

				</div>

			</div>  
			<div class="card card-tasks border-primary mt-3">

				<div class="card-header">{{titulo}}</div>
				<div class="card-title text-center text-white bg-primary"><h5><b>2. - Procesos de Compra (Productos)</b> </h5></div>
				<div class="card-body">
					<v-client-table :columns="columns" v-model="tableData" :options="options">
						<div slot="historial" slot-scope="props">
							<a href="#" @click="detalleot(props.row.pro_id,props.row.id_proceso,props.row.pro_id_cpp)"><i class="fas fa-history fas-10x"></i></a>

						</div>
						<div slot="pro_total" slot-scope="props">
							{{formatPrice(props.row.pro_total)}}
							
						</div>




					</v-client-table>

				</div>

			</div>
			
			<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="detalleotmodal">
				<div class="modal-dialog modal-dialog-centered " role="document" style="max-width: 1500px !important">
					<div class="modal-content ">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Detalle</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							

							<div class="col-12">
								<div class="card border-primary">
									<button v-show="ocularboton" id="toggleButton1">Toggle</button>
									<div class="card-header text-center bg-primary text-white"><b><em>Detalles Proceso Ordenes de Compras (fecha de inicio:{{fecha_proceso}}) Estado: {{estado_e}}</em></b></div>

									<div class="card-body">
										
										<div class="alert alert-success" role="alert" v-if="procesosdevueltos.length==0">
											<h4 class="alert-heading">No se ha iniciado un nuevo proceso</h4>
											<p>Si el producto inicio un proceso se vera reflejado en parte inferior</p>
											<hr>
											<p class="mb-0"></p>
										</div>
										

										<ul class="timeline3" id="timeline1">

											<carousel :perPage=4 >

												<slide  v-for="(de,index) in procesosdevueltos" :key="index">
													<li  :class="de.fecha_inicio != null ?'li complete1' : 'li'"> 
														
														<div class="timestamp1">
															<div class="card" :class="de.fecha_inicio != null ?'border-primary' : 'border-secondary'">
																<div class="card-header" :class="de.fecha_inicio != null ?'bg-primary text-white text-center':'bg-secondary text-center text-white'">
																	<div class="row">
																		<div :class="index == 1 ?'col-11':'col-12'" v-if="de.fecha_inicio != null" style="font-size: 12px">Tiempo: {{de.dias}} Dias  </div>
																		<div class="col-12"  v-if="de.fecha_inicio == null" style="font-size: 12px">Tiempo: {{de.dias}} Dias </div>
																	</div>
																</div>
																<div class="card-body">
																	<div class="row">
																		<div class="col-12"  v-if="de.fecha_inicio != null" style="font-size: 12px">
																			Fecha Inicio: <b>{{de.fecha_inicio}}</b>
																		</div>
																		<div class="col-12"  v-if="de.fecha_inicio != null" style="font-size: 12px">
																			Fecha Termino: {{de.fecha_termino}}
																		</div>
																		<div class="col-12" v-if="de.fecha_inicio != null" style="font-size: 12px" >
																			
																			<div class="row" v-if="de.verificar == 1">
																				<b>
																					<div class="col-12">
																						Fecha enviado: {{f_enviado}}
																					</div>
																					<div class="col-12">
																						Fecha encargado: {{f_encargado}}
																					</div>
																					<div class="col-12">
																						Fecha Jefatura: {{f_jefatura}}
																					</div>
																				</b>
																				
																			</div>	
																			<div class="row" v-if="de.verificar != 1" style="height: 54px;">
																				<div class="col-12">
																					
																				</div>
																				
																			</div>	

																		</div>

																		<div class="col-12" v-if="de.fecha_inicio == null" style="font-size: 12px">
																			Fecha Inicio
																		</div>
																		<div class="col-12" v-if="de.fecha_inicio == null" style="font-size: 12px">
																			Fecha termino
																		</div>
																		<div class="col-12" v-if="de.fecha_inicio == null" style="font-size: 12px" >
																			<div class="row"  style="height: 54px;">
																				<div class="col-12">
																					
																				</div>
																				
																			</div>	
																		</div>



																	</div>

																</div>
															</div>


														</div>
														<div class="status1 ">
															<label class="mt-5" style="font-size: 12px"> {{de.nombre}}</label>

														</div>


													</li>
												</slide>
											</carousel>		



										</ul>
										<h5 class="offset-5"><label>Deslice para ver las etapas</label></h5>
										<div class="row" v-show="f_refrendacion">
											<div class="col-2">
												<div class="alert alert-secondary" role="alert">
													CPP: {{cpp_numero}} 
													<a href="#" @click="verpdfs(cpp_id)"><img :src="'../../assets/img/pdf.png'" width="30" height="30"></a>

												</div>
												
											</div>
											
										</div>




										<div class="row">
											<div class="col-12">
												<div><a href="#" @click="historialproducto =! historialproducto"><img :src="'../../assets/img/procesos.gif'" width="120" height="100" data-toggle="tooltip" data-placement="bottom" title="Historial Procesos"></a><span class="badge badge-danger">{{logprocesos.length}}</span></div>
											</div>

										</div>

										<v-client-table :columns="columnsproceso" v-model="dataproceso" :options="optionsproceso" v-show="historialproducto">

											<div slot="child_row" slot-scope="props">
												<table  >
													
													
													<thead>
														<tr>
															<th scope="col">Id</th>													
															<th scope="col">Nombre proceso</th>	
															<th>Dias</th>										
															<th scope="col">Fecha Inicio</th>
															<th scope="col">Fecha Termino</th>

														</tr>
													</thead>
													<tbody>
														<tr v-for="(proces2,index) in logprocesos2" :key="index" class="table-primary" v-if="props.row.id_procesos == proces2.id_procesos">
															<td>{{index+1}}</td>
															<td>{{proces2.nombre_detalle}}</td>
															<td> {{proces2.dias}}</td>
															<td>{{proces2.fecha_inicio}}</td>
															<td>{{proces2.fecha_termino}}</td>

														</tr>
													</tbody>

												</table>
											</div>
											<div slot="id" slot-scope="row">
												{{row.index}}
												
											</div>
											<div slot="fecha_terminio" slot-scope="props">
												{{calcularDiastotal(props.row.fecha_inicio,props.row.total)}}
											</div>

										</v-client-table>




									</div>

								</div>

							</div>





						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

						</div>
					</div>
				</div>
			</div>
			<BlockUI :message="msg"  v-if="bloqueo">
				<img :src="'../../assets/img/745.gif'">

			</BlockUI>
		</div>

	</template>
	<style type="text/css">
		.VueTables__child-row-toggler {
			width: 16px;
			height: 16px;
			line-height: 16px;
			display: block;
			margin: auto;
			text-align: center;
		}
		.VueTables__child-row-toggler--closed::before {
			content: "+";
		}

		.VueTables__child-row-toggler--open::before {
			content: "-";
		}
		html {
			font-size: 1rem;
		}

		@include media-breakpoint-up(sm) {
			html {
				font-size: 1.2rem;
			}
		}

		@include media-breakpoint-up(md) {
			html {
				font-size: 1.4rem;
			}
		}

		@include media-breakpoint-up(lg) {
			html {
				font-size: 1.6rem;
			}
		}
		.timeline2 {
			list-style-type: none;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.li {
			transition: all 200ms ease-in;
		}

		.timestamp {
			margin-bottom: 20px;
			padding: 0px 40px;
			display: flex;
			flex-direction: column;
			align-items: center;
			font-weight: 100;
		}

		.status {
			padding: 0px 0px;
			display: flex;
			justify-content: center;
			border-top: 2px solid #D6DCE0;
			position: relative;
			transition: all 200ms ease-in;
		}

		.status:before {
			content: "";
			width: 25px;
			height: 25px;
			background-color: white;
			border-radius: 25px;
			border: 1px solid #ddd;
			position: absolute;
			top: -15px;
			left: 42%;
			transition: all 200ms ease-in;
		}

		.li.complete .status {
			border-top: 2px solid #66DC71;
		}
		.li.complete .status:before {
			background-color: #66DC71;
			border: none;
			transition: all 200ms ease-in;
		}
		.li.complete .status h4 {
			color: #66DC71;
		}

		@media (min-device-width: 320px) and (max-device-width: 700px) {
			.timeline2 {
				list-style-type: none;
				display: block;
			}

			.li {
				transition: all 200ms ease-in;
				display: flex;
				width: inherit;
			}

			.timestamp {
				width: 100px;
			}

			.status:before {
				left: -8%;
				top: 30%;
				transition: all 200ms ease-in;
			}
		}



		#toggleButton {


			background-color: #75C7F6;
		}
		h2{
			margin: 5%;
			text-align: center;
			font-size: 2rem;
			font-weight: 100;
		}




	</style>
	<style type="text/css">
		.timeline3 {
			list-style-type: none;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.li {
			transition: all 200ms ease-in;
		}

		.timestamp1 {
			margin-bottom: 20px;
			padding: 0px 40px;
			display: flex;
			flex-direction: column;
			align-items: center;
			font-weight: 100;
		}

		.status1 {
			padding: 0px 10px;
			display: flex;
			justify-content: center;
			border-top: 2px solid #D6DCE0;
			position: relative;
			transition: all 200ms ease-in;
		}
		.li.completemedia .status:before {
			background: linear-gradient(to right, #66DC71 0%, #66DC71 50%, white 50%, white 100% );
			border: none;

			transition: all 200ms ease-in;
		}

		.status1:before {
			content: "";
			width: 25px;
			height: 25px;
			background-color: white;
			border-radius: 25px;
			border: 1px solid #ddd;
			position: absolute;
			top: -15px;
			left: 42%;
			transition: all 200ms ease-in;
		}

		.li.complete1 .status1 {
			border-top: 2px solid #4e73df;
		}
		.li.complete1 .status1:before {
			background-color: #4e73df;
			border: none;
			transition: all 200ms ease-in;
		}
		.li.complete1 .status1 h4 {
			color: #4e73df;
		}

		@media (min-device-width: 320px) and (max-device-width: 700px) {
			.timeline3 {
				list-style-type: none;
				display: block;
			}

			.li {
				transition: all 200ms ease-in;
				display: flex;
				width: inherit;
			}

			.timestamp1 {
				width: 100px;
			}

			.status1:before {
				left: -8%;
				top: 30%;
				transition: all 200ms ease-in;
			}
		}



		#toggleButton {


			background-color: #75C7F6;
		}
		h2{
			margin: 5%;
			text-align: center;
			font-size: 2rem;
			font-weight: 100;
		}
		.fade-enter-active, .fade-leave-active {
			transition: opacity .5s
		}
		.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
			opacity: 0
		}

	</style>


	<script>
		export default
		{
			props: ['id_session','titulo','orden','id','cod'],

			data(){

				return {
					conveniosmensaje:'',
                    ocultarconvenio:false,
					mensajeso:'',
					cpp_id:'',
					cpp_numero:'',
					f_refrendacion:false,
					f_enviado:'',
					f_encargado:'',
					f_jefatura:'',
					isActive :false,
					logprocesos2:[],
					logprocesos:[],
					otfecha_anula:'',
					ot_anulada:false,
					historialproducto:false,
					estado_e:'',
					procesosarray:[],
					nombre_proceso:'',
					procesosdevueltos:[],
					verprocesos:false,
					detalleH:[],
					numeroot:'',
					procesocompra:false,
					vista:'',
					detalleheader:[],
					completes1:'',
					completes:'',
					toggleButton:'',
					toggleButton1:'',
					historial:[],
					nombre_cc:'',
					nombre_cr:'',
					msg: 'Espere un Momento...',
					bloqueo:false,
					ot:[],
					ocularboton:false,
					firmas:[],
					header2:[],
					header:
					[
					{
						titulo:'O.T. Creada',
						fecha:null,
						firma:null,
						estado:1,
						actividad:null,
						id_actividad:0
					},
					{
						titulo:'Firmas Encargados',
						fecha:null,
						firma:null,
						estado:2,
						actividad:"sin actividad",
						id_actividad:0


					},

					{
						titulo:'Firma C.C.',
						fecha:null,
						firma:null,
						estado:3,
						actividad:"sin actividad",
						id_actividad:0
						
					},

					{
						titulo:'Firma Sub. Direccion.',
						fecha:null,
						firma:null,
						estado:4,
						actividad:"sin actividad",
						id_actividad:0
					},

					{
						titulo:'Jefatura Dep. Compras',
						fecha:null,
						firma:null,
						estado:5,
						actividad:"sin actividad",
						id_actividad:0
					},

					{
						titulo:	'Asignado a Comprador',
						fecha:null,
						firma:null,
						estado:6,
						actividad:"sin actividad",
						id_actividad:0
					},

					{
						titulo:'Compra Terminada',
						fecha:null,
						firma:null,
						estado:7,
						actividad:"sin actividad",
						id_actividad:0

					},



					],
					etapa_id:'',
					id_producto:'',
					columnsproceso: ['id','nombre_etapa', 'nombre', 'observacion','fecha_inicio','fecha_terminio'],
					dataproceso:[],
					optionsproceso: {
						childRow: 'row-component',

						rowClassCallback: function(row) { 
							console.log(row.estado);
							if(row.estado == 5){
								return "table-danger text-dark"
							}

						},
						childRow: function(h, row) {
							console.log(row)
						},
						perPage: 5,
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
							id: 'ID',
							nombre_etapa:'Nombre Etapa',
							nombre: 'Nombre Estado',
							observacion:'Observacion',                
							fecha_inicio: 'Fecha Inicio', 
							fecha_terminio:'Fecha Termino' ,



						},
						sortable:  ['id'],
						filterable: ['id'],
					},
					columns: ['pro_id','compra_numero', 'pro_nombre', 'nombre_comprador','estado_producto','pro_precio','pro_cantidad','pro_total','pro_observacion','historial'],
					tableData:[],
					options: {

						rowClassCallback: function(row) { 
							console.log(row.pro_estado_producto);
							if(row.pro_estado_producto == 9){
								return "table-danger text-dark"
							}

						},
						perPage: 5,
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
							compra_numero:'OC',
							pro_nombre: 'Nombre Producto',                 
							nombre_comprador: 'Comprador', 
							estado_producto:'Estado Producto' ,
							pro_precio:'Precio',
							pro_cantidad:'Cantidad',
							pro_total:'Total',	
							pro_observacion:'Observacion',					
							historial:'Historial',



						},
						sortable:  ['id'],
						filterable: ['id'],
						editableColumns:['id']
					},
					fecha_proceso:'',
					etapasot2:[],
					estado_porceso:'',
					comprador:[],
					listftercero:[],
					listfquimico:[]


				}
			} ,
			created:function()
			{
				this.getProductos();
				this.getFirmas();
				this.getOt();
				this.getcomprador();



			},
			mounted()
			{

				this.bloqueo=true;

				switch(parseInt(this.cod)) {
				case 0:this.vista='listarordenes';
					break;

				}

				axios.get('../../detalleetapas/'+this.id).then(response1=>{
				});

			},
			methods:
			{
				getsoliitudestandq(id,tipo){
					var d=new FormData();
					d.append('id',id)
					d.append('tipo',tipo)
					axios.post('../../solicitudes5',d).then(response=>{
						if(tipo == 5){
							this.listftercero=response.data
						}else{
							this.listfquimico=response.data
						}

					}).catch(err=>{

					});

				},
				verpdfs(id)
				{
					var d=new FormData();
					d.append('id',id);
					axios.post('../../encriptar',d).then(response=>{
						window.open("../../visorpdfcpp/"+response.data);
					}).catch(err=>{
					});
				},//visorpdfcpp(cpp)pdfs(ot)

				detalleprocesos(id)
				{

					axios.get('../../etapasot3/'+id).then(response=>{
						if (!this.isActive) {
							this.isActive = true;
						} else {
							this.isActive = false;
						}
						this.logprocesos2=response.data;
						

					}).catch(err=>{});

				},

				detalleprocesos2()
				{

					axios.get('../../etapasot').then(response=>{
						if (!this.isActive) {
							this.isActive = true;
						} else {
							this.isActive = false;
						}
						this.logprocesos2=response.data;
						

					}).catch(err=>{});

				},
				getcomprador()
				{
					axios.get('../../comprador').then(response=>{
						this.comprador=response.data;
					});

				},
				getvercomprador(id)
				{
					for (var i = 0; i < this.comprador.length; i++) {
						if(this.comprador[i].per_id ==id)
						{
							return this.comprador[i].per_nombre;
						}
					}
				},
				gettipocompra(proceso)
				{
					axios.get('../../procesos2/'+proceso).then(response=>{
						this.fecha_proceso=response.data.created_at;
						if(response.data.estado == 1){
							this.estado_e="Inicio de Proceso";
						}else{
							this.estado_e=response.data.nombre
						}

                       //

					}).catch(erro=>{});
				},
				formatPrice(value) {
					let val = (value/1).toFixed(0).replace('.', '.')
					return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
				},
				getcomplete()
				{
					var contador =this.etapasot2.length;
					console.log(contador);


					this.toggleButton1 = document.getElementById("toggleButton1");
					this.$nextTick(() => {
						this.completes1=document.querySelectorAll(".complete1");
						console.log('completes tabla dos',this.completes1.length);
						for (var i = 0; i < this.completes1.length; i++) 
						{  
							this.completes1[i]
							if(i < contador){
								console.log('no hace nada2');

							}else{

								var  lastComplete1 = this.completes1[i];


								console.log('lastComplete1',lastComplete1)
								this.toggleButton.onclick = lastComplete1.classList.toggle('complete1');

							}


							;
						}
					});

				},
				
				getloghistorial(id)
				{
					axios.get('../../loghistorial/'+id).then(response=>{
						this.logprocesos=response.data
						this.dataproceso=response.data
						this.detalleprocesos2()
					}).catch(errr=>{

					});

				},
				async getEtapaOrdenes(id)
				{
					this.bloqueo=true;
					await axios.get('../../detalleetapas2/'+id).then(response=>{
						this.procesosdevueltos=[]
						this.procesosdevueltos=response.data;
						axios.get('../../etapasot/'+id).then(responseot=>{
							this.bloqueo=false
							for (var i = 0; i < response.data.length; i++) {
								if(this.procesosdevueltos[i].verificar == 1){

								}
								for (var j = 0; j < responseot.data.length; j++) {
									if(responseot.data[j]['detalle_etapa'] === response.data[i]['id']){
										this.procesosdevueltos[i].fecha_termino=responseot.data[j]['fecha_termino']
										this.procesosdevueltos[i].fecha_inicio=responseot.data[j]['fecha_inicio']
									}
								}


							}
						}).catch(err=>{

						});
						



						console.log('toggleButton',this.toggleButton1);

					// axios.get('../../etapasot/'+id).then(responseeto=>{
					// 	this.etapasot2=responseeto.data;
					// 	this.getcomplete();
					// 	this.procesosdevueltos=JSON.parse(JSON.stringify(this.procesosdevueltos));
					// 	console.log('etapas',responseeto.data[0]);
					// 	for (var i = 0; i < this.procesosdevueltos.length; i++) {
					// 		if(this.procesosdevueltos[i].id == this.etapasot2[i].detalle_etapa)
					// 		{
					// 			// this.procesosdevueltos[i].fecha=responseeto.data[i].created_at;
					// 			// this.procesosdevueltos[i].termino=responseeto.data[i].fecha_termino;
					// 			// this.procesosdevueltos[i].firma=responseeto.data[i].comprador;

					// 		}else{
					// 			this.procesosdevueltos=JSON.parse(JSON.stringify(this.procesosdevueltos));
					// 			this.procesosdevueltos[i].fecha=null;
					// 		}

					// 		console.log('final',this.procesosdevueltos);

					// 	}

					// });





					}).catch(err=>{

					});
				},			
				enviarlink(){

					window.location.href='../../'+this.vista;
				},
				getcpprefrendacion(id){
					axios.get('../../compromiso4/'+id).then(response=>{
						this.f_enviado=response.data.fecha_envio
						this.f_encargado=response.data.fecha_encargado
						this.f_jefatura=response.data.fecha_jefatura
						this.cpp_id=response.data.id
						this.cpp_numero=response.data.numero

						this.f_refrendacion=true;

					}).catch(err=>{

					});
				},
				detalleot(ids,proceso,cpp){
					if(ids == null){
						ids=0

					}
					
					if(cpp != 0){
						this.getcpprefrendacion(cpp);

					}else{
						this.f_refrendacion=false;
					}
					$("#detalleotmodal").modal();
					this.getloghistorial(ids)
					this.id_producto=ids;
					this.gettipocompra(proceso);
					this.getEtapaOrdenes(proceso);
					if(ids == 0){
						this.historialproducto=false;
					}


				},
				getOt()
				{
					axios.get('../../ordenesdecompra2/'+this.id).then(response=>{
						this.ot=response.data;
						for (var i = 0; i < this.ot.length; i++) {
							this.numeroot=this.ot[i].compra_numero;
							this.nombre_cc=this.ot[i].cc_nombre;
							this.nombre_cr=this.ot[i].cr_nombre;
							var id_h=this.ot[i].id_historial;

							if(this.ot[i].compra_convenio == 1){
							this.conveniosmensaje="Orden de Compra Con Convenio"
							this.ocultarconvenio=true
							}
						


						}
						this.getsoliitudestandq(this.id,5);
						this.getsoliitudestandq(this.id,4);
						this.historialot(this.id);

					}).catch(err=>{
						this.bloqueo=false;
					});
				},
				historialot(id)
				{
					axios.get('../../historialdecompras2/'+id).then(response=>{
						this.historial=response.data;

						console.log('historial',this.historial)
						console.log(this.header);
						this.header=JSON.parse(JSON.stringify(this.header));
						for (var i = 0; i < this.header.length; i++) {						


							switch (this.header[i].estado) 
							{

							case 1: 
								for (var j = 0; j < this.historial.length; j++) {
									if(this.historial[j].estado === 2){

										this.header[i].firma=this.historial[i].usuario;
										this.header[i].fecha=this.historial[i].created_at;
										this.header[i].actividad=this.historial[i].nombre;
										this.header[i].id_actividad=this.historial[j].actividad 
									}
									
								}
								
								break;
							case 2:
								for (var j = 0; j < this.historial.length; j++) {
									console.log('id',this.historial[j].estado);
									if(parseInt(this.historial[j].estado) === 5){
										console.log('indx',j);
										if(this.historial[j].actividad === 5){
											this.header[i].firma=null;
											this.header[i].fecha=null;
											this.header[i].actividad=this.historial[j].nombre;
										}else if(this.historial[j].actividad === 1){
											this.header[i].firma=this.historial[j].usuario;
											this.header[i].fecha=this.historial[j].created_at;
											this.header[i].actividad=this.historial[j].nombre;
											this.header[i].id_actividad=this.historial[j].actividad 

										}
									}
								}
								break;
							case 3:
								for (var j = 0; j < this.historial.length; j++) {
									if(this.historial[j].estado === 3){

										this.header[i].firma=this.historial[i].usuario;
										this.header[i].fecha=this.historial[j].created_at;
										this.header[i].actividad=this.historial[j].nombre;
										this.header[i].id_actividad=this.historial[j].actividad 

									}
								}
								break;

							case 4:
								for (var j = 0; j < this.historial.length; j++) {
									if(this.historial[j].estado === 4){

										this.header[i].firma=this.historial[i].usuario;
										this.header[i].fecha=this.historial[j].created_at;
										this.header[i].actividad=this.historial[j].nombre;
										this.header[i].id_actividad=this.historial[j].actividad 

									}
								}
								break;

							case 5:
								for (var j = 0; j < this.historial.length; j++) {
									if(this.historial[j].estado === 7){

										this.header[i].firma=this.historial[j].usuario;
										this.header[i].fecha=this.historial[j].created_at;
										this.header[i].actividad=this.historial[j].nombre;
										this.header[i].id_actividad=this.historial[j].actividad 

									}
								}
								break;

							case 6:

								for (var j = 0; j < this.historial.length; j++) {
									if(this.historial[j].estado === 8){

										this.header[i].firma=this.historial[j].usuario;
										this.header[i].fecha=this.historial[j].created_at;
										this.header[i].actividad=this.historial[j].nombre;
										this.header[i].id_actividad=this.historial[j].actividad 

									}
								}
								break;
							case 7:
								this.header[i].firma=null;
								this.header[i].fecha=null;
								break;

							}

						}


						console.log('largo',this.header);		

						

						this.completes = document.querySelectorAll(".complete");
						console.log('completes1',this.completes.length);
						this.toggleButton = document.getElementById("toggleButton");
						console.log('toggleButton',this.toggleButton);
						
						for (var i = 0; i < this.header.length; i++) {
                       	if(parseInt(this.header[i].id_actividad) === 4 ){// comprador parcial
                       		
                       		var  lastComplete = this.completes[i];

                       		console.log('lastComplete1',lastComplete)

                       		this.toggleButton.onclick = lastComplete.classList.toggle('completemedia');

                       	}
                       	console.log(this.header[i].fecha)
                       	if(this.header[i].fecha == null){

                       		
                       		
                       		var  lastComplete =this.completes[i];

                       		console.log('lastComplete1',lastComplete)

                       		this.toggleButton.onclick = lastComplete.classList.toggle('complete');

                       		
                       		

                       	}
                       }

					/*for (var i =0 ; i < this.completes.length ; i--) 
					{

						for (var j = 0; j < this.historial.length; j++) {
						
								this.completes[i]
								var arr=[]
								arr.push(this.completes[i]);
								console.log('aqui',this.completes[i])
								console.log('alla',this.historial[i])
								console.log('i',i);
								var  lastComplete =this.completes[i];

								console.log('lastComplete1',lastComplete)

								this.toggleButton.onclick = lastComplete.classList.toggle('complete');

						
						}*/
                       

						/*this.completes[i]
						if(i <=contador){
							console.log('no hace nada');
							console.log(i)

							if(i == 5){
								if(this.historial.id_estado_timeline == 15){
									this.completes[i]
									var  lastComplete = this.completes[i];





									console.log('lastComplete1',lastComplete)

									this.toggleButton.onclick = lastComplete.classList.toggle('completemedia');
								}

							}*/


						/*}else{

							console.log('aqui',this.completes[i])
							var  lastComplete = this.completes[i];





							console.log('lastComplete1',lastComplete)

							this.toggleButton.onclick = lastComplete.classList.toggle('complete');


						}*/

                       
                       
                       this.bloqueo=false;
                   }).catch(err=>{
                   	this.bloqueo=false;
                   });
               },

               getFirmas()
               {
               	axios.get('../../firmaot/'+this.id).then(response=>{
               		this.firmas=response.data;
               	}).catch(err=>{
               		this.bloqueo=false;
               	});
               },
               getProductos()
               {

               	axios.get('../../productos/'+this.id).then(response=>{
               		this.tableData=response.data;
               	}).catch(err=>{
               		this.bloqueo=false;
               	});
               },
               getestadotabla(){
               	axios.get(this.nombretabla).then(response=>{

               	}).catch(err=>{
               		this.bloqueo=false;
               	});
               },
               calcularDiastotal(inicial,total){

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

           }	

       }	

   </script> -->