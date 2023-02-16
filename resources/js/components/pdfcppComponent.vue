<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-right">
				<button class="btn btn-primary" @click="exportToPDF">DESCARGAR PDF</button>	 
			</div>
			
			
		</div>
		<div class="row">
			
			<div class="col-7 offset-3">
				<section slot="pdf-content">
					<section class="pdf-item">
						<div class="container-fluid">
							<div class="content-principal pdf-item" id="primeral">
								<div class="row mt-4">
									<div class="col-auto">
										<img :src="'../assets/pdf/logo.jpg'" width="80" height="80">

									</div>
								
								
									<div class="col-md-4 mt-2 " style="line-height:0;text-align: left">
										<p style="font-size: 12px;">MINISTERIO DE SALUD </p>
										<p style="font-size: 12px;">Servicio de Salud de Arica</p>
										<p style="font-size: 12px;">61.606.000-7</p>
										<p style="font-size: 12px;">Arturo Part # 305</p>
									</div>
									<div class="col-md-4 mt-5">
										<label class="offset-6" style="font-size: 18px;text-align: right;">N° {{id}} Año {{year}}</label>

									</div>

								</div>
								<div class="row mt-1">
									<div class="col-12" style="line-height:0">
										<p style="font-size: 20px;text-align: center"><u>COMPROMISO PRESUPUESTARIO</u></p>
										<p style="font-size: 18px;text-align: center">Servicio de salud de arica</p>


									</div>

								</div>
								<div class="row mt-2">
									<div class="col-12">
										<p style="font-size: 18px"><b>1.- Antecedentes</b></p>
									</div>

								</div>

								<div class="card border-dark" >
									<div class="card-body">

										<div class="row ">
											<div class="col-3">
												<label>Nombre:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px"><b>{{nombre}}</b></label>
											</div>

											<div class="col-2">
												<label class="text-right">N Licitacion:</label>
											</div>
											<div class="col-2">
												<div><b><label style="font-size: 14px">{{nombrelicitacion}}</label></b></div>
											</div>



										</div>
										<div class="row " >
											<div class="col-3">
												<label class="text-right">Run:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px;"><b>{{run}}</b></label>

											</div>

											<div class="col-2">
												<label class="text-left">Fecha Lic.:</label>

											</div>
											<div class="col-3">
												<label>{{fechalicitacion}}</label>
											</div>




										</div>
										<div class="row" >
											<div class="col-3">
												<label>Fecha/Hora:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px;"><b>{{fecha}}</b></label>

											</div>
											<div class="col-3">
												<label class="text-left">OC. Portal.:</label>

											</div>
											<div class="col-2">

											</div>


										</div>
										<div class="row" >
											<div class="col-3">
												<label>Creado por:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px;"><b>{{creado}}</b></label>

											</div>
											<div class="col-2">
												<label class="text-left">Situacion:</label>

											</div>
											<div class="col-3">
												<label style="font-size: 14px">{{situacion}}</label>
											</div>

											

										</div>
										<div class="row" >
											<div class="col-md-3 col-sm-2">
												<label>Convenio:</label>
											</div>
											<div class="col-md-4 col-sm-8">
												<label style="font-size: 16px;"><b>{{convenio}}</b></label>

											</div>
											<div class="col-2">
												<label class="text-left">Tipo:</label>

											</div>
											<div class="col-2">
												<label style="font-size: 14px">{{tipocpp}}</label>
											</div>
										</div>

									</div>

								</div>	
								<div class="row mt-2">
									<div class="col-12">
										<p style="font-size: 18px"><b>2.- Detalles</b></p>
									</div>

								</div>

								<div class="row mt-2 "  ref="verificartable">
									<div class="col-12 table-responsive-sm" >
										<table class="table table-striped table-bordered" ref="verfilas">
											<thead>
												<tr class="bg-primary text-white">
													<th scope="col" style="font-size: 12px">Id</th>
													<th scope="col" style="font-size: 12px">Producto</th>
													<th scope="col" style="font-size: 12px">OT</th>
													<th scope="col" style="font-size: 12px">Item</th>
													<th scope="col" style="font-size: 12px">Centro Costo</th>
													<th scope="col" style="font-size: 12px">Cant.</th>
													<th scope="col" style="font-size: 12px">Unit</th>
													<th scope="col" style="font-size: 12px">Total Neto</th>
													<th scope="col" style="font-size: 12px">Total Bruto</th>
												</tr>
											</thead>
											<tbody>
												
												<tr v-for="(d,index) in productos"  ref="tr"  v-if="index<=9">
													<td>{{index+1}}</td>
													<td style="font-size: 12px">{{d.nombre}}</td>
													<td style="font-size: 12px">{{d.oc}}</td>											
													<td style="font-size: 12px">{{d.cuenta_sigfe}}</td>
													<td style="font-size: 12px">{{d.cc}}</td>
													<td style="font-size: 12px">{{formatPrice(d.cantidad)}}</td>
													<td style="font-size: 12px">{{formatPrice(d.precio)}}</td>
													<td style="font-size: 12px">{{formatPrice(d.t_neto)}}</td>
													<td style="font-size: 12px">{{formatPrice(d.pro_costo_unitario_incluye_todo)}}</td>

												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td><b>TOTAL</b></td>
													<td></td>
													<td><b>{{formatPrice(totalneto)}}</b></td>
													<td><b>{{formatPrice(totalbruto)}}</b></td>
													
													
												</tr>


												

											</tbody>
										</table>
										

									</div>

								</div>
									<div class="row mt-2 ">
											<div class="col-8 border table-responsive-sm1">
												<label><b>Observacion: {{observacion}}</b></label>
												
											</div>
											<div class="col-4">
												<div class="row">
													<div class="col-6">
														<label><b>(=) Neto:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(totalneto2)}}</b></label>
													</div>
													
												</div>
												<div class="row">
													<div class="col-6">
														<label><b>(+) Despacho:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(despacho)}}</b></label>
													</div>
													
												</div>
												<div class="row">
													<div class="col-6">
														<label><b>(-) Descuento:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(descuento)}}</b></label>
													</div>
													
												</div>
												<div class="row">
													<div class="col-6">
														<label><b>(+) I.V.A:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(iva)}}</b></label>
													</div>
													
												</div>
											
												<div class="row">
													<div class="col-6">
														<label><b>(+) Impuesto:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(impuesto)}}</b></label>
													</div>
													
												</div>
													<div class="row">
													<div class="col-6">
														<label><b>(=) Total:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(total)}}</b></label>
													</div>
													
												</div>
												
												
												
											</div>
											
										</div>

							
							</div><!-- fin del content-principal -->
							<span class="break-page"  v-if="totallineasproducto >= 439"  ></span>
							
							<span class="break-page"></span>
							<div class="content-principal pdf-item" id="primeral">


								<div class="col-12 table-responsive-sm" v-show="list_refrendacion != ''">
									<table class="table table-striped table-bordered">
										<thead>
											<tr class="bg-primary text-white">
												<th scope="col" style="font-size: 12px" >ITEM</th>
												<th scope="col" style="font-size: 12px">SUB. ITEM</th>
												<th scope="col" style="font-size: 12px">NOMBRE CUENTA</th>
												<th scope="col" style="font-size: 12px">C.R.</th>
												<th scope="col" style="font-size: 12px">C.C.</th>
												<th scope="col" style="font-size: 12px">$ GASTO</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(d,index) in productos2"  >
												<th scope="row">{{d.sigfe}}</th>
												<td>{{d.sub_sigfe}}</td>
												<td>{{d.pro_nombre_sigfe}}</td>
												<td>{{d.cr}}</td>
												<td>{{d.cc}}</td>
												<td>{{formatPrice(d.monto)}}</td>

											</tr>

										</tbody>
										<tfoot>

											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th>Total</th>

												<th>$ {{formatPrice(totalgastos)}}</th>

											</tr>

										</tfoot>
									</table>

								</div>
							</div>

							<div class="row mt-1" v-show="list_refrendacion != ''">
								<div class="col-md-6" >
									<div class="row">
										<div class="col-12">
											<qr-code class="offset-4" :text="r_encargado":size="100"></qr-code>
										</div>
										<div class="col-12">
											<p class="text-center">Registro Encargado</p>
										</div>

									</div>



								</div>
								<div class="col-md-6 ">
									<div class="row">
										<div class="col-12">
											<qr-code class="offset-4" :text="r_jefatura" :size="100"></qr-code>
										</div>
										<div class="col-12">
											<p class="text-center">Jefe Depto. Finanzas</p>
										</div>

									</div>
								</div>

							</div>

						</div>
					</section>

					<section class="pdf-item">
					</section>
				</section>


				
			</div>
			
		</div>
		<div class="row">
			<div class="col-12 offset-2">
				<vue-html2pdf 		
				:show-layout="false"				
				:float-layout="true"
				:enable-download="true"
				:preview-modal="true"
				:paginate-elements-by-height="650"		
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
							<div class="content-principal pdf-item" id="primeral">
								<div class="row mt-4">
									<div class="col-auto">
										<img :src="'../assets/pdf/logo.jpg'" width="80" height="80">

									</div>
								
								
									<div class="col-md-4 mt-2 " style="line-height:0;text-align: left">
										<p style="font-size: 12px;">MINISTERIO DE SALUD </p>
										<p style="font-size: 12px;">Servicio de Salud de Arica</p>
										<p style="font-size: 12px;">61.606.000-7</p>
										<p style="font-size: 12px;">Arturo Part # 305</p>
									</div>
									<div class="col-md-4 mt-5">
										<label class="offset-6" style="font-size: 18px;text-align: right;">N° {{id}} Año {{year}}</label>

									</div>

								</div>
								<div class="row mt-1">
									<div class="col-12" style="line-height:0">
										<p style="font-size: 20px;text-align: center"><u>COMPROMISO PRESUPUESTARIO</u></p>
										<p style="font-size: 18px;text-align: center">Servicio de salud de arica</p>


									</div>

								</div>
								<div class="row mt-2">
									<div class="col-12">
										<p style="font-size: 18px"><b>1.- Antecedentes</b></p>
									</div>

								</div>

								<div class="card border-dark" >
									<div class="card-body">

										<div class="row ">
											<div class="col-3">
												<label>Nombre:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px"><b>{{nombre}}</b></label>
											</div>

											<div class="col-2">
												<label class="text-right">N Licitacion:</label>
											</div>
											<div class="col-2">
												<div><b><label style="font-size: 14px">{{nombrelicitacion}}</label></b></div>
											</div>



										</div>
										<div class="row " >
											<div class="col-3">
												<label class="text-right">Run:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px;"><b>{{run}}</b></label>

											</div>

											<div class="col-2">
												<label class="text-left">Fecha Lic.:</label>

											</div>
											<div class="col-3">
												<label>{{fechalicitacion}}</label>
											</div>




										</div>
										<div class="row" >
											<div class="col-3">
												<label>Fecha/Hora:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px;"><b>{{fecha}}</b></label>

											</div>
											<div class="col-3">
												<label class="text-left">OC. Portal.:</label>

											</div>
											<div class="col-2">

											</div>


										</div>
										<div class="row" >
											<div class="col-3">
												<label>Creado por:</label>
											</div>
											<div class="col-4">
												<label style="font-size: 14px;"><b>{{creado}}</b></label>

											</div>
											<div class="col-2">
												<label class="text-left">Situacion:</label>

											</div>
											<div class="col-3">
												<label style="font-size: 14px">{{situacion}}</label>
											</div>

											

										</div>
										<div class="row" >
											<div class="col-md-3 col-sm-2">
												<label>Convenio:</label>
											</div>
											<div class="col-md-4 col-sm-8">
												<label style="font-size: 16px;"><b>{{convenio}}</b></label>

											</div>
											<div class="col-2">
												<label class="text-left">Tipo:</label>

											</div>
											<div class="col-2">
												<label style="font-size: 14px">{{tipocpp}}</label>
											</div>
										</div>

									</div>

								</div>	
								<div class="row mt-2">
									<div class="col-12">
										<p style="font-size: 18px"><b>2.- Detalles</b></p>
									</div>

								</div>

								<div class="row mt-2"  ref="verificartable">
									<div class="col-12 table-responsive-sm" >
										<table class="table table-striped table-bordered" ref="verfilas">
											<thead>
												<tr class="bg-primary text-white">
													<th scope="col" style="font-size: 12px">Id</th>
													<th scope="col" style="font-size: 12px">Producto</th>
													<th scope="col" style="font-size: 12px">OT</th>
													<th scope="col" style="font-size: 12px">Item</th>
													<th scope="col" style="font-size: 12px">Centro Costo</th>
													<th scope="col" style="font-size: 12px">Cant.</th>
													<th scope="col" style="font-size: 12px">Unit</th>
													<th scope="col" style="font-size: 12px">Total Neto</th>
													<th scope="col" style="font-size: 12px">Total Bruto</th>
												</tr>
											</thead>
											<tbody>
												
												<tr v-for="(d,index) in productos"  ref="tr"  >
													<th scope="row">{{index+1}}</th>
													<td style="font-size: 12px">{{d.nombre}}</td>
													<td style="font-size: 12px">{{d.oc}}</td>											
													<td style="font-size: 12px">{{d.cuenta_sigfe}}</td>
													<td style="font-size: 12px">{{d.cc}}</td>
													<td style="font-size: 12px">{{d.precio}}</td>
													<td style="font-size: 12px">{{formatPrice(d.cantidad)}}</td>
													<td style="font-size: 12px">{{formatPrice(d.t_neto)}}</td>
													<td style="font-size: 12px">{{formatPrice(d.pro_costo_unitario_incluye_todo)}}</td>


												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td><b>TOTAL</b></td>
													<td></td>
													<td><b>{{formatPrice(totalneto)}}</b></td>
													<td><b>{{formatPrice(totalbruto)}}</b></td>
													
													
												</tr>




												

											</tbody>
										</table>
										

									</div>

								</div>

							</div><!-- fin del content-principal -->
							<span class="break-page"  v-if="productos.length >9 " ></span>
							<div class="content-principal pdf-item" id="primeral" v-if="productos.length >9 " >
								<div class="row mt-4">
									<div class="col-auto">
										<img :src="'../assets/pdf/logo.jpg'" width="80" height="80">

									</div>
								
								
									<div class="col-md-4 mt-2 " style="line-height:0;text-align: left">
										<p style="font-size: 12px;">MINISTERIO DE SALUD </p>
										<p style="font-size: 12px;">Servicio de Salud de Arica</p>
										<p style="font-size: 12px;">61.606.000-7</p>
										<p style="font-size: 12px;">Arturo Part # 305</p>
									</div>
									<div class="col-md-4 mt-5">
										<label class="offset-6" style="font-size: 18px;text-align: right;">N° {{id}} Año {{year}}</label>

									</div>

								</div>
								<div class="row mt-1">
									<div class="col-12" style="line-height:0">
										<p style="font-size: 20px;text-align: center"><u>COMPROMISO PRESUPUESTARIO</u></p>
										<p style="font-size: 18px;text-align: center">Servicio de salud de arica</p>


									</div>

								</div>
								<div class="row mt-2">
									<div class="col-12">
										<p style="font-size: 18px"><b>2.- Detalles</b></p>
									</div>

								</div>

								<div class="row mt-2"  ref="verificartable">
									<div class="col-12 table-responsive-sm" >
										<table class="table table-striped table-bordered" ref="verfilas">
											<thead>
												<tr class="bg-primary text-white">
													<th scope="col" style="font-size: 12px">Id</th>
													<th scope="col" style="font-size: 12px">Producto</th>
													<th scope="col" style="font-size: 12px">OT</th>
													<th scope="col" style="font-size: 12px">Item</th>
													<th scope="col" style="font-size: 12px">Centro Costo</th>
													<th scope="col" style="font-size: 12px">Cant.</th>
													<th scope="col" style="font-size: 12px">Unit</th>
													<th scope="col" style="font-size: 12px">Total Neto</th>
													<th scope="col" style="font-size: 12px">Total Bruto</th>
												</tr>
											</thead>
											<tbody>
												
												<tr v-for="(d,index) in productos"  ref="tr"  v-if="index >=7">
													<td>{{index+1}}</td>
													<td style="font-size: 12px">{{d.nombre}}</td>
													<td style="font-size: 12px">{{d.oc}}</td>											
													<td style="font-size: 12px">{{d.sigfe}}</td>
													<td style="font-size: 12px">{{d.cc}}</td>
													<td style="font-size: 12px">{{d.precio}}</td>
													<td style="font-size: 12px">{{d.t_neto}}</td>
													<td style="font-size: 12px">{{d.pro_total}}</td>
													<td style="font-size: 12px">{{d.pro_costo_unitario_incluye_todo}}</td>

												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td><b>TOTAL</b></td>
													<td></td>
													<td>{{formatPrice(totalneto)}}</td>
													<td>{{formatPrice(totalbruto)}}</td>
													
													
												</tr>	

											</tbody>
										</table>
											
									</div>

								</div>

							</div>
							<div class="row mt-2">
											<div class="col-8 border border-dark table-responsive-sm1">
												<label><b>Observacion: {{observacion}}</b></label>
												
											</div>
											<div class="col-4">
												<div class="row">
													<div class="col-6">
														<label><b>(=) Neto:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(totalneto2)}}</b></label>
													</div>
													
												</div>
												<div class="row">
													<div class="col-6">
														<label><b>(+) Despacho:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(despacho)}}</b></label>
													</div>
													
												</div>
												<div class="row">
													<div class="col-6">
														<label><b>(-)Descuento:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(descuento)}}</b></label>
													</div>
													
												</div>
												<div class="row">
													<div class="col-6">
														<label><b>(+) I.V.A:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(iva)}}</b></label>
													</div>
													
												</div>
											
												<div class="row">
													<div class="col-6">
														<label><b>(+) Impuesto:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(impuesto)}}</b></label>
													</div>
													
												</div>
													<div class="row">
													<div class="col-6">
														<label><b>(=) Total:</b></label>
													</div>
													<div class="col-6">
														<label><b>$ {{formatPrice(total)}}</b></label>
													</div>
													
												</div>
												
												
												
											</div>
											
										</div>

							<span class="break-page"></span>
							<div class="content-principal pdf-item" id="primeral">
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
										<label class="offset-6" style="font-size: 18px;text-align: right;">N° {{id}} Año {{year}}</label>

									</div>

								</div>
								<div class="row mt-1">
									<div class="col-12" style="line-height:0">
										<p style="font-size: 20px;text-align: center"><u>COMPROMISO PRESUPUESTARIO</u></p>
										<p style="font-size: 18px;text-align: center">Servicio de salud de arica</p>


									</div>

								</div>
								<div class="row mt-2" v-show="list_refrendacion != ''">
									<div class="col-12">
										<p style="font-size: 18px"><b>3.- Departamento de Finanzas </b></p>
									</div>

								</div>
								<div class="col-12 table-responsive-sm"  v-show="list_refrendacion != ''">
									<table class="table table-striped table-bordered">
										<thead>
											<tr class="bg-primary text-white">
												<th scope="col" style="font-size: 12px">ITEM</th>
												<th scope="col" style="font-size: 12px">SUB. ITEM</th>
												<th scope="col" style="font-size: 12px">NOMBRE CUENTA</th>
												<th scope="col" style="font-size: 12px">C.C.</th>
												<th scope="col" style="font-size: 12px">C.R.</th>
												<th scope="col" style="font-size: 12px">$ GASTO</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(d,index) in productos2"  >
												<th scope="row">{{d.sigfe}}</th>
												<td>{{d.sub_sigfe}}</td>
												<td>{{d.pro_nombre_sigfe}}</td>
												<td>{{d.cr}}</td>
												<td>{{d.cc}}</td>
												<td>{{formatPrice(d.monto)}}</td>

											</tr>

										</tbody>
										<tfoot>

											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th>Total</th>

											<th>$ {{formatPrice(totalgastos)}}</th>

											</tr>

										</tfoot>
									</table>

								</div>
							</div>

							<div class="row mt-1" v-show="list_refrendacion != ''">
								<div class="col-md-6" v-show="list_refrendacion != ''">
									<div class="row">
										<div class="col-12" >
											<qr-code class="offset-4" :text="r_encargado" :size="100"></qr-code>
										</div>
										<div class="col-12">
											<p class="text-center">Registro Encargado</p>
										</div>

									</div>



								</div>
								<div class="col-md-6 ">
									<div class="row">
										<div class="col-12">
											<qr-code class="offset-4" :text="r_jefatura" :size="100"></qr-code>
										</div>
										<div class="col-12">
											<p class="text-center">Jefe Depto. Finanzas</p>
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

		<div class="title m-b-md">

		</div>

	</div>

</div>

</template>
<style>.break-page {break-after: page;} .content {padding: 40px}
.content-principal
{
	max-height: 1200px;
}
</style>
<script>
	
	export default
	{
		props: ['cod'],

		data(){

			return {
				tipocpp:'',
				gastos:[],
				observacion:'',
				totalneto2:0,
				total:0,
				impuesto:0,
				descuento:0,
				despacho:0,
				iva:0,
				fechalicitacion:'',
				nombrelicitacion:'',
				totalbruto:0,
				totalneto:0,
				r_jefatura:'',
				r_encargado:'',
				list_refrendacion:[],
				id:'',
				year:'',
				nombre:'',
				run:'',
				fecha:'',
				creado:'',
				convenio:'',
				nliciatcion:'',
				fechal:'',
				oc:'',
				situacion:'',
				totallineasproducto:0,
				verbreak:false,
				productos2:[],				
				productos:[],
				compra_fecha_guardada:'',
				compra_proyecto:'',
				compra_correo:'',
				year:'',
				compra_numero:'',
				htmlToPdfOptions: {

					filename: `hehehe.pdf`,
					margin:[30, 30, 30, 30],



					enableLinks: false,


					html2canvas: {
						scale: 1,
						useCORS: true
					},
					pagebreak: { mode: ['css'], after:'.break-page'},
					jsPDF: {
						unit: 'in',
						format: 'a4',
						orientation: 'portrait',

					}
				},
				dato: [],
				primeraseccion:'',
				totalgastos:0,
				

			}
		} ,
		created:function()
		{
			this.getcpp();
			this.getrefrendar();
			this.getgasto();
		},
		mounted()
		{
			this.matchHeight();
			
		},
		methods:
		{
			getgasto(){

				axios.get('../gasta/'+this.cod).then(responser=>{
                    this.productos2=responser.data;
                    for (var i = 0; i < this.productos2.length; i++) {
                    	this.totalgastos+=this.productos2[i].monto
                    }
				}).catch(err=>{

				});

			},
			formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', '.')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			getrefrendar()
			{
				axios.get('../refrendacion/'+this.cod).then(response=>{
					console.log(response.data)
					this.list_refrendacion=response.data;

					if(response.data != ''){					

						axios.get("../persona/"+response.data.encargado).then(res=>{
							this.r_encargado='Firmado por :'+res.data[0].per_nombre+' '+'Fecha:'+response.data.fecha_encargado

						}).catch(err=>{

						});

						axios.get("../persona/"+response.data.jefatura).then(res=>{
							this.r_jefatura='Firmado por :'+res.data[0].per_nombre+' '+'Fecha:'+response.data.fecha_jefatura

						}).catch(err=>{

						});
					}

				}).catch(err=>{

				});
			},

			getcpp()
			{
				axios.get('../compromiso/'+this.cod).then(response=>{
					
					this.run=response.data.usuario;
					this.fecha=response.data.created_at;
					this.id=response.data.numero;
					this.year=response.data.year;
					this.situacion=response.data.cpp_estado	
					this.nombrelicitacion=response.data.nombre_licitacion
					this.fechalicitacion=response.data.fecha
					this.impuesto=response.data.impuesto
					this.descuento=response.data.descuento
					this.iva=response.data.iva
					this.despacho=response.data.despacho
					this.total=response.data.total
					this.totalneto2=response.data.total_neto
					this.observacion=response.data.observacion	
					this.tipocpp=response.data.tiponombre		
					
					if(response.data.id_convenios == null){
						this.convenio='NO';
					}else{
						this.convenio='SI';
					}

					// this.nliciatcion=
					// this.fechal=
					this.oc=response.data.oc;
					
					axios.get('../estadocpp/'+response.data.estado).then(responseestado=>{
						//this.situacion=responseestado.data.nombre;
						axios.get('../persona2/'+response.data.usuario).then(res=>{
							this.nombre=res.data.per_nombre;
							this.creado=res.data.per_nombre;
							axios.get('../productos_comprador_ccpp/'+this.cod).then(response=>{
								this.productos=response.data;

								for (var i = 0; i < this.productos.length; i++) {
									this.totalneto=this.totalneto+this.productos[i].t_neto;
									this.totalbruto=this.totalbruto+this.productos[i].pro_costo_unitario_incluye_todo

								}

							});
						});
					});
				}).catch(err=>{

				});
			},
			getboton(){
				this.matchHeight();
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

				for (var i = 0; i < this.productos.length; i++) {
					console.log(this.$refs.tr[i].clientHeight);
					var valor=parseInt(this.$refs.tr[i].clientHeight)
					this.totallineasproducto=this.totallineasproducto+valor;
					this.verbreak=true;
					
				}
				
			}
			

		}	

	}	  
</script>