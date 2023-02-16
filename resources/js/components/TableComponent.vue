<template>
	<div class="container-fluid mt-4">
		<div class="card">
			<div class="card-title text-center"><h5><b>Lista Productos</b></h5></div>
			<div class="card-body">	
				<div class="row">
					<div class="col-3">
						<div class="card  mb-3 border border-success" style="max-width: 18rem;">
							<div class="card-header text-white bg-success ">Presupuesto</div>
							<div class="card-body">
								<h5 class="card-title">$ {{presupuesto_cc}}</h5>
								
							</div>
						</div>

					</div>
					<div class="col-3">
						<div class="card  mb-3 border border-warning" style="max-width: 18rem;">
							<div class="card-header ext-dark bg-warning">Costo de OT</div>
							<div class="card-body">								
								<h5 class="card-title">$ {{costoot}}</h5>
						
								
							</div>
						</div>
						
					</div>
					<div class="col-3">
						<div class="card  mb-3 border border-info" style="max-width: 18rem;">
							<div class="card-header ext-dark bg-info">Saldo</div>
							<div class="card-body">
								<div :class="alertmenor==true? 'alert alert-danger':'alert alert-success'" role="alert" >
								<h5 class="card-title">$ {{saldo}}</h5>
							</div>
								
							</div>
						</div>
						
					</div>
					<div class="col-3">
						<div class="card  mb-3 border border-primary" style="max-width: 18rem;">
							<div class="card-header text-white bg-primary">Monto Sin Refendar</div>
							<div class="card-body">
								<h5 class="card-title">$ 5.000.000</h5>
								
							</div>
						</div>
						
					</div>

				</div>			
				<div class="row">
					<div class="col-md-1">
						<button class="btn btn-primary" @click="agregar()">Agregar</button>

					</div>
					<div class="col-2 mt-3">
						<input type="number" name="" class="form-control" v-model="cantidadfila" maxlength="2" size="2">
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						

						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Nombre</th>
									<th scope="col">precio</th>
									<th scope="col">Cantidad</th>
									<th scope="col">Subtotal</th>
									<th scope="col">Descripcion</th>
									<th scope="col">obrsevacion</th>
									<th scope="col">Adjuntos</th>
									<th scope="col">Eliminar</th>
								</tr>
							</thead>
							
							<paginate name="productos" :list="productos" :per="4" tag="tbody">
								<tr  v-for="(pro,index) in paginated('productos')" :key="index">
									<td>{{index+1}}

									</td>
									<td>
										<input v-model="pro.nombre" :name="`productos[${index}][nombre]`" type="text" class="form-control" placeholder="Nombre del producto">
										<div style="z-index: 1;position: absolute;width: 100%;background-color: #ffff;">
											<div >
												<span></span>
											</div>
										</div>

									</td>
									<td>
										<input v-model="pro.precio" :name="`productos[${index}][precio]`" type="number" class="form-control" placeholder="Ingrese precio">

									</td>
									<td>
										<input v-model="pro.cantidad" :name="`productos[${index}][cantidad]`" type="number" class="form-control" placeholder="Ingrese cantidad" @change="sacarvalor(pro.precio,pro.cantidad,index)">

									</td>
									<td>
										<input v-model="pro.total" :name="`productos[${index}][total]`" type="number" class="form-control" disabled="disabled">

									</td>
									<td>
										<textarea class="form-control"  v-model="pro.descripcion" :name="`productos[${index}][descripcion]`">
										</textarea>
									</td>
									<td>
										<textarea class="form-control"  v-model="pro.obrsevacion" :name="`productos[${index}][observacion]`">
										</textarea>


									</td>
									<td>

										<form method="POST" enctype="multipart/form-data" name="myForm">
											<div class="text-bold-600 font-medium-2 btn btn-success" @click="getFile_2(index)">
												SUBIR
											</div>
											
											<input name="MAX_FILE_SIZE" type="hidden" id="imageA"  value="3000000" />
											<div style='height: 0px;width: 0px; overflow:hidden;'><input :name="`productos[${index}][adjunto]`" type="file"  :id="'upfile_documentos'+index" ref="file_documento"  @change="sub_documento($event,index)" multiple="true" accept="application/pdf" /></div>
										</form>
										
										<div class="row">
											<div class="col-12 offset-4">
												
												<div v-for="(ad,j) in getverarchivos(index) " :key="j">
													{{ad.name}}
													
												</div>

											</div>

										</div>					



									</td>

									<td>

										<input v-model="pro.eliminar" :name="`productos[${index}][total]`" type="button" class="btn btn-danger" >
									</td>
								</tr>

							</paginate>
							<tfoot>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col">Total:$ {{totalot}}</th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tfoot>	

						</table>
							<paginate-links for="productos" :classes="{'ul': ['pagination','justify-content-end'], 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
						<button class="btn btn-primary" @click="guardar">
							Guardar
						</button>
					</div>
					
				</div>
			</div>
			
		</div>
		
	</div>	
</template>
<script>
	export default {
		props:['name','id'],
		data(){

			return {
				paginate: ['productos'],
				productos:[],
				costoot:0,
				archivos:[],
				totalot:0,
				presupuesto_cc:5000000,
				alertmenor:false,
				saldo:0,
				cantidadfila:1

			}
		},
		watch:{
			pro(newQuestion, oldQuestion) {
				console.log(newQuestion);
			}
		},
		methods:{
			getverarchivos(index)
			{
				console.log('veer',this.productos[index].adjunto);
				return this.productos[index].adjunto;
			},
			sacarvalor(precio,cantidad,index)
			{
				this.productos[index].total=precio*cantidad;
				this.costoot=this.costoot+this.productos[index].total;
				this.totalot=this.totalot+this.productos[index].total;
                this.saldo=this.presupuesto_cc -this.costoot;
				if(this.presupuesto_cc < this.costoot){
					this.alertmenor=true;

				}else{
				 this.alertmenor=false;
	
				}

			},
			changeFiles()
			{

			},
			guardar(){
				const data = {
					productos: this.productos
				}
				let f=new FormData();
				for (var i = 0; i < this.productos.length; i++) {
					console.log(this.productos[i].adjunto);
					for (var j = 0; j < this.productos[i].adjunto.length; j++) {
						f.append('file[]',this.productos[i].adjunto[j]);
						f.append('id',i);
					}

				}
             axios.post('archivo',f).then(response=>{

             });
			
			console.log(this.productos);
			alert(JSON.stringify(data, null, 2))

		},
		agregar(){
			for (var i = 0; i < this.cantidadfila; i++) {
				this.productos.push({
				nombre:'',
				precio:'',
				cantidad:'',
				total:'',
				descripcion:'',
				observacion:'',
				adjunto:[],
				eliminar:'Eliminar'})
				
			}
			
		},
		sub_documento(event,index){
			console.log(event.target);
			this.productos[index].adjunto.push(event.target.files[0]);

			console.log(this.productos);
				// this.productos=JSON.stringify(this.productos);
				// this.productos[index].adjunto.push(this.file_documento2);
				console.log(this.productos);
				

			},
			getFile_2:function(index){
				var arch=document.getElementById("upfile_documentos"+index).click();

			},
		}

	}
</script>