<template>
	<div>
		<v-client-table :columns="columns" v-model="tableData" :options="options">
			<div slot="id" slot-scope="row" >
				{{row.index}}
				
			</div>
			<div slot="ver" slot-scope="props">
				<a @click="verpdfs(props.row.compra_id)"><img src="assets/img/pdf.png" width="30" height="30" style="cursor: pointer;"></a>
				
			</div>

			<div slot="acciones"  slot-scope="props">
				<a href="#"  @click="detalleot(props.row.id_proceso,props.row.compra_id,props.row.compra_numero,props.row.comprador,props.row.year,props.row.nombre,props.row.observacion)"><i style="cursor: pointer;" class="fas fa-search"></i></a>
			</div>
			<div slot="editar" slot-scope="props" v-if="props.row.compra_estado == 1">
				<a href=""><i class="fas fa-edit"></i></a>
			</div>



		</v-client-table>


		<!-- Modal -->
		<div class="modal fade" id="modal_procesos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Procesos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-1">



								<label>N° OT</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" class="form-control" readonly="readonly" v-model="numero_ot">
								
							</div>
							<div class="col-1">
								<label>AÑO</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" class="form-control" readonly="readonly" v-model="year">
								
							</div>
							<div class="col-2">
								<label>Comprador:</label>
								
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control" readonly="readonly" v-model="comprador">
								
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<label>Observacion</label>
							</div>
							<div class="col-12">
								<textarea class="form-control" readonly="readonly" v-model="observacion"></textarea>
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<label>Historial:</label>
							</div>
							<div class="col-12">
								<div class="progress">
									<div class="progress-bar progress-bar-striped" role="progressbar" :style="{width:progresos +'%'}" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<label>Procesos: {{progresos}} %</label>
								
							</div>
							<div class="col-12">
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">Id</th>
											<th scope="col">Etapa</th>
											<th scope="col">Comprador</th>
											<th scope="col">Detalle Etapa</th>
											<th scope="col">Fecha de Inicio</th>
											<th scope="col">Fecha de Termino</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(datos,index) in datostable">
											<td>{{index+1}}</td>
											<td>{{datos.nombre}}</td>
											<td>{{datos.per_nombre}}</td>
											<td>{{datos.nombre_detalle}}</td>
											<td>{{datos.fecha_inicio}}</td>
											<td>{{datos.fecha_termino}}</td>
										</tr>
										
									</tbody>
								</table>
								
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</template>
<script >
	export default{
		props:['id_session'],
		data(){
			return{
				datostable:[],
				numero_ot:'',
				year:'',
				comprador:'',
				observacion:'',
				progresos:0,

				columns: ['id', 'id_proceso', 'nombre','year','comprador','id_licitacion','compra_numero','created_at','ver','acciones'],
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
						id: 'Id',
						id_proceso: 'Proceso',                 
						nombre: 'Estado', 
						year:'Año' ,
						comprador:'Comprador',
						id_licitacion:'Licitacion',
						compra_numero:'OT',	
						created_at:'Fecha',
						ver:'VER',					
						acciones:'Acciones',



					},
					sortable:  ['id'],
					filterable: ['id'],
					editableColumns:['id']
				}

			}

		},
		created:function()
		{
			this.getProcesos();
		},
		methods:{
			
			getProcesosid(id,id_compra,numero_compra,comprador,year,estado,observacion)
			{
				this.numero_ot=numero_compra
				this.year=year
				this.comprador=comprador
				this.observacion=observacion
				axios.get('etapasot3/'+id).then(response=>{
					this.progresos=0
					this.progresos=response.data[response.data.length-1].proceso;
					this.datostable=response.data;
					for (var i = 0; i < response.data.length; i++) {
						
					}
				}).catch(err=>{});
			},
			detalleot(id,id_compra,numero_compra,comprador,year,estado,observacion)
			{
				this.getProcesosid(id,id_compra,numero_compra,comprador,year,estado,observacion);
				$("#modal_procesos").modal();
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
			getProcesos()
			{
				axios.get('procesosindex').then(response=>{
					this.tableData=response.data;
				}).catch(errr=>{

				});
			}

		}
	}
	
</script>