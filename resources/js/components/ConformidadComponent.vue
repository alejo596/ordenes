<template>
	<div class="container-fluid">
		<div class="card">
			
			<div class="card-header text-white text-center bg-primary">
				<h5>CONFORMIDAD</h5>
				
			</div>
			<div class="card-body">

				<v-client-table :columns="columns" v-model="tableData" :options="options">
					<div slot="pdf" slot-scope="props">
						<a @click="verpdfs(props.row.compra_id)"><img :src="'assets/img/pdf.png'" width="40" height="40" style="cursor: pointer;"></a>

					</div>
					<div slot="id" slot-scope="props">
						{{props.index}}
					</div>
					<div slot="cpp" slot-scope="props">
						<a href="#" @click="verpdfcpp(props.row.cpp)"> <img :src="'assets/img/CPP.png'" width="40" height="40" > </a>


					</div>
					<div slot="pdfrecepcion" slot-scope="props">
						<a href="#"><img :src="'assets/img/recepcion.png'" width="40" height="40" @click="verrecepciones(props.row.recepciones)">  </a>
						
					</div>

					<div slot="pdffactura" slot-scope="props">
						
						<a :href="props.row.pdffactura" target="_blank"><img :src="'assets/img/pdf.png'" width="40" height="40" style="cursor: pointer;"></a>
						
						
					</div>
					<div slot="notacredito" slot-scope="props">
						<a href="#"><img :src="'assets/img/notadecredito.png'"   width="40" height="40" @click="vernota(props.row.idFac)">  </a>
						
					</div>
					<div slot="adjunto" slot-scope="props">
						<a href="#"><img :src="'assets/img/adjuntos_cpp.png'"  width="40" height="40"> </a> 
						
					</div>
					<div slot="accion"  slot-scope="props">
						<a href="#" class="btn btn-primary" @click="guardar(props.row.idFac)">Autorizar</a>
						<a href="#" class="btn btn-danger" @click="rechazar(props.row.idFac,props.row.numRecep)">Rechazar</a>
					</div>
					<div slot="editar" slot-scope="props" v-if="props.row.compra_estado == 1">
						<a href=""><i class="fas fa-edit"></i></a>
					</div>
					<div slot="check" slot-scope="props">
						<input type="checkbox" name="" :value="props.row.idFac" v-model="cambioestado" :id="props.row.idFac"  @change="marcarcheck($event,props.row.idFac)">
						
					</div>



				</v-client-table>
				
			</div>
			
			
		</div>
		<div class="modal fade" id="verarchivoscpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Adjuntos Compromisos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div v-for="arcpp in archivoscpp">
								<a href="#"><img :src="'assets/img/recepcion.png'" width="40" height="40" > </a> 
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="verarchivosrecepcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Adjuntos Recepcion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div v-for="arrecep in archivosrecpciones">
								<div class="col-3">

									<a href="#"><img :src="'assets/img/recepcion.png'" width="40" height="40" > </a>    
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

		
	</div>
	
</template>
<script>
	export default
	{
		props: ['id_session','nombre'],

		data(){

			return {
				archivoscpp:[],
				tablada:[],
				archivosrecpciones:[],
				cambioestado:[],
				columns: ['id', 'factura', 'oc','proveedor','pdffactura','pdfrecepcion','cpp','adjunto','notacredito','accion','check'],
				tableData:[],
				options: {
					rowClassCallback: function(row) { 
						console.log(row.chk_oc);
						if(row.chk_oc == 1){
							return "table-success text-DARK"

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
						id: 'Id',
						factura: 'Numero de Factura',                 
						oc: 'OC - Portal', 
						proveedor:'Proveedor' ,
						pdffactura:'Factura',
						pdfrecepcion:'Recepcion',
						cpp:'CPP',						
						adjunto:'Adjuntos',
						notacredito:'Nota de Credito',
						accion:'Accion',
						check:'Check'


					},
					sortable:  ['id'],
					filterable: ['id'],
					editableColumns:['id']
				}



			}
		},
		created:function(){
			this.getConformidad();
		},
		methods:{
			rechazar(id,numero){

				Swal.fire({
					title: 'Desea rechazar la conformidad',          
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

						var url='facturacion/'+id
					
					var 	d={
							docto_estado_id:3,
							_method:'patch',
							devolucion:"SI"
						}
							this.getConformidad();

						axios.post(url,d).then(response=>{
							var da=new FormData();
							da.append('detalle',result.value);
							da.append('responsable',this.id_session);
							da.append('id_documento',id);
							da.append('id_tipo_obs',1);



							axios.post('observacionesfact',da).then(resp=>{
							}).catch(error=>{});
						}).catch(err=>{});




					}

				})

				

			},
			guardar(id){
				Swal.fire({
					title: 'Desea aprobar a solicitud',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {
						var url='facturacion/'+id
						var d=new FormData();
						d={
							docto_estado_id:4,
							_method:'patch',
							devolucion:"NO"
						}
						axios.post(url,d).then(response=>{
							this.getConformidad();
						}).catch(err=>{

						});

					}

				});

			},
			verrecepciones(array){
				if(array.length == 1){

				}else if(array.length > 1){
					$("#verarchivosrecepcion").modal();
					this.archivosrecpciones=array

				}


			},
			vernota(id){
				axios.get('facturacionget/'+id).then(response=>{
					if(response.data.length == 0){

					}else if(response.data.length == 1){
						window.open(response.data[0].link,'_blank')

					}else if(response.data.length > 1){

					}
					
				}).catch(err=>{

				});

			},
			verpdfcpp(id)
			{
				console.log(id)
				if(id.length ==1){
					axios.get('encriptar/'+id[0]).then(response=>{
						window.open('visorpdfcpp/'+response.data);

					}).catch(errr=>{ 

					});


				}else if(id.length > 1){
					$("#verarchivoscpp").modal();
					this.archivoscpp=id

				}
				

			},
			marcarcheck(e,id){
				console.log(e.target.checked)
				if(e.target.checked == true){
					var url="facturacion/"+id
					var d={
						chk_oc:1,
						_method:'patch'

					}
					axios.post(url,d).then(response=>{
						this.getConformidad()

					}).catch(err=>{});

				}else{
					var url="facturacion/"+id
					var d={
						chk_oc:0,
						_method:'patch'

					}
					axios.post(url,d).then(response=>{
						this.getConformidad()

					}).catch(err=>{});

				}
				
				
			},
			getConformidad(){
				axios.get('conformidadbuscar').then(response=>{
					this.tablada=response.data
					this.tableData=response.data.filter((valorActual, indiceActual, arreglo) => {
						return arreglo.findIndex(valorDelArreglo => JSON.stringify(valorDelArreglo) === JSON.stringify(valorActual)) === indiceActual

					});
					for (var i = 0; i < this.tableData.length; i++) {

						if(this.tableData[i].chk_oc == 1){

							this.$set(this.cambioestado,i,this.tableData[i].idFac)
							

						}else{
							this.$set(this.cambioestado,i,'')
						}
					}

				}).catch(err=>{

				});
			}

		}
	}	      		    
</script>