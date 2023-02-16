<template>
	<div class="container-fluid">

		<div class="card">
			<div class="card-title text-center text-white bg-primary"><h5>Lista Productos</h5> </div>
			<div class="row">
				<div class="col-12 offset-9">
					<button class="btn btn-success" @click="abrirmodal">Agregar Productos</button>
					
				</div>
				
			</div>
			
			<div class="card-body">
				<v-client-table :columns="columns" v-model="tableData" :options="options">

					<div slot="acciones" slot-scope="props">
						<button class="btn btn-primary" @click="editarmodal(props.row)">Editar</button>
					</div>

				</v-client-table>

			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="modificarproductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Productos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-2">

								<label>Nombre Productos:</label>
							</div>
							<div class="col-4">
								<input type="search" name="" class="form-control" v-model="editar.nombre">

							</div>
							<div class="col-1">

								<label>Unidad:</label>
							</div>
							<div class="col-2">
								<input type="text" name="" class="form-control" v-model="editar.unidad_medida">
							</div>

						</div>

						<div class="row mt-2">
							<div class="col-2">

								<label>nombre:</label>
							</div>
							<div class="col-4">
								<input type="search" name="" class="form-control" v-model="editar.nombre_sigfe" @keyup="buscarcuentas(editar.nombre_sigfe)">
								<div style="
								z-index: 2;
								position: absolute;
								background-color: #ffff;
								width: 100%;
								" v-if="toggle_firma" >
								<div class="result" v-for="(book,index) in cuentas" >
									<span @click="selectResult_firma(book.nombre,book.sigfe_id,book.sub_item,index)" @mousedown.prevent class="elecciondepersona_">
										{{ book.nombre}}
									</span>
								</div>

							</div>

						</div>
						<div class="col-1">

							<label>Cuenta:</label>
						</div>
						<div class="col-2">
							<input type="text" name="" class="form-control" v-model="editar.cuenta_sigfe">

						</div>

						<div class="col-1">

							<label>subitem:</label>
						</div>
						<div class="col-2">
							<input type="text" name="" class="form-control" v-model="editar.sub_item_sigfe">
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" @click="guardarproducto(editar.id,editar)">Guardar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="addabrir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agregar Productos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-2">
							<label>Nombre:</label>
							
						</div>
						<div class="col-4">
							<input type="text" name="" v-model="nombre_p" class="form-control">
							
						</div>
						<div class="col-2">
							<label>Unidad:</label>
							
						</div>
						<div class="col-4">
							<input type="text" name="" v-model="unidad" class="form-control">
							
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-2">
							<label>Nombre Cuenta:</label>
							
						</div>
						<div class="col-4">
							<input type="search" name="" v-model="nombre_cuenta" class="form-control"  @keyup="buscarcuentas2(nombre_cuenta)">
							<div style="
								z-index: 2;
								position: absolute;
								background-color: #ffff;
								width: 100%;
								" v-if="toggle_firma2" >
								<div class="result" v-for="(book,index) in cuentas2" >
									<span @click="selectResult_firma2(book.nombre,book.sigfe_id,book.sub_item,index)" @mousedown.prevent class="elecciondepersona_">
										{{ book.nombre}}
									</span>
								</div>

							</div>
							
						</div>
						<div class="col-2">
							<label>Cuenta:</label>
							
						</div>
						<div class="col-4">
							<input type="text" name="" v-model="cuenta" class="form-control">
							
						</div>

						
					</div>
					<div class="row mt-2">
							<div class="col-2">
							<label>Sub Item:</label>
							
						</div>
						<div class="col-4">
							<input type="text" name="" v-model="subitem" class="form-control">
							
						</div>
							
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" @click="agregarproductos()">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	export default
	{
		props: ['id_session','nombre'],

		data(){

			return {
				cuentas2:[],
				nombre_p:'',
				unidad:'',
				nombre_cuenta:'',
				cuenta:'',
				subitem:'',
				toggle_firma:false,
				toggle_firma2:false,
				editar:[],
				years:'',
				columns: ['id', 'nombre', 'unidad_medida','cuenta_sigfe','nombre_sigfe','sub_item_sigfe','acciones'],
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
						id: 'id',
						nombre: 'Nombre Productos',                 
						unidad_medida: 'UD', 
						cuenta_sigfe:'Cuenta Sigfe',
						nombre_sigfe:'Nombre Cuenta',
						sub_item_sigfe:'Sub Item',
						acciones:'Acciones' ,



					},
					sortable:  ['id','nombre'],
					filterable: ['id','nombre'],
					editableColumns:['id']
				}

			}
		},
		created:function()
		{
			this.getProductos();
		},
		mounted()
		{
			var today = new Date();
			this.years = today.getFullYear();

		},
		watch:
		{


		},
		methods:

		{
			 dulcealert(text,icono)
        {
        	Swal.fire({
        		icon: icono,

        		text: text,

        	})


        },
			abrirmodal(){
                	$("#addabrir").modal();
			},
			agregarproductos(){
				var d=new FormData()
				d.append('nombre',this.nombre_p)
				d.append('unidad_medida',this.unidad.toUpperCase())
				d.append('nombre_sigfe',this.nombre_cuenta)
				d.append('cuenta_sigfe',this.cuenta)
				d.append('sub_item_sigfe',this.subitem)
				axios.post('productos_base',d).then(response=>{
					$("#addabrir").modal('hide');
					this.getProductos();
					this.dulcealert('Agregado','success')

				}).catch(err=>{
				})


			},
			guardarproducto(id,array){
				var url='productos_base/'+id

				var d={
					nombre:array.nombre,
					unidad_medida:array.unidad_medida,
					nombre_sigfe:array.nombre_sigfe,
					cuenta_sigfe:array.cuenta_sigfe,
					sub_item_sigfe:array.sub_item_sigfe,
					_method:'patch'

				}

				axios.post(url,d).then(response=>{
					$("#modificarproductos").modal('hide');
					this.getProductos();
				}).catch(err=>{

				})

			},
			selectResult_firma2(nombre,cuenta,subitem,index){

				this.cuenta=cuenta
				this.nombre_cuenta=nombre
				this.subitem=subitem
				this.toggle_firma2=false  

			},
			selectResult_firma(nombre,cuenta,subitem,index){
				this.editar.cuenta_sigfe=cuenta
				this.editar.nombre_sigfe=nombre
				this.editar.subitem=subitem
				this.toggle_firma=false  



			},
			buscarcuentas2(nombre){
				axios.get('cuentassigfes/'+nombre).then(response=>{
					this.cuentas2=response.data
					this.toggle_firma2=true    
				}).catch(err=>{

				});

			},
			buscarcuentas(nombre){
				axios.get('cuentassigfes/'+nombre).then(response=>{
					this.cuentas=response.data
					this.toggle_firma=true    
				}).catch(err=>{

				});

			},
			editarmodal(array){
				this.editar=array;
				$("#modificarproductos").modal();

			},

			getProductos(){
				axios.get('productos_base').then(response=>{
					this.tableData=response.data
				}).catch(err=>{

				});
			}
		}

	}

</script>