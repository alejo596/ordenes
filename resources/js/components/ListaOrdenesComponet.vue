<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card border-success">
					<div class="card-header text-center text-white bg-success">
						<h5><b>Solicitudes de Trabajo / Compra Generadas</b></h5>
					</div>

					<div class="card-body">
						<div class="row mt-3">
							<div class="col-1">
								<label>N° OT</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" class="form-control" v-model="ot">
								
							</div>
							<div class="col-md-1 ">
								<label>CENTROS DE COSTOS</label>
								
							</div>
							<div class="col-md-4">
								

								<input type="text" name=""  v-model="cc_nombre_b" class="form-control" @blur="verlista">
								
								<div class="vistainput"  >
									<div  v-for="(lcc,index) in listcc" :key="index">
										<span class="elegir" @click="elecciondecc(lcc.id,lcc.nombre)" @mousedown.prevent >{{lcc.nombre}}</span>
									</div>
								</div>
								<input type="hidden" name="" v-model="idcc_b">
								
							</div>
							<div class="col-md-1">
								<label>AÑO</label>
								
							</div>
							<div class="col-md-2">
								<select class="form-control" v-model="year2">
									<option v-for="y in year_reporte" :selected="y.year == years ? 'selected' : ''" :value="year2">{{y.year}}</option>
								</select>
								
							</div>
							
							
						</div>
						<div class="row mt-2">
							<div class="col-md-1">
								<label>MES:</label>
								
							</div>
							<div class="col-md-2">
								<select class="form-control" v-model="mes">
									
									<option value="1" >Enero</option>
									<option value="2" >Febrero</option>
									<option value="3" >Marzo</option>
									<option value="4" >Abril</option>
									<option value="5" >Mayo</option>
									<option value="6" >Junio</option>
									<option value="7" >Julio</option>
									<option value="8" >Agosto</option>
									<option value="9" >Septiembre</option>
									<option value="10" >Octubre</option>
									<option value="11" >Noviembre</option>
									<option value="12" >Diciembre</option>
								</select>    
								
							</div>
							<div class="col-md-1">
								<label>Estado:</label>
							</div>
							<div class="col-md-2">
								<select class="form-control" v-model="estado">
									<option value="1">Guardadas</option>
									<option value="2">En Proceso</option>
									<option value="3">Listado</option>
								</select>
								
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-12 offset-5">
								<button class="btn btn-success" @click="buscarordenes">Buscar</button>
								<button class="btn btn-info" @click="limpiarordenes">Limpiar</button>
							</div>

						</div>
						<br>
						<br>
					</div>
					




				</div>

				
			</div>
			
		</div>
		<div class="card mt-3 border-primary">
			<div class="card-header text-center text-white bg-primary"><h5><b>Lista de Ordenes de Trabajo</b></h5></div>
			<div class="card-body">
				<div class="row ">
					<div class="col-md-12">
						<v-client-table :columns="columns" v-model="tableData" :options="options">
							<div slot="pdf" slot-scope="props">
								<a @click="verpdfs(props.row.compra_id)"><img :src="'assets/img/pdf.png'" width="30" height="30" style="cursor: pointer;"></a>

							</div>
							<div slot="acciones"  slot-scope="props">
								<a href="#"  @click="detalleot(props.row.compra_id)"><i style="cursor: pointer;" class="fas fa-search"></i></a>
							</div>
							<div slot="editar" slot-scope="props" v-if="props.row.compra_estado == 1">
								<a href="#" @click="ediatrordenes(props.row.compra_id,props.row.compra_numero,props.row,props.row.sigfe_presupuesto)"><i class="fas fa-edit"></i></a>
							</div>
							<div slot="fecha_registrada" slot-scope="props">
								{{formatofecha(props.row.fecha_registrada)}}
								
							</div>
							<div slot="fecha_sub" slot-scope="props" v-if="props.row.fecha_sub != null">

								{{formatofecha(props.row.fecha_sub)}}
							</div>




						</v-client-table>

					</div>
				</div>


			</div>
			

		</div>
		<BlockUI :message="msg"  v-if="bloqueo">
			<img :src="'assets/img/745.gif'">

		</BlockUI>
		<div class="modal fade" id="ediatrorden"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
			<div class="modal-dialog modal-dialog-centered modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ordenes de Compra N {{editar_numero}}  Estado: {{editar.estado_nombre}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-2">
								<label>Centro de Costo:</label>
								
							</div>
							<div class="col-4">
								<input type="" name="" v-model="editar.cc_nombre" placeholder="Buscar Centro Costo"  class="form-control" @keyup="buscarcentrodecosto(editar.cc_nombre)">
								<div  v-if="toggle_centro"  style="
								z-index: 1;
								position: absolute;
								background-color: #ffff;
								width: 80%;
								">
								<div  v-for="(book,index) in newBooks_centro" >
									<span @click="selectResult_centro(book.id,book.nombre,book.cr_id,book.cr_nombre,index,editar)" @mousedown.prevent  class="elecciondeproducto">
										{{ book.nombre }}
									</span>
								</div>
							</div> 
							
							<input type="hidden" name="" v-model="cr_centros">
							<input type="hidden" name="" v-model="editar.compra_cc">
							<input type="hidden" name="" v-model="id_personas_centro">
						</div>
						<div class="col-2">
							<label>Sigfe:</label>

						</div>
						<div class="col-2">
							<input type="" name="" class="form-control" v-model="editar.sigfe_presupuesto">

						</div>


					</div>
					<div class="row mt-2">
						<div class="col-2">
							<label>Correo:</label>

						</div>
						<div class="col-4">
							<input type="" name="" class="form-control" v-model="editar.compra_correo">

						</div>
						<div class="col-2">
							<label>Fecha Guardada:</label>

						</div>
						<div class="col-4">
							<input type="" name="" class="form-control" v-model="editar.compra_fecha_guardada">

						</div>


					</div>
					<div class="row mt-2">
						<div class="col-4">
							<div class="card border-primary">
								<div class="card-header bg-primary text-center text-white">
									<h5>Firmas Anexas</h5>
								</div>
								
								<div class="card-body">
									<div class="row">
										<div class="col-12">

											<input type="" name="" class="form-control" v-model="search_firma" placeholder="Buscar firma anexa">
											<div class="results" v-if="toggle_firma"  style="
											z-index: 1;
											position: absolute;
											background-color: #ffff;
											width: 80%;
											">
											<div class="result" v-for="(book,index) in newBooks_firma" >
												<span @click="selectResult_firma(book.per_nombre,book.per_rut,index)" @mousedown.prevent class="elecciondepersona_">
													{{ book.per_nombre}}
												</span>
											</div>
										</div>

									</div>


								</div>

								<ul class="list-group mt-2">
									<li class="list-group-item " v-for="(firma,index) in firmasanexas" style="font-size: 12px">{{firma.per_nombre}} <img  :src="'assets/img/priority.png'" width="30" height="30" v-if="checkprioridad[index]==true || firma.prioridad == 1">
										<input type="checkbox" name="" class="mt-1" v-model="checkprioridad[index]" :value="index" :checked="tfirmas" @change="cambioprioridad(index,checkprioridad[index],firma)">
										<a><i @click="eliminarelemento(index,firma.crud,firma.id)" class="fas fa-trash"></i></a>
									</li>

								</ul>

							</div>

						</div>

					</div>
					<div class="col-4">

						<div class="card  mb-3 border border-info" style="max-width: 18rem;">
							<div class="card-header text-white bg-info">Valor OT</div>
							<div class="card-body">

								<h5 class="card-text">$ {{formatPrice(totalproedit)}}</h5>


							</div>
						</div>



					</div>
					<div class="col-4">
						<div class="card  mb-3 border border-success" style="max-width: 18rem;">
							<div class="card-header text-white bg-success">Presupuesto</div>
							<div class="card-body">

								<h5 class="card-text">$ {{saldo_actual}}</h5>


							</div>
						</div>

					</div>

				</div>
				<div class="row mt-2">
					<div class="col-12">
						<div class="alert alert-danger" role="alert" v-show="saldo_actual == 0">
							<label class="text-center">No tiene Prespuesto </label>	
						</div>
						<div class="alert alert-warning" role="alert" v-show="monto_sobrepasado">
							<label class="text-center">Monto sobre pasa el presupuesto </label>	
						</div>
					</div>

				</div>
				<div class="row mt-2">
					<div class="col-12 offset-10">
						<button class="btn btn-primary" @click="agregar()">Agregar Productos</button>

					</div>

				</div>
				<div class="row mt-2">

					<table class="table table-hover">

						<thead>
							<tr>
								<th scope="col">Id</th>
								<th scope="col">Nombre</th>
								<th scope="col">cantidad</th>
								<th scope="col">precio</th>
								<th scope="col">Total</th>
								<th>Descripcion</th>
								<th>Justificacion</th>
								<th scope="col">Adjuntos</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>

						<paginate name="editar_productos" :list="editar_productos" :per="4" tag="tbody" :key="editar_productos ? editar_productos.length :0">
							<tr v-for="(p,index) in paginated('editar_productos')" >

								<td>{{p.indice}}</td>
								<td v-show="p.crud == 1">{{p.pro_nombre}}</td> 
								<td v-show=" p.crud == 0"> 
									<input v-model="p.pro_nombre" :name="`editar_productos[${p.indice}][nombre]`" type="text" class="form-control fontinput" placeholder="Nombre del producto" @keyup="buscar_producto(p.pro_nombre,p.indice)">
									<div style="z-index: 1;position: absolute;width: 28%;background-color: #ffff;" v-if="toggle_producto[p.indice]">
										<div class="result_producto" v-for="book_producto in newBooks_producto2[p.indice]" >
											<span  @click="selectResult_producto(book_producto.codigo,book_producto.nombre,p.indice,book_producto.cuenta_sigfe,book_producto.sub_item_sigfe,book_producto.nombre_sigfe,book_producto.unidad_medida,book_producto.zgen)"
											class="elecciondeproducto" @mousedown.prevent style="font-size: 12px">
											{{book_producto.codigo}} - {{ book_producto.nombre}}
										</span>
									</div>
								</div>




                        

							</td>
						
							<td  v-show="p.crud == 1">{{formatPrice(p.pro_cantidad)}}</td>
							<td  v-show="p.crud == 0"> <input type="" :name="`editar_productos[${p.indice}][cantidad]`" class="form-control" v-model="p.pro_cantidad" @change="sacarvalor(p.pro_precio,p.pro_cantidad,p.indice)"></td>

							<td  v-show="p.crud == 0"><input type="" :name="`editar_productos[${p.indice}][precio]`" class="form-control" v-model="p.pro_precio"  @change="sacarvalor2(p.pro_precio,p.pro_cantidad,p.indice)"></td>
							<td  v-show="p.crud == 1">{{formatPrice(p.pro_precio)}}</td>
							<td>{{formatPrice(p.pro_cantidad*p.pro_precio)}}</td>

							<td  v-show="p.crud == 1"  @click="check(p.indice,p.pro_id,p.pro_descripcion)" >
								{{p.pro_descripcion.substring(0, 9)}}

							</td>
							<td v-show="p.crud == 0" @click="check(p.indice,p.pro_id,p.pro_descripcion)">
								{{p.pro_descripcion.substring(0, 9)}}
							</td>
							<td v-show="p.crud == 1" @click="check2(p.indice,p.pro_id,p.pro_justificacion)">
								{{p.pro_justificacion.substring(0, 9)}}

							</td>
							<td  v-show="p.crud == 0" @click="check2(p.indice,p.pro_id,p.pro_justificacion)">
								{{p.pro_justificacion.substring(0, 9)}}
							</td>
							<td v-show="p.crud == 0">

								<form method="POST" enctype="multipart/form-data" name="myForm">
									<div class="text-center   btn btn-success btn-sm offset-2" style=" text-align: center;"  @click="getFile_2(p.indice)">
										SUBIR
									</div>

									<input name="MAX_FILE_SIZE" type="hidden" id="imageA"  value="3000000" />
									<div style='height: 0px;width: 0px; overflow:hidden;'><input :name="`editar_productos[${p.indice}][adjunto]`" type="file"  :id="'upfile_documentos'+p.indice" ref="file_documento"  @change="sub_documento($event,p.indice)" multiple="true" accept="application/pdf" /></div>
								</form>
								<div class="container mt-2">
									<carousel>
										<slide v-if="p.adjunto.length > 0 " v-for="(ad,j) in p.adjunto" :key="j">

											<img :src="'assets/img/pdf.png'"  width="40" height="35" data-toggle="tooltip" data-placement="top"  :title="ad.name">
											<span ><a @click="limpiar(p.indice,j)"><i class="far fa-trash-alt"></i></a></span>

										</slide>
									</carousel>
								</div>

							</td>
							<td v-show="p.crud == 1">

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
										<div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{editar.compra_numero}} </div>
										<div class="card-body">
											<div class="col-12 container">
												<carousel>
													<slide v-for="(ar,index) in archivos" :key="index" v-if="ar.index == p.pro_id">
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
						<td> <a href="#" @click="elimnarproducto(p.pro_id,p.pro_id_oc,p.indice,p.crud)"><i class="fas fa-trash"></i></a></td>

					</tr>

				</paginate>

			</table>
			<paginate-links for="editar_productos" :classes="{'ul': ['pagination','justify-content-end'], 'li': 'page-item', 'a': 'page-link'}"></paginate-links>

		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-success" @click="guardareditar">Guardar</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		<button class="btn btn-danger" @click="eliminarot(editar.compra_id)">Eliminar</button>
		<button type="button" class="btn btn-primary" @click="enviarot(editar.compra_id,editar.compra_cc,editar.compra_amio)" v-show="ocultarenviar">Enviar</button>
	</div>
</div>
</div>
</div>
<div class="modal face"  id="modaleditor" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editor {{titulo}}</h5>
				<button type="button" class="close"  aria-label="Close" @click="cerrarmodaleditar()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<markdown-editor toolbar="bold italic heading | image link | numlist bullist code quote | preview fullscreen"  v-model="value" @change="evaluarcaracteres(value)"></markdown-editor>
				<div class="input-group-addon" v-text="(max - value.length)">Caracteres</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" @click="Copiar">Copiar {{titulo2}}</button>
				<button type="button" class="btn btn-primary" @click="guardartexto">Guardar</button>
				<button type="button" class="btn btn-secondary" @click="cerrarmodaleditar()">Cerrar</button>

			</div>
		</div>
	</div>
</div>

</div>	
</template>
<style type="text/css">
	.vistainput{
		z-index:1;
		position:absolute;
		background-color:#ffff;
		width: 100%
	}
	.elegir:hover{
		cursor: pointer;
		color:#f96332;

	}
</style>
<script >
	export default
	{
		props: ['id_session','nombre'],

		data(){

			return {
				numero_compra:'',
				contador:0,
				id_paginacion:0,
				monto_sobrepasado:false,
				tfirmas:[],
				checkprioridad:[],
				elegirFirma:[],
				newBooks_firma:[],
				search_firma:'',
				toggle_firma:false,
				books_firma: [
				{name: 'Liste des livres de Chair de poule'},
				{name: 'Les Cent Meilleurs Romans policiers de tous les temps'},
				{name: 'Liste des livres publiés par Champ libre'}
				],
				ocultarenviar:true,
				presupuesto_cc:0,
				refrendar:0,
				g_refrendado:0,
				saldo:0,
				sigfe:0,
				saldo_ot:0,
				saldo_table:0,
				saldo_actual:0,
				toggle_centro:false,
				info_centro_c:[],
				search_centro:'',
				id_personas_centro:'',
				cr_id:'',
				cr_centros:'',
				cr:'',
				newBooks_centro:[],
				newBooks:[],
				paginate: ['editar_productos'],
				newBooks_producto2:[],
				id_producto:[],
				search_producto: [],
				toggle_producto:[],
				max:1500,
				value:'',
				titulo:'',
				titulo2:'',
				flag:'',
				flag_ix:'',
				firmasanexas:[],
				totalproedit:0,
				msg2:'',
				archivos:[],
				editar_productos:[],
				editar_numero:'',
				ediatr_id:'',
				editar:[],
				ot:'',
				verlista:false,
				idcc_b:'',
				listcc:[],
				estado:'',
				msg: 'Espere un Momento...',
				bloqueo:false,
				cc_nombre_b:'',
				years:0,
				year2:2022,
				mes:'',
				year_reporte:[],
				ordenes:[],
				centros:[],
				columns: ['compra_numero', 'per_nombre', 'cc_nombre','estado_nombre','fecha_registrada','fecha_sub','acciones','pdf','editar'],
				tableData:[],
				options: {
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
						compra_numero: 'N°',
						per_nombre: 'Nombre Usuario',                 
						cc_nombre: 'Centro de Costo', 
						estado_nombre:'Estado OT' ,
						fecha_registrada:'Fecha Registarda',					

						fecha_sub:'Fecha Ingreso a Compra',						
						acciones:'Detalle',
						pdf:'PDF',
						editar:'Editar'


					},
					sortable:  ['id'],
					filterable: ['id'],
					editableColumns:['id']
				}
				,

			}
		} ,
		created:function()
		{
			this.getListaOrdenes();

			this.getyear();
		},
		mounted()
		{
			var today = new Date();
			this.years = today.getFullYear();

		},
		watch:
		{
			cc_nombre_b(val)
			{
				console.log('valor',val)
				if(val.length >4)
				{          
					this.controladordepromesas(event,val);
				}
			},
			search_firma(val) {
				console.log(val);
				this.newBooks_firma = []; 

				axios.get('persona/'+val).then(response=>{
					this.newBooks_firma =response.data;
					this.toggle_firma=true


				}); 


			},
		},
		methods:
		{
			
			limpiar(index,j)
			{

				this.editar_productos[index].adjunto.splice(j,1);
			},
			getFile_2:function(index){
				var arch=document.getElementById("upfile_documentos"+index).click();

			},
			sub_documento(event,index){
				console.log(event.target);
				this.editar_productos[index-1].adjunto.push(event.target.files[0]);


				// this.productos=JSON.stringify(this.productos);
				// this.productos[index].adjunto.push(this.file_documento2);
				console.log(this.editar_productos);
				

			},
			
			guardareditar(){

				Swal.fire({
					title: 'Desea Guardar?',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {
						this.updateproductos(this.ediatr_id,this.editar.compra_cc);
						this.updatecompras(this.ediatr_id,this.editar.compra_cc,this.sigfe,this.cr_id,this.editar.compra_correo)
						console.log(this.firmasanexas)
						let year =  new Date().getFullYear();
						for (var i = 0; i < this.firmasanexas.length; i++) {
							if(this.firmasanexas[i].crud == 1){
								this.addfirmas(this.firmasanexas[i].run,year,this.editar.compra_cc,this.editar_numero,this.ediatr_id,this.firmasanexas[i].prioridad)
							}else{
								this.updatedirmas(this.firmasanexas[i].id,this.firmasanexas[i].run,this.editar.compra_cc,this.editar_numero,this.ediatr_id,this.firmasanexas[i].prioridad,year)
							}

						}


					}

				});
				
			},
			updateproductos(id,cc){
				this.actualizarproductos(id,0,cc);
				

			},
			postArchivos(p,a,producto,compra,ultima)
			{
				var total_adjunto=this.editar_productos[p].adjunto.length;
				this.total_i=this.total_i+a;


				let f=new FormData();
				f.append('file',this.editar_productos[p].adjunto[a]);
				f.append('id',producto);
				f.append('oc',compra);
				axios.post('adjuntos_ot',f).then(response=>{
					if(total_adjunto == this.total_i){

						this.id_paginacion=1;
					}
					this.bloqueo=false;

				}).catch(err=>{
					this.bloqueo=false;
					this.dulcealert('Error Al crear OT'+err,'error')
				});
			},
			actualizarproductos(id,estado,cc){
				var _this=this;
				for (let i = 0; i < this.editar_productos.length; i++) {
					console.log(this.editar_productos)
					console.log(i);	
					if(this.editar_productos[i].crud == 0){

						var p=new FormData();				
						p.append('oc',id);
						p.append('nombre',this.editar_productos[i].pro_nombre);
						p.append('cantidad',this.editar_productos[i].pro_cantidad);
						p.append('detalle',this.editar_productos[i].pro_descripcion);
						p.append('precio',this.editar_productos[i].pro_precio);
						p.append('id_pro',this.editar_productos[i].id_pro);
						p.append('estado_refren',1);
						p.append('estado',estado);
						p.append('cuenta',this.editar_productos[i].pro_cuenta_sigfe);
						p.append('total',this.editar_productos[i].pro_total);
						p.append('unidad',this.editar_productos[i].pro_unidad);
						p.append('nombre_producto',this.editar_productos[i].nombre_producto);
						p.append('sub_item_sigfe',this.editar_productos[i].sub_item_sigfe);
						p.append('justificacion',this.editar_productos[i].pro_justificacion);
						p.append('cc',cc);
						p.append('sigfe_item',this.editar_productos[i].sigfe_item);
						p.append('convenio',0);
						p.append('pro_id_cpp',0);
						axios.post('productos',p).then(response=>{
							this.editar_productos=JSON.parse(JSON.stringify(this.editar_productos));

							console.log('largo archivo',this.editar_productos[i]);
							for (var k = 0; k < this.editar_productos[i].adjunto.length;k++) 
							{
								console.log("aqui");

								_this.postArchivos(i,k,response.data,id,this.editar_productos[i].adjunto.length);	
							}

						}).catch(err=>{

						});

						

					}else{
						var url='productos/'+this.editar_productos[i].pro_id;
						if(this.editar_productos[i].pro_nombre == ""){
							break;
							this.dulcealert("Debe ingresar el nombre del producto","error")

						}

						var d={
							pro_nombre:this.editar_productos[i].pro_nombre,
							pro_cantidad:this.editar_productos[i].pro_cantidad,
							pro_precio:this.editar_productos[i].pro_precio,
							pro_id_aba:this.editar_productos[i].pro_id_aba,
							pro_comprador:this.editar_productos[i].pro_comprador,
							pro_total:this.editar_productos[i].pro_total,
							pro_nombre_sigfe:this.editar_productos[i].pro_nombre_sigfe,
							pro_nombre_producto:this.editar_productos[i].pro_nombre_producto,
							pro_sub_item_sigfe:this.editar_productos[i].pro_sub_item_sigfe,
							pro_estado_producto:estado,
							pro_costo_unitario_incluye_todo:this.editar_productos[i].pro_costo_unitario_incluye_todo,
							pro_cc:cc,
							pro_amio:this.editar_productos[i].pro_amio,
							pro_convenio:this.editar_productos[i].pro_convenio,
							pro_cantidad_solicitud:this.editar_productos[i].pro_cantidad_solicitud,
							pro_precio_unitario:this.editar_productos[i].pro_precio_unitario,
							pro_cantidad_unitario:this.editar_productos[i].pro_cantidad_unitario,
							sigfe_item:this.editar_productos[i].sigfe_item,
							pro_descripcion:this.editar_productos[i].pro_descripcion,
							pro_justificacion:this.editar_productos[i].pro_justificacion,
							_method:'patch'

						}

						axios.post(url,d).then(response=>{

						}).catch(err=>{

						});


					}
					
				}


			},
			addproductos(id,estado){
				for (var i = 0; i < this.editar_productos.length; i++) {
					let p=new FormData();				
					p.append('oc',id);
					p.append('nombre',this.editar_productos[i].pro_nombre);
					p.append('cantidad',this.editar_productos[i].pro_cantidad);
					p.append('detalle',this.editar_productos[i].pro_descripcion);
					p.append('precio',this.editar_productos[i].pro_precio);
					p.append('id_pro',this.editar_productos[i].id_pro);
					p.append('estado_refren',1);
					p.append('estado',estado);
					p.append('cuenta',this.editar_productos[i].pro_cuenta_sigfe);
					p.append('total',this.editar_productos[i].pro_total);
					p.append('unidad',this.editar_productos[i].pro_unidad);
					p.append('nombre_producto',this.editar_productos[i].nombre_producto);
					p.append('sub_item_sigfe',this.editar_productos[i].sub_item_sigfe);
					p.append('justificacion',this.editar_productos[i].pro_justificacion);
					p.append('cc',this.editar_productos[i].pro_cc);
					p.append('sigfe_item',this.editar_productos[i].sigfe_item);
					p.append('convenio',0);
					p.append('pro_id_cpp',0);
					axios.post('productos',p).then(response=>{

					}).catch(err=>{

					});

				}


			},
			updatecompras(id,cc,sigfe,cr,correo){
				var url="compras/"+id
				var d={
					compra_cc:cc,
					compra_sub_direccion:cr,
					sigfe_presupuesto:sigfe,
					compra_correo:correo,
					_method:'patch'
				}
				axios.post(url,d).then(response=>{

				}
				).catch(err=>{

				});

			},
			updatedirmas(id,run,cc,numero,id_doc,prioridad,year){
				this.bloqueo=true;
				var url="solicitudes/"+id
				var d={
					usuario:run,
					cc:cc,
					numero:numero,
					id_doc:id_doc,
					prioridad:prioridad,
					year:year,
					_method:'patch'
				}
				axios.post(url,d).then(response=>{
					this.getFirmas(id_doc);
					this.dulcealert("Firma Guardada","success");
					this.bloqueo=false;
				}).catch(err=>{
					this.bloqueo=false;

				});

			},
			addfirmas(run,year,cc,numero,idoc,prioridad){
				this.bloqueo=true;
				var fir=new FormData();
				fir.append('usuario',run);
				fir.append('estado',2);
				fir.append('tipo',5);
				fir.append('year',year);
				fir.append('cc',cc);
				fir.append('numero',numero);
				fir.append('id_doc',idoc);
				fir.append('prioridad',prioridad);
				fir.append('activo',1);


				axios.post('solicitudes',fir).then(response=>{
					this.getFirmas(idoc);
					this.bloqueo=false;
					this.dulcealert("Firma Guardada","success");
				}).catch(erro=>{
					this.bloqueo=false;
				});



			},
			eliminarelemento(index,crud,id){
				console.log(crud);
				if(crud == 1){
					this.checkprioridad[index]=false
					this.firmasanexas.splice(index,1);

				}else{
					this.checkprioridad[index]=false
					this.eliminarsolicitud(id);
					this.firmasanexas.splice(index,1);
				}


			},
			eliminarsolicitud(id){

				axios.get('solicitudes6/'+id,{_method:'delete'}).then(response=>{

				}).catch(err=>{

				});

			},
			cambioprioridad(index,valarboo,array2)
			{
				console.log(	this.firmasanexas[index].prioridad)  
				var parsedobj = JSON.parse(JSON.stringify(array2));

				console.log('valarboo',valarboo)
				
				if(valarboo== true){
					// var prio={prioridad:1}
					// var a=Object.assign(parsedobj,prio);
					// this.elegirFirma[index]=a
					this.firmasanexas[index].prioridad=1;

				}else{
					// delete parsedobj.prioridad
					// this.elegirFirma[index]=parsedobj

					this.firmasanexas[index].prioridad=0;
				}
				console.log('elegirFirma',this.firmasanexas[index]);

			},
			selectResult_firma(nombre,run,index)
			{   
				var d=new Array();

				this.search_firma='';
				this.firmasanexas.push({'run':run,'per_nombre':nombre,'prioridad':0,'crud':1,'id':0});

			},
			agregar(){



				this.editar_productos.push({
					indice:this.id_paginacion+1,
					pro_nombre:'',
					pro_precio:0,
					pro_cantidad:1,
					pro_total:0,
					pro_descripcion:'Ingrese Descripcion',
					pro_justificacion:'Ingrese Justificacion',
					adjunto:[],
					id_pro:'',
					cuenta:'',
					familia_sigfe:'',
					sub_item_sigfe:'',
					zgen:0,
					compra:'',
					cc:null,
					convenio:null,
					nombre_producto:null,
					estado:null,
					unidad:null,
					crud:0,
					eliminar:'Eliminar'

				})





			},
			getFirmas(id){
				axios.get('solicitudes5/'+id).then(response=>{
					this.firmasanexas=response.data;
					for (var i = 0; i < this.firmasanexas.length; i++) {
						if(this.firmasanexas[i].prioridad == 1){
							this.checkprioridad[i]=true
						}
						
					}
				}).catch(err=>{

				});

			},
			enviarot(id,cc,year)
			{
				console.log(this.firmasanexas)
				
				Swal.fire({
					title: 'Desea enviar OT al centro de costo?',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {
						this.bloqueo=true;
						var url='compras/'+id
						var d={
							compra_estado:2,
							compra_id:id,
							_method:'patch'
						}

						axios.post(url,d).then(response=>{
							var url2='actualizarporot/'+id
							var da={
								pro_estado_producto:0

							}

							axios.post(url2,da).then(response=>{
								this.bloqueo=false;
								this.revisarsolicitudes(id,cc,year);
								this.dulcealert('OT enviada','success')
								this.getListaOrdenes();
								$("#ediatrorden").modal('hide')

								this.getyear();
							}).catch(err=>{
								this.bloqueo=false;
							});

						}).catch(err=>{
							this.bloqueo=false;
						});

					}

				});

			},
			 revisarsolicitudes(id,cc,year){
				for (var i = 0; i < this.editar_productos.length; i++) {
					if(this.editar_productos[i].zgen != 0){
						this.contador++;
					}
				}

				console.log("contador de zgen",this.contador)
				for (var i = 0; i < this.firmasanexas.length; i++) {
					 if(this.firmasanexas[i].prioridad == 1){ //add notiifcacion 
					 	var datos=new FormData();
					 	datos.append('accion','Debe autorizar o rechazar')
					 	datos.append('ot',this.firmasanexas[i].numero)
					 	datos.append('observacion','Tiene una firma anexa ')
					 	datos.append('estado',1)
					 	datos.append('usuario',this.firmasanexas[i].run)

					 	axios.post('notificaciones',datos).then(ressp=>{

					 	}).catch(err=>{});
					 }
					if(this.firmasanexas[i].crud == 0){// de bd se debe actualizar

						var url="solicitudes/"+this.firmasanexas[i].id
						var d={
							 prioridad:this.firmasanexas[i].prioridad,
							 activo:0,
							_method:'patch'
						}
                       axios.post(url,d).then(response=>{}).catch(err=>{});
				    }else if(this.firmasanexas[i].crud == 1){

							var fir=new FormData();
							fir.append('usuario',this.firmasanexas[i].run);
							fir.append('estado',2);
							fir.append('tipo',5);
							fir.append('year',year);
							fir.append('cc',cc);
							fir.append('numero',numero);
							fir.append('id_doc',id_doc);
							fir.append('prioridad',this.firmasanexas[''].prioridad);
							fir.append('activo',1);

							axios.post('solicitudes',fir).then(firmas=>{
                                	
							}).catch(erro=>{
								
							});
				    }
				}
				
				
				axios.get('compras/'+id).then(respo=>{
					this.numero_compra=respo.data.compra_numero;
					if(this.contador > 0){
						this.crearsolicitudquimico(cc,this.numero_compra,id,year,1,4,0,3);
						
						this.getListaOrdenes();
						$("#ediatrorden").modal("hide")
						this.bloqueo=false;
						
						this.productos=[];

						}else{//cc,numero,id_doc,year,estado,tipo,prioridad
							this.crearsolicitud(cc,this.numero_compra,id,year,3,1,0,3);
						
							this.bloqueo=false;
							$("#ediatrorden").modal("hide")
							this.getListaOrdenes();
							
							

						}
						this.updatecomprasestado(id,1);

					}).catch(err=>{

					});


				

			},
			crearsolicitud(cc,numero,id_doc,year,estado,tipo,prioridad)
			{
				console.log('largo de firmas',this.elegirFirma.length)
				console.log('array',this.elegirFirma)

				var d=new FormData();
				d.append('tipo',tipo)
				d.append('estado',estado)
				d.append('usuario',this.id_session)
				d.append('year',year)
				d.append('cc',cc)
				d.append('numero',numero)
				d.append('id_doc',id_doc)
				d.append('prioridad',prioridad)
				d.append('activo',0)
				axios.post('solicitudes',d).then(response=>{
					this.updatecomprasestado(id_doc,3);
					
                     this.crearsolicitudesdefirmas(cc,numero,id_doc,year,estado,tipo,prioridad)
				}).catch(err=>{

				});

			},
			crearsolicitudesdefirmas(cc,numero,id_doc,year,estado,tipo,prioridad)
			{
				
                   console.log('length',this.firmasanexas.length);
				if(parseInt(this.firmasanexas.length) > 0)
					{
						this.updatecomprasestado(id_doc,5);
						this.firmasanexas=JSON.parse(JSON.stringify(this.firmasanexas))

						
						this.crearhistoria(id_doc,2,6);
						this.crearhistoria(id_doc,5,0);
					}else{
						console.log("no entra al if")
					}
			},

			crearsolicitudquimico(cc,numero,id_doc,year,estado,tipo,prioridad){
				var d=new FormData();
				d.append('tipo',tipo)
				d.append('estado',estado)
				d.append('usuario',this.id_session)
				d.append('year',year)
				d.append('cc',cc)
				d.append('numero',numero)
				d.append('id_doc',id_doc)
				d.append('prioridad',prioridad)
				d.append('activo',0)
				axios.post('solicitudes',d).then(response=>{				
                     
                    this.updatecomprasestado(id_doc,6);
					if(this.firmasanexas.length > 0)
					{
						this.firmasanexas=JSON.parse(JSON.stringify(this.firmasanexas))
						
						this.crearhistoria(id_doc,2,6);
						this.crearhistoria(id_doc,5,0);

					}
                  this.bloqueo=false;
				}).catch(err=>{
                      this.bloqueo=false;
				});

			},
			updatecomprasestado(id,estado){
                var url="compras/"+id;
					var d={
                          compra_estado:estado,
                          _method:'patch'
					}

					axios.post(url,d).then(response=>{

					}).catch(err=>{

					});
			},
			crearhistoria(id,estado,actividad){
				var usuario=estado == 5 ? null:this.id_session;
				console.log(usuario)
				var d=new FormData();
				d.append('id_compra',id)
				d.append('estado',estado)
				d.append('actividad',actividad)
				d.append('usuario',usuario)
				axios.post('historialdecompras2',d).then(response=>{

				}).catch(err=>{

				});


			},
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
			elimnarproducto(id,ot,index,crud)
			{
				console.log(this.editar_productos.length)
				Swal.fire({
					title: 'Desea Eliminar Producto?',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {


						if(crud == 1){
							
							this.editar_productos.splice(index-1,1);
							this.dulcealert('Producto Eliminada','success')

						}else{
							
							axios.get('productoeliminar/'+id).then(response=>{
								this.dulcealert('Producto Eliminada','success')
								this.getproductoseditar(ot);
							}).catch(err=>{

							});
							this.editar_productos.splice(index-1,1);
							
						}


						/*if(this.editar_productos.length == 1)
						{
							this.eliminarottotal(ot);
							this.dulcealert('Producto Eliminada','success')
							this.getproductoseditar(ot);
							


						}else{
							axios.get('productoeliminar/'+id).then(response=>{
								this.dulcealert('Producto Eliminada','success')
								this.getproductoseditar(ot);
							}).catch(err=>{

							});

						}*/

					}

				});

			},
			eliminarpro()
			{
				for (var i = 0; i < this.editar_productos.length; i++) {

					axios.get('productoeliminar/'+this.editar_productos[i].pro_id).then(response=>{

					}).catch(err=>{

					});
				}
			},
			eliminarottotal(id)
			{
				axios.get('comprasdelete/'+id).then(response=>{
					this.eliminarpro();
					this.getproductoseditar(id);
					this.dulcealert('OT Eliminada','success')
					this.getListaOrdenes();
					this.getyear();
					$("#ediatrorden").modal('hide')

				}).catch(error=>{

				});

			},
			formatPrice(value) {


				if(parseInt(value) == 0 || isNaN(value)){
					
					return 0;
				}else{
					let val = (value/1).toFixed(0).replace('.', '.')
					return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")	
				}
				
			},
			
			eliminarot(id)
			{
				Swal.fire({
					title: 'Desea Eliminar OT?',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {

						axios.get('comprasdelete/'+id).then(response=>{
							this.eliminarpro();
							this.getproductoseditar(id);
							this.dulcealert('OT Eliminada','success')
							this.getListaOrdenes();
							this.getyear();
							$("#ediatrorden").modal('hide')

						}).catch(error=>{

						});

					}

				});

			},
			quitarFormatoPrice(value)
			{
				
				var monto=0;

				if(value != 0 ){
					if(value.length >=4){


						monto=value.replace(/[.]/g,'');
					}else{
						monto=value;
					}
				}else{
					monto=value;
				}

				return monto

				
				
			},
			calculartotal2()
			{
				this.bloqueo=true;
				var prespuesto=this.quitarFormatoPrice(this.presupuesto_cc);
				console.log('prespuesto',prespuesto);
				var refrendar =this.quitarFormatoPrice(this.refrendar)
				console.log('refrendar',refrendar);
				var g_refrendado=this.quitarFormatoPrice(this.g_refrendado)
				console.log('g_refrendado',g_refrendado);
				var saldo=  parseInt(prespuesto)-(parseInt(refrendar)+parseInt(g_refrendado))
				console.log(saldo);
				this.saldo=this.formatPrice(parseInt(saldo))				 
				
				this.saldo_actual=this.saldo
				this.bloqueo=false;


			},
			ediatrordenes(id,numero,array,sigfe)
			{

				this.sigfe=sigfe
				this.ediatr_id=id;
				this.editar_numero=numero
				this.editar=array
				this.getproductoseditar(id);
				this.getFirmas(id);

				this.buscarprespuestos(array.compra_cc,this.sigfe);
				this.buscarrefrendacioncc(array.compra_cc,this.sigfe);
				this.buscarsinrefrendar(array.compra_cc,this.sigfe);
				this.buscarpagado(array.compra_cc,this.sigfe);
				$("#ediatrorden").modal();


			},
			getproductoseditar(id)
			{
				axios.get('lista_editar/'+id).then(response=>{
					this.editar_productos=response.data
					this.totalproedit=0
					for (var i = 0; i < this.editar_productos.length; i++) {
						this.totalproedit=this.totalproedit+(this.editar_productos[i].pro_precio*this.editar_productos[i].pro_cantidad);
						console.log('totalproedit',this.totalproedit)
						this.getarchivos(this.editar_productos[i].pro_id)

					}

					this.id_paginacion=this.editar_productos[this.editar_productos.length-1].indice

				}).catch(err=>{

				});
			},
			limpiarordenes()
			{
				location.reload();
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
			detalleot(id)
			{

				this.bloqueo=true;
				var e=new FormData();
				e.append('id',id);
				axios.post('encriptar',e).then(response=>{
					this.bloqueo=true;
					window.location.href='detallelink/'+response.data+'/'+0;


				}).catch(err=>{

				});



				this.bloqueo=false;

			},
			controladordepromesas: function (event,val) 
			{
				this.idcc_b=''; 
				axios.get('centros/'+val).then(response=>{
					this.listcc=response.data;
					this.verlista=true;

				})





			},
			elecciondecc(id,nombre)
			{

				console.log('nombre',nombre);
				this.cc_nombre_b=nombre;
				this.idcc_b=id;
				this.verlista=false;
				this.listcc=[];


			},
			buscarordenes()
			{
				if(this.ot.length != 0){
					this.bloqueo=true;
					var d=new FormData();
					d.append('ot',this.ot)
					d.append('year',this.year2)
					axios.post('otsincc_buscadorxid',d).then(response=>{
						this.tableData=response.data;
						this.bloqueo=false;
					}).catch(err=>{
						this.bloqueo=false;
					});
				}else{


					this.bloqueo=true;

					if(this.idcc_b == '')
					{
						this.bloqueo=false;
						return this.dulcealert('Debe ingresar el centro de costo','error');
					}

					if(this.estado == '')
					{
						if(this.mes == '')
						{
							this.bloqueo=false;
							return this.dulcealert('Debe ingresar un mes','error');
						}

						if(this.year2 == '')
						{
							this.bloqueo=false;
							return this.dulcealert('Debe ingresar un año','error');
						}

						var d= new FormData();
						d.append('cc',this.idcc_b);
						d.append('mes',this.mes);
						d.append('year',this.year2);
						axios.post('otsincc_buscador',d).then(response=>{

							if(response.data.length == 0)
							{
								this.dulcealert('No Existen datos','warning');
							}
							this.tableData=[];
							this.tableData=response.data;


							this.bloqueo=false;

						}).catch(err=>{
							this.bloqueo=false;
						});
					}
				}

			},
			getyear(){
				var currentTime = new Date();
				var year = currentTime.getFullYear()
				var year=year+3;
				for (var i = 2022; i <= year; i++) {

					this.year_reporte.push({'year':i});

				}

			},
			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			getCentros()
			{
				axios.get('centros').then(response=>{
					this.centros=response.data;
				}).catch(err=>{
					this.dulcealert('error '+err,'error');

				});
			},
			getbuscarCompras(){

			},
			formatofecha(texto){
				return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3-$2-$1');
			},
			check(index,inx,value)
			{

				
				this.value=value;
				console.log(this.value)
				let numero=inx;
				this.titulo='Descripcion Producto N°'+numero;
				this.titulo2='Observacion';
				this.flag=0;
				this.flag_ix=index;
				$("#modaleditor").modal('show');
				


			},
			check2(index,inx,value)
			{
				

				this.value=value;
				let numero=inx;
				this.titulo='Observacion Producto N°'+numero;
				this.titulo2='Descripcion';
				this.flag=1;
				this.flag_ix=index;
				$("#modaleditor").modal('show');
				


			},
			Copiar()
			{

				let i=this.flag_ix;	
				if(this.flag == 0){
					this.editar_productos[i].pro_justificacion=this.value;
					this.dulcealert('Observacion copiada','success');
				}else{
					this.editar_productos[i].pro_descripcion=this.value;
					this.dulcealert('Descripcion copiada','success');
				}
			},
			cerrarmodaleditar()
			{
				var  i=this.flag_ix;	


				if(this.flag ==0){
					
					
					$("#modaleditor").modal('hide');
				}else{
					
					$("#modaleditor").modal('hide');
				} 

				



			},
			calculartotal()
			{
				this.totalproedit=0;
				for (var i = 0; i < this.editar_productos.length; i++) {
					this.totalproedit=this.totalproedit+(this.editar_productos[i].pro_precio*this.editar_productos[i].pro_cantidad);
				}
				var valor=this.quitarFormatoPrice(this.saldo_actual)
				console.log(valor);

				if(this.totalproedit > valor ){
					this.ocultarenviar=false
					this.monto_sobrepasado=true

				}else{
					this.ocultarenviar=true	
					this.monto_sobrepasado=false
				}
			},
			guardartexto()
			{
				

				let i=this.flag_ix;
				if(this.flag ==0){
					this.editar_productos[i].pro_descripcion=this.value;
					this.dulcealert('Descripcion guardada','success');
					$("#modaleditor").modal('hide');

				}else{
					this.editar_productos[i].pro_justificacion=this.value;
					this.dulcealert('Jstificacion guardada','success');
					$("#modaleditor").modal('hide');

				}

			},
			evaluarcaracteres(valor)
			{
				console.log(valor.length)
				if(valor.length  == 1500){
					this.dulcealert("debe ser ingresar solo hasta 1500 caracteres")
				}else{

				}
			},
			buscar_producto(value,index)
			{
				var inx=index-1;
				console.log(index);
				if(value.length > 3)
				{
					axios.get('productos_base/'+value).then(response=>{

						this.$set(this.newBooks_producto2,index,response.data);
						this.$set(this.toggle_producto,index,true);

					});
				}
			},
			selectResult_producto(id,nombre,index,cuenta_sigfe,sub_item_sigfe,nombre_sigfe,unidad,zgen)
			{

				this.toggle_producto[index]=false;
				this.editar_productos[index-1].pro_nombre=id+'-'+nombre;				
				this.editar_productos[index-1].id_pro=id;
				this.editar_productos[index-1].cuenta_sigfe=cuenta_sigfe;
				this.editar_productos[index-1].sub_item_sigfe=sub_item_sigfe;
				this.editar_productos[index-1].nombre_sigfe=nombre_sigfe;
				this.editar_productos[index-1].nombre_producto=nombre;
				this.editar_productos[index-1].unidad=unidad;
				this.editar_productos[index-1].zgen=zgen;
				
				console.log(index-1);
				var inx=index-1;

				console.log('data',this.data);


				this.id_producto[index]=id;

			},
			sacarvalor(precio,cantidad,index)
			{
				this.editar_productos[index-1].total=precio*cantidad;
				let valortotal=precio*cantidad;
				this.calculartotal();
				

			},
			sacarvalor2(precio,cantidad,index){
				this.editar_productos[index-1].total=precio*cantidad;
				let valortotal=precio*cantidad;
				this.calculartotal();
			},
			buscarcentrodecosto(val)
			{				

				axios.get('centros/'+val).then(response=>{
					this.newBooks_centro =response.data;
					this.toggle_centro=true;

				}); 

			},
			selectResult_centro(id,nombre,cr_id,cr_nombre,index,array)
			{ 

				console.log()
				this.info_centro_c.push({'cr':cr_id,'cr_nombre':cr_nombre,'cc_id':id,'cc_nombre':nombre});

				array.cc_nombre=nombre
				//this.search_centro=nombre;
				this.id_personas_centro=id;
				this.cr_id=cr_id;
				this.cr_centros=cr_id;
				this.cr=cr_nombre;
				this.toggle_centro=false;
				//this.buscarpresupuesto();
				this.buscarprespuestos(this.id_personas_centro,this.sigfe);
				this.buscarrefrendacioncc(this.id_personas_centro,this.sigfe);
				this.buscarsinrefrendar(this.id_personas_centro,this.sigfe);
				this.buscarpagado(this.id_personas_centro,this.sigfe);
				
			},
			
			
			buscarsinrefrendar(id)
			{

				var today = new Date();
				var year = today.getFullYear();		
				var d=new FormData();
				d.append('cc',id);
				d.append('year',year);
				d.append('sigfe',this.sigfe);
				axios.post('refrendacionsin',d).then(response=>{
					this.refrendar=this.formatPrice(response.data)
				}).catch(err=>{});

			},
			buscarrefrendacioncc(id)
			{
				var today = new Date();
				var year = today.getFullYear();		
				var d=new FormData();
				d.append('cc',id);
				d.append('year',year);
				d.append('sigfe',this.sigfe);
				axios.post('refrendacionesgasto',d).then(response=>{
					this.g_refrendado=this.formatPrice(response.data);
				}).catch(err=>{

				});

			},
			buscarprespuestos(id,sigfe){
				var today = new Date();
				var year = today.getFullYear();	
				var d=new FormData();
				d.append('cc',id);
				d.append('sigfe',sigfe);
				d.append('amio',year)
				axios.post('nuevoprespuesto',d).then(response=>{
					this.presupuesto_cc=this.formatPrice(response.data.monto);
					this.presupuesto_cc_table=response.data.monto;
					this.getsigfe(id,sigfe);
				}).catch(err=>{

				});

			},
			getListaOrdenes()
			{
				this.bloqueo=true;
				axios.get('encargados_cc/'+this.id_session).then(responsecc=>{
					let arr=[];

					if(arr.length == 0)
					{
						var d=new FormData();
						d.append('year',this.years);
						d.append('rut',this.id_session);

						axios.post('otsincc',d).then(response=>{
							this.tableData=response.data;
							this.bloqueo=false;
						}).catch(err=>{
							this.dulcealert('error '+err,'error');
							this.bloqueo=false;
						});

					}else{

						for (var i = 0; i < responsecc.data.length; i++) {

						}

					}

					axios.get('ordenesdecompra/'+this.id_session).then(response=>{
						this.data=response.data;

					}).catch(err=>{

					});
				}).catch(err=>{

				});

			},
			buscarpagado(id)
			{
				var today = new Date();
				var year = today.getFullYear();		
				var d=new FormData();
				d.append('cc',id);
				d.append('year',year);
				d.append('sigfe',this.sigfe);
				axios.post('pagado',d).then(response=>{
					this.g_ejecutado=this.formatPrice(response.data);
					this.calculartotal2();
				}).catch(err=>{

				});
			},
		}	

	}	      

</script>