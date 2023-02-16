<template>
	<div class="container-fluid">
		<div class="container-fluid">
			<div class="card border-primary">
				<div class="card-header text-white text-center bg-primary"><h5>{{cr_cc}}</h5></div>
				<div class="card-body">
					

					<ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ordenes de Compras <span class="badge badge-danger">{{totalcompras}}</span></a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="versolicitudes(2)">Viaticos</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" @click="versolicitudes(3)">Solicitud de Fondos Fijos</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="row">
								<div class="col-12 text-center">
									<h5>Ordenes de Compra</h5>
								</div>

							</div>
							<v-client-table :columns="columns_productos_sub" v-model="data_productos_sub" :options="options_productos_sub">

								<a slot="acciones" slot-scope="props">
									
									<button class="btn btn-success" @click="visualizarnuevo(props.row.id_doc,props.row.tipo,props.row.cc,props.row.id,props.row.anticipo,props.row.idproveedor)">Visualizar</button>

								</a>

							</v-client-table>

						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="row">
								<div class="col-12 text-center">
									<h5>Viaticos</h5>
								</div>

							</div>
							<v-client-table :columns="columns_productos_sub1" v-model="data_productos_sub1" :options="options_productos_sub1">
								<a slot="acciones" slot-scope="props">

									<button class="btn btn-success" @click="visualizarnuevo(props.row.id_doc,props.row.tipo,props.row.cc,props.row.id,props.row.anticipo,props.row.idproveedor)">Visualizar</button>
								</a>


							</v-client-table>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<div class="row">
								<div class="col-12 text-center">
									<h5>Fondo Fijo</h5>
								</div>

							</div>
							<v-client-table :columns="columns_productos_sub2" v-model="data_productos_sub2" :options="options_productos_sub2">
								<a slot="acciones" slot-scope="props">
									<button class="btn btn-success" @click="visualizarnuevo(props.row.id_doc,props.row.tipo,props.row.cc,props.row.id,props.row.anticipo,props.row.idproveedor)">Visualizar</button>
								</a>




							</v-client-table>
						</div>
					</div>


				</div>
			</div>


		</div>




		<div class="modal" tabindex="-1" role="dialog" id="modalaceptar">
			<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1400px !important;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">{{titulomodal}}</h5>
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
								<label>Telefono Contacto:</label>
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
							<div class="col-4">
								<div class="card border-success" >
									<div class="card-header text-white bg-success" ><h5>Firmas</h5></div>
									<div class="card-body">
										<div class="row">
											<div class="col-auto">
												<label>Centros</label>  
											</div>
											
											<div class="col-auto">
												<label> Nombre/Fecha /Hora</label>
											</div>
											<div class="col-4 text-center">
												<label> Accion</label>
											</div>
										</div>
										<div class="row" v-show="ver_jefatura">
											<div class="col-auto">
												<label>Jefatura Directa</label>  
											</div>
											<div class="col-auto">
												<label></label>
											</div>
											<div class="col-auto">
												<input type="" name="" class="form-control" v-model="firma_jef_encargado" readonly="readonly">
											</div>
											<div class="col-4">
												<a href="#"><img :src="url_imagen_jef" width="30" height="30"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-auto">
												<label>C.C.</label>  
											</div>
											
											<div class="col-auto">
												<label style="font-size: 12px">{{firma_cc_encargado}}</label>
											</div>
											<div class="col-auto">
												<a href="#"><img :src="url_imagen_cc" width="20" height="20"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-auto">
												<label>C.R.</label>  
											</div>
											
											<div class="col-auto">
												<label style="font-size: 12px">{{firma_cr_encargado}}</label>
											</div>
											<div class="col-4">
												<a href="#"><img :src="url_imagen_cr" width="20" height="20"></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-8">
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
								<div class="card">
									<div class="card-header text-center text-white bg-primary"><h5>Productos</h5></div>
									<div class="card-body">
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
					<button type="button" class="btn btn-primary" @click="autorizarot(s_tipo,idcomprar)">Autorizar</button>
					<button type="button" class="btn btn-danger"@click="rechazar(s_tipo)">Rechazar</button>
					<button type="button" class="btn btn-success" v-if="s_tipo ==1">Actualizar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<BlockUI :message="msg"  v-if="bloqueo">
		<img :src="'../assets/img/745.gif'">

	</BlockUI>
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
							<a :href="'../../../anticipos/storage/app/'+url_f" target="_blank"><img :src="'../assets/img/pdf.png'" width="40" height="30"></a>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="autorizarot(s_tipo)">Autorizar</button>
					<button type="button" class="btn btn-danger" @click="rechazar(s_tipo)">Rechazar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

				</div>
			</div>
		</div>
	</div>



</div>

</template>
<script>

	export default {
		props: ['id_session','cr','sub_cc'],

		data(){

			return {
				proveedor:0,
				anticipoviatico:0,
				v_total:0,
				v_cc:'',
				v_ley_med:'',
				v_calidad:'',
				v_year:'',
				v_local:'',
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
				totalcompras:'',
				cc_firmas:'',
				cr_firmas:'',
				firma_jef_encargado:'',
				firma_cr_encargado:'',
				url_imagen_jef:'../assets/img/cruzado.png',
				url_imagen_cc:'../assets/img/cruzado.png',
				url_imagen_cr:'../assets/img/cruzado.png',
				firma_cc_encargado:'',
				ver_jefatura:false,
				columns: ['cc_nombre', 'compra_numero', 'compra_amio','fondo','accion'],
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
						cc_nombre: 'Centro de Costo',
						compra_numero: 'N°',                 
						compra_amio: 'Año', 
						fondo:'Categoria' ,
						accion:'Acciones'                    

					},
					sortable:  ['cc_nombre', 'nombre'],
					filterable: ['cc_nombre', 'nombre'],
				},
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
				cr_cc:'',
				columns_productos_sub2: ['compra_numero', 'compra_amio', 'cc_nombre','compra_proyecto','estado_nombre','acciones'],
				data_productos_sub2:[],
				options_productos_sub2: {
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
						compra_numero: 'N°',
						compra_amio: 'AÑO',                 
						cc_nombre: 'Centros de Costos', 
						compra_proyecto:'Proyecto',
						estado_nombre:'Estado',						
						acciones:'Accion'


					},
					sortable:  ['cc_nombre', 'nombre'],
					filterable: ['cc_nombre', 'nombre'],
				},
				columns_productos_sub1: ['compra_numero', 'compra_amio', 'cc_nombre','compra_proyecto','estado_nombre','acciones'],
				data_productos_sub1:[],
				options_productos_sub1: {
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
						compra_numero: 'N°',
						compra_amio: 'AÑO',                 
						cc_nombre: 'Centros de Costos', 
						compra_proyecto:'Proyecto',
						estado_nombre:'Estado',						
						acciones:'Accion'


					},
					sortable:  ['cc_nombre', 'nombre'],
					filterable: ['cc_nombre', 'nombre'],
				},
				columns_productos_sub: ['compra_numero', 'compra_amio', 'cc_nombre','compra_proyecto','estado_nombre','acciones'],
				data_productos_sub:[],
				options_productos_sub: {
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
						compra_numero: 'N°',
						compra_amio: 'AÑO',                 
						cc_nombre: 'Centros de Costos', 
						compra_proyecto:'Proyecto',
						estado_nombre:'Estado',						
						acciones:'Accion'


					},
					sortable:  ['cc_nombre', 'nombre'],
					filterable: ['cc_nombre', 'nombre'],
				},
				titulomodal:'',
				devol:[],
				viaticos_jt:'',
				id_categoria:'',
				categoria:'',
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



			}

		},
		created:function(){
			//this.getcrrut();
			this.getAgregarNombre();


		},
		mounted(){

			this.getTotalcc();
		},
		methods:{
			verpdfviatico(id){
				var d=new FormData()
				d.append('id',id);
				axios.post('../encriptar',d).then(response=>{
					window.open('../visorpdfarchivos/'+response.data);
				}).catch(err=>{});

			},
			rechazar(tipo)
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
					title: 'Desea rechazar el (la)'+tipos +'N° '+this.numero+'?',          
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
						if(tipo == 1){
							this.rechazarot(result.value)
						}else if(tipo == 2){
							this.rechzarviatico(result.value)

						}else if(tipo == 3){
							this.rechazarFondo(result.value)
						}
						




					}

				});

			},
			rechazarFondo(obs){
				var url='../fondo_j/'+this.numero
				var d={
					_method:'patch',
					estado:4,
					motivo_rechazo:obs

				}
				axios.post(url,d).then(response=>{

				}).catch(err=>{

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
			rechazarot(obs){
				var url="../ordenesdecompra"+this.numero
				var d={
					compra_estado:16,
					compra_anulada_por:this.id_session,
					compra_motivo_anulacion:obs,
					_method:'patch'
				}
				axios.post(url,d).then(response=>{}).catch(err=>{});

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
			getarchivos(id)
			{
				axios.get('../adjuntosots_bd/'+id).then(response=>{
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
			getpersona(id,fecha)
			{
				axios.get('../persona/'+id).then(response=>{
					this.firma_cc_encargado=response.data[0].per_nombre+ fecha;

					

				}).catch(err=>{

				});

			},
			getpersona2(id,fecha)
			{
				axios.get('../persona/'+id).then(response=>{
					this.firma_jef_encargado=response.data[0].per_nombre+ fecha;

					

				}).catch(err=>{

				});

			},
			crearhistoria(id,estado,actividad){
				var d=new FormData();
				d.append('id_compra',id)
				d.append('estado',estado)
				d.append('actividad',actividad)
				d.append('usuario',this.id_session)
				axios.post('../historialdecompras2',d).then(response=>{

				}).catch(err=>{

				});


			},
			autorizarot(tipo,numero2)
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

						if(tipo== 1){
							this.autorizarots();
							this.updatedsolicitud(this.id_so);
							this.addfirmassolicitud(this.id_so);
							this.versolicitudes(tipo);
							this.crearhistoria(this.idcomprar,4,1);
							this.crearhistoria(this.idcomprar,7,6);
							this.versolicitudes(tipo);
							this.getTotalcc();
							$("#modal_fondo").modal('hide');
						}else if(tipo == 2){
							
							this.updatedsolicitud(this.id_so);
							this.addfirmassolicitud(this.id_so);
							this.versolicitudes(tipo);
							this.creacppviatico(numero2);
							this.getTotalcc();
							$("#modal_fondo").modal('hide');

						}else if(tipo == 3){
							this.updatesolicitud();
							this.updatedsolicitud(this.id_so);
							this.addfirmassolicitud(this.id_so);
							this.versolicitudes(tipo);
							this.getTotalcc();
							$("#modal_fondo").modal('hide');

						}
						

					}

				});

			},
			refrendarcc(id,cpp)
			{
				var d=new FormData();
				d.append('cpp',cpp);
				d.append('refrendacion',id)
				axios.post('../montoscc',d).then(response=>{

				}).catch(err=>{});


			},

			creacppviatico(numero2){
				const f = new Date();
				var day = f.getDate()
				var month = f.getMonth() + 1
				let year = f.getFullYear()

				var obse="Viatico "+this.numero+"/"+this.v_year +" a "+this.v_beneficiario+
				" a contar del"+ this.v_fecha_inicio +" hasta "+this.v_fecha_termino+
				" en Provincia de "+this.v_lugar+"."+
				" por el sgte motivo: "+this.v_motivo;
				var tipoviatico= this.anticipoviatico ==1 ? 9:5;
				var d=new FormData();
				
				d.append('total_neto',this.v_total);
				d.append('total',this.v_total);
				d.append('descuento',0);
				d.append('despacho',0);
				d.append('impuesto',0);
				d.append('oc',0);
				d.append('proveedor',0);						
				d.append('tipo',tipoviatico);
				d.append('estado',2);
				d.append('iva',0);
				d.append('proveedor',this.proveedor)
				d.append('observacion',obse);
				d.append('year',this.v_year);
				d.append('usuario',this.id_session);
				axios.post('../crearcpp',d).then(response=>{
					axios.get('../crearcpp/'+response.data).then(resbuscar=>{
						this.dulcealert("CPP Creado N°"+resbuscar.data.numero,'success')

					}).catch(err=>{

					});
					this.updaviatico(numero2,response.data);
					this.addviaticoproducto(response.data);
					this.refrendacion(response.data,this.v_total);
					this.addcppviaticos(numero2,response.data,tipoviatico);
					this.addcompromisoviaticos(response.data,numero2)
					$("#modalaceptar").modal('hide');
				}).catch(err=>{

				});

			},
			addcompromisoviaticos(cpp,viatico){
				var d=new FormData()
				d.append('cpp',cpp)
				d.append('viatico',viatico)
				axios.post('viaticoscpp',d).then(response=>{
				}).catch(err=>{

				});



			},
			addcppviaticos(numero2,cpp,tipo){
				var url='../adjuntosdocu/'+numero2
				var d={
					numero:numero2,
					tipo:tipo,
					_method:'patch'

				}

				axios.post(url,d).then(response=>{

				}).catch(err=>{

				});

			},
			refrendacion(id,monto)
			{
				var fecha = new Date();
				const dia = fecha.getDate();
				const mes = fecha.getMonth(); 
				const year = fecha.getFullYear();
				const hora=fecha.getHours();
				const minuto=fecha.getMinutes();
				const segundo=fecha.getSeconds();

				const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
				var d=new FormData();
				d.append('monto',monto);
				d.append('cpp',id);
				d.append('estado',1);
				d.append('usuario',this.id_session);
				d.append('fecha',this.formateofechasbdhoy());
				d.append('year',this.v_year);

				this.bloqueo=true;
				axios.post('../refrendacion',d).then(response=>{

					this.refrendarcc(response.data,id);
					this.bloqueo=false
				});

			},
			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			addviaticoproducto(id)
			{
				
				switch(this.v_ley_med){
				case 1:
					switch(this.v_calidad){
					case 1:
						var item='53102040603'
						var subitem='210200400603';
						var nombre='Viaticos Contrata Ley 19664';
						break;
					case 2:
						var item='53102040603'
						var subitem='210200400603';
						var nombre='Viaticos Planta Ley 19664';
						break;
					case 3:
						var item='531030105'
						var subitem='210300100105';
						var nombre='Viáticos Honorarios A Suma Alzada';
						break;
					}
					break;
				case 2:
					switch(this.v_calidad){
					case 1:
						var item='53102040602'
						var subitem='210200400602';
						var nombre='Viaticos Contrata Ley 18834';
						break;
					case 2:
						var item='53101040602'
						var subitem='210100400602';
						var nombre='Viaticos Planta Ley 18834';
						break;
					case 3:
						var item='531030105'
						var subitem='210300100105';
						var nombre='Viáticos Honorarios A Suma Alzada';
						break;
					}

					break;
					
				}
				var p=new FormData();
				p.append('nombre','9000202 - VIATICO')
				p.append('cantidad',1)
				p.append('detalle',null)
				p.append('precio',this.v_total)
				p.append('id_aba',0)
				p.append('orden',1)
				p.append('cuenta',1)
				p.append('total',this.v_total)
				p.append('unidad','UD')
				p.append('nombre_sigfe',nombre)
				p.append('nombre_producto','9000202 - VIATICO')
				p.append('sub_item_sigfe',subitem)
				p.append('estado',0)
				p.append('justificacion',null)
				p.append('cc',this.v_cc)
				p.append('convenio',0)
				p.append('precio_todo',this.v_total)
				p.append('pro_id_cpp',id)
				p.append('pro_precio_unitario',this.v_total)
				p.append('pro_cantidad_unitario',1)
				p.append('sigfe_item',21)
				p.append('zgen',0)
				p.append('cuenta',item)
				p.append('oc',0) 
				axios.post('../crearproductos',p).then( respo=>{	
				}).catch(err=>{

				});

			},
			updaviatico(numero2,cpp){
				var url="../viaticos_jt/"+numero2
				var d={
					v_estado:2,
					v_firma_cc:this.formateofechasbdhoy(),
					v_firma_cc_run:this.id_session,
					v_id_cpp:cpp,

					_method:'patch'
				}
				axios.post(url,d).then(response=>{

				}).catch(err=>{

				});


			},
			updatesolicitud()
			{
				var url="../fondo_j/"+this.numero;
				var d={
					estado:3,
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
					estado:5,
					prioridad:0,
					activo:0,
					actividad:1,
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
				d.append('estado',4)
				axios.post('../firmasolicitudes',d).then(response=>{

				}).catch(err=>{

				});

			},
			autorizarots(){
				this.bloqueo=true;
				var fecha = new Date();
				const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;

          var url="../historials/"+this.id_h;
          var d={
          	id:this.id_h,          
          	firma_sub:this.id_session,
          	fecha_sub:dateString,
          	id_estado_timeline:6,
          	_method:'patch'
          }
          axios.post(url,d).then(response=>{
          	var url2='../compras/'+this.idcomprar;
          	var da={
          		compra_id:this.idcomprar,
          		compra_jefatura_sub_rut:this.id_session,
          		compra_jefatura_sub_aprueba_fecha:dateString,
          		compra_estado:7,
          		_method:'patch'
          	}
          	axios.post(url2,da).then(resp=>{
          		this.bloqueo=false;

          		this.updatedsolicitud(this.id_so);
          		
          		this.versolicitudes(tipo);


          	}).catch(err=>{});


          	$("#modalaceptar").modal('hide');
          }).catch(err=>{
          	this.bloqueo=false;
          });




      },
      versolicitudes(tipo){
      	var fecha = new Date();
      	const dia = fecha.getDate();
      	const mes = fecha.getMonth(); 
      	const year = fecha.getFullYear();
      	var d=new FormData();
      	d.append('run',this.id_session)
      	d.append('year',year);
      	d.append('estado',4);
      	d.append('tipo',tipo);
      	this.bloqueo=true;
      	axios.post('../solicitudes3',d).then(response=>{
      		if(tipo == 1){
      			this.data=response.data;
      		}else if(tipo == 2){
      			this.data_productos_sub1=response.data

      		}else if(tipo == 3){
      			this.data_productos_sub2=response.data
      		}

      		this.bloqueo=false;
      		console.log(response.data[0].id_cc);

      	}).catch(err=>{
      		this.bloqueo=false;
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

      getTotalcc(){
      	this.bloqueo=true;
      	if(this.cr == 1){
      		var id_cc_sub2=14;

      	}else  if(this.cr == 3){
      		var 	id_cc_sub2=138;
      	}else{
      		var id_cc_sub2=0;
      	}

      	var d={
      		id_sub:this.cr,
      		id_cc_sub:this.sub_cc,
      		id_cc_sub2:id_cc_sub2
      	}
      	var fecha = new Date();
      	const dia = fecha.getDate();
      	const mes = fecha.getMonth(); 
      	const year = fecha.getFullYear();
      	var d=new FormData();
      	d.append('run',this.id_session)
      	d.append('year',year);
      	d.append('estado',4);
      	d.append('tipo',1);
      	this.bloqueo=true;
      	axios.post('../solicitudes3',d).then(response=>{
      		this.data_productos_sub=response.data;
      		this.bloqueo=false;
      		console.log(response.data[0].id_cc);

      	}).catch(err=>{
      		this.bloqueo=false;
      	});




      },
      getFirmas(id){

//firmaotsub

      	axios.get('../firmaotter/'+id).then(response=>{
      		if(response.data !=''){
      			this.ver_jefatura=true;
      			this.firma_jef_encargado=response.data[0].per_nombre+'  '+response.data[0].created_at;
      			this.url_imagen_jef='../assets/img/check.png';
      		}

      	});
      	axios.get('../firmaotsub/'+id).then(response=>{
      		if(response.data !=''){	
      			
      			this.firma_cr_encargado=response.data[0].per_nombre+'  '+response.data[0].created_at;
      			this.url_imagen_cr='../assets/img/check.png';
      		}

      	});
      	axios.get('../firmaot/'+id).then(response=>{
      		if(response.data !=''){
      			this.firma_cc_encargado=response.data[0].per_nombre+'  '+response.data[0].created_at;;
      			
      			this.url_imagen_cc='../assets/img/check.png';
      		}

      	});


      },
      getNombreusuario(id,fecha,cc,cr){
      	axios.get('../persona/'+id).then(response=>{
      		if(response.data != ''){

      			if(cc == 1){
      				this.url_imagen_cc='';
      				this.firma_cc_encargado=response.data[0].per_nombre+'   '+fecha;
      				this.url_imagen_cc='../assets/img/check.png';

      			}else{
      				this.url_imagen_cr='';
      				this.firma_cr_encargado=response.data[0].per_nombre+'   '+fecha;
      				this.url_imagen_cr='../assets/img/check.png';

      			}

      		}

      	});


      },
      visualizarnuevo(id,tipo,cc,id_s,anticipo,idproveedor)
      {
      	this.viewproductos=false;
      	this.viewviaticos=false
      	this.s_tipo=tipo;
      	this.id_so=id_s;
      	this.bloqueo=true;
      	switch(tipo) {
      	case 1:
      		this.getordenes(id)
      		break;
      	case 2:
      		this.getViaticos(id,anticipo,idproveedor)
      		break;
      	case 3:
      		this.getFondo(id_s)
      		break;
      	default:
    // code block
      	}




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
      getViaticos(id,anticipo,idproveedor){
      	this.anticipoviatico=anticipo;
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
      		this.proveedor=idproveedor
      		this.v_ley_med=response.data[0].v_ley_med
      		this.v_calidad=response.data[0].v_calidad
      		this.v_year=response.data[0].v_year
      		this.v_local=response.data[0].reg_nombre
      		this.v_lugar=response.data[0].prov_nombre+','+response.data[0].reg_nombre;
      		this.year=response.data[0].v_year;
      		this.numero=response.data[0].v_num;
      		this.centro_costo=response.data[0].cc;
      		this.centro_res=response.data[0].cr;
      		this.nombre_usuario=response.data[0].per_nombre;
      		this.precio_total=this.formatPrice(response.data[0].v_d_total)    
      		this.fecha_orden=response.data[0].v_sistema_fecha;
      		this.v_total=response.data[0].v_d_total
      		this.v_cc=response.data[0].v_cc
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
      getordenes(id,sigfe){
      	axios.get('../ordenesdecompra2/'+id).then(response=>{

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
      visualizar(numero,id,year,nombre,usuario,cr_nombre,contacto,fecha,id_compra,id_cc_cr,id_cc,sigfe,historial,subdireecion,fechas,j_centros,fechac){
      	this.bloqueo=true;
      	console.log(j_centros);
      	setTimeout(()=>{

      		this.titulomodal='Solicitud de Compra';
      		this.year=year;
      		this.numero=numero;
      		this.centro_costo=nombre;

      		
      		this.centro_res=cr_nombre;
      		this.nombre_usuario=usuario;
      		this.contacto=contacto;
      		this.fecha_orden=fecha;
      		this.idcomprar=id_compra;
      		this.id_cc_cr=id_cc_cr;
      		this.id_h=historial;

      		this.getpersona2(subdireecion,fechas)
      		this.getpersona(j_centros,fechac)





					//this.getPresupuesto(id_cc_cr,id_cc,sigfe);   
      		this.buscarprespuestos(id_cc,sigfe);     

      		this.getProductos(id_compra);
      		;} , 3000);

      	$("#modalaceptar").modal();

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
      buscarprespuestos(id,sigfe){
      	var today = new Date();
      	var year = today.getFullYear(); 
      	var d=new FormData();
      	d.append('cc',id);
      	d.append('sigfe',sigfe);
      	d.append('amio',year)
      	axios.post('../nuevoprespuesto',d).then(response=>{
      		this.presupuesto_cc=response.data.monto;
      		this.sigfe_id=response.data.sigfe
      		this.buscartotalprespuestocr(response.data.cr)
      		this.buscarrefrendacioncc(id,this.sigfe_id);
      		this.getgasta(response.data.cr,2,this.sigfe_id);

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
      getAgregarNombre(){
      	if(this.cr == 1){
      		this.cr_cc="DIRECCION"
      	}else if(this.cr == 2){
      		this.cr_cc="SDRFYF";

      	}else if(this.cr == 3){
      		this.cr_cc="SDGA";
      	}else if(this.cr == 4){
      		this.cr_cc="SDRRHH";

      	}

      },
      async  getcrrut(){
      	if(this.cr == 1){
      		var id_cc_sub2=14;

      	}else  if(this.cr == 3){
      		var 	id_cc_sub2=138;
      	}else{
      		var id_cc_sub2=0;
      	}

      	var d={
      		id_sub:this.cr,
      		id_cc_sub:this.sub_cc,
      		id_cc_sub2:id_cc_sub2
      	}

      	await axios.post('../ot_por_asignar',d).then(response=>{
      		let ins=this;
      		if(response.data != ''){
      			ins.data_productos_sub=response.data


      		}else{
      			axios.get('../ot_aprobar_persona/'+this.id_session).then(response2=>{
      				ins.data_productos=response2.data;
      			});

      		}					

      	});
      },
      formatPrice(value) {
      	let val = (value/1).toFixed(0).replace('.', '.')
      	return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },    getCalculo_2(id,id2){
      	var cal=(id2/id)*100;



      	return cal;

      },

      getCalculo_1(id,id2){

      	var cal=id-id2;

      	return cal;

      },
      getProductos(id){

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


  }

}

</script>