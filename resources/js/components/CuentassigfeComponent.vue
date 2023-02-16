<template>
	<div class="container-fluid">
		<div class="card">
			<div class="card-title text-center text-white bg-primary"><h5>Lista Cuentas Sigfe</h5></div>
			<div class="row">
				<div class="col-12 offset-9">
					<button class="btn btn-success" @click="abrirmodal">Agregar Cuentas</button>
					
				</div>
				
			</div>
			
			<div class="card-body">
				<v-client-table :columns="columns" v-model="tableData" :options="options">
					<div slot="acciones" slot-scope="props">
						<button class="btn btn-primary" @click="editarmodal(props.row)"> Editar</button>
						<button class="btn btn-danger" @click="eliminar(props.row.id)"> Eliminar</button>
					</div>



				</v-client-table>

			</div>
		</div>
		<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Cuentas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-2">
								<label>Nombre</label>
								
							</div>
							<div class="col-4">
								<input type="" name="" v-model="editar.nombre" class="form-control">
							</div>
							<div class="col-1">
								<label>Sigfe</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" v-model="editar.sigfe_id" class="form-control"> 
							</div>
							<div class="col-1">
								<label>Sub Sigfe</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" v-model="editar.sub_item" class="form-control">
							</div>
							
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="updatecuentas(editar.id,editar.nombre,editar.sigfe_id,editar.sub_item)">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="addcuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Cuenta</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-1">
								<label>Nombre</label>
							</div>
								<div class="col-3">
								<input type="" name="" class="form-control" v-model="nombrecuenta">
							</div>
							<div class="col-1">
								<label>Sigfe</label>
							</div>
								<div class="col-3">
								<input type="number" name="" class="form-control" v-model="sigfe">
							</div>
							<div class="col-1">
								<label>Sub Sigfe</label>
							</div>
								<div class="col-3">
								<input type="number" name="" class="form-control" v-model="subsigfe">
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarcuenta">Guardar</button>
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
				nombrecuenta:'',
				sigfe:'',
				subsigfe:'',
				editar:[],
				years:'',
				columns: ['id', 'nombre', 'sigfe_id','sub_item','acciones'],
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
						nombre: 'Nombre Cuenta',                 
						sigfe_id: 'Sigfe', 
						sub_item:'Subitem',
						acciones:'Acciones',



					},
					sortable:  ['id'],
					filterable: ['id','nombre'],
					editableColumns:['id']
				}

			}
		},
		created:function()
		{
			this.getCuentas();
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
			guardarcuenta(){
				var d=new FormData()
				d.append('nombre',this.nombrecuenta)
				d.append('sigfe',this.sigfe)
				d.append('subsigfe',this.subsigfe)

				axios.post('cuentassigfes',d).then(response=>{
					$("#addcuenta").modal("hide");
					this.dulcealert('Cuenta agregada','success')
					this.nombrecuenta=''
					this.sigfe=''
					this.subsigfe=''
					this.getCuentas();

				}).catch(err=>{});

			},
			abrirmodal(){
				$("#addcuenta").modal();

			},

			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			updatecuentas(id,nombre,sigfe,subitem){
				var url="cuentassigfes/"+id 
				var d={
					_method:'patch',
					nombre:nombre,
					sigfe_id:sigfe,
					sub_item:subitem
				}
				axios.post(url,d).then(response=>{
					$("#editar").modal('hide');
					this.dulcealert('Cuenta Actualizada','success')
					this.getCuentas();
				}).catch(err=>{

				});

			},
			eliminar(id){
				var url="cuentassigfes/"+id 
				var d={
					_method:'patch',
					sigfe_obsoleta:1,
					
				}
				axios.post(url,d).then(response=>{
					$("#editar").modal('hide');
					this.dulcealert('Cuenta Eliminada','success')
					this.getCuentas();
				}).catch(err=>{

				});


			},
			editarmodal(arra){
				this.editar=arra
				$("#editar").modal();


			},
			getCuentas(){

				axios.get('cuentassigfes').then(response=>{
					this.tableData=response.data
				}).catch(err=>{

				});
			}
		}

	}

</script>