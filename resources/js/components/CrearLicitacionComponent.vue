<template>
	<div class="container-fluid">
		<div class="card border border-primary">
			<div class="card-header text-center text-white bg-primary">CREAR CONVENIO</div>
			<div class="card-body">
				<div class="row mt-2">
					<div class="col-sm-1">
						<label>Nombre:</label>
					</div>
					<div class="col-sm-3">
						<input type="" class="form-control" name="" v-model="nombre_convenio">
					</div>
					<div class="col-sm-1">
						<label>Fecha de Inicio</label>
					</div>
					<div class="col-sm-2">
						<input type="date" name="" class="form-control" v-model="fecha_i">


					</div>
					<div class="col-sm-1">
						<label>Fecha de Termino</label>
					</div>
					<div class="col-sm-2">
						<input type="date" name="" class="form-control" v-model="fecha_t">

					</div>
					<div class="col-sm-2">
						<input type="number" name="" class="form-control" v-model="monto" placeholder="ingrese monto">

					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-1">
						<label>Producto:</label>
					</div>
					<div class="col-sm-3">
						<input type="" class="form-control" name="" v-model="producto" @keyup="buscar_producto(producto)">
						<div class="vistainput" v-if="verproducto" >
							<div  v-for="(p,index) in listproductos" :key="index">
								<span class="elegir" @click="elecciondeproducto(p.id,p.nombre,p.codigo,p.nombre_sigfe,p.sigfe_item,p.sub_item_sigfe,p.zgen,p.cuenta_sigfe)" @mousedown.prevent >{{p.nombre}}</span>
							</div>
						</div>
						<input type="hidden" name="" v-model="idproducto">
					</div>
					<div class="col-sm-1">
						<label>Centro de Costo:</label>
					</div>
					<div class="col-sm-2">
						<input type="text" name=""  v-model="cc_nombre_b" class="form-control" @blur="verlista" @keyup="buscarcentro($event,cc_nombre_b)">

						<div class="vistainput"  >
							<div  v-for="(lcc,index) in listcc" :key="index">
								<span class="elegir" @click="elecciondecc(lcc.id,lcc.nombre)" @mousedown.prevent >{{lcc.nombre}}</span>
							</div>
						</div>
						<input type="hidden" name="" v-model="idcc_b">

					</div>
					<div class="col-sm-1">
						<label>Proveedor:</label>
					</div>
					<div class="col-sm-4">
						<input type="" class="form-control" name="" v-model="cpp_proveedor" @keyup="getproveedor" :disabled="disabled_proveedor">
						<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="el_proveedor">
							<div v-for="pro in proveedor">
								<span class="elecciondepersona_" @click="seleccionproveedor(pro.id,pro.nombre)"> {{pro.nombre}}</span>
							</div>
						</div>
						<input type="hidden" name="" v-model="cpp_id_proveedor">
						<div class="alert alert-danger" role="alert mt-2" v-if="mensaje_runproveedor">
							{{mensajerun}}
						</div>
					</div>

					
				</div>
				<div class="row mt-2">
					<div class="col-12">
						
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Id</th>
									<th scope="col">Nombre</th>
									<th scope="col">Precio</th>
									<th scope="col">Cantidad</th>
									<th scope="col">Total</th>
									<th scope="col">Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(li,index) in listapro">
									<td>{{index+1}}</td>
									<td>{{li.nombre}}</td>
									<td ><input class="form-control" type="" name="" v-model="li.precio" @change="valor1(index)"></td>
									<td> <input class="form-control" type="" name="" v-model="li.cantidad" @change="valor2(index)"></td>
									<td>{{li.precio*li.cantidad}}</td>
									<td><a href="#" @click="eliminarproducto(index)"><i class="fas fa-trash"></i></a></td>

								</tr>

							</tbody>
						</table>

						
					</div>
					
				</div>

				<div class="row mt-2">
					<div class="col-12 offset-11">

						<button type="button" class="btn btn-primary" @click="addoconvenios()" >Guardar</button>

					</div>
				</div>
				
			</div>
			
		</div>
		<div class="card mt-2 border border-success">
			<div class="card-header text-white text-center bg-success"><h5>LISTA DE CONVENIOS</h5></div>
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nombre Convenio</th>
							<th scope="col">Proveedor</th>
							<th scope="col">Fecha Inicio</th>
							<th scope="col">Fecha Termino</th>
							<th scope="col">cpp</th>
							<th scope="col">Monto</th>
							<th scope="col">Estado</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(con,index) in conve_pro" :class="con.estado == 5 ?'table-danger':''">
							
							<td>{{index+1}}</td>
							<td>{{con.nombre}}</td>
							<td>{{con.nombre_provedor}}</td>
							<td>{{con.fecha_i}}</td>
							<td>{{con.fecha_t}}</td>
							<td>{{con.numero}}</td>
							<td>{{formatPrice(con.monto)}}</td>
							<td>{{con.estado_convenio}}                       

							</td>
							<td><a href="#" class="btn btn-primary" v-if="con.estado==1 || con.estado==4 " @click="enviar(con.id,con,con.nombre_cc,con.cc,con.nombre_provedor,con.proveedor,con.monto,con.fecha_i,con.fecha_t)">Enviar</a>
								<!-- <a href="#" class="btn btn-success" v-show="con.estado==0" @click="ediatrsubconvenio">Editar</a> -->
								<a href="#" class="btn btn-warning" v-show="con.estado==3" @click="agregarprograma(con.id,con.monto,con.id_convenio)">Agregar Programas</a>

							</td>
						</tr>
						
					</tbody>
				</table>
				
			</div>
		</div>
		<div class="modal fade" id="enviarconvenios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Enviar Convenios  Monto : $ {{formatPrice(monto2)}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row mt-2">
							<div class="col-auto">
								<label>Nombre:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control" v-model="editar.nombre">
							</div>
							<div class="col-auto">
								<label>Proveedor:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control" v-model="editarproveedor" @keyup="buscareditarproveedor(editarproveedor)">
								<div style="width: 100%;background-color:#ffff;z-index:2;position: absolute;">
									<div v-for="prove in listaproveedor" v-show="verlista3">
										<span class="elegir" @click="seleccionareditarproveedor(prove.id,prove.nombre)" >{{prove.nombre}}</span>
									</div>
									
									
								</div>
							</div>
							<div class="col-auto">
								<label>Monto:</label>
							</div>
							<div class="col-3">
								<input type="number" name="" class="form-control" v-model="editar.monto">
							</div>						
							
						</div>
						<div class="row mt-2">
							<div class="col-auto">
								<label>F. Inicio:</label>
							</div>
							<div class="col-3">
								<input type="date" name="" class="form-control" v-model="fechai_editar">
							</div>
							<div class="col-auto">
								<label>F. Termino:</label>
							</div>
							<div class="col-3"> 

								<input type="date" name="" class="form-control" v-model="fechat_editar">
							</div>
							<div class="col-auto">
								<label>Centro:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control" v-model="editarcc" @keyup="buscareditarcc(editarcc)">
								<div style="width: 120px;background-color:#ffff;z-index:2;position: absolute;">
									<div v-for="lcc in listacentro" v-show="verlista2">
										<span class="elegir" @click="seleccionareditarcc(lcc.id,lcc.nombre)" >{{lcc.nombre}}</span>
									</div>
									
									
								</div>
								<input type="hidden" name="" class="" v-model="lccid">
							</div>						
							
						</div>
						<div class="row mt-2">
							<div class="col-3">					  		
								<label>Ingresar Observacion:</label>
							</div>
							<div class="col-9">
								<textarea class="form-control" v-model="observacion"></textarea>

							</div>

						</div>
						<div class="row mt-2">
							<div class="col-3">					  		
								<label>Ingresar Archivos:</label>
							</div>
							<div class="col-9">

								<div class="custom-file">
									<input type="file" class="custom-file-input" id="inputGroupFile01" @change="verarchivo($event)" >
									<label class="custom-file-label" for="inputGroupFile01">Seleccione archivo</label>
									<span v-for="f in file">
										<img :src="'assets/img/pdf.png'" width="30" height="30">{{f.name}}
										<a href="#" @click="eliminararchivo(index)"><i class="fas fa-trash"></i></a>
									</span>
								</div>
								
							</div>


						</div>

						<div class="row mt-2">
							<div class="col-12">
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">Id</th>
											<th scope="col">Nombre</th>
											<th scope="col">Precio</th>
											<th scope="col">Cantidad</th>
											<th scope="col">Total</th>
											<th scope="col">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(li2,index) in productosget">
											<td>{{index+1}}</td>
											<td>{{li2.pro_nombre}}</td>
											<td ><input class="form-control" type="" name="" v-model="li2.pro_precio" @change="valor3(index)"></td>
											<td> <input class="form-control" type="" name="" v-model="li2.pro_cantidad" @change="valor4(index)"></td>
											<td>{{li2.pro_precio*li2.pro_cantidad}}</td>
											<td><a href="#" @click="eliminarproducto2(index,li2.pro_id)"><i class="fas fa-trash"></i></a></td>

										</tr>

									</tbody>
								</table>
								
								
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" >Guardar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-success" @click="crearcpp()">Enviar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modaladdprograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">AGREGAR SUBCONVENIOS  Convenio N° {{idconvenios}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row" >
							<div class="col-4">
								<div class="alert alert-success" role="alert">
									Monto Convenio ${{formatPrice(cpp_total_convenio2)}}
								</div>
							</div>
							<div class="col-4">
								<div class="alert alert-danger" role="alert">
									Monto Subconvenio ${{formatPrice(cpp_total_convenio3)}}
								</div>
							</div>
							<div class="col-4 text-right">
								<button class="btn btn-success" @click="addinput">Agregar Mas</button>
								
							</div>
							
						</div>
						<div class="row mt-4" v-for="(lis,index) in listsform">
							<div class="col-1">
								<label>Nombre </label>
								
							</div>
							<div class="col-4">
								<input type="" name="" class="form-control" v-model="lis.nombre">
								
							</div>
							<div class="col-1">
								<label>Monto </label>
								
							</div>
							<div class="col-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">$</span>
									</div>
									<input type="number" class="form-control" v-model="lis.monto" placeholder="Monto" aria-label="Username" aria-describedby="basic-addon1"  :disabled="lis.indice == 1">
								</div>
								
							</div>

							<div class="col-1">
								<a href="#" @click="restarmonto(lis.monto,index)"  v-if="lis.indice == 0"><i class="fas fa-plus-circle"></i></a>
							</div>
							<div class="col-1">
								<a href="#" @click="editarmonto(lis.monto,index)"><i class="fas fa-edit"></i></a>
							</div>
							<div class="col-1">
								<a href="#" @click="removeinput(index)"><i class="fas fa-trash"></i></a>
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-12">
								<v-client-table :columns="columns" v-model="tableData" :options="options">
									<div slot="monto" slot-scope="props">
										{{formatPrice(props.row.monto)}}
										
									</div>


									<div slot="accion"  slot-scope="props" >
										
										<a @click="editarsubconvenios(props.row)" class="btn btn-success"><i class="fas fa-edit"></i></a>
										<a @click="eliminarsubconvenio(props.row.id,props.row.convenio_id)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
									</div>	

								</v-client-table>
								
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button"class="btn btn-primary"  @click="guardarprograma">Guardar Subconvenio</button>
						<!-- <button type="button" class="btn btn-success"  @click="guardarproalcpp()">Guardar</button> -->

						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="editarsubconveniomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Subconvenios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
						<div class="row">
							<div class="col-2">
								<label>Nombre :</label>

							</div>
							<div class="col-4">
								<input type="" name="" class="form-control" v-model="editarsubcon.destino">
							</div>
							<div class="col-2">
								<label>Monto :</label>

							</div>
							<div class="col-4">
								<input type="" name="" class="form-control" v-model="editarsubcon.monto">
							</div>
							<input type="hidden" name="" v-model="editarsubcon.id">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="updatemodalsubconvenios(editarsubcon,valorantiguo)">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="editarsubconvenio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Editar Subconvenios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row mt-2">
							<div class="col-auto">
								<label>Nombre:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">
							</div>
							<div class="col-auto">
								<label>Proveedor:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">
							</div>
							<div class="col-auto">
								<label>Monto:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">
							</div>						
							
						</div>
						<div class="row mt-2">
							<div class="col-auto">
								<label>F. Inicio:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">
							</div>
							<div class="col-auto">
								<label>F. Termino:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">
							</div>
							<div class="col-auto">
								<label>Centro:</label>
							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">
							</div>						
							
						</div>
						<div class="row mt-2">
							<div class="col-auto">

							</div>						
							
						</div>


					</div>
					<div class="modal-footer">
						<button  type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

						<button type="button" class="btn btn-primary" @click="guardarsubconvenio">Guardar</button>
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
				arra_editar:[],
				fechai_editar:'',
				fechat_editar:'',
				valorantiguo:0,
				id_conveniocontrato:0,
				idconvenios:0,
				cpp_total_convenio3:0,
				cpp_total_convenio2:0,
				listaproveedor:[],
				listacentro:[],
				editarproveedor:'',
				editaridproveedor:0,
				lccid:0,
				editarcc:'',
				editar:[],
				file:[],
				observacion:'',
				verproducto:false,
				listproductos:[],
				idproducto:'',
				verlista:false,
				idcc_b:'',
				listcc:[],
				cc_nombre_b:'',
				centros:'',
				disabled_proveedor:false,
				producto:'',
				monto:0,
				nombre_convenio:'',
				fecha_i:'',
				fecha_t:'',
				listsform:[{nombre:'',monto:'',indice:0}],
				nuevo_convenio:[],
				verconvenios:false,
				cpp_id_convenios:0,
				cpp_total_convenio:'',
				cpp_proveedor:'',
				cpp_id_proveedor:'',
				el_proveedor:false,
				proveedor:[],
				mensaje_runproveedor:false,
				mensajerun:'',
				listapro:[],
				year2:0,
				conve_pro:[],
				nombre_archivo:'',
				productosget:[],
				verlista2:false,
				mensaje_runproveedor2:false,
				mensajerun2:'',
				monto2:0,
				ideditar:0,
				editarsubcon:[],
				columns: ['id', 'destino', 'monto','accion'],
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
						id: 'N°',
						destino: 'Nombre',                 
						monto: 'Monto', 
						accion:'Acciones',						


					},
					sortable:  ['id'],
					filterable: ['id'],
					editableColumns:['id']
				},



			}
		},
		watch:
		{
			

		},	
		created(){
			this.getcalcular();
			this.getconvenios();
			this.getcalcular2();
		},
		mounted(){
			var y = new Date();
			var amio= y.getFullYear();


			var fechai=new Date(amio+"-01-01");
			var fechat=new Date(amio+"-12-31");

			this.fecha_i=new Date(fechai.toString()).toISOString().substr(0, 10) 
			this.fecha_t=new Date(fechat.toString()).toISOString().substr(0, 10) 
			var fecha = new Date();
			this.year2 = fecha.getFullYear();

		},

		methods:{
			guardarsubconvenio(){

			},
			ediatrsubconvenio(){
				$("#editarsubconvenio").modal();
			},
			eliminarsubconvenio(id,convenio){

				Swal.fire({
					title: 'Desea Eliminar Programa N°'+id,          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {

						axios.get('conveniosprogramaseliminar/'+id).then(response=>{
							this.buscarprogramas(convenio);
							this.dulcealert("Programa Eliminado",'error');
							$("#modaladdprograma").modal("hide");
						}).catch(err=>{

						});

					}

				});


			},
			updatemodalsubconvenios(todo,monto){


				if(parseInt(todo.monto) > parseInt(monto)){
					var valordecambio=parseInt(todo.monto)-parseInt(monto)
				}else{
					var valordecambio=parseInt(monto)-parseInt(todo.monto)	
				}
				var total=parseInt(this.cpp_total_convenio3)+valordecambio
				console.log(total)
				if(parseInt(this.cpp_total_convenio2) < parseInt(total)){

					return this.dulcealert("Monto mayor al convenio",'error')
				}else{
					console.log(this.cpp_total_convenio2)
					var url="conveniosprogramas/"+todo.id
					var d={
						monto:todo.monto,
						destino:todo.destino,
						_method:'patch'
					}
					axios.post(url,d).then(response=>{
						$("#editarsubconveniomodal").modal("hide")
						this.buscarprogramas(todo.convenio_id)
					}).catch(err=>{

					})
				}
				
			},
			editarsubconvenios(arra){
				this.editarsubcon=arra;
				this.valorantiguo=arra.monto;
				$("#editarsubconveniomodal").modal()

			},
			guardarproalcpp(){
				console.log(JSON.parse(JSON.stringify(this.checkpro)))

				if(this.checkpro.length == 0){
					return this.dulcealert('Debe seleccionar un opcion','error');

				}else{

					JSON.parse(JSON.stringify(this.tableData))
					console.log(this.tableData.length)
					for (var i = 0; i < this.tableData.length; i++) {
						if(this.tableData[i].id == this.checkpro[0]){
							this.id_elegidaconv=this.checkpro[0];
							this.montoprogramael=this.tableData[i].monto
							this.verprogramamonto=true
						}
					}
					$("#modaladdprograma").modal("hide");
				}


			},
			guardarprograma()
			{
				for (var i = 0; i < this.listsform.length; i++) {

					if(this.listsform[i].nombre == '' ){
						return this.dulcealert("Existe un registro sin nombre",'error')
					}
					if(this.listsform[i].monto != '' ){
						var d=new FormData();
						d.append('destino',this.listsform[i].nombre);
						d.append('monto',this.listsform[i].monto);
						d.append('convenio_id',this.id_conveniocontrato);

						axios.post('conveniosprogramas',d).then(response=>{

						}).catch(err=>{

						});

					}

					if(i == this.listsform.length-1){
						this.buscarprogramas(this.id_conveniocontrato);
						this.dulcealert("Programas guardados",'success')
						
						this.limpiarlistaconvenio();
					}
				}

			},
			buscarprogramas(id){

				axios.get('conveniosprogramas/'+id).then(response=>{
					if(response.data.length == 0){

					}else{
						this.tableData=response.data;
						var mont=0
						for (var i = 0; i < response.data.length; i++) {
							mont=mont+response.data[i].monto
						}
						this.cpp_total_convenio3=mont
						this.buscarprogramasporcpp(id)
					}

				}).catch(err=>{

				});

			},
			limpiarlistaconvenio(){
				this.listsform=[]
			},
			editarmonto(monto,index){
				this.listsform=JSON.parse(JSON.stringify(this.listsform));
				this.cpp_total_convenio3=this.cpp_total_convenio3-this.listsform[index].monto;
				this.listsform[index].monto=0;
				this.listsform[index].indice=0;	

			},
			restarmonto(monto,index)
			{
				console.log('monto',monto);
				var mont_=this.cpp_total_convenio2
				if(this.cpp_total_convenio3 > this.cpp_total_convenio2 )
				{ 
					console.log('listsform',JSON.parse(JSON.stringify(this.listsform)));             	

					this.listsform=JSON.parse(JSON.stringify(this.listsform));
					this.cpp_total_convenio3=this.cpp_total_convenio3 -monto;
					this.listsform[index].monto=0; 
					return this.dulcealert("Supera el monto del convenio",'error');
				}


				if(monto == 0 && monto == ''){
					this.cpp_total_convenio3=0
				}else{

					this.listsform=JSON.parse(JSON.stringify(this.listsform));
					this.listsform[index].indice=1;
					this.cpp_total_convenio3=this.cpp_total_convenio3+parseInt(monto);
					if(this.cpp_total_convenio3 > this.cpp_total_convenio2 )
					{
						console.log('listsform',JSON.parse(JSON.stringify(this.listsform)));             	

						this.listsform=JSON.parse(JSON.stringify(this.listsform));
						this.cpp_total_convenio3=this.cpp_total_convenio3 -monto;
						this.listsform[index].monto=0; 
						this.listsform[index].indice=0;
						return this.dulcealert("Supera el monto del convenio",'error');

					}
				}




			},
			addinput(){
				this.listsform.push({
					nombre: '',
					monto: 0,
					indice:0
				})

			},
			removeinput (index) {
				this.listsform.splice(index, 1)
			},
			agregarprograma(id,monto,antiguo){
				this.id_conveniocontrato=antiguo
				this.idconvenios=id
				this.cpp_total_convenio2=monto
				$("#modaladdprograma").modal();
				this.buscarprogramas(this.id_conveniocontrato)

			},
			seleccionareditarproveedor(id,nombre){
				this.editarproveedor=nombre
				this.editaridproveedor=id
			},
			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			buscareditarproveedor(id){
				var poisicion=this.editarproveedor.indexOf('-')
				this.listaproveedor=[]
				if (isNaN(id) === true) {
					console.log("String");
					axios.get('proveedores/'+this.editarproveedor).then(response=>{
						this.listaproveedor=response.data;
						this.verlista3=true;

					}).catch(err=>{

					});

				}else{
					console.log("numero");
					if(parseInt(poisicion) >=5){

						var vali_run=this.editarproveedor.split("-");
						console.log(this.editarproveedor.charAt(8))
						console.log(this.editarproveedor.charAt(8+1))
						if(this.editarproveedor.charAt(poisicion+1) != ''){
							var validar=this.validaRut(vali_run[0]+'-'+vali_run[1]) ? true :false;

							console.log(validar);
							if(validar == true){
								this.mensaje_runproveedor2=false;
								axios.get('proveedores/'+this.editarproveedor).then(response=>{
									this.listaproveedor=response.data;
									this.verlista3=true;

								}).catch(err=>{

								});
							}else{
								this.editarproveedor=[];
								this.verlista3=false;
								this.mensaje_runproveedor2=true;
								this.mensajerun2="El run no es valido"
							}

						}


					}	

				}

			},
			seleccionareditarcc(id,nombre){
				this.editarcc=nombre
				this.lccid=id
				this.verlista2=false;
			},
			buscareditarcc(id)
			{
				this.lccid=''; 
				axios.get('centros/'+id).then(response=>{
					this.listacentro=response.data;
					this.verlista2=true;

				})


			},
			formatPrice(value) {
				if(value=== 0){
					return 0;
				}else{
					let val = (value/1).toFixed(0).replace('.', '.')
					return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
				}

			},
			eliminarproducto2(index,id){
				this.productosget.splice(index,1)
				this.getcalcularresta2(index);

				axios.get('productos/',id,{_method:'delete'}).then(response=>{}).catch(err=>{});
			},
			eliminararchivo(index){
				this.file.splice(index,1)
			},
			verarchivo(event){
				console.log(event.target.files[0]);
				this.file.push(event.target.files[0]);

			},
			getproductos(id){

				axios.get('productosconvenios/'+id).then(response=>{
					this.productosget=response.data
				}).catch(err=>{

				});

			},
			enviar(id,arra,cc,idcc,proveedor,idproveedor,monto,fechai,fechat)
			{
				$("#enviarconvenios").modal();
				this.fechai_editar=new Date(fechai.toString()).toISOString().substr(0, 10) 
                this.fechat_editar=new Date(fechai.toString()).toISOString().substr(0, 10) 
				this.ideditar=id
				this.editar=arra
				this.lccid=idcc
				this.editarcc=cc
				this.editarproveedor=proveedor
				this.editaridproveedor=idproveedor
				this.monto2=monto
				this.file=[]
				this.getproductos(id);
				/*Swal.fire({
					title: 'Enviar Convenio?',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {

					}

				});*/
			},
			crearcpp(){
				var c=new FormData(); 
				c.append('year',this.year2);
				c.append('proveedor',this.editaridproveedor);
				c.append('oc',0);
				c.append('total_neto',this.monto2);
				c.append('iva',0);
				c.append('total',this.monto2);
				c.append('descuento',0);
				c.append('despacho',0);
				c.append('impuesto',0);
				c.append('usuario',this.id_session);
				c.append('observacion',this.observacion);
				c.append('tipo',8);
				axios.post('compromiso',c).then(response=>{

					this.updateproducto(response.data)
					this.updateCoenvenio(this.ideditar,response.data)
					axios.get('compromiso/'+response.data).then(res=>{
						this.subirarchivos(response.data,res.data.numero)
					}).catch(err2=>{

					})
					this.updatecpp(response.data,this.ideditar);
					this.getconvenios();
					$("#enviarconvenios").modal("hide");
					this.refrendar(response.data);

					
				}).catch(errr=>{

				});


			},
			updatecpp(id,id2){
				var url="compromiso/"+id
				var d={
					_method:'patch',
					id_convenios:id2
				}

				axios.post(url,d).then(response=>{}).catch(err=>{});
			},
			refrendar(cpp){
				var fecha = new Date();
				const dia = fecha.getDate();
				const mes = fecha.getMonth(); 
				const year = fecha.getFullYear();
				const hora=fecha.getHours();
				const minuto=fecha.getMinutes();
				const segundo=fecha.getSeconds();

				const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
				var d=new FormData();
				d.append('monto',this.monto2);
				d.append('cpp',cpp);
				d.append('estado',1);
				d.append('usuario',this.id_session);
				d.append('fecha',dateString);
				d.append('year',this.year2);

				this.bloqueo=true;
				axios.post('refrendacion',d).then(response=>{

					this.refrendarcc(response.data,cpp);
					var url='compromiso/'+cpp;

					var c={
						estado:2,
						_method:'patch',

					}

					axios.post(url,c).then(res=>{

					}).catch(err=>{

					});

				}).catch(err=>{

				});

			},
			refrendarcc(id,cpp)
			{
				var d=new FormData();
				d.append('cpp',cpp);
				d.append('refrendacion',id)
				axios.post('montoscc',d).then(response=>{

				}).catch(err=>{});


			},
			updateproducto(cpp){
				for (var i = 0; i < this.productosget.length; i++) {
					var url="productos/"+this.productosget[i].pro_id
					var d={
						pro_id_cpp:cpp,
						pro_estado_producto:5,
						_method:'patch',
						pro_precio:this.productosget[i].precio,
						pro_cantidad:this.productosget[i].cantidad,
						pro_cc:this.lccid
					}
					axios.post(url,d).then(response=>{}).catch(err=>{})
					
				}
				

			},
			updateCoenvenio(id,cpp){

				var url="convenioscpp/"+id
				var d={
					estado:2,
					monto:this.monto2,
					id_cpp:cpp,
					_method:'patch'

				}

				axios.post(url,d).then(response=>{

				}).catch(errr=>{});


			},
			getconvenios(){
				axios.get('convenioscpp3/'+this.id_session).then(response=>{
					this.conve_pro=response.data
				}).catch(err=>{});

			},
			guardarconvenio(){


			},
			getcalcular2(index){
				this.monto2=0;
				//for (var i = 0; i < this.listapro.length; i++) {
				if(this.productosget.length != 0){
					this.monto2=this.monto2+(this.productosget[index].precio*this.productosget[index].cantidad);
				}



			},
			getcalcularresta2(index){
				this.monto2=0;
				this.monto2=this.monto2-(this.productosget[index].precio*this.productosget[index].cantidad);
			},
			getcalcularresta(index){
				this.monto=0;
				//for (var i = 0; i < this.listapro.length; i++) {
				this.monto=this.monto-(this.listapro[index].precio*this.listapro[index].cantidad);


			},
			getcalcular(index){
				this.monto=0;
				//for (var i = 0; i < this.listapro.length; i++) {
				if(this.listapro.length != 0){
					this.monto=this.monto+(this.listapro[index].precio*this.listapro[index].cantidad);
				}



			},
			valor3(index){
				this.productosget[index].precio*this.productosget[index].cantidad
				this.getcalcular2(index)
			},
			valor4(index){

				this.productosget[index].precio*this.productosget[index].cantidad
				this.getcalcular2(index)
			},
			valor1(index){
				this.listapro[index].precio*this.listapro[index].cantidad
				this.getcalcular(index);
			},
			valor2(index){
				this.listapro[index].precio*this.listapro[index].cantidad
				this.getcalcular(index);
			},
			eliminarproducto(index){
				this.getcalcularresta(index);
				this.listapro.splice(index,1);

			},
			addproducto(convenio){
				console.log('productos',this.listapro);
				for (var i = 0; i < this.listapro.length; i++) {
					console.log(this.listapro[i])
					var p= new FormData();
					p.append('oc',0); 
					p.append('nombre',this.listapro[i].nombre);
					p.append('cantidad',this.listapro[i].cantidad);
					p.append('precio',this.listapro[i].precio);
					p.append('detalle','');
					p.append('id_pro',this.listapro[i].id_pro);
					p.append('cuenta',this.listapro[i].item); 
					p.append('total',this.listapro[i].t_neto);
					p.append('unidad',this.listapro[i].unidad);        		
					p.append('nombre_sigfe',this.listapro[i].sigfe);
					p.append('nombre_producto',this.listapro[i].nombre);
					p.append('sub_item_sigfe',this.listapro[i].subitem);
					p.append('estado',16);
					p.append('justificacion','');
					p.append('cc',this.idcc_b);
					p.append('year',this.year2);
					p.append('convenio',0);
					p.append('pro_id_cpp',0);
					p.append('pro_precio_unitario',this.listapro[i].precio)
					p.append('pro_cantidad_unitario',this.listapro[i].cantidad)
					p.append('precio_todo',(this.listapro[i].precio*this.listapro[i].cantidad))
					p.append('total',(this.listapro[i].precio*this.listapro[i].cantidad))
					p.append('sigfe_item',this.listapro[i].sigfe_item)

					axios.post('productos',p).then(response=>{
						var conpro=new FormData();
						conpro.append('convenio',convenio)
						conpro.append('producto',response.data)
						axios.post('conveniosproductos',conpro).then(responseconpro=>{

						}).catch(err=>{});
					}).catch(err=>{

					});
					if(i == this.listapro.length-1){
						this.eliminarproductos()
					}


				}
			},
			subirarchivos(id,numero)
			{
				for (var i = 0; i < this.file.length; i++) {
					this.file[i]
					var a=new FormData();
					a.append('tipo',8);
					a.append('year',this.year2);
					a.append('file',this.file[i]);
					a.append('id', id);
					a.append('numero',numero);
					axios.post('adjuntosdocu',a).then(response=>{

						var arreglo=JSON.parse(JSON.stringify(this.file))
						arreglo.splice(i,1);
						arreglo.splice(i,1);

					}).catch(err=>{

					});
				}

			},
			eliminarproductos(){
				for (var i = 0; i < this.listapro.length; i++) {
					this.listapro.splice(i,1)
				}
			},
			addoconvenios(id,monto){
				if(this.nombre_convenio == ''){
					return this.dulcealert("debe ingresar el nombre convenio",'error');
				}
				if(this.cpp_id_proveedor == ''){
					return this.dulcealert("debe ingresar el proveedor","error");
				}
				Swal.fire({
					title: 'Desea Guarda la informacion?',          
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Aceptar'
				}).then((result) => {
					if (result.isConfirmed) {
						var d= new FormData();
						d.append('nombre',this.nombre_convenio);
						d.append('fechai',this.fecha_i);
						d.append('fechat',this.fecha_t);	
						d.append('cpp',0);
						d.append('monto',this.monto);
						d.append('nuevo',1);
						d.append('id_convenio',0)
						d.append('programa',0)
						d.append('estado',1)
						d.append('usuario',this.id_session)
						d.append('cc',this.idcc_b)
						d.append('proveedor',this.cpp_id_proveedor)




						axios.post('convenioscpp',d).then(response=>{
							this.nombre_convenio=''
							this.idcc_b=0
							this.monto=0
							this.cc_nombre_b=''
							this.cpp_proveedor=''
							this.cpp_id_proveedor=0
							this.addproducto(response.data);
							this.getconvenios();
							var url="compromiso/"+id
							var da={
								id_convenios:response.data,
								_method:'patch'
							}
						/*axios.post(url,da).then(response=>{

						}).catch(err=>{

						});*/

						}).catch(err=>{

						});

					}

				});


			},

			elecciondeproducto(id,nombre,codigo,nombre_sigfe,sigfe_item,sub_item_sigfe,zgen,cuenta_sigfe)
			{
				//this.producto=nombre
				//this.idproducto=id
				var nom=codigo+"-"+nombre
				this.listapro.push({
					nombre:nom,
					id_pro:codigo,
					oc:0,
					cc:0,
					id_cc:0,
					sigfe:nombre_sigfe,
					item:cuenta_sigfe,
					subitem:sub_item_sigfe,
					precio:0,
					cantidad:0,
					t_neto:0,
					sigfe_item:sigfe_item,
					pro_id_oc:0,
					zgen:zgen,
					unidad:'UD'


				});
				this.verproducto=false
				this.producto=''
			},

			buscar_producto(value)
			
			{

				if(value.length > 3)
				{
					axios.get('productos_base/'+value).then(response=>{
						this.listproductos=response.data
						this.verproducto=true


					});
				}
			},
			buscarcentro(event,val){
				console.log('valor',val)
				if(val.length >3)
				{          
					this.controladordepromesas(val);
				}

			},
			controladordepromesas(val) 
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
			getproveedor()
			{
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
			seleccionproveedor(id,nombre)
			{
				this.cpp_proveedor=nombre;
				this.cpp_id_proveedor=id;
				this.el_proveedor=false;
			},
			limpiarconvenionuevo()
			{
				if(this.cpp_conv >0){
					this.conv_nombre=''
					this.conv_fechai=''
					this.conv_fechaf=''
					this.con_new=0;
					this.nuevo_convenio=[]
					this.conv_nova=false
					var url='convenioscpp/'+this.cpp_conv
					var d={
						estado:1,
						_method:'patch'
					}
					axios.post(url,d).then(response=>{
						var url2="compromiso/"+this.cpp_id
						var da={
							_method:'patch',
							id_convenios:0
						}
						axios.post(url2,da).then(respon=>{
							this.dulcealert("convenios eliminado del compromiso N° "+this.cpp_numero,'success')

						}).catch(err=>{

						});

					}).catch(err=>{

					});

				}else{
					this.conv_nombre=''
					this.conv_fechai=''
					this.conv_fechaf=''
					this.con_new=0;
					this.nuevo_convenio=[]
					this.conv_nova=false	
				}


			},

			guardarmodalconvenio(nombre,fechai,fechat)
			{
				console.log(fechai)
				var f=this.formateofechasbd2(fechai)
				console.log(f.toString())
				this.conv_nombre=nombre
				this.conv_fechai= new Date(fechai.toString()).toISOString().substr(0, 10) 
				this.conv_fechaf=new Date(fechat.toString()).toISOString().substr(0, 10) 
				this.conv_nova=true
				this.bloqueo=true;
				this.nuevo_convenio.push({nombre:this.conv_nombre,fecha_i:this.conv_fechai,fecha_t:this.conv_fechaf});
				this.cpp_convenios='';
				$("#modal_convenios").modal('hide');
				this.convenios=[];
				this.con_new=1;
				this.nombre_convenio=''
				this.fecha_i=''
				this.fecha_t=''
				this.bloqueo=false;
			},
			formatPrice(value) {
				if(value=== 0){
					return 0;
				}else{
					let val = (value/1).toFixed(0).replace('.', '.')
					return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
				}

			},
			seleeccionconvenio(nombre,id,total,fechai,fechat)
			{
				if(id == 1063)
				{
					$("#modal_convenios").modal();
					this.verconvenios=false;
					this.vistatotalconvenio=false
				}else{
					this.vistatotalconvenio=true
					this.cpp_convenios=nombre;
					this.cpp_total_convenio=total;
					this.cpp_id_convenios=id;
					this.buscarprogramas(id);
					this.conveniooldfechai=fechai;
					this.conveniooldfechat=fechat;
					this.verconvenios=false;

				}

			},
			buscarConvenios()
			{
				axios.get('convenios/'+this.cpp_convenios).then(response=>{
					this.convenios=response.data;

					this.verconvenios=true;
				}).catch(err=>{

				});
			},
		}   

	}		   

</script>	