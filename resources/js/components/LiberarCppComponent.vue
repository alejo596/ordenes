<template>
	<div class="container-fluid">
		<div class="card border border-primary">
			<div class="card-header  text-center text-white bg-primary">
				<h5>Buscar CPP</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<label>Cpp</label>
					</div>
					<div class="col-4">
						<input type="number" class="form-control" v-model="cpp" />
					</div>
					<div class="col-2">
						<label>Año</label>
					</div>
					<div class="col-2">
						<select class="form-control" v-model="amio">
							
							<option v-for="y in years_" :value="y">{{y}}</option>
						</select>
					</div>
					<div class="col-2">
						<button class="btn btn-primary" @click="buscarcpp">Buscar</button>
					</div>
				</div>
				
			</div>
			
		</div>
		<div class="card mt-2">
			<div class="card-header text-center text-white bg-primary"><h5>Lista CPP</h5></div>
			<div class="card-body">
				
				<v-client-table :columns="columns" v-model="tableData" :options="options">

					<div slot="acciones" slot-scope="props">
						<button class="btn btn-primary" @click="abrirmodal(props.row.cpp_estado_id,props.row.id)">Editar</button>

					</div>

				</v-client-table>

			</div>
		</div>
		<BlockUI :message="msg"  v-if="bloqueo">
			<img :src="'assets/img/745.gif'">

		</BlockUI>

		<!-- Modal -->
		<div class="modal fade" id="cambioestado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Abrir CPP</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<select v-model="estado" class="form-control">
							<option v-if="id_estado == 3" value="1">creado</option>
						</select>
						<div class="alert alert-danger" role="alert" v-show="id_estado < 3" >
							Debe estar en estado aProbado en refrendacion
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" v-show="id_estado == 3" @click="guardar(cpp_id)" >Guardar</button>
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
				cpp_id:'',
				id_estado:'',
				estado:0,
				amio:0,
				msg: 'Espere un Momento...',
				bloqueo:false,
				years_:[],
				cpp:'',
				years:'',
				columns: ['id', 'numero', 'year','total','cpp_estado','acciones'],
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
						numero: 'CPP',                 
						year: 'Año', 
						total:'Monto',
						cpp_estado:'Estado',
						acciones:'Acciones' ,



					},
					sortable:  ['id'],
					filterable: ['id'],
					editableColumns:['id']
				}

			}
		},
		created:function()
		{
			this.getyear()
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
			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			guardar(id){
				var url='compromiso/'+id
				var d={
					estado:1,
					_method:'patch'
				}

				axios.post(url,d).then(response=>{
					var da=new FormData()
					da.append('id',id)
					  axios.post('eliminargastos',da).then(response=>{
					  	this.dulcealert("cpp actualizado",'success')
					  	$("#cambioestado").modal("hide");
					  	this.buscarcpp()

					  	}).catch(err=>{

					  	});

				}).catch(err=>{

				});

			},
			abrirmodal(id,cpp)
			{
				this.cpp_id=cpp
				this.id_estado=id
				$("#cambioestado").modal();
			},
			buscarcpp(){
				var d=new FormData();
				d.append('numero',this.cpp);
				d.append('year',this.amio);

				this.bloqueo=true;
				axios.post('compromiso7',d).then(response=>{
					if(response.data == ''){

						this.bloqueo=false;
						return this.dulcealert('Datos No Encontrados','error');
					}
					this.tableData=response.data

					this.bloqueo=false;
				}).catch(err=>{

				});

			},
			getyear(){
				var today = new Date();
				var amio= today.getFullYear();

				
				for (var i = 2023; i <(amio+3); i++) {
					console.log(i)
					this.years_.push(i)
				}
			}
		}

	}

</script>