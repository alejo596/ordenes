<template>
	<div class="container-fluid">
		<div class="card">
			<div class="card-title text-center text-white bg-primary"><h5>Lista Proveedor</h5> </div>
			<div class="row">
				<div class="col-12 offset-9">
					<button class="btn btn-success" @click="abrirmodal">Agregar Proveedor</button>
					
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
		<div class="modal fade" id="addproveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
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
								<input type="text" name="" class="form-control" v-model="addnombre">
							</div>
							<div class="col-2">
								<label>Run:</label>
							</div>
							<div class="col-4">
								<input type="text" name="" class="form-control" v-model="addrun" @keyup="verrun2(addrun)">
								<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="el_proveedor2">
									<div v-for="pro in proveedor2">
										<span class="elecciondepersona_" @click="seleccionproveedor2(pro.id,pro.nombre,pro.run)"> {{pro.nombre}}</span>
									</div>
								</div>

								<div class="alert alert-danger" role="alert mt-2" v-if="mensaje_runproveedor2">
									{{mensajerun2}}
								</div>
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-success" @click="guardaraddproveedor">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="editarproveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							
							<div class="col-2">
								<label>Run </label>
								

							</div>
							<div class="col-4">
								<input type="" name="" v-model="editar.run" @keyup="verrun(editar.run)" class="form-control">
								<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="el_proveedor">
									<div v-for="pro in proveedor">
										<span class="elecciondepersona_" @click="seleccionproveedor(pro.id,pro.nombre,pro.run)"> {{pro.nombre}}</span>
									</div>
								</div>

								<div class="alert alert-danger" role="alert mt-2" v-if="mensaje_runproveedor">
									{{mensajerun}}
								</div>
							</div>
							<div class="col-2">
								<label>Nombre </label>
								

							</div>
							<div class="col-4">
								<input type="" name="" v-model="editar.nombre" class="form-control">
							</div>
							
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="updateproveedor(editar.id,editar.nombre,editar.run)">Guardar</button>
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
				addnombre:'',				
                addrun:'',
				nombre_proveedor2:'',
				cpp_proveedor2:'',
				mensaje_runproveedor2:false,
				el_proveedor2:false,
				mensajerun2:'',

				nombre_proveedor:'',
				cpp_proveedor:'',
				mensaje_runproveedor:false,
				el_proveedor:false,
				mensajerun:'',
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
				columns: ['id', 'nombre', 'run','acciones'],
				tableData:[],
				options: {
					perPage: 10,
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
						nombre: 'Nombre Proveedor',                 
						run: 'run', 
						acciones:'Acciones' ,



					},
					sortable:  ['id'],
					filterable: ['id','nombre'],
					editableColumns:['id']
				}


			}

		},
		created:function()
		{
			this.getProveedor();
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
			guardaraddproveedor(){
               var d=new FormData()
               d.append('nombre',this.addnombre.toUpperCase())
               d.append('run',this.addrun)

				axios.post('proveedores',d).then(response=>{
					$("#addproveedor").modal('hide');
					this.getProveedor();
					this.dulcealert('proveedor agregado','success')

				}).catch(err=>{

				});

			},
			seleccionproveedor2(id,nombre,run)
			{
				this.editar.id=id
				this.editar.nombre=nombre
				this.editar.run=run
				this.el_proveedor=false

			},
			updateproveedor(id,nombre,run){

				var url="proveedores/"+id
				var d={
					_method:'patch',
					nombre:nombre,
					run:run
				}

				axios.post(url,d).then(response=>{
					$("#editarproveedor").modal('hide');
					this.getProveedor();
					this.dulcealert('proveedor actualizado','success')
				}).catch(err=>{
				})



			},
			seleccionproveedor(id,nombre,run)
			{
				this.editar.id=id
				this.editar.nombre=nombre
				this.editar.run=run
				this.el_proveedor=false

			},
			verrun(run){
				this.cpp_proveedor=run
				var poisicion=this.cpp_proveedor.indexOf('-')
				this.proveedor=[]
				if (isNaN(this.cpp_proveedor) === true) {
					console.log("String");
					axios.get('proveedores/'+this.cpp_proveedor).then(response=>{
						this.proveedor=response.data;
						this.el_proveedor=true;

					}).catch(err=>{

					});

				}else{
					console.log("numero");
					if(parseInt(poisicion) >=5){

						var vali_run=this.cpp_proveedor.split("-");
						console.log(this.cpp_proveedor.charAt(8))
						console.log(this.cpp_proveedor.charAt(8+1))
						if(this.cpp_proveedor.charAt(poisicion+1) != ''){
							var validar=this.validaRut(vali_run[0]+'-'+vali_run[1]) ? true :false;

							console.log(validar);
							if(validar == true){
								this.mensaje_runproveedor=false;
								axios.get('proveedores/'+this.cpp_proveedor).then(response=>{
									this.proveedor=response.data;
									this.el_proveedor=true;

								}).catch(err=>{

								});
							}else{
								this.proveedor=[];
								this.el_proveedor=false;
								this.mensaje_runproveedor=true;
								this.mensajerun="El run no es valido"
							}

						}


					}	
				}

			},

			verrun2(run){
				this.cpp_proveedor2=run
				var poisicion=this.cpp_proveedor2.indexOf('-')
				var vali_run=this.cpp_proveedor2.split("-");
						console.log(this.cpp_proveedor2.charAt(8))
						console.log(this.cpp_proveedor2.charAt(8+1))
						if(this.cpp_proveedor2.charAt(poisicion+1) != ''){
							var validar=this.validaRut(vali_run[0]+'-'+vali_run[1]) ? true :false;

							console.log(validar);
							if(validar == true){
								this.mensaje_runproveedor2=false;
								axios.get('proveedores/'+this.cpp_proveedor2).then(response=>{
									this.proveedor2=response.data;
									this.el_proveedor2=true;

								}).catch(err=>{

								});
							}else{
								this.proveedor2=[];
								this.el_proveedor2=false;
								this.mensaje_runproveedor2=true;
								this.mensajerun2="El run no es valido"
							}

						}

				

			},
			validaRut (rutCompleto) {
				if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
					return false;
				var tmp 	= rutCompleto.split('-');
				var digv	= tmp[1]; 
				var rut 	= tmp[0];
				if ( digv == 'K' ) digv = 'k' ;
				return (this.dv(rut) == digv );
			},
			dv(T){
				var M=0,S=1;
				for(;T;T=Math.floor(T/10))
					S=(S+T%10*(9-M++%6))%11;
				return S?S-1:'k';
			},
			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			abrirmodal(){
				$("#addproveedor").modal();
			},
			editarmodal(array){
				this.editar=array;
				$("#editarproveedor").modal();

			},
			getProveedor(){

				axios.get('proveedores').then(response=>{
					this.tableData=response.data

				}).catch(err=>{

				});
			}

		}


	}

</script>