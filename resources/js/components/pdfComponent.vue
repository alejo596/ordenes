<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-right">
				<button class="btn btn-primary" @click="exportToPDF">DESCARGAR PDF</button>	
			</div>
			
		</div>
		<div class="row">
			<div class="col-12 offset-2">
				<vue-html2pdf 		
		:show-layout="true"
		:enableLinks="false"
		:float-layout="false"
		:enable-download="false"
		:preview-modal="true"
		:paginate-elements-by-height="1100"		
		:pdf-quality="2"
		:manual-pagination="true"
		pdf-format="a4"
		pdf-orientation="portrait"
		pdf-content-width="800px"		
		@hasGenerated="hasGenerated($event)"
		@beforeDownload="beforeDownload($event)"
		ref="html2Pdf">
		<section slot="pdf-content">
			<section class="pdf-item">
				<div class="container-fluid">
					<div class="row mt-4">
						<div class="col-md-2">
							<img :src="'../assets/pdf/logo.jpg'" width="150" height="150">

						</div>
						&nbsp;
						&nbsp;
						&nbsp;
						<div class="col-md-4 mt-2 " style="line-height:0;text-align: left">
							<p style="font-size: 14px;">MINISTERIO DE SALUD </p>
							<p style="font-size: 14px;">Servicio de Salud de Arica</p>
						</div>
						<div class="col-md-4 mt-5">
							<label class="offset-5" style="font-size: 18px;text-align: right;">N° {{compra_numero}} Año {{year}}</label>

						</div>

					</div>
					<div class="row mt-1">
						<div class="col-12" style="line-height:0">
							<p style="font-size: 20px;text-align: center"><u>Solicitud de Trabajo o Compra</u></p>
							<p style="font-size: 18px;text-align: center">Servicio de salud de arica</p>

						</div>

					</div>
					<div class="row mt-2">
						<div class="col-12">
							<p style="font-size: 18px"><b>1.- Antecedentes</b></p>
						</div>

					</div>

					<div class="card border-dark">
						<div class="card-body">

							<div class="row ">
								<div class="col-md-3 col-sm-2">
									<label>Usuario Responsable:</label>
								</div>
								<div class="col-md-4 col-sm-2">
									<label style="font-size: 16px"><b>{{usuario}} </b></label>
								</div>
								<div class="col-md-5 col-sm-2">
									<div class="row">
										<div class="col-md-7">
											<label class="text-right">Fecha de Solicitud:</label>
										</div>
										<div class="col-5">
											<div><b>{{compra_fecha_guardada}}</b></div>
										</div>

									</div>
								</div>

							</div>
							<div class="row " >
								<div class="col-md-3 col-sm-2">
									<label>Mail:</label>
								</div>
								<div class="col-md-9 col-sm-8">
									<label style="font-size: 16px;"><b>{{compra_correo}}</b></label>

								</div>


							</div>
							<div class="row" >
								<div class="col-md-3 col-sm-2">
									<label>Centro de Costo:</label>
								</div>
								<div class="col-md-9 col-sm-8">
									<label style="font-size: 16px;"><b>{{nombre_cc}}</b></label>

								</div>


							</div>
							<div class="row" >
								<div class="col-md-3 col-sm-2">
									<label>Proyecto:</label>
								</div>
								<div class="col-md-9 col-sm-8">
									<label style="font-size: 16px;"><b>{{compra_proyecto}}</b></label>

								</div>
							</div>

						</div>

					</div>	
					<div class="row mt-2">
						<div class="col-12">
							<p style="font-size: 18px"><b>2.- Detalles</b></p>
						</div>

					</div>

					<div class="row mt-2">
						<div class="col-12 table-responsive-sm" >
							<table class="table table-striped">
								<thead>
									<tr class="bg-primary text-white">
										<th scope="col">N°</th>
										<th scope="col">Producto</th>
										<th scope="col">Descripcion</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Total</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(d,index) in productos"  ref="infoBox">
										<th scope="row">{{index+1}}</th>
										<td>{{d.pro_nombre}}</td>
										<td style="font-size:12px;overflow: hidden;height: 100px;width: 100px;">{{d.pro_descripcion}}</td>
										<td>{{d.pro_cantidad}}</td>
										<td>{{formatPrice(d.pro_precio)}}</td>
										<td>{{formatPrice(d.pro_total)}}</td>
										
									</tr>

								</tbody>
							</table>

						</div>

					</div>
					<div class="row mt-2">
						<div class="col-md-6 text-center">
							<div class="row">
										<div class="col-12" >
											<qr-code class="offset-4" :text="r_cr" :size="100"></qr-code>
							               </div>
										<div class="col-12">
											<p class="text-center">Encargado de Centro de Responsabilidad</p>
										</div>

									</div>				
										
                           
						</div>
						<div class="col-md-6 text-center">
								<div class="row">
										<div class="col-12" >
											<qr-code class="offset-4" :text="r_cc" :size="100"></qr-code>
							               </div>
										<div class="col-12">
											<p class="text-center">Encargado de Centro de Costo</p>
										</div>

									</div>	
                            
						</div>

					</div>

				</div>
			</section>

			<section class="pdf-item">
			</section>
		</section>
	</vue-html2pdf>
				
			</div>
			
		</div>

		

</div>	
</template>
<script >
	export default
	{
		props: ['id_session','cod'],

		data(){

			return {
				r_cc:'',
				r_cr:'',
				nombre_cc:'',
				usuario:'',
				productos:[],
				compra_fecha_guardada:'',
				compra_proyecto:'',
				compra_correo:'',
				year:'',
				compra_numero:'',
				htmlToPdfOptions: {

					filename: `hehehe.pdf`,
					margin:20,



					enableLinks: false,


					html2canvas: {
						scale: 1,
						useCORS: true
					},

					jsPDF: {
						unit: 'in',
						format: 'a4',
						orientation: 'portrait'
					}
				},

				dato: []


			}
		} ,
		created:function()
		{
          this.getCompras();
          this.getProductos();
		},
		mounted()
		{
			this.matchHeight()
			console.log(this.matchHeight())


		},
		methods:
		{
			formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', '.')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			getProductos()
			{
               axios.get('../productos/'+this.cod).then(response=>{
                  this.productos=response.data;
               }).catch(err=>{
               });
			},
			getCompras()
			{
				axios.get('../compras/'+this.cod).then(response=>{
					this.year=response.data.compra_amio;
					this.compra_numero=response.data.compra_numero;
					this.compra_correo=response.data.compra_correo;
					this.compra_proyecto=response.data.compra_proyecto;
					this.compra_fecha_guardada=response.data.compra_fecha_guardada;
					this.usuario=response.data.per_nombre;
					this.nombre_cc=response.data.centrocosto;

					axios.get('../persona/'+response.data.compra_encargado_cc_rut).then(res=>{

						this.r_cc="Nombre: "+res.data[0].per_nombre+' '+'Fecha:'+response.data.compra_encargado_cc_aprueba_fecha

					}).catch(err=>{

					});

					axios.get('../persona/'+response.data.compra_jefatura_sub_rut).then(res=>{

						this.r_cr="Nombre: "+res.data[0].per_nombre+' '+'Fecha:'+response.data.compra_jefatura_sub_aprueba_fecha

					}).catch(err=>{

					});

				}).catch(err=>{

				});
			},
			async beforeDownload ({ html2pdf, options, pdfContent }) {
				await html2pdf().set(options).from(pdfContent).toPdf().get('pdf').then((pdf) => {
					const totalPages = pdf.internal.getNumberOfPages()
					for (let i = 1; i <= totalPages; i++) {
						pdf.setPage(i)
						pdf.setFontSize(10)
						pdf.setTextColor(150)
						pdf.text('Pag. ' + i + ' de ' + totalPages, (pdf.internal.pageSize.getWidth() * 0.88), (pdf.internal.pageSize.getHeight() - 0.3))
					} 
				}).save()
			},
			exportToPDF () 
			{
				this.$refs.html2Pdf.generatePdf()
			},
			matchHeight () {
				let height = this.$refs.infoBox.clientHeight;
				return height;
			}	
		},


	}	      

</script>