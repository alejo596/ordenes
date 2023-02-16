<template>
	<div class="container">
		<div class="card border-success">
			<div class="card-header text-center text-white bg-success">
				<h5>Mensaje</h5>
				
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-1">
						<label>Fecha </label>
						
					</div>
					<div class="col-5">
						<input type="" name="" v-model="fecha_mensaje" class="form-control" readonly="readonly">
						
					</div>
					
				</div>

				<div class="row mt-2">
					<div class="col-12">
						<textarea class="form-control" v-model="obse"></textarea>
					</div>
					
				</div>
				
			</div>
			
		</div>

		<div class="card mt-2 border-primary">
			<div class="card-header text-center text-white bg-primary">
				<h5>Lista De Mensajes</h5>
			</div>
			<div class="card-body">
				<v-client-table :columns="columns" v-model="tableData" :options="options">
					<div slot="id" slot-scope="row">
						{{row.index}}
					</div>
						



					</v-client-table>
				
			</div>
			
		</div>

		
	</div>
	
</template>
<script>

	export default {
		props: ['id_session','id_mensaje'],

		data(){

			return {
				obse:'',
				fecha_mensaje:'',
				list_mensaje:[],
				columns: ['id','observacion','nombre','created_at'],
					tableData:[],
					options: {
						
					rowClassCallback: function(row) { 
						console.log(row.pro_estado_producto);
						if(row.estado== 1){
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
							id:'Id',
							observacion:'Mensajes',
							nombre:'Estado',
							created_at:'Fecha de Creacion'

						},

			}
		}

		},
		created:function()
		{
			this.getmensajes();
			this.gettodosmensajes();
			

		},
		methods:{
			gettodosmensajes()
			{
               axios.get('../notificaciones3/'+this.id_session).then(response=>{
                             this.tableData=response.data;
               }).catch(err=>{

               });
			},
			getmensajes()
			{
				axios.get('../notificaciones/'+this.id_mensaje).then(response=>{
                    this.obse=response.data.observacion;
                    this.fecha_mensaje=response.data.created_at;
				}).catch(err=>{

				});
			}
		}


	}
	
</script>