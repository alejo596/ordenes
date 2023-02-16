<template>
	<div class="container-fluid">
		<div class="card border-primary">
			<div class="card-header bg-primary text-white text-center ">
				<h5>Lista de Solicitudes Quimicos</h5>
				
			</div>
			<div class="card-body">
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
												<a href="#"><img :src="'assets/img/cruzado.png'" width="30" height="30"></a>
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
												<a href="#"><img :src="'assets/img/cruzado.png'" width="30" height="30"></a>

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
														<a @click="eliminarproducto(props.row.pro_id,props.row.pro_nombre_producto,props.row.pro_id_oc)"><img :src="'assets/img/eliminar.png'" width="30" height="30"></a>

													</a>
													<a slot="adjunto" slot-scope="props" >
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
																<div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{numero}} </div>
																<div class="card-body">

																	<div class="col-12 container">

																		<carousel>
																			<slide v-for="(ar,index) in archivos" :key="index" v-if="ar.id_producto == props.row.pro_id">
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


												</a>


											</v-client-table>

										</div>

									</div>



								</div>
							</div>


						</div>



					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="autorizarot(s_tipo)">Autorizar</button>
						<button type="button" class="btn btn-danger" @click="rechazar(s_tipo)">Rechazar</button>
						<button type="button" class="btn btn-success" v-if="s_tipo ==1">Actualizar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</template>
<script>

	export default
	{


		props: ['id_session'],

		data(){

			return {
				cc_id:'',
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
		created:function()
		{
			this.verquimico();
		},
		methods:{
			autorizarot(tipo)
			{
				var tipos
				if(tipo == 1){
					tipos="OT"
				}else if(tipo == 2){
					tipos="viatico"
				}else if(tipo == 3){
					tipos="fondos fijos"

				}else if(tipo == 4){
					tipos="ot/quimico(a)"
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
          if(tipo == 4){
          	var url="historials/"+this.id_h;
          	var d={
          		id:this.id_h,          
          		firma_quimico:this.id_session,
          		fecha_quimico:dateString,
          		id_estado_timeline:16,
          		_method:'patch'
          	}
          	axios.post(url,d).then(response=>{
          		var url2='compras/'+this.idcomprar;
          		var da={
          			compra_id:this.idcomprar,          		
          			compra_estado:2,
          			_method:'patch'
          		}
          		axios.post(url2,da).then(resp=>{
          			this.bloqueo=false;
                    this.addsolicitudes(this.numero,this.idcomprar,this.cc_id)
          			this.updatedsolicitud(this.id_so);
          			this.addfirmassolicitud(this.id_so);
          			this.revisarfirmasaxenas(this.idcomprar);
          			this.getsolicitudesquimico();


          		}).catch(err=>{});


          		$("#modalaceptar").modal('hide');
          	}).catch(err=>{
          		this.bloqueo=false;
          	});

          }else if(tipo == 2){
          	//this.updatedsolicitud(this.id_so);
          	this.addsolicitudes(this.numero,this.idcomprar,this.cc_id)
          	this.addfirmassolicitud(this.id_so);
          	this.getsolicitudesquimico();
          	this.revisarfirmasaxenas(this.idcomprar);
          		this.getsolicitudesquimico();

          }else if(tipo == 3){
          	this.updatedsolicitud(this.id_so);
          	this.addfirmassolicitud(this.id_so);
          	this.updatesolicitud();
          	$("#modal_fondo").modal('hide');
          	this.getsolicitudesquimico();

          }



      }

  });

			},
			revisarfirmasaxenas(id)
			{

				axios.get('solicitudes5/'+id).then(response=>{
					for (var i = 0; i < response.data.length; i++) {
						
						var url='solicitudes/'+response.data[i].id
						var d={
						activo:0,
						_method:'patch'
					    }
					    axios.post(url,d).then(resp=>{}).catch(err=>{});
					}
					
					

					

				}).catch(err=>{

				});

			},
			addfirmassolicitud(id)
			{
				var d=new FormData();
				d.append('solicitud',id)
				d.append('usuario',this.id_session)
				d.append('estado',10)
				axios.post('firmasolicitudes',d).then(response=>{

				}).catch(err=>{

				});

			},
			updatesolicitud()
			{
				var url="fondo_j/"+this.numero;
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
				var url="solicitudes/"+id
				var d={
					estado:10,
				     activo:2,
					_method:'patch'

				}

				axios.post(url,d).then(response=>{

				}).catch(err=>{

				});



			},
				addsolicitudes(numero,id_doc,cc_id){
					var d=new FormData();
					d.append('tipo',1)
					d.append('estado',3)
					d.append('usuario',this.id_session)
					d.append('year',this.year)
					d.append('cc',cc_id)
					d.append('numero',numero)
					d.append('id_doc',id_doc)
					d.append('prioridad',0)
				    d.append('activo',0)
					axios.post('solicitudes',d).then(response=>{

					}).catch(err=>{

					});
				},

			verquimico(){

				axios.get('encargadoq/'+this.id_session).then(response=>{
					if(response.data == ''){
						this.dulcealert('No se encuentra como Quimico','error');
					}else{
						this.getsolicitudesquimico();
					}


				}).catch(err=>{

				});

			},
			getsolicitudesquimico(){
				var fecha = new Date();
				const dia = fecha.getDate();
                const mes = fecha.getMonth(); // Be careful! January is 0, not 1
                const year = fecha.getFullYear();
                var d=new FormData();
                d.append('run',this.id_session)
                d.append('year',year);
                d.append('estado',1);
                d.append('tipo',4);
                this.bloqueo=true;
                axios.post('solicitudes2',d).then(response=>{
                	this.data=response.data;
                	this.bloqueo=false;
                }).catch(err=>{
                	this.bloqueo=false;
                });

            },
            getordenes(id){
            	axios.get('ordenesdecompra/'+id).then(response=>{

            		this.titulomodal='Solicitud de Compra';
            		this.cc_id=response.data[0].compra_cc;
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
            buscarprespuestos(id,sigfe){
            	var today = new Date();
            	var year = today.getFullYear(); 
            	var d=new FormData();
            	d.append('cc',id);
            	d.append('sigfe',sigfe);
            	d.append('amio',year)
            	axios.post('nuevoprespuesto',d).then(response=>{
            		if(response.data == ''){
            			this.presupuesto_cc=0
            			this.sigfe_id=sigfe  
            			this.buscartotalprespuestocr(response.data.cr)
            			this.buscarrefrendacioncc(id,this.sigfe_id);
            			this.getgasta(response.data.cr,2,this.sigfe_id);
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
            buscartotalprespuestocr(cr)
            {
            	var today = new Date();
            	var year = today.getFullYear();  
            	var d=new FormData();
            	d.append('cr',cr);
            	d.append('year',year);
            	axios.post('totalcrprespuesto',d).then(response=>{
            		this.presucentros=response.data
            	}).catch(err=>{});

            },
            getgasta(cr,estado,sigfe){
            	var today = new Date();
            	var year = today.getFullYear(); 
            	var d=new FormData();
            	d.append('year',year)
            	d.append('familia',sigfe)
            	d.append('cr',cr)
            	d.append('estado',estado)
            	axios.post('gasta',d).then(response=>{
            		this.gastocentros=response.data;
            		this.saldo_cr=this.presucentros -this.gastocentros;
            		this.porcentaje_gastado_cr='% '+Math.round(this.getCalculo_2(this.presucentros,this.gastocentros) );
            	}).catch(err=>{});

            },  
            buscarrefrendacioncc(id,sigfe)
            {
            	var today = new Date();
            	var year = today.getFullYear();   
            	var d=new FormData();
            	d.append('cc',id);
            	d.append('year',year);
            	d.append('sigfe',sigfe);
            	axios.post('refrendacionesgasto',d).then(response=>{
            		this.totalcentros=response.data;
            		this.saldo_cc=this.presupuesto_cc-this.totalcentros;
            		this.porcentaje_cc='% '+Math.round(this.getCalculo_2(this.presupuesto_cc,this.totalcentros));



            	}).catch(err=>{

            	});

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

            getarchivos(id)
            {
            	axios.get('adjuntosots_bd/'+id).then(response=>{
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
            getProductos(id){
            	this.bloqueo=true
            	axios.get('productos/'+id).then(response=>{
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
            getFirmas(id)
            {
            	axios.get('firmaot/'+id).then(response=>{
            		this.firmas=response.data;

            		if(this.firmas.length == 0){
            			this.firma_cc="sin firma";
            			this.firma_cr="sin firma";

            		}
            	}).catch(err=>{
            		this.bloqueo=false;
            	});
            },
            visualizarnuevo(id,tipo,cc,id_s)
            {
            	this.s_tipo=tipo;
            	this.id_so=id_s;
            	this.bloqueo=true;
            	switch(tipo) {
            		case 4:
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
        formatPrice(value) {
        	let val = (value/1).toFixed(0).replace('.', '.')
        	return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        dulcealert(text,icono)
        {
        	Swal.fire({
        		icon: icono,

        		text: text,

        	})


        },
    }
}		

</script>