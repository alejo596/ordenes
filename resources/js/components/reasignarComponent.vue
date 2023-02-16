<template>
	<div class="container-fluid">
		<div class="card">
			<div class="card-header text-white bg-primary text-center"><h4>Reasignar OT's</h4></div>
			<div class="card-body">
				<div class="row offset-1">
					<div class="col-1">
						<label>Comprador</label>
						
					</div>
					<div class="col-2">
						<input type="" name="" class="form-control" v-model="ingresar_comprador" @keyup="buscarcomprador(ingresar_comprador)">
						<div style="z-index: 1;background-color: #ffff;position: absolute;width: 120px" v-if="verlistacomprador">
							<div v-for="c in comprador">
								<span class="elecciondeproducto" @click="selecionarcomprador(c.id,c.per_nombre)">{{c.per_nombre}}</span>
							</div>
						</div>
						<input type="hidden" name="" v-model="id_comprador">
					</div>
					<div class="col-1">
						<label>Año</label>
						
					</div>
					<div class="col-2">
						<select class="form-control" v-model="year2">
							<option v-for="y in year_reporte" :selected="y.year == years ? 'selected' : ''">{{y.year}}</option>
						</select>
						
					</div>
					<div class="col-1">
						<label>N° OT</label>
						
					</div>
					<div class="col-2">
						<input type="" name="" class="form-control" v-model="ot">
						
					</div>
					<div class="col-2">
						<button class="btn btn-primary" @click="buscarproecso()">Buscar</button>
						<button class="btn btn-info" @click="limpiarbusqueda()">Limpiar</button>
					</div>
					
				</div>
				
			</div>
			
		</div>
		<div class="card mt-2">
			<div class="card-header text-white text-center bg-success"><h5>Lista Productos /Procesos</h5></div>
			<div class="card-body">
				<div class="row">
					<div class="col-2 mt-2">
						<label>Comprador:</label>						
					</div>
					<div class="col-2 mt-2">
						<input type="" name="" class="form-control" v-model="compradortodos" @keyup="buscartodoscomprador(compradortodos)">
						<div style="z-index: 1;background-color: #ffff;position: absolute;width: 250px" v-if="verlistacomprador3">
							<div v-for="comp in compradores">
								<span  class="elecciondeproducto" @click="selecciontodos(comp.id,comp.per_nombre)">{{comp.per_nombre}}</span>
							</div>
						</div>
						<input type="hidden" name="" v-model="id_todos">
					</div>
					<div class="col-2 mt-2">
					<!-- 	<button class="btn btn-success" @click="agregaratodos">Agregar a Todos</button> -->

						<div class="btn-group btn-group-toggle" data-toggle="button">
							<label  class="btn btn-success">
								<input type="checkbox" name="" @click="agregaratodos($event)">Marcar Todas
							</label>
						</div>



					</div>
					<div class="col-2 offset-4">
						<button class="btn btn-primary" @click="agregarnuevocomprador()">Agregar nuevo Comprador</button>
					</div>
					
				</div>
				
				<table class="table table-hover mt-4">
					<thead>
						<tr>
							<th scope="col" style="font-size: 12px">Id</th>
							<th scope="col" style="font-size: 12px">OC</th>
							<th scope="col" style="font-size: 12px">Fecha</th>
							<th scope="col" style="font-size: 12px">Producto</th>
							<th scope="col" style="font-size: 12px">Descripcion</th>
							<th scope="col" style="font-size: 12px">Cant.</th>
							<th scope="col" style="font-size: 12px">Total</th>
							<th scope="col" style="font-size: 12px">Estado Prod.</th>
							<th scope="col" style="font-size: 12px">CPP</th>
							<th scope="col" style="font-size: 12px">Estado CPP</th>
							<th scope="col" style="font-size: 12px">Proveedor</th>
							<th scope="col" style="font-size: 12px">Comprador</th>
							<th scope="col" style="font-size: 12px">Acciones</th>

						</tr>
					</thead>
					<tbody>
						<tr v-for="(pro_e,index) in procesosencontrados" :class=" colortable[index] == true ? 'table-success':''">
							<td style="font-size: 12px">{{index+1}}</td>
							<td style="font-size: 12px">{{pro_e.compra_numero}}</td>
							<td style="font-size: 12px">{{pro_e.created_at}}</td>
							<td style="font-size: 12px">{{pro_e.pro_nombre}}</td>
							<td style="font-size: 12px">{{pro_e.pro_descripcion}}</td>
							<td style="font-size: 12px">{{pro_e.cantidad}}</td>
							<td style="font-size: 12px">{{formatPrice(pro_e.pro_total)}}</td>
							<td style="font-size: 12px">{{pro_e.nombre}}</td>
							<td style="font-size: 12px">{{pro_e.cpp_numero}}</td>
							<td style="font-size: 12px">{{pro_e.estado_cpp}}</td>
							<td style="font-size: 12px">{{pro_e.proveedor}}</td>
							<td style="font-size: 12px">{{pro_e.per_nombre}}</td>
							<td><input type="" name="" class="form-control" v-model="com_elegido[index]" @keyup="buscarcomptable(com_elegido,index)">
								<div style="z-index: 1;background-color: #ffff;position: absolute;width: 120px" v-if="verlistacomprador2[index]">
									<div v-for="com in elegircom[index]">
										<span class="elecciondeproducto" @click="seleccionarcompratable(com.id,com.per_nombre,index,pro_e.pro_id,pro_e.id_proceso,pro_e.pro_id_oc)">{{com.per_nombre}}</span>
									</div>
									<input type="hidden" name="" v-model="id_compel[index]">
									
								</div>

							</td>
							
							
						</tr>

						
					</tbody>
				</table>


				
			</div>
			
		</div>
		<BlockUI :message="msg"  v-if="bloqueo">
			<img :src="'assets/img/745.gif'">

		</BlockUI>
		
	</div>
	
</template>
<script >
	export default
	{
		props: ['id_session','nombre'],

		data(){

			return {
				colortable:[],
				grupoot:[],
				checkboxVal:[],
				id_todos:'',
				compradores:[],
				compradortodos:'',
				id_compel:[],
				com_elegido:[],
				ingresar_comprador:'',
				comprador:[],
				verlistacomprador:false,
				verlistacomprador2:[],
				verlistacomprador3:false,
				id_comprador:'',
				year2:'',
				years:0,
				year_reporte:[],
				ot:'',
				procesosencontrados:[],
				msg: 'Espere un Momento...',
				bloqueo:false,
				elegircom:[],
				productos:[]
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
		methods:{
			agregarnuevocomprador()
			{
				if(this.procesosencontrados.length == 0){
					return this.dulcealert('No existen Productos','error');

				}
				if(this.id_compel.length == 0)
				{
					return this.dulcealert('No agregado compradores nuevos','error');
				}

				Swal.fire({
					title: 'Desea agregar nuevo Comprador?',
					showDenyButton: true,
					showCancelButton: true,
					confirmButtonText: 'Continuar Proceso',
					denyButtonText: `Nuevo Proceso`,
				}).then((result) => {
					if (result.isConfirmed) {							
						this.continuarproceso(); 

					} else if (result.isDenied) {
						this.nuevoproceso();

					}else if(result.isDismissed){
						return 0;

					}


				});

				console.log(this.id_compel.length)
				
			},
			crearhistoria(id,estado,actividad){
				var usuario=estado == 5 ? null:this.id_session;
				console.log(usuario)
				var d=new FormData();
				d.append('id_compra',id)
				d.append('estado',estado)
				d.append('actividad',actividad)
				d.append('usuario',usuario)
				axios.post('historialdecompras2',d).then(response=>{

				}).catch(err=>{

				});


			},
			continuarproceso()
			{
				console.log(this.productos)
				for (var i = 0; i < this.productos.length; i++) {
					this.grupoot.push(this.productos[i].oc);
					
					var url='productos/'+this.productos[i].id;
					var d={

						pro_id:this.productos[i].id,
						pro_comprador:this.productos[i].comprador,
						_method:'patch'

					}

					axios.post(url,d).then(response=>{



					}).catch(err=>{

					});
					var url2='procesosu';                      

					var d2=new FormData();
					d2.append('id_comprador',this.productos[i].comprador);
					d2.append('id',this.productos[i].proceso);
					axios.post(url2,d2).then(resp=>{



					});

					if(i == this.productos.length-1){
						if(this.productos[i].proceso != null){
                             this.dulcealert('Comprador Nuevo Agregado /Continuidad de proceso N°'+this.productos[i].proceso,'success')
						}else{
							this.dulcealert('Comprador Nuevo Agregado','success')
						}
						this.com_elegido=[]
						
						

					}

                    this.buscarproecso();


				}
				console.log(this.grupoot)
				let sinrepetir=[...new Set(this.grupoot)]
				console.log(sinrepetir);
				for (var i = 0; i < sinrepetir.length; i++) {
					
					this.crearhistoria(sinrepetir[i],14,3);
				}

			},
			nuevoproceso(){

				for (var i = 0; i < this.productos.length; i++) {
					this.grupoot.push(this.productos[i].oc);
					var url='productos/'+this.productos[i].id;
					var d={

						pro_id:this.productos[i].id,
						pro_comprador:this.productos[i].comprador,
						pro_estado_producto:1,
						id_proceso:0,
						_method:'patch'

					}
					axios.post(url,d).then(response=>{



					}).catch(err=>{

					});

					var url2='procesosu';                      

					var d2=new FormData();
					d2.append('estado',4);
					d2.append('id',this.productos[i].proceso);
					axios.post(url2,d2).then(resp=>{



					});

					if(i == this.productos.length-1){
						this.dulcealert('Comprador Nuevo Agregado','success')
						this.buscarproecso();

					}

				}
				console.log(this.grupoot)
				let sinrepetir=[...new Set(this.grupoot)]
				console.log(sinrepetir);
				for (var i = 0; i < sinrepetir.length; i++) {
					
					this.crearhistoria(sinrepetir[i],14,3);
				}
			},
			selecciontodos(id,nombre)
			{
				this.compradortodos=nombre;
				this.id_todos=id;
				this.verlistacomprador3=false;

			},
			buscartodoscomprador(id)
			{
				axios.get('comprador/'+id).then(response=>{
					this.compradores=response.data;
					this.verlistacomprador3=true;
				}).catch(err=>{

				});
			},
			agregaratodos(event)
			{
				this.bloqueo=true;
				if(this.procesosencontrados.length == 0){
					this.bloqueo=false;
					return this.dulcealert('No existen Productos','error');

				}
				this.productos=[];

				for (var i = 0; i < this.procesosencontrados.length; i++) {
					if(event.target.checked == true){
						this.colortable[i]=true

						this.$set(this.com_elegido,i,this.compradortodos);
						this.$set(this.id_compel,i,this.id_todos);
						this.productos.push({id:this.procesosencontrados[i].pro_id,comprador:this.id_todos,proceso:this.procesosencontrados[i].id_proceso});
					}else{
						this.colortable[i]=false
						this.$set(this.com_elegido,i,'');
						this.$set(this.id_compel,i,'');
						this.productos=[]

					}
				}

				this.bloqueo=false;

			},
			seleccionarcompratable(id,nombre,index,pro_id,proceso,oc){
				this.productos=[];
				this.productos.push({id:pro_id,comprador:id,proceso:proceso,oc:oc});
				this.$set(this.com_elegido,index,nombre);
				this.verlistacomprador2[index]=false

				this.$set(this.id_compel,index,id);
			},
			buscarcomptable(id,index)
			{   let sinrepetir=[...new Set(id)]
				console.log(sinrepetir)
				axios.get('comprador/'+sinrepetir[0]).then(response=>{
					
					this.$set(this.elegircom,index,response.data);
					this.verlistacomprador2[index]=true;
				}).catch(err=>{});
			},
			limpiarbusqueda()
			{
				this.year2='';
				this.ot='';
				this.procesosencontrados=[]
				this.ingresar_comprador=''
				this.id_comprador=''
				this.compradortodos=''
				this.id_todos=''
				this.productos=[]
				this.com_elegido=[]
			},
			dulcealert(text,icono)
			{
				Swal.fire({
					icon: icono,

					text: text,

				})


			},
			formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', '.')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			buscarproecso()
			{
				
				this.bloqueo=true;
				var d=new FormData();
				d.append('numero',this.ot);
				d.append('year',this.year2);
				d.append('comprador',this.id_comprador);

				axios.post('productosprocesos',d).then(response=>{
					this.procesosencontrados=response.data;
					for (var i = 0; i < this.procesosencontrados.length; i++) {
						this.colortable[i]=false;
						
					}
					this.bloqueo=false;
				}).catch(err=>{

				});

			},
			getyear(){
				var currentTime = new Date();
				var year = currentTime.getFullYear()
				var year=year+3;
				for (var i = 2022; i <= year; i++) {

					this.year_reporte.push({'year':i});
					
				}

			},
			buscarcomprador(id)
			{
				console.log(id)
				axios.get('comprador/'+id).then(response=>{
					this.comprador=response.data;
					this.verlistacomprador=true;
				}).catch(err=>{});

			},
			selecionarcomprador(id,nobre)
			{
				this.ingresar_comprador=nobre;
				this.id_comprador=id;
				this.verlistacomprador=false;

			}


		}

	}     
	
</script>