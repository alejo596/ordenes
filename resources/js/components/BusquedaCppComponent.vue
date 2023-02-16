<template>
	<div class="container-fluid mt-2">
		<div class="card border-primary">
			<div class="card-header text-center text-white bg-primary"><h5>Busqueda CPP</h5></div>
			<div class="card-body">
				<div class="row">
					<div class="col-1">
						<label>Estado</label>
						
					</div>
					<div class="col-2">
						<select class="form-control" v-model="cpp_estado">
							<option value="0" selected="selected">Seleccione..</option>
							<option v-for="es in estado" :value="es.id">{{es.nombre}}</option>
						</select>
						
					</div>
					<div class="col-1">
						<label>OC</label>
					</div>
					<div class="col-2">
						<input type="" name="" v-model="ot" class="form-control">
						
					</div>
					<div class="col-1">
						<label>Proveedor Run</label>
					</div>
					<div class="col-2">
						<input type="" name="" v-model="run_proveedor" class="form-control" @keyup="getproveedor(run_proveedor)">
						<div style="z-index: 1;width: 100%;background-color: #ffff;position: absolute;" v-if="proveedor_oculto">
							<div v-for=" p in proveedores">
								<span class="elecciondeproducto" @click="seleccionarproveedor(p.id,p.nombre)">{{p.nombre.toLowerCase()}}</span>
								
							</div>
							
						</div>
						<input type="hidden" name="" v-model="id_proveedor" class="form-control">
						
					</div>
					<div class="col-1">
						<label>N CPP</label>
					</div>
					<div class="col-2">
						<input type="" name="" v-model="cpp" class="form-control">
						
					</div>
					

					
				</div>
				<div class="row">
					<div class="col-1">
						<label>Año CPP</label>
						
					</div>
					<div class="col-2">
						<select class="form-control" v-model="year">
							<option v-for="y in year_reporte" :selected="y.year == years ? 'selected' : ''" :value="year">{{y.year}}</option>
						</select>
						
					</div>
					<div class="col-1">
						<label>CC</label>
					</div>
					<div class="col-2">
						<input type="" name="" v-model="cc" class="form-control" @keyup="getcentros(cc)">
						<div style="z-index: 1;width: 100%;background-color: #ffff;position: absolute;" v-if="cc_oculto">
							<div v-for=" c in centros">
								<span class="elecciondeproducto" @click="seleccionarcc(c.id,c.nombre,c.cr_id,c.cr_nombre)">{{c.nombre.toLowerCase()}}</span>
								
							</div>
							
						</div>
						<input type="hidden" name="" v-model="id_cc" class="form-control">
						
					</div>
					<div class="col-1">
						<label>CR</label>
					</div>
					<div class="col-2">
						<input type="" name="" v-model="cr" class="form-control">
						<input type="hidden" name="" v-model="id_cr">
						
					</div>
					<div class="col-1">
						<label>Por Usuario</label>
					</div>
					<div class="col-2">
						<toggle-button @change="onChangeEventHandler($event)" :value="valor_check" :labels="{checked: 'SI', unchecked: 'NO'}" :color="{checked: '#38c172', unchecked: '#FF0000', disabled: '#CCCCCC'}"    />
						
						
					</div>
					
				</div>

				<div class="row mt-2">
					<div class="col-1">
						<label>N OT</label>
						
					</div>
					<div class="col-2">
						<input type="" name="" class="form-control" v-model="numero_ot">
					</div>
					<div class="col-1">
						<label>Año OT</label>
					</div>
					<div class="col-2">
						<select class="form-control" v-model="year_ot">

							<option v-for="y in year_reporte" :selected="y.year == years ? 'selected' : ''" :value="year_ot">{{y.year}}</option>
						</select>
						
					</div>
					<div class="col-1">
						<label>CPP CREADO  POR</label>
					</div>
					<div class="col-5">
						<input type="" name="" v-model="cpp_creado" class="form-control" @keyup="getpersona(cpp_creado)">
						<div style="z-index: 1;width: 100%;background-color: #ffff;position: absolute;" v-if="usuario_oculto">
							<div v-for=" per in personas">
								<span class="elecciondeproducto" @click="seleccionpersona(per.per_rut,per.per_nombre)">{{per.per_nombre}}</span>
								
							</div>
							<input type="hidden" name="" v-model="id_persona">
						</div>
						
					</div>

				</div>

				<div class="row mt-2">
					<div class="col-12 offset-5">
						<button class="btn btn-success" @click="buscarcpp()">Buscar </button>

					</div>

				</div>

			</div>
		</div>
		<div class="card mt-3">
			<div class="card-header text-center text-white bg-primary"><h5>Lista de CPP</h5></div>
			<div class="card-body table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">CPP</th>
							<th scope="col">Año</th>
							<th scope="col">Proveedor</th>
							<th scope="col">OC Portal</th>
							<th scope="col">Creado Por</th>
							<th scope="col">Estado</th>
							<th scope="col">Monto</th>
							<th scope="col">Obs. Finanza</th>
							<th scope="col">Fecha Devuelta</th>
							<th scope="col">Proceso</th>
							<th scope="col">OT</th>
							<th scope="col">PDF</th>
							<th scope="col">Recepcion</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(bu,index) in  busqueda">
							<th scope="row">{{index+1}}</th>
							<td>{{bu.numero}}</td>
							<td>{{bu.year}}</td>
							<td>{{bu.nombre_proveedor}}</td>
							<td>{{bu.ocportal}}</td>
							<td>{{bu.nombre}}</td>
							<td>{{bu.estado}}</td>
							<td>{{formatPrice(bu.total)}}</td>
							<td>{{bu.observacion}}</td>
							<td></td>
							<td>{{bu.id_proceso}}</td>
							<td>{{bu.compra_numero}}</td>
							<td> <a href="#" @click="verpdf(bu.id)"><img src="assets/img/pdf.png" width="30" height="40"></a></td>
							<td>{{bu.num_recepcion}}</td>

						</tr>


					</tbody>
				</table>

			</div>

		</div>
		<BlockUI :message="msg"  v-if="bloqueo">
			<img :src="'assets/img/745.gif'">

		</BlockUI>

	</div>


</div>

</template>
<script>
	export default {
		props: ['id_session'],

		data(){

			return {
				id_persona:'',
				usuario_oculto:false,
				valor_check:true,
				ot:'',
				run_proveedor:'',
				cpp:'',
				cpp_creado:'',
				numero_ot:'',
				year_ot:0,
				cr:'',
				cc:'',
				years:2022,
				year_reporte:[],
				estado:[],
				cpp_estado:'',
				year:2022,
				proveedores:[],
				id_proveedor:'',
				proveedor_oculto:false,
				centros:[],
				id_cc:'',
				id_cr:'',
				cc_oculto:false,
				porusuario:'',
				personas:[],
				msg: 'Espere un Momento...',
				bloqueo:false,
				busqueda:[]


			}
		},
		mounted()
		{
			var today = new Date();
			this.years = today.getFullYear();
			this.porusuario=this.id_session



		},
		created:function()
		{
			this.getestado();
			this.getyear();

		},

		methods:{
			verpdf(id)
			{
				axios.get('encriptar/'+id).then(response=>{
						window.open('visorpdfcpp/'+response.data);

					}).catch(errr=>{

					});

			},
			formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', '.')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			buscarcpp()
			{
				
				this.bloqueo=true
				var d=new FormData();
				d.append('usuario',this.porusuario)
				d.append('estado',this.cpp_estado)
				d.append('oc',this.ot)
				d.append('proveedor',this.id_proveedor)
				d.append('cpp',this.cpp)
				d.append('yearcpp',this.year)
				d.append('cc',this.id_cc)
				d.append('cr',this.id_cr)
				d.append('numero',this.numero_ot)
				d.append('yearot',this.year_ot)
				d.append('creado',this.id_persona)



			

					axios.post('productoscppbusqueda',d).then(response=>{
						this.busqueda=response.data
						this.bloqueo=false
					}).catch(err=>{
						this.bloqueo=false
					});

				

			},
			seleccionpersona(id,nombre)
			{
				this.cpp_creado=nombre;
				this.id_persona=id
				this.usuario_oculto=false

			},
			getpersona(id){
				axios.get('persona/'+id).then(response=>{
					this.personas=response.data
					this.usuario_oculto=true
				}).catch(err=>{});

			},
			onChangeEventHandler(event)
			{
				console.log(event)
				if(event.value == true)
				{
					this.porusuario=this.id_session


				}else{
					this.porusuario=''
				}

			},
			getyear(){
				var currentTime = new Date();
				var year = currentTime.getFullYear()
				var year=year+3;
				for (var i = 2022; i <= year; i++) {

					this.year_reporte.push({'year':i});

				}


			},
			getestado()
			{
				axios.get('estadocpp').then(response=>{
					this.estado=response.data
				}).catch(err=>{})

			},
			getcentros(id)
			{
				axios.get('centros/'+id).then(response=>{
					this.centros=response.data
					this.cc_oculto=true
				}).catch(err=>{})

			},
			seleccionarcc(id,nombre,id_cr,cr_nombre)
			{
				this.cc=nombre
				this.id_cc=id
				this.id_cr=id_cr
				this.cr=cr_nombre
				this.cc_oculto=false

			},
			getproveedor(id)
			{
				axios.get('proveedores/'+id).then(response=>{
					this.proveedores=response.data
					this.proveedor_oculto=true
				}).catch(err=>{});
			},
			seleccionarproveedor(id,nombre)
			{
				this.run_proveedor=nombre
				this.id_proveedor=id
				this.proveedor_oculto=false
			}	   
		}
	}
</script>