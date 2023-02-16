<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header text-white text-center bg-primary"><h5>Modificacion de Productos</h5></div>
					<div class="card-body">
						<div class="row">
							<div class="col-1">
								<label>Buscar</label>
								
							</div>
							<div class="col-2">
								<input type="number" name="" class="form-control" placeholder="OT" v-model="ot">
								
							</div>
							<div class="col-3">
								<input type="number" name="" class="form-control" placeholder="CPP" v-model="cpp">
								
							</div>
							<div class="col-1">
								<select class="form-control" v-model="year2">
									<option v-for="y in year_reporte" :selected="y.year == years ? 'selected' : ''" :value="year2">{{y.year}}</option>
								</select>
								
							</div>
							<div class="col-2">
								<div class="alert alert-danger" role="alert">
									Estado:{{estado_cpp}}
								</div>
							</div>
							<div class="col-3">
								<button class="btn btn-primary" @click="buscar">Buscar</button>
								<button class="btn btn-info" @click="limpiar()">Limpiar</button>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="card">
					{{estado_cpp_id}}
					<div class="card-header text-center text-white bg-success"><h5>Listado de Productos</h5></div>
					<div class="row MT-2">
						<div class="col-2">
							<label>Valor Total OT:</label>
							
						</div>
						<div class="col-3">
							$<label v-if="totalot > 0">{{formatPrice(totalot)}}</label>
						</div>
						<div class="col-2">
							<label>Valor Total CPP:</label>
							
						</div>
						<div class="col-3">
							$<label v-if="totalcpp >0">{{formatPrice(totalcpp)}}</label>
						</div>
						<div class="2">
							<button class="btn btn-warning">Agregar</button>
							
						</div>
						
					</div>
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">Id</th>
									<th scope="col">Nombre</th>
									<th scope="col">Precio</th>
									<th scope="col">Cantidad</th>
									<th scope="col">Total</th>
									<th scope="col">Centro de Costo</th>
									<th scope="col">Descripcion</th>
									
									<th scope="col">Observacion</th>
									<th scope="col">Accion</th>
								</tr>
							</thead>
							<tbody>
								<tr  v-for=" (p,index) in productos">
									<th scope="row">{{index+1}}</th>
									<td class="col-4">{{p.nombre}}</td>
									<td>{{formatPrice(p.precio)}}</td>
									<td>{{p.cantidad}}</td>
									<td>{{formatPrice(p.precio*p.cantidad)}}</td>
									<td>{{p.cc}}</td>
									<td>{{p.pro_descripcion}}</td>

									<td>{{p.pro_justificacion}}</td>
									<td><button class="btn btn-primary" @click="editarproducto(p)">Editar</button> <button class="btn btn-danger" @click="eliminar(p)">Eliminar</button></td>
								</tr>
								<tr v-if="productos.length == 0">
									<th scope="row"></th>
									<td></td>
									<td></td>
									<td class="text-right">No Existen Datos</td>
									<th scope="row"></th>
									<td></td>
									<td></td>
									<td></td>
									
									
								</tr>

							</tbody>
						</table>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		<div class="modal fade" id="editarproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Producto  Total:${{formatPrice(prod.precio*prod.cantidad)}} </h5>


						
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-2">
								<label>Nombre Producto:</label>
							</div>
							<div class="col-6">
								<input type="" name="" v-model="prod.nombre" class="form-control" @keyup="getproductos(prod.nombre)">
								<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="liprooculto">
									<div v-for=" lipro in listproductos">
										<span class="elecciondeproducto" @click="selecciona(lipro.codigo,lipro.nombre,prod)">{{lipro.codigo}}-{{lipro.nombre}}</span>
									</div>
									
								</div>
								<input type="hidden" name="" v-model="id_producto">
							</div>
							<div class="col-1">
								<label>CC</label>
							</div>
							<div class="col-3">
								<input type="" name="" v-model="prod.cc" class="form-control" @keyup="getcc(prod.cc)">
								<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="ccoculto">
									<div v-for="cc in  centros">
										<span class="elecciondeproducto" @click="elegircc(cc.cc_id,cc.cc_nombre,prod,cc.cc_cr_id)">{{cc.cc_nombre}}</span>
										
									</div>
									<input type="hidden" name="" v-model="id_cc">
									<input type="hidden" name="" v-model="id_cr">
								</div>

								
							</div>
							
						</div>
						<div class="row mt-2">
							<div class="col-1">
								<label>Precio</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" v-model="prod.precio" class="form-control">
								
							</div>
							<div class="col-1">
								<label>Cantidad</label>
								
							</div>
							<div class="col-2">
								<input type="" name="" v-model="prod.cantidad" class="form-control" @change="calcular(prod)">
								
							</div>
							<div class="col-1">
								<label>Descripcion</label>
								
							</div>
							<div class="col-2">

								<textarea class="form-control" cols="5" v-model="prod.pro_descripcion">
									

								</textarea>
								
							</div>
							<div class="col-1">
								<label>Justificacion</label>
								
							</div>
							<div class="col-2">
								

								<textarea class="form-control" cols="5" v-model="prod.pro_justificacion">
									

								</textarea>
								
							</div>
							
						</div>
						<div class="row mt-2">

							<div class="col-5 ">
								<label>Sige:</label>
								<input type="" name="" class="form-control" v-model="prod.nombre_sigfe" @keyup="cuentassigfe(prod.nombre_sigfe)">
								<div style="z-index: 1;background-color: #ffff;position: absolute;width: 100%" v-if="ocultar_sigfe">
									<div v-for="c in c_sigfes">
										<span class="elecciondeproducto" @click="seleccionarsigfe(c.id,c.nombre,c.sigfe_id,c.sub_item,prod)">{{c.nombre}}</span>
									</div>

								</div>


							</div>
							<div class="col-3 mt-2">
								<div><label>Item</label></div>
								<div class="alert alert-primary" role="alert" v-text="prod.item">

								</div>
								
							</div>
							<div class="col-3 mt-2">
								<div><label>Sub item</label></div>
								<div class="alert alert-success" role="alert" v-text="prod.subitem">
									
								</div>
								
							</div>
							
						</div>
						<!-- <div class="row">
							<div class="col-12 offset-5">
								<progress-bar
								:options="options"
								:value="value"
								/>
							</div> -->
							{{cc_antiguo}} -{{precio_antiguo}} -{{cantidad_antiguo}}- {{sigfe_antiguo}}



						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" @click="guardarcambio(prod)">Guardar</button>
						</div>
					</div>
				</div>
			</div>

		</div>

	</template>
	<style  lang="scss" scoped>
		.vuejs-progress-bar {
			display: inline-block;
			align-content: stretch;
			width: 0;
			line-height: 20px;
		}
	</style>
	<script >
		export default
		{
			props: ['id_session'],

			data(){

				return {
					estado_cpp_id:'',
					estado_cpp:'',
					options: {
						text: {
							color: '#FFFFFF',
							shadowEnable: true,
							shadowColor: '#000000',
							fontSize: 14,
							fontFamily: 'Helvetica',
							dynamicPosition: false,
							hideText: false
						},
						progress: {
							color: '#2dbd2d',
							backgroundColor: '#333333',
							inverted: false
						},
						layout: {
							height: 35,
							width: 140,
							verticalTextAlign: 61,
							horizontalTextAlign: 43,
							zeroOffset: 0,
							strokeWidth: 30,
							progressPadding: 0,
							type: 'line'
						}
					},
					value:10,
					centros:[],
					id_cc:'',
					id_cr:'',
					ccoculto:false,
					liprooculto:false,
					listproductos:[],
					year2:2022,
					year_reporte:[],
					ot:'',
					cpp:'',
					totalot:0,
					totalcpp:0,
					productos:[],
					cpp_elegido:'',
					ot_cpp:'',
					prod:{id:'',id_producto:'',nombre:'',cc:'',precio:'',cantidad:'',total:'',cc_id:'',sigfe:'',item:'',subitem:'',nombre_sigfe:''},
					years:'',
					id_producto:'',
					c_sigfes:[],
					ocultar_sigfe:false,
					cc_antiguo:'',
					precio_antiguo:0,
					cantidad_antiguo:0,
					cpp_year:0,
					id_refrendacion:'',
					sigfe_antiguo:0

				}

			},
			created:function()
			{
				this.getyear();


			},
			mounted()
			{
				var today = new Date();
				this.years = today.getFullYear();



			},
			methods:
			{ 
				eliminarot(pro){
					if(this.productos.length == 1)
					{
						Swal.fire({
						title: 'Si elimina el ultimo producto se anulara el OC'+this.ot,          
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (result.isConfirmed) {
							var url='productos/'+pro.id;
							var d={
								_method:'patch',
								pro_estado_producto:9
							}

                            axios.post(url,d).then(response=>{

                            	var urlot='compras/'+this.ot;
                            	var da={
                            		_method:'patch',
                            		compra_estado:8
                            	}
                            	axios.post(urlot,da).then(res=>{

                            	}).catch(ee=>{

                            	});
                            }).catch(err=>{

                            });

						}

					});


					}else{

						Swal.fire({
						title: 'DEsea elimuinar el producto N'+this.pro.id,          
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (result.isConfirmed) {
							var url='productos/'+pro.id;
							var d={
								_method:'patch',
								pro_estado_producto:9
							}

                            axios.post(url,d).then(response=>{

                            	
                            }).catch(err=>{

                            });

						}

					});

					}

				},
				eliminarcpp()
				{

					Swal.fire({
						title: 'DEsea elimuinar el producto N'+this.pro.id,          
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Aceptar'
					}).then((result) => {
						if (result.isConfirmed) {
							var url='productos/'+pro.id;
							var d={
								_method:'patch',
								pro_estado_producto:9,
								pro_id_cpp:0

							}

                            axios.post(url,d).then(response=>{

                            	
                            }).catch(err=>{

                            });

						}

					});

				},
				eliminar(pro){

					if(this.cpp_elegido != ''){
                           this.eliminarcpp(pro);
					}else if(this.ot != ''){
                       this.eliminarot(pro);
					}

					
					

				},
				seleccionarsigfe(id,nombre,item,subitem,pro)
				{
					pro.item=item
					pro.subitem=subitem
					pro.sigfe=nombre
					// this.cuenta_sigfe=nombre;
					this.ocultar_sigfe=false;
					// this.elegido_item=item;
					// this.elegido_subitem=subitem
					// this.ocultar_sigfe2=true

				},
				cuentassigfe(id)
				{
					axios.get('cuentassigfes/'+id).then(response=>{
						this.c_sigfes=response.data;
						this.ocultar_sigfe=true;

					}).catch(err=>{

					});

				},
				limpiar()
				{
					location.reload()

				},
				elegircc(id,nombre,array,cr)
				{
					this.id_cc=id
					array.cc_id=id
					array.cc=nombre
					this.ccoculto=false

				},
				getcc(id)
				{
					axios.get('centros/'+id).then(response=>{
						this.centros=response.data
						this.ccoculto=true
					}).catch(err=>{});

				},
				selecciona(codigo,nombre,array)
				{
					this.id_producto=codigo
					array.nombre=nombre
					console.log(array.nombre)
					this.liprooculto=false



				},
				getproductos(id)
				{
					axios.get('productos_base/'+id).then(response=>{
						this.listproductos=response.data;
						this.liprooculto=true
					}).catch(err=>{});
				},
				calcular(product)
				{
					console.log(product)
					product.total=product.cantidad*product.precio;

				},
				actualziarcpp(cpp)
				{
					var d= new FormData();
					d.append('cpp',cpp);
					d.append('refrendacion',this.id_refrendacion)
					axios.post('actualizarcpp',d).then(response=>{

					}).catch(err=>{

					});

				},
				enviodeproductos(pro)
				{
					var url="productos/"+pro.id
					var total=parseInt(pro.precio)*parseInt(pro.cantidad)

					var d={
						pro_precio:parseInt(pro.precio),
						pro_cantidad:parseInt(pro.cantidad),
						pro_total:total,
						pro_justificacion:pro.justificacion,
						pro_descripcion:pro.descripcion,
						pro_cuenta_sigfe:pro.sigfe,
						pro_nombre_sigfe:pro.nombre_sigfe,
						pro_sub_item_sigfe:pro.subitem,
						pro_cc:pro.cc_id,
						_method:'patch'
					}
					axios.post(url,d).then(response=>{
						this.actualziarcpp(this.cpp_elegido);
						this.dulcealert('SE actualizo el producto','success');
						$("#editarproduct").modal('hide');
						this.buscar()
					}).catch(err=>{});

				},
				verproductos(cc)
				{
					var to=0
					for (var i = 0; i < this.productos.length; i++) {
						if(parseInt(cc) == parseInt(this.productos[i].pro_cc)){
							to = to+(this.productos[i].cantidad*this.productos[i].precio)
						}
						
					}
					return to;

				},
				productosgastos(pro)
				{
					var total=parseInt(pro.precio)*parseInt(pro.cantidad)
					var url='gasta/'+pro.id;
					var d={
						_method:'patch',
						cr:pro.cr,
						cc:pro.cc_id,
						monto:total,
						sigfe:pro.sigfe,
						sub_sigfe:pro.subitem,
						familia:pro.sigfe_item
					}
					axios.post(url,d).then(response=>{

					}).catch(err=>{

					});




				},
				verproductocambiado(cc)
				{

				},
				guardarcambio(pro)
				{
					console.log('productos',pro)
					console.log('tipo',this.estado_cpp_id)
					if(this.estado_cpp_id >= 3)
					{
						this.productosgastos(pro);
						if(parseInt(this.cc_antiguo) == parseInt(pro.cc_id)){
							this.enviodeproductos(pro)

						}else{
							this.enviodeproductos(pro)

							var valortotal=this.verproductos(pro.cc_id);
							var precionuevo=parseInt(pro.precio)*parseInt(pro.cantidad)
							var precioantiguo=parseInt(this.precio_antiguo)*parseInt(this.cantidad_antiguo)
							var item_sigfe=pro.subitem.toString().substring(0,2);

							var da=new FormData();
							da.append('total',precioantiguo)
							da.append('cc',this.cc_antiguo);
							da.append('sigfe',item_sigfe)
							da.append('id_compromiso',this.cpp_elegido)
							da.append('precionuevo',precionuevo)
							da.append('ccnuevo',pro.cc_id)
							da.append('refrendacion',this.id_refrendacion)
							da.append('estado',this.estado_cpp_id)
							da.append('year',this.cpp_year)
							da.append('usuario',this.id_session)
							da.append('sigfe_antiguo',this.sigfe_antiguo)					   

							axios.post('restarcc',da).then(response=>{


							}).catch(err=>{

							});
							console.log('cc distintos',this.verproductos(pro.cc_id))

						}

						

					}
					

				},
				buscar()
				{
					if(this.ot == '' && this.cpp == ''){
						this.dulcealert('Debe ingresar un parametro CPP o OT','error');

					}
					if(this.ot != ''){
						var d= new FormData();
						d.append('numero',this.ot);
						d.append('year',this.year2);
						axios.post('productosots',d).then(response=>{
							if(response.data.length == 0){
								this.dulcealert('No existen datos','error');
							}
							this.productos=response.data
							var total=0
							for (var i = 0; i < this.productos.length; i++) {
								total=total+this.productos[i].pro_total
								this.estado_cpp=this.productos[i].cpp_estado
								this.estado_cpp_id=this.productos[i].estado_cpp_id

							}
							this.totalot=total;

						}).catch(error=>{

						});
					}else if(this.cpp != ''){
						var d= new FormData();
						d.append('numero',this.cpp);
						d.append('year',this.year2);

						axios.post('compromiso2',d).then(r=>{
							if(r.data == ''){
								return this.dulcealert('no existen datos del CPP','error');

							}
							console.log(r.data.cpp_estado_id)
							this.cpp_elegido=r.data.id
							this.totalcpp=r.data.total
							this.ot=r.data.oc
							this.estado_cpp=r.data.cpp_estado
							this.estado_cpp_id=r.data.cpp_estado_id
							this.cpp_year=r.data.year
							this.id_refrendacion=r.data.id_refrendacion

							this.getproductoscpp(r.data.id)

						}).catch(e=>{

						});
					}


				},	
				editarproducto(datos)
				{   this.prod.cc_id=datos.pro_cc
					this.cc_antiguo=datos.pro_cc
					this.prod.id=datos.pro_id
					this.prod.nombre=datos.nombre
					this.prod.cc=datos.cc
					this.prod.precio=datos.precio
					this.prod.cantidad=datos.cantidad
					this.prod.descripcion=datos.pro_descripcion
					this.prod.justificacion=datos.pro_justificacion
					this.prod.subitem=datos.subitem
					this.prod.item=datos.sigfe_item
					this.sigfe_antiguo=datos.sigfe_item
					this.prod.sigfe=datos.sigfe
					this.prod.total=datos.total
					this.prod.nombre_sigfe=datos.nombre_sigfe
					this.precio_antiguo=datos.precio
					this.cantidad_antiguo=datos.cantidad

					//prod:id:'',id_producto:'',nombre:'',cc:'',precio:'',cantidad:'',total:'',cc_id:'',sigfe:'',item:'',subitem:''},

					$("#editarproduct").modal();

				},
				getproductoscpp(cpp)
				{

					axios.get('productos_comprador_ccpp/'+cpp).then(response=>{
						this.productos=response.data;
					}).catch(err=>{

					});

				},
				formatPrice(value) {
					let val = (value/1).toFixed(0).replace('.', '.')
					return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
				},
				dulcealert(text,icono)
				{
					Swal.fire({
						icon: icono,

						text: text,

					})


				},

				getyear(){

					var currentTime = new Date();
					var year = currentTime.getFullYear()
					var year=year+3;
					for (var i = 2022; i <= year; i++) {

						this.year_reporte.push({'year':i});

					}

				},


			}
		}	     		   

	</script>