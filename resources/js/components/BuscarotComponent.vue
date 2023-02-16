<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card border-primary">
					<div class="card-header text-white text-center bg-primary">
						<h5>Buscar OT</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-1">
								<label>CR</label>
							</div>
							<div class="col-2">
								
								<select class="form-control" v-model="cr">
									<option value="0" selected="selected">Seleccione</option>
									<option v-for="crs in centros_r" :value="crs.id">{{crs.nombre}}</option>
								</select>
							</div>
							<div class="col-1">
								<label>CC</label>
							</div>
							<div class="col-2">
								<input type="" name="" v-model="centros" class="form-control" @keyup="buscarcentro(centros)">
								<div style="width: 100%;background-color: #ffff;z-index: 1;position: absolute;" v-if="ocultarcc">
									<div v-for="c in centros_elegidos">
										<span  @click="seleccionarcentro(c.id,c.nombre)" class="elecciondeproducto">{{c.nombre}}</span>
									</div>

								</div>
							</div>
							<div class="col-1">
								<label>Productos</label>
							</div>
							<div class="col-5">
								<input type="" name="" class="form-control" v-model="nombre" @keyup="buscarproductos(nombre)">
								<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="ocultar_pro">
									<div v-for="pro in productos_elegidos">
										<span @click="seleecionproductos(pro.codigo,pro.nombre)" class="elecciondeproducto">{{pro.codigo}}-{{pro.nombre}}</span>
									</div>
									
								</div>
								<input type="hidden" name="" v-model="id_producto">
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-sm-1">
								<label>N° OT</label>
							</div>
							<div class="col-2">
								<input type="" name="" class="form-control" v-model="numero">
							</div>
							<div class="col-1">
								<label>Año</label>
							</div>
							<div class="col-2">
								<select class="form-control" v-model="year2">
									<option v-for="y in year_reporte" :selected="y.year === year2 ? 'selected' : ''" :value="y.year">{{y.year}}</option>
								</select>
							</div>
							<div class="col-1">
								<label>Fecha Inicio</label>
							</div>
							<div class="col-2">
								<input type="date" name="" class="form-control" v-model="fecha_inicio">
							</div>
							<div class="col-1">
								<label>Fecha Termino</label>
							</div>
							<div class="col-2">
								<input type="date" name="" class="form-control" v-model="fecha_terminar">
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-12 offset-5">
								
								<button class="btn btn-primary" @click="buscarot()">Buscar</button>
								
								
							</div>
							
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="card border-success">
					<div class="card-header text-white text-center bg-success"><h5>Lista de Productos</h5></div>
					<div class="card-body">
						<v-client-table :columns="columns" v-model="data" :options="options">
							<a slot="pdf" slot-scope="props">
								<a @click="verpdfs(props.row.compra_id)"> <img :src="'assets/img/pdf.png'" width="30" height="30"></a>
							</a>                                   
							<a slot="id" slot-scope="row">
								{{row.index}}


							</a>
							<a slot="pro_nombre" slot-scope="props">

								<div class="row" v-for="produ in props.row.detalles">
									<div class="col-6 border border-dark" >
										<label style="font-size:12px">{{produ.pro_nombre}}</label>
									</div>
									<div class="col-4 border border-dark" >
										<label style="font-size:12px;overflow: hidden;height: 100px;width: 100px;">{{produ.pro_descripcion}}</label>
									</div>
									<div class="col-2 border border-dark">
										<label style="font-size:12px;overflow: hidden;height: 100px;width: 100px;">{{produ.estado_producto}}</label>
										
										
									</div>
								</div>
							</a>                  
							<a slot="accion" slot-scope="props">



								<button class="btn btn-success" @click="detalleot(props.row.compra_id)">Visualizar</button>

							</a>


						</v-client-table>
						
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
				fecha_inicio:'',
				fecha_terminar:'',
				detalles_lista:[],
				lista_productos:[],
				cr:'',
				centros_r:[],
				id_producto:'',
				productos_elegidos:[],
				ocultar_pro:false,
				nombre:'',
				numero:'',
				years:0,
				year2:0,
				year_reporte:[],
				centros:'',
				ocultarcc:false,
				id_cc:'',
				centros_elegidos:[],
				columns: ['id','compra_numero','compra_amio','created_at','cr','cc','estado_nombre','pro_nombre','pdf','accion'],
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
						id: 'Id',
						compra_numero: 'N°',                 
						compra_amio: 'Año', 
						created_at:'Fecha' ,
						cr:'CR',
						cc:'CC',
						estado_nombre:'Estado',
						pro_nombre:'Producto',         
						pdf:'PDF',
						accion:'Accion'


					},
					sortable:  ['cc_nombre', 'nombre'],
					filterable: ['cc_nombre', 'nombre'],
				}
			}
		},
		created:function()
		{
			this.getyear();
			this.getcentrosr();


		},
		mounted()
		{
			var today = new Date();
			this.years = today.getFullYear();
				axios.get('yeartotal').then(response=>{
				this.year2=response.data.year
				
			}).catch(err=>{});



		},
		methods:{
			detalleot(id)
			{
				
				this.bloqueo=true;
				var e=new FormData();
				e.append('id',id);
				axios.post('encriptar',e).then(response=>{
					this.bloqueo=true;
						window.open('detallelink2/'+response.data+'/'+0);
					

				}).catch(err=>{

				});

               

				this.bloqueo=false;

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
			getcentrosr()
			{
				axios.get('c_responsabilidad').then(response=>{
					this.centros_r=response.data
				}).catch(err=>{});

			},
			buscarot()
			{
				var d=new FormData();
				d.append('year',this.year2)
				d.append('cc',this.id_cc)
				d.append('cr',this.cr)				
				d.append('nombre',this.nombre)
				d.append('numero',this.numero)
				d.append('inicio',this.fecha_inicio)
				d.append('terminar',this.fecha_terminar)
				axios.post('productosbusquedaot',d).then(response=>{
					this.data=response.data
					this.detalles_lista=JSON.stringify(JSON.parse(this.data[0].detalle))
					console.log('proyecto',this.detalles_lista)



				}).catch(err=>{});
				


			},
			seleccionarcentro(id,nombre){
				this.centros=nombre
				this.id_cc=id
				this.ocultarcc=false

			},
			getyear(){
				var currentTime = new Date();
				var year = currentTime.getFullYear()
				var year=year+3;
				for (var i = 2022; i <= year; i++) {

					this.year_reporte.push({'year':i});

				}

			},
			seleecionproductos(id,nombre)
			{
				this.nombre=nombre
				this.id_producto=id
				this.ocultar_pro=false
			},
			buscarproductos(id)
			{
				axios.get('productos_base/'+id).then(response=>{
					this.productos_elegidos=response.data
					this.ocultar_pro=true

				}).catch(err=>{});

			},
			buscarcentro(id,index)
			{
				axios.get('centros/'+id).then(response=>{
					this.centros_elegidos =response.data;
					this.ocultarcc=true;

				}); 
			},
		}
	}			  
	
</script>