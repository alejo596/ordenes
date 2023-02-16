<template>
	<div class="container-fluid">
		
		<div class="row" v-show="disabled_refrendacion">
			<div class="col-6">
				<div class="card border-left-danger " >

					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col-10">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Refrendación Encargado</div>

								<div style="font-size: 12px" class=" mb-0 font-weight-bold text-gray-800"><em>{{encargado_refrendacion}}</em>
								</div>
								
							</div>
							<div class="col-2">
								<i class="fa fa-signature fa-2x text-gray-300"></i>

							</div>
						</div>								
					</div>

				</div>

			</div>
			<div class="col-6">
				<div class="card border-left-success " >

					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col-10">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Refrendación Jefatura</div>

								<div style="font-size: 12px" class=" mb-0 font-weight-bold text-gray-800"><em>{{jefatura_refrendacion}}</em> 
								</div>
							</div>
							<div class="col-2">
								<i class="fa fa-signature fa-2x text-gray-300"></i>
							</div>
						</div>								
					</div>

				</div>

			</div>

		</div>

		<div class="card border-primary mt-1">
		
			<div  class="card-header text-center text-white bg-primary" :class="{'card-header text-center text-white bg-danger':id_estado == 5,'card-header text-center text-white bg-secondary ':id_estado == 4,'card-header text-center text-white bg-primary':id_estado == 1 ,'card-header text-center text-white bg-primary':id_estado == 2,'card-header text-center text-white bg-success':id_estado == 3}" >
				<div class="row">
					<div class="col-5 text-right">
						<h3><b>CPP</b></h3>
					</div>
					<div class="col-3 text-right" v-if="cpp != '' ">
						<h5>Estado:{{estadocpp}}</h5>
					</div>
					<div class="col-4 text-left" v-if="cpp != ''">
						<h5>Creada por : {{persona_nombre}}</h5>
					</div>

				</div>

			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-sm-1" v-if="cpp != '' ">
						<a href="#" @click="verpdfcpp()" data-toggle="tooltip" data-placement="top" title="Ver CPP"><img :src="'assets/img/pdf.png'" width="30" height="40"></a>

					</div>
					
				</div>
				<div class="row mt-2">	
					<div class="col-auto" v-for="tp in tiposcc" v-if=" tp.id != 8">
						<label style="font-size: 20px">{{tp.nombre}} :</label>

						<input type="radio" :name="tp.id" :id="tp.id" v-model="tipos"  :value="tp.id" @change="getquimico($event)">

					</div>	
					<div class="col-auto mt-2">
						<i class="fa fa-history" data-toggle="tooltip" data-placement="top"  @click="addComplementaria()"title="Complementaria"></i>

					</div>
					


				</div>

				<div  class="row mt-2" v-if="vistatotalconvenio">
					<div class="col-auto mt-2" >
						<div class="alert alert-success" role="alert">
							<label>Saldo de Convenio: <i class="fas fa-dollar-sign"></i>{{formatPrice( (cpp_total_convenio-montocppprograma ))}}</label>
						</div>				


					</div>
					<div class="col-auto mt-2" v-if="verprogramamonto">
						<div class="alert alert-warning" role="alert">
							<label>SubConvenio : <i class="fas fa-dollar-sign"></i>{{formatPrice((montoprogramael-montocppprograma))}}</label>
						</div>
					</div>

					<div class="col-auto mt-2" v-show="vistasearchsubconvenio" >
						<div class="alert alert-info" role="alert">
							<label>Programa Elegidos :<span >{{subconvenio.destino}} <i class="fas fa-dollar-sign" > {{formatPrice((subconvenio.monto - montocppprograma))}}</i></span></label>
						</div>
						

					</div>

					<div class="col-auto mt-2" v-if="verprogramamonto">
						<div class="alert alert-info" role="alert">					

							<label>Montos ocupados de Programas : <i class="fas fa-dollar-sign"></i> {{formatPrice(montocppprograma)}}</label>	

						</div>


					</div>
				</div>
				<div class="row mt-2">


					<div class="col-1">
						<label>Factura</label>
					</div>
					<div class="col-2">
						<input type="number" class="form-control" name="" v-model="cpp_factura" size="10">
					</div>
					<div class="col-1">
						<label>Convenios:</label>
					</div>
					<div  :class="agregarprogramas ? 'col-3':'col-4'">
						<input type="search" class="form-control" name="" v-model="cpp_convenios" @keyup="buscarConvenios">
						<div style="z-index: 1;background-color: #ffff;width: 100%;position: absolute;" v-if="verconvenios">
							<div v-for="con in convenios">
								<span class="elecciondepersona_" @click="seleeccionconvenio(con.cont_nombre,con.cont_id,con.cont_monto_actual,con.cont_fecha_inicio,con.cont_fecha_termino)">{{con.cont_nombre_abreviado}} (N° {{con.cont_id}})</span>
							</div>							

						</div>
						<input type="hidden" name="" v-model="cpp_id_convenios">
					</div>
					<div v-if="agregarprogramas">
						<button class="btn btn-primary" @click="agregarprograma">Subconvenios <i class="fas fa-plus-circle"></i></button>
						
					</div>
					<div class="col-sm-1">
						<label>OC Portal</label>
					</div>
					<div  :class="agregarprogramas ? 'col-sm-2':'col-sm-3'">
						<input type="" name="" class="form-control" v-model="ocportal">
					</div>

				</div>
				<div class="row mt-2 alert alert-success"  v-show="conv_nova">
					<div class="col-2 text-left">
						<label>Nuevo Convenio</label>
					</div>
					<div class="col-2">
						<input type="" name="" class="form-control" v-model="conv_nombre">
					</div>

					<div class="col-2">
						<label>Fecha inicio</label>
					</div>
					<div class="col-2">
						<input type="date" name="" class="form-control" v-model="conv_fechai">
					</div>

					<div class="col-1">
						<label>Fecha Final</label>
					</div>
					<div class="col-2">
						<input type="date" name="" class="form-control" v-model="conv_fechaf">
					</div>
					<div class="col-1 mt-2" v-if="id_estado <= 1">
						<a href="#" @click="limpiarconvenionuevo"><i class="fa fa-trash"></i></a>
						
					</div>
					
					
				</div>

				<div class="row mt-2">
					<div class="col-1">
						<label>N° CPP</label>
					</div>
					<div class="col-sm-1">
						<input type="number" name="" class="form-control" v-model="cpp_numero" >

					</div>
					<div class="col-1 mt-1" style="max-width: 3.33333% !important;">
						<a href="#" @click="buscarcpp(1,cpp_numero)"><i class="fas fa-search"></i></a>
					</div>
					<div class="col-auto">
						<label>AÑO</label>
					</div>
					<div class="col-sm-auto">
						<select class="form-control" v-model="year2">
							<option v-for="y in year_reporte" :selected="y.year == year2 ? 'selected' : ''" :value="y.year">{{y.year}}</option>
						</select>

					</div>
					<div class="col-sm-1">
						<label>Proveedor</label>

					</div>
					<div class="col-sm-3"><input type="" name="" class="form-control" v-model="cpp_proveedor" @keyup="getproveedor" :disabled="disabled_proveedor">
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
					<div class="col-sm-1"  style="max-width: 4.33333% !important;">
						<label>Lic.</label>
						
					</div>
					<div class="col-sm-2" style="max-width: 16.66667%!important">

						<input type="" name="" class="form-control" disabled="disabled" v-model="licitacionadd">
						
					</div>
					<div class="col-sm-1">
						<button class="btn btn-warning btn-sm" @click="addlicitacion">Add Lic</button>	
					</div>
					

				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-3">
				<div class="card1 bg-c-blue order-card">
					<div class="card1-block">
						<h6 class="m-b-20"> Total Neto Producto</h6>
						<h2 class="text-right"><i class=" fas fa-dollar-sign f-left"></i><span>{{formatPrice(cpp_valor_neto)}} </span></h2>

					</div>
				</div>

			</div>
			<div class="col-3">
				<div class="card1 bg-c-green order-card">
					<div class="card1-block">
						<h6 class="m-b-20">Total Neto</h6>
						<h2 class="text-right"><i class=" fas fa-dollar-sign  f-left"></i><span>{{formatPrice(cpp_valor_f_neto)}}</span></h2>

					</div>
				</div>

			</div>
			<div class="col-3">
				<div class="card1 bg-c-yellow order-card">
					<div class="card1-block">
						<h6 class="m-b-20"> I.V.A.</h6>
						<h2 class="text-right"><i class="fas fa-dollar-sign f-left"></i><span> {{formatPrice(cpp_iva)}}</span></h2>

					</div>
				</div>

			</div>
			<div class="col-3">
				<div class="card1 bg-c-pink order-card">
					<div class="card1-block">
						<h6 class="m-b-20">Total Final</h6>
						<h2 class="text-right"><i class="fas fa-dollar-sign f-left"></i><span>{{formatPrice(cpp_total_final)}}</span></h2>

					</div>
				</div>

			</div>

		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="card border-success">
					<div class="card-header text-center text-white bg-success">
						<div class="row">
							<div class="col-6 text-right">
								<h5>Productos</h5>
							</div>
							<div class="col-3 text-right" v-show="ocultaraddproductos">
								<button class="btn btn-primary" @click="agregar">Agregar</button>
							</div>

							<div class="col-1 " v-show="ocultaraddproductos">
								<input type="number" name="" class="form-control mx-sm-3" v-model="cantidadfila">
							</div>

						</div>

					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 ">

								<table class="table table-hover  table-striped table-sm">
									<thead>
										<tr>
											<th scope="col" style="font-size: 12px">Id</th>
											<th scope="col" style="font-size: 12px">Nombre</th>
											<th scope="col" style="font-size: 12px">OC</th>
											<th scope="col" style="font-size: 12px" class="text-center">CC</th>
											<th scope="col" style="font-size: 12px" class="text-center">Sigfe</th>
											<th scope="col" style="font-size: 12px" class="text-center">Item</th>
											<th scope="col" style="font-size: 12px" class="text-center">Subitem</th>
											<th scope="col" style="font-size: 12px" class="text-center">Precio</th>
											<th scope="col" style="font-size: 12px" class="text-center">Cantidad</th>
											<th scope="col" style="font-size: 12px" class="text-center">Total Neto</th>
											<th scope="col" style="font-size: 12px" class="text-center">Precio Unitario</th>
											<th scope="col" style="font-size: 12px" class="text-center">Cantidad Unitario</th>
											<th scope="col" style="font-size: 12px" class="text-center" v-if="tipos.length != 0">Adjuntos</th>
										</tr>
									</thead>

									<paginate name="productos" :list="productos" :per="4" tag="tbody" :key="productos ? productos.length :0" >
										<tr v-for="(pro,index) in paginated('productos')" :key="index" class="table-primary">
											<input type="hidden" :name="`productos[${pro.id_index}][pro_costo_unitario_incluye_todo]`" v-model="pro.pro_costo_unitario_incluye_todo" >
											<input type="hidden" :name="`productos[${pro.id_index}][porcentaje]`" v-model="pro.porcentaje" >
											<input type="hidden" :name="`productos[${pro.id_index}][valorporcentaje]`" v-model="pro.valorporcentaje" >

											<td style="font-size: 12px">{{pro.id_index+1}}</td>
											<td width="300px" style="font-size: 12px">
												<input v-model="pro.nombre" :name="`productos[${pro.id_index}][nombre]`" type="text" class="form-control fontinput" placeholder="Nombre del producto" @keyup="buscar_producto(pro.nombre,pro.id_index)" :disabled="id_estado ==4" autocomplete="off">
												<div style="z-index: 1;position: absolute;width: 28%;background-color: #ffff;" v-if="toggle_producto[pro.id_index]">
													<div class="result_producto" v-for="book_producto in newBooks_producto2[pro.id_index]" >
														<span @click="selectResult_producto(book_producto.codigo,book_producto.nombre,pro.id_index,book_producto.cuenta_sigfe,book_producto.sub_item_sigfe,book_producto.nombre_sigfe,book_producto.unidad_medida,book_producto.sigfe_item)" class="elecciondeproducto" @mousedown.prevent>
															{{book_producto.codigo}} - {{ book_producto.nombre}}
														</span>
													</div>
												</div>


											</td>
											<td style="font-size: 12px" >{{pro.oc}}</td>
											<td style="font-size: 12px" width="160px" ><input autocomplete="off" type="" name="" class="form-control fontinput form-control-sm" v-model="pro.cc" :name="`productos[${pro.id_index}][cc]`" @keyup="buscarcentro(pro.cc,pro.id_index)" @blur="toggle_centro = false" @focus="toggle_centro = true" :disabled="id_estado ==4">
												<div style="width: 13%;background-color: #ffff;z-index: 1;position: absolute;" v-if="el_centro[pro.id_index]">
													<div v-for="c in centros">
														<span  @click="seleccionarcentro(c.id,c.nombre,pro.id_index)" class="elecciondeproducto">{{c.nombre}}</span>
													</div>

												</div>
												<input type="hidden" name="" v-model="pro.id_cc" :name="`productos[${pro.id_index}][id_cc]`" >
											</td>
											<td style="font-size: 12px" @click="cambiarsigfe(pro.id_index,pro.nombre,index)"> {{pro.nombre_sigfe}}</td>
											<td style="font-size: 12px">{{pro.cuenta_sigfe}} </td>
											<td style="font-size: 12px">{{pro.sub_item_sigfe}} <input type="hidden" v-model="pro.sigfe_item" name="`productos[${pro.id_index}][sigfe_item]`"></td>
											<td style="font-size: 12px"><input :disabled="id_estado ==4" v-model="pro.precio" :name="`productos[${pro.id_index}][precio]`" type="text" class="form-control form-control-sm fontinput" placeholder="precio" ></td>
											<td style="font-size: 12px"><input :disabled="id_estado ==4" v-model="pro.cantidad" :name="`productos[${pro.id_index}][cantidad]`" type="text" class="form-control form-control-sm fontinput" placeholder="cantidad" @change="sacarvalor(pro.precio,pro.cantidad,index)"> </td>
											<td style="font-size: 12px"> {{formatPrice(pro.t_neto)}}</td>
											<td><input :disabled="id_estado ==4" v-model="pro.precio_unitario" :name="`productos[${pro.id_index}][precio_unitario]`" type="number" class="form-control fontinput form-control-sm" ></td>
											<td><input :disabled="id_estado ==4" v-model="pro.cantidad_unitario" :name="`productos[${pro.id_index}][cantidad_unitario]`" type="number" class="form-control fontinput form-control-sm" ></td>
											
											<td v-if="pro.pro_id_oc != 0 ">
												<VDropdown >
                                                      

													<a @click="getarchivos(pro.id_producto)" ><img :src="'assets/img/pdf.png'" width="30" height="30" ></a>

													<!-- This will be the content of the popover -->
													<template #popper>
														<input type="hidden" class="tooltip-content" v-model="msg2" placeholder="Adjuntos" />
														<div class="card border-warning">
															<div class="card-header text-white text-center bg-warning">Adjuntos OT N° {{modal_n_ot}} </div>
															<div class="card-body">
																<div class="col-12 container">
																	<carousel>
																	
																		<slide v-for="(ar,index) in archivos" :key="index" >
																			<a target="_blank" :href="'../storage/app'+ar.url"><img :src="'assets/img/pdf.png'" width="30" height="30" data-toggle="tooltip" data-placement="top"  :title="ar.nombre" ></a>
																		</slide>


																	</carousel>

																</div>


															</div>

														</div>
														<!-- You can put other components too -->

													</template>
												</VDropdown>
											</td>
										</tr>
									</paginate>
									
									


								</table>
								<paginate-links for="productos" :classes="{'ul': ['pagination','justify-content-end'], 'li': 'page-item', 'a': 'page-link'}"></paginate-links>

							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row mt-2">
			<div class="col-12">
				<div class="card border-success">
					<div class="card-body">
						<div class="row">
							<div class="col-2">
								<label>Despacho Neto:</label>

							</div>
							<div class="col-2">
								<input type="number" class="form-control" name="" v-model="cpp_despacho" @change="adddespacho(cpp_despacho)" :disabled="id_estado ==4">

							</div>
							<div class="col-2 text-center">
								<label>IVA:</label>

							</div>
							<div class="col-2 text-left">
								<toggle-button @change="onChangeEventHandler($event)" :value="valor_check" :labels="{checked: 'SI', unchecked: 'NO'}" :color="{checked: '#38c172', unchecked: '#FF0000', disabled: '#CCCCCC'}"    />
							</div>
							<div class="col-2">
								<label>Descuento:</label>

							</div>
							<div class="col-2">
								<input type="number" class="form-control" name="" v-model="cpp_descuento" @change="subdescuento(cpp_descuento)" :disabled="id_estado ==4">

							</div>
							
						</div>
						<div class="row mt-1">
							<div class="col-2">
								<label>Impuesto:</label>

							</div>
							<div class="col-2">
								<input type="number" class="form-control" name=""  v-model="cpp_impuesto" @change="addimpuesto(cpp_impuesto)" :disabled="id_estado ==4">

							</div>
							<div class="col-2 text-center">
								<label>Ajustes:</label>

							</div>
							<div class="col-2">
								<input type="number" name=""  class="form-control" v-model="ajustes" @change="addajuste()" :disabled="id_estado ==4">
							</div>
							<div class="col-2 text-left">
								<label>Total</label>

							</div>
							<div class="col-2 ">
								<div class="alert alert-dark" role="alert">
									<label><b>$ {{formatPrice(totalajuste)}}</b></label>
								</div>
								

							</div>
							
						</div>

					</div>

				</div>
			</div>


		</div>
		<div class="row mt-2">
			<div :class="id_estado == 5 ?'col-5' :'col-7'">
				<div class="card border-success">
					<div class="card-header text-white text-center bg-success">
						<h5>Observacion</h5>
					</div>
					<div class="card-body">
						<textarea class="form-control" rows="4" placeholder="Ingresar Observacion" v-model="cpp_observacion"></textarea>

					</div>

				</div>

			</div>
			<div v-if="id_estado == 5" :class="id_estado == 5 ?'col-3' :''">
				<div class="card border-success">
					<div class="card-header text-white text-center bg-danger">
						<h5>Observacion Finanza</h5>
					</div>
					<div class="card-body">
						<textarea class="form-control" rows="4" v-model="observacionrechazada" readonly="readonly"></textarea>

					</div>

				</div>
				
			</div>
			<div  :class="id_estado == 5 ?'col-4' :'col-5'">
				<div class="card border-success">
					<div class="card-header text-white text-center bg-success"><h5>Adjuntos</h5> 





					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 " >
								<button class="btn btn-primary offset-4" v-show="id_estado != 0" @click="modalsubirarchivos()"><i class="fas fa-save"></i>  Agregar Archivos </button>

							</div>
							<div class="col-12" v-show="id_estado == 0">
								<form method="POST" enctype="multipart/form-data" name="myForm" ref="form">
											<div class=" btn btn-primary offset-4 mt-2" style=" text-align: center;"  @click="getFilecomienzo()">
												<i class="fas fa-save"></i> Selecciona
											</div>

											<input name="MAX_FILE_SIZE" type="hidden" id="imageA"  value="3000000" />
											<div style='height: 0px;width: 0px; overflow:hidden;'><input  type="file"  id="upfile_documentoscomienzo" ref="file_documento"  @change="sub_documentocomienzo($event)" multiple="true" accept="application/pdf" /></div>
										</form>
								
							</div>
							<div class="col-12 mt-2">
								<label>Archivos</label>
								<div class="card border border-dark">
									<div class="card-body">
									
										<carousel>
											<slide v-if="todosarchivos.length > 0 " v-for="(adt,j) in todosarchivos" :key="j" >
												
											<a class="col-12" href="#" @click="verpdf(adt.id)"><img :src="'assets/img/pdf.png'"  width="40" height="35" data-toggle="tooltip" data-placement="top"  :title="adt.nombre"></a>
												<label class="col-12" style="font-size: 10px">{{adt.nombre}}{{adt.name}}</label>
												<a  @click="eliminarelemento(j,adt.id)" class="col-12" v-if="id_estado == 0 || id_estado == 1" ><i class="fas fa-trash"></i></a>

											</slide>
										</carousel>
									</div>
								</div>
								
							</div>
							

						</div>

					</div>

				</div>

			</div>

		</div>
		<div class="row mt-2">


		</div>
		<div class="row" v-if="tipos == 2">
			<div class="col-4 border border-warning" v-show="id_f_quimico != ''">
				<label>Firmado por: <b>{{nombre_quimico }}</b></label>
			</div>
			
		</div>
		<div class="row mt-2">
			<div class="col-12">
				<button class="btn btn-primary" @click="crearcpp" v-show="estado_inicial">Crear CPP</button>
				<button class="btn btn-primary" @click="guadarcpp()" :disabled="disabled_guardar">Guardar</button>

				<button class="btn btn-success" @click="refrendar" :disabled="disabled_refrendar">Refrendar</button>
				<button class="btn btn-danger" :disabled="disabled_anular" @click="anularcpp">Anular</button>
				<button class="btn btn-warning" :disabled="disabled_pagar" @click="modalpagarcpp">Pagar</button>
				
				<button class="btn btn-primary" :disabled="disabled_enviarapago" v-show="cpp_estados == 3 & tipos != 2" @click="modalenviarp">Enviar a Pago</button>
				<button class="btn btn-info" :disabled="disabled_migrar"  @click="migrarcpp">Migrar</button>
				<button class="btn btn-primary" :disabled="disabled_recepcionbpm" @click="recepcionbpm" v-if="tipos == 2 ">Recepcion BPM</button>
				<button class="btn btn-primary" :disabled="disabled_facturabpm"  @click="facturabpm" v-if="tipos == 2">Factura BPM</button>
				<button class="btn btn-primary" :disabled="disabled_firmacpp"  @click="firmarcpp" v-if="tipos == 2">Firma CPP</button>
				<button  class="btn btn-success"v-show="liberarcppshow" @click="liberar()">Liberar CPP</button>

				<button class="btn btn-primary" v-show="serviciocon">Servicio Conforme</button>
				<button class="btn btn-primary" v-show="serviciopar">Servicio Parcial</button>
			</div>







		</div>
		

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Generar Recepcion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="card">
							<div class="card-body">
								<div class="col-2">
									Estado de la Recepción
								</div>
								
							</div>
							
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerar</button>
						<button type="button" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalenviarapago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl">
				<div class="modal-content">
					<div class="modal-header bg-primary text-center text-white">
						<h5 class="modal-title" id="exampleModalLabel">Ingrese datos de factura para enviar a pago</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-2">
								<label>N° Factura:</label>
							</div>
							<div class="col-4">
								<input type="" name="" class="form-control" v-model="modalenviarfactura">
							</div>

							<div class="col-2">
								<label>Tipos de Documentos:</label>
							</div>
							<div class="col-4">
								<select class="form-control" v-model="modalenviartipo">
									<option v-for="tipos in tiposdoc" :value="tipos.id_tipo_documento">{{tipos.nombre_documento}}</option>
								</select>
							</div>


						</div>
						<div class="row mt-2">
							<div class="col-2">
								<label>Fecha Emision:</label>
							</div>
							<div class="col-4">
								<input type="date" name="" class="form-control" v-model="modalenviaremision">
							</div>

							<div class="col-2">
								<label>Fecha Recepcion:</label>
							</div>
							<div class="col-4">
								<input type="date" name="" class="form-control" v-model="modalenviarrecepcion">
							</div>


						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarfacturapago">Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modalpagarc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Pagar CPP</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="" v-model="id_modal_pagarcpp">


						<div class="row">
							<div class="col-2">
								<label>Sigfe</label>
							</div>
							<div class="col-10">
								<input type="number" name="" class="form-control" v-model="sigfemodalpago">
								
							</div>
							
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarcpppagadocompleto()">Pagar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal_convenios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nuevo Convenio</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row mt-2">
							<div class="col-sm-1">
								<label>Nombre:</label>
							</div>
							<div class="col-sm-4">
								<input type="" class="form-control" name="" v-model="nombre_convenio">
							</div>
							<div class="col-sm-1">
								<label>Fecha de Inicio</label>
							</div>
							<div class="col-sm-2">
								<input type="date" name="" class="form-control" v-model="fecha_i">
								{{fecha_i}}

							</div>
							<div class="col-sm-1">
								<label>Fecha de Termino</label>
							</div>
							<div class="col-sm-2">
								<input type="date" name="" class="form-control" v-model="fecha_t">

							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarmodalconvenio(nombre_convenio,fecha_i,fecha_t)" >Guardar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_complementaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Datos Complementarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-1">
								<label>Año</label>

							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">

							</div>
							<div class="col-1">
								<label>N°</label>

							</div>
							<div class="col-3">
								<input type="" name="" class="form-control">

							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<BlockUI :message="msg"  v-if="bloqueo">
			<img :src="'assets/img/745.gif'">

		</BlockUI>
		<div class="modal fade" id="modalactualizarsigfe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Actualizar Sigfe Productos: {{nombre_modal_producto}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-1">
								sigfe:

							</div>
							<input type="hidden" name="" v-model="id_modal_producto">
							<div class="col-6">
								<input type="" name="" class="form-control" v-model="cuenta_sigfe" @keyup="cuentassigfe(cuenta_sigfe)">
								<div style="z-index: 1;background-color: #ffff;position: absolute;width: 100%" v-if="ocultar_sigfe">
									<div v-for="c in c_sigfes">
										<span class="elecciondeproducto" @click="seleccionarsigfe(id_modal_producto,c.id,c.nombre,c.sigfe_id,c.sub_item)">{{c.nombre}}</span>
									</div>

								</div>


							</div>
							<div class="col-2" v-if="ocultar_sigfe2">
								<div class="alert alert-success" role="alert">
									{{elegido_item}}
								</div>

							</div>
							<div class="col-2" v-if="ocultar_sigfe2">
								<div class="alert alert-primary" role="alert">
									{{elegido_subitem}}
								</div>
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarsigfe(id_modal_producto,cuenta_sigfe,elegido_item,elegido_subitem)">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modaladdlicitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Agregar Licitacion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-1">
								<label>Lic.</label>
							</div>
							<div class="col-4">
								<input type="" name="" class="form-control" v-model="numnero_licitacion">
								
							</div>
							<div class="col-1">
								<label>Fecha </label>
							</div>
							<div class="col-4">
								<input type="date" name="" class="form-control" v-model="fecha_licitacion">
								
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarlicitacion">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalsubirar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Subir Archivos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">CPP</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">RECEPCION</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">FACTURACION</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contactfondo" role="tab" aria-controls="pills-contact" aria-selected="false">FONDO FIJOS</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<div class="row">
									<div class="col-8">
										<form method="POST" enctype="multipart/form-data" name="myForm">
											<div class=" btn btn-success offset-4 mt-2" style=" text-align: center;"  @click="getFile()">
												<i class="fas fa-save"></i> Selecciona
											</div>

											<input name="MAX_FILE_SIZE" type="hidden" id="imageA"  value="3000000" />
											<div style='height: 0px;width: 0px; overflow:hidden;'><input  type="file"  id="upfile_documentos" ref="file_documento"  @change="sub_documento($event)" multiple="true" accept="application/pdf" /></div>
										</form>
									</div>

									<div class="col-4" v-if="id_estado >= 1">
										<button class="btn btn-primary" @click="subirarchivos()"><i class="fas fa-upload"></i>Subir archivos</button>
										
									</div>
									
								</div>
								
								<label>Subir</label>
								<div class="card border border-primary">
									<div class="card-body">
										<carousel>
											
											<slide v-if="adjuntos.length > 0 " v-for="(ad,j) in adjuntos" :key="j" class="col-2">
												

												<a class="col-12" href="#" @click="verpdfpre(ad)"><img :src="'assets/img/pdf.png'"  width="40" height="35" data-toggle="tooltip" data-placement="top"  :title="ad.nombre"></a>
												<label class="col-12" style="font-size: 10px">{{ad.nombre}}{{ad.name}}</label>
												<!-- 	<span  class="col-12"><a @click="limpiar(j,ad.id)"><i class="far fa-trash-alt"></i></a></span> -->

											</slide>
										</carousel>
									</div>
								</div>
								<label class="mt-2" v-show="id_estado >= 1">Subidos</label>
								<div class="card border border-warning" v-show="subirocultar">
									<div class="card-body">


										<carousel>
											<slide v-if="cpparchivos.length > 0 " v-for="(ad3,k) in cpparchivos" :key="k" >
												
												<a class="col-12" href="#" @click="verpdf(ad3.id)"><img :src="'assets/img/pdf.png'"  width="40" height="35" data-toggle="tooltip" data-placement="top"  :title="ad3.nombre"></a>
												<label class="col-12" style="font-size: 10px">{{ad3.nombre}}{{ad3.name}} {{ad3.crud}}</label>
												<span  class="col-12"><a @click="limpiararchivos(k,ad3.id,ad3.crud)"><i class="far fa-trash-alt"></i></a></span>

											</slide>
										</carousel>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
							<div class="tab-pane fade" id="pills-contactfondo" role="tabpanel" aria-labelledby="pills-contact-tab">
								
								<div v-show="tipos === 4">

									<carousel>
										<slide v-if="cpparchivos.length > 0 " v-for="(ad3,k) in cpparchivos" :key="k" >


											<a class="col-12" href="#" @click="verpdf(ad3.id)"><img :src="'assets/img/pdf.png'"  width="40" height="35" data-toggle="tooltip" data-placement="top"  :title="ad3.nombre"></a>
											<div class="card">
												<div class="card-body">
													<label class="col-12" style="font-size: 10px">{{ad3.nombre}}{{ad3.name}}</label>
													<label class="col-12" style="font-size: 10px">Monto:$ {{ad3.pro_precio}}</label>
													<label class="col-12" style="font-size: 10px">Numero Boleta :</label>
													<span  class="col-12"><a href="#" @click="limpiar(k,ad3.id)"><i class="far fa-trash-alt"></i></a>
														<a href="#" @click="editararchivospro(ad3.id,ad3.nombre,ad3.pro_precio,ad3,k)"><i class="far fa-edit"></i></a>
													</span>
													
												</div>
												
											</div>
											

										</slide>
									</carousel>
									
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
						
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modaladdprograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">AGREGAR SUBCONVENIOS </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row" v-if="usuario_crea == id_session">
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
								<button v-if="usuario_crea == id_session" class="btn btn-success" @click="addinput">Agregar Mas</button>
								
							</div>
							
						</div>
						<div class="row mt-4" v-for="(lis,index) in listsform" v-if="usuario_crea == id_session">
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


									<div slot="accion"  slot-scope="props" v-if="id_session != usuario_crea">
										<input type="checkbox" name="" v-model="checkpro" :value="props.row.id">
									</div>	

								</v-client-table>
								
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button"v-if="id_session == usuario_crea" class="btn btn-primary"  @click="guardarprograma">Guardar</button>
						<button v-if="id_session != usuario_crea" type="button" class="btn btn-success"  @click="guardarproalcpp()">Guardar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="editararchivoproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Editar Archivo {{nombrearchivo}}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-2">
								<label>Precio</label>
								<input type="hidden" name="" class="form-control" v-model="idarchivo">
							</div>
							<div>
								<input type="" name="" v-model="archivoprecio" class="form-control" readonly="readonly">
							</div>

							<div class="col-2">
								<label>Sigfe</label>
								
							</div>
							<div>
								<input type="" name="" v-model="archivoprecio" class="form-control" readonly="readonly">
							</div>

						</div>
						<div class="row mt-2">
							<div class="col-2">
								<label>Item</label>
								
							</div>
							<div>
								<input type="" name="" v-model="archivoprecio" class="form-control" readonly="readonly">
							</div>
							<div class="col-2">
								<label>Subitem</label>
								
							</div>
							<div>
								<input type="" name="" v-model="archivoprecio" class="form-control" readonly="readonly">
							</div>
							
						</div>

						<div class="row mt-2">
							<div class="col-12 text-center">
								
								<a @click="verpdf(idarchivo)" href="#" v-show="ocultarimagen[indexarchivo]"> <img :src="'assets/img/pdf.png'" width="40" height="40"  ></a>

								
								<input class="form-control form-control-lg" id="formFileLg" type="file" v-show="ocultarfile[indexarchivo]">
								<a href="#" @click="eliminararchivo(indexarchivo)" v-show="ocultarimagen[indexarchivo]"><i class="fa fa-trash"></i></a>
							</div>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-success">Guardar</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>
<style type="text/css">
	.order-card {
		color: #fff;
	}

	.bg-c-blue {
		background: linear-gradient(45deg,#4099ff,#73b4ff);
	}

	.bg-c-green {
		background: linear-gradient(45deg,#2ed8b6,#59e0c5);
	}

	.bg-c-yellow {
		background: linear-gradient(45deg,#FFB64D,#ffcb80);
	}

	.bg-c-pink {
		background: linear-gradient(45deg,#FF5370,#ff869a);
	}


	.card1 {
		border-radius: 5px;
		-webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
		box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
		border: none;
		margin-bottom: 30px;
		-webkit-transition: all 0.3s ease-in-out;
		transition: all 0.3s ease-in-out;
	}

	.card1 .card1-block {
		padding: 25px;
	}

	.order-card i {
		font-size: 26px;
	}

	.f-left {
		float: left;
	}

	.f-right {
		float: right;
	}
</style>
<script>
	export default
	{
		props: ['id_session'],

		data(){

			return {
				liberarcppshow:false,
				ocultaraddproductos:true,
				serviciocon:false,
				serviciopar:false,
				indexarchivo:'',
				ccc:0,
				ocultarimagen:[],
				ocultarfile:[],
				idarchivo:0,
				archivoprecio:0,
				nombrearchivo:'',
				dimension:"1200 px !important",
				cambiodepantalla:false,
				pantalla:0,
				opciones:{nav: 'fixed'},
				vistasearchsubconvenio:false,
				montocppprograma:0,
				subirocultar:false,
				mensajerun:'',
				oc_cpp:0,
				estadoconvenios:0,
				conveniosxcpp:[],
				id_elegidaconv:0,
				checkpro:[],
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
				usuario_crea:'',
				cpp_total_convenio3:0,
				cpp_total_convenio2:0,
				nombreprograma:[],
				montoprograma:[],
				listsform:[{nombre:'',monto:'',indice:0}],
				agregarprogramas:false,
				id_conv_cpp:0,
				vistatotalconvenio:false,
				con_new:0,
				conveniooldfechai:'',
				conveniooldfechat:'',
				conv_nombre:'',
				conv_fechai:'',
				conv_fechaf:'',
				conv_nova:false,
				observacionid:'',
				ot:'',
				ocportal:'',
				observacionrechazada:'',
				botonanular:false,
				cpp_observacionrechazo:'',
				nombre_quimico:'',
				id_quimico:'',
				run_quimico:'',
				disabled_recepcionbpm:false,
				disabled_facturabpm:false,
				disabled_firmacpp:true,
				totalajuste:0,
				ajustes:0,
				modalenviaremision:'',
				modalenviarrecepcion:'',
				modalenviartipo:'',
				modalenviarfactura:'',
				sigfemodalpago:'',
				cpp_estados:'',
				disabled_enviarapago:false,
				progress:0,
				fecha_inicio:'',
				fecha_termino:'',
				cpparchivos:[],
				todosarchivos:[],
				licitacionadd:'',
				numnero_licitacion:'',
				fecha_licitacion:'',
				firmas:[],
				adjuntos_todos:false,
				adjuntos_agregar:false,
				modal_n_ot:'',
				msg2:'',
				elegido_item:'',
				elegido_subitem:'',
				nombre_modal_producto:'',
				id_modal_producto:'',
				idobservacion:'',
				eliminar_adjuntos:false,
				control_adjuntos_bloqueo:false,
				control_adjuntos:true,
				estado_inicial:true,
				persona_nombre:'',
				cpp_numero:'',
				estadocpp:'',
				tipos:[],
				tipo:0,
				years:0,
				cpp_observacion:null,
				year2:2022,
				cpp_descuento:0,
				impuesto_final:0,
				cpp_impuesto:0,
				cpp_despacho:0,
				cpp_iva:0,
				cpp_total_final:0,
				search_centro:'',
				cpp_valor_f_neto2:0,
				cpp_valor_f_neto:0,
				cpp_valor_final:0,
				cpp_valor_neto:0,
				cpp_proveedor:'',
				cpp_id_proveedor:'',
				msg: 'Espere un Momento...',
				bloqueo:false,
				nombre_convenio:'',
				fecha_i:'',
				fecha_t:'',
				nuevo_convenio:[],
				verconvenios:false,
				cpp_id_convenios:0,
				cpp_total_convenio:'',
				cpp_gasto:'',
				cpp_bpm:'',
				cpp_pago_an:'',
				cpp_convenios:'',
				cpp_conv:'',
				convenios:[],
				cpp:[],
				filelist: [],
				valor_check:false,
				valor_check_iva:'',
				paginate: ['productos'],
				productos:[],
				newBooks_producto2:[],
				toggle_producto:[],
				cantidadfila:1,
				id_paginacion:0,
				proveedor:[],
				el_proveedor:false,
				centros:[],
				el_centro:[],
				year_reporte:[],
				tiposcc:[],
				tipoflag:'',
				adjuntos:[],
				cpp_id:'',
				cpp_factura:'',
				c_sigfes:[],
				cuenta_sigfe:'',
				ocultar_sigfe:false,
				ocultar_sigfe2:false,
				nuevos_archivos:[],
				tipos_:'',
				disabled_guardar:true,
				disabled_refrendar:true,
				disabled_anular:true,
				disabled_pagar:true,
				disabled_migrar:true,
				disabled_proveedor:false,
				disabled_refrendacion:false,
				cpp_estado:'',
				archivos:[],
				encargado_refrendacion:'',
				jefatura_refrendacion:'',
				id_estado:0,
				id_proceso:'',
				id_modal_pagarcpp:'',
				tiposdoc:[],
				run_proveedor:'',
				estadofac:'',
				usuarioconf:'',
				user:'',
				facturaid:'',
				recepcionid:'',
				verifcarf:'',
				verprogramamonto:false,
				montoprogramael:0,
				mensaje_runproveedor:false,
				subconvenio:[]
			}
		} ,
		created:function()
		{
			this.getyear();
			this.gettiposcpp();
			this.getdocumentos();


		},
		mounted()
		{
			var today = new Date();
			this.years = today.getFullYear();
			this.pantalla= screen.width;
			
			axios.get('yeartotal').then(response=>{
				this.year2=response.data.year
				
			}).catch(err=>{});




		},
		watch: {
			totalajuste(nuevoValor, valorAnterior){

				console.log("El nombre pasó de ser %s a %s", valorAnterior, nuevoValor+this.cpp_iva);
				return ;
			}
		},

		methods:
		{ 
			eliminarelemento(index,id= null){
				let archivo=this.todosarchivos[index]
				console.log('archivos',`${archivo}`)
				if(`${archivo}` == '[object File]' ){
                   this.todosarchivos.splice(index,1)
                   this.$refs.form.reset() 
				}else{
					this.elimnarelemetoadjunto(id)
					 this.todosarchivos.splice(index,1)
                     this.$refs.form.reset() 
				}
				 
			},
			liberar(){
				var t=this
				Swal.fire({
					title: 'Desea Liberar Cpp',
					input: 'textarea',
					showCancelButton: true,   
                    closeOnConfirm: false, 
				}).then(function(result) {
					if (result.value) {
						

						console.log(t.cpp_id)
						var d=new FormData()
						d.append('cpp',t.cpp_id)
						d.append('usuario',t.id_session)
						d.append('motivo',result.value)
						axios.post('cppliberar',d).then(response=>{
							axios.get('cppliberar/'+t.cpp_id).then(resp=>{
                                   t.buscarcpp(1,t.cpp_numero)
							}).catch(e=>{});

						}).catch(err=>{
						});
					}
				})
				

			},
			addComplementaria()
			{
				$("#modal_complementaria").modal();
			},
			eliminararchivo(id){
				
				this.ocultarimagen[id]=false
				this.ocultarfile[id]=true
				this.$set(this.ocultarimagen,id,false);
				this.$set(this.ocultarfile,id,true);

			},
			editararchivospro(id,nombre,precio,arr,index){
				this.nombrearchivo=nombre
				this.archivoprecio=precio
				this.idarchivo=id
				this.indexarchivo=index
				$("#editararchivoproducto").modal();
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
						d.append('convenio_id',this.cpp_id_convenios);

						axios.post('conveniosprogramas',d).then(response=>{

						}).catch(err=>{

						});

					}

					if(i == this.listsform.length-1){
						this.buscarprogramas(this.cpp_id_convenios);
						this.dulcealert("Programas guardados",'success')
						$("#modaladdprograma").modal("hide");
						this.limpiarlistaconvenio();
					}
				}

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
			agregarprograma()
			{
				$("#modaladdprograma").modal();

			},
			addobservacion(id)
			{
				var url="cpphistorial/"+id
				var d={
					observacion:this.cpp_observacion,
					_method:'patch'
				}
				axios.post(url,d).then(response=>{

				}).catch(err=>{

				});
			},
			getquimico(e)
			{
				var data = e.target.value;
				console.log(data)
				if(data == 2){
					this.buscarquimico();
				}


			},
			async guardarfacturapago()
			{
				await this.validarFactura(this.modalenviarfactura,this.run_proveedor,this.modalenviartipo);
				
				
			},

			verificarDatos(f)
			{
				if(f == 0)
				{
					this.addfactura();
				}else{
					this.facturaid=f;
					this.addrecepcion();
					if(this.estadofac == 3){
						this.updatecpp(this.cpp_id,11)//pagado
						this.updateproductos(13)
						if(this.ot != 0){
							this.updateot(14,this.ot)
						}

					}else{
					this.updatecpp(this.cpp_id,9) // Servicio Completo
					this.updateproductos(11)

				}

			}

			

		},
		updateot(estado,id)
		{

			var url="compras/"+id
			var d={
				_method:'patch',
				compra_estado:estado,
			}

			axios.post(url,d).then(response=>{

			}).catch(err=>{

			});

		},
		addrecepcion()
		{  


			axios.get('cppconformidad/'+this.cpp_id).then(response=>{


				this.usuarioconf=response.data.usuario

				if(this.usuarioconf != undefined){
					this.user=this.usuarioconf

				}else{

					this.user=this.id_session
				}

				axios.get('recepcionbo/'+this.cpp_id).then(responserec=>{

					if(responserec.data.length == 0){
						this.agregarrecepcion(this.user);
					}else{
						this.recepcionid=responserec.data.id_recepcion;
						this.productosrepccion(responserec.data.id_recepcion)
						this.addfacturarecepcion();
					}

				}).catch(err=>{

				});
				console.log('usuario',user)
				console.log(this.usuarioconf)

			}).catch(err=>{

			});	
		},
		agregarrecepcion(user)
		{
			var d=new FormData();
			d.append('usuario',user);
			d.append('year',this.year2)
			d.append('fechai',this.modalenviaremision);
			d.append('fechar',this.modalenviarrecepcion);
			d.append('numero',this.modalenviarfactura);
			d.append('tipo',this.modalenviartipo);
			d.append('estado',1);
			d.append('proveedor',this.run_proveedor);
			d.append('n_lic',this.ocportal);
			d.append('obs',this.observacion);
			d.append('cpp',this.cpp_id);
			d.append('id_factura',this.facturaid);
			d.append('bodeguero',this.id_session);

			axios.post('recepcionbo',d).then(response=>{
				this.productosrepccion(response.data.id_recepcion);
				this.recepcionid=response.data.id_recepcion;
				this.addfacturarecepcion();

			}).catch(err=>{

			});

		},
		productosrepccion(id)
		{console.log(this.productos);
		for (var i = 0; i < this.productos.length; i++) {
			var tipo='A01'

			this.verBodegas(tipo,this.productos[i].pro_id_aba,id,this.productos[i].id_producto,this.productos[i].precio_unitario,this.productos[i].cantidad_unitario);

			if(i == this.productos.length -1){
				$("#modalenviarapago").modal('hide');
				this.dulcealert('cpp enviado a pago','success');

			}
		}

	},
	verBodegas(tipo,codigo,id,idproducto,precio,cantidad)
	{
		var d=new FormData();
		d.append('tipo',tipo)
		d.append('codigo',codigo)
		axios.post('bodegas',d).then(response=>{
			var _this=this
			console.log(response.data.length);
			if(response.data.length == 0)
			{	
				var stock=0
				_this.addbodegas(tipo,codigo,stock,this.recepcionid,idproducto,precio,cantidad);	


			}else{							
				var stock=0;
				this.updatebodegas(codigo,tipo,response.data[0].id,response.data[0].id_programa_assoc,stock,id);
				_this.addproductosrecepcion(response.data[0].id,this.recepcionid,codigo,idproducto,precio,cantidad)	
			}

		}).catch(err=>{

		});

	},
	addproductosrecepcion(idbodega,idrecepcion,codigo,idproducto,precio,cantidad)
	{
		var d=new FormData();
		d.append('recepcion',idrecepcion)				
		d.append('codigo',codigo)
		d.append('tipo','A01')
		d.append('medida','UD')
		d.append('productoid',idproducto)
		d.append('quedan',0)
		d.append('idbodega',idbodega)
		d.append('valor',precio)
		d.append('cantidad',cantidad)
		axios.post('prorecep',d).then(response=>{


		}).catch(err=>{

		})


	},
	updatebodegas(codigo,tipo,id,prog,stock)
	{
		var url='bodegas/'+id
		var d={
			_method:'patch',
			cod_producto:codigo,
			id_programa_assoc:prog,
			tipo_bodega:tipo,
			stock_producto:stock

		}
		axios.post(url,d).then(response=>{

		}).catch(err=>{

		});

	},
	addbodegas(tipo,codigo,stock,id,idproducto,precio,cantidad)
	{
		console.log('addbodegas');
		var d=new FormData();
		d.append('tipo',tipo);
		d.append('codigo',codigo);
		d.append('stock',stock);
		axios.post('bodegas2',d).then(response=>{

			this.addproductosrecepcion(response.data[0].id,id,codigo,idproducto,precio,cantidad)

		}).catch(err=>{

		});

	},
	addfacturarecepcion()
	{
		var d=new FormData()
		d.append('idfactura',this.facturaid)
		d.append('recepcionid',this.recepcionid)
		d.append('usuario',this.id_session)
		d.append('mini',0)
		axios.post('docurecep',d).then(response=>{
			$("#modalenviarapago").modal('hide');
			var da=new FormData();
			da.append('cpp',this.cpp_id)
			da.append('factura',this.facturaid)
			da.append('recepcion',this.recepcionid)
			axios.post('cpppgoenvio',da).then(response=>{

			}).catch(err=>{});
		}).catch(err=>{

		});


	},
	addlogfactura(id)
	{
		var d=new FormData();
		d.append('id',id)
		d.append('usuario',this.id_session)
		d.append('estado',1)
		d.append('dias',0)
		d.append('id_docto',0)

		axios.post('logdocumentos',d).then(response=>{

		}).catch(errr=>{

		});
	},
	addfactura()
	{
		var d=new FormData();
		d.append('numero',this.modalenviarfactura)
		d.append('tipo',this.modalenviartipo)
		d.append('fechae',this.modalenviaremision)
		d.append('fechar',this.modalenviarrecepcion)
		d.append('run',this.run_proveedor)
		d.append('monto',this.cpp_total_final)
		axios.post('documentos',d).then(response=>{
			this.addlogfactura(response.data)
			this.updatecpp(this.cpp_id,9)
			this.updateproductos(11)
			this.facturaid=response.data
			this.addrecepcion();

		}).catch(err=>{

		});

	},
	validarFactura(numero,run,tipo)
	{
		this.estadofac=''
		var d=new FormData();
		d.append('numero',numero);
		d.append('tipo',tipo)
		d.append('run',run);
		axios.post('facturacion',d).then(response=>{
			console.log('facturacion',response.data);
			if(response.data != 0){
				this.verifcarf=response.data.id
				this.estadofac=response.data.docto_estado_id

			}else{
				this.verifcarf=0

				this.verificarDatos(this.verifcarf)

			}
		}).catch(err=>{

		});





	},
	updateproductos(estado)
	{
		for (var i = 0; i < this.productos.length; i++) {
			var url='productos/'+this.productos[i].id_producto

			var d={
				pro_cuenta_sigfe:this.productos[i].cuenta_sigfe,
				pro_nombre_sigfe:this.productos[i].nombre_sigfe,
				pro_sub_item_sigfe:this.productos[i].sub_item_sigfe,
				sigfe_item:this.productos[i].sigfe_item,
				pro_estado_producto:estado,
				_method:'patch'
			}

			axios.post(url,d).then(response=>{


			}).catch(err=>{

			});
		}

	},
	updatecpp(id,estado)
	{
		var url="compromiso/"+id
		var d={
			estado:estado,
			_method:'patch'


		}
		this.bloqueo=true
		axios.post(url,d).then(response=>{
			this.bloqueo=false
		}).catch(err=>{
			this.bloqueo=false
		});

	},
	guardarcpppagadocompleto()
	{
		if(this.productos.length != 0)
		{
			var url="compromiso/"+this.id_modal_pagarcpp
			var d={
				sigfe_pago:this.sigfemodalpago,
				_method:'patch',
				estado:11

			}
			this.bloqueo=true
			axios.post(url,d).then(response=>{


				this.bloqueo=false
			}).catch(err=>{
				this.bloqueo=false
			});

			this.pagarProductos(this.id_modal_pagarcpp,13)
			this.buscarcpp(1,this.id_modal_pagarcpp);
			$("#modalpagarc").modal('hide')


		}else{
			return this.dulcealert('No se puede pagar sin no tiene productos','error')
		}



	},
	addpagado(estado,cpp,year,monto,ot,cc,sigfe)
	{
		var d=new FormData();
		d.append('cpp',cpp)
		d.append('year',year)
		d.append('monto',monto)
		d.append('ot',ot)
		d.append('estado',estado)
		d.append('cc',cc)
		d.append('sigfe',sigfe)


		axios.post('pagado2',d).then(response=>{
			this.buscarcpp(1,cpp);
		}).catch(err=>{

		})

	},
	pagarProductos(id,estado)
	{
		for (var i = 0; i < this.productos.length; i++) {
			var url='productos/'+this.productos[i].id_producto
			var d={
				pro_estado_producto:estado,
				_method:'patch'
			}
			if(this.productos[i].id_proceso != null){
				var urlproceso="procesosu/"+this.productos[i].id_proceso
				var da={
					estado:3,
					_method:'patch'
				}
				axios.post(urlproceso,da).then(respo=>{

				}).catch(er=>{

				});

			}
			this.addpagado(estado,this.productos[i].pro_id_cpp,this.productos[i].pro_amio,this.productos[i].pro_costo_unitario_incluye_todo,this.productos[i].pro_id_oc,this.productos[i].pro_cc,this.productos[i].sigfe_item)
			axios.post(url,d).then(response=>{


			}).catch(err=>{

			});
		}

	},
	anularcpp()
	{
		Swal.fire({
			title: 'Motivo por la Anulacion',
			input: 'textarea',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		}).then((result) =>{
			var $_thius=this
			if (result.value) {

				if(result.value == ''){
					return this.dulcealert('debe ingreasar el montivo','error')

				}

				var url='compromiso/'+this.cpp_id
				var d={
					estado:4,
					_method:'patch'
				}
				axios.post(url,d).then(response=>{
					this.updateobservacionanular(result.value)
                 
      		            if(this.con_new== 1){
                           this.cambiarestadoconvenio(this.id_conv_cpp,5)
      		            }

					if(this.tipos == 4){
						axios.get('cpp_anticipos/'+this.cpp_id).then(resp=>{
							var url='cpp_anticipos/'+resp.data.id_anticipo
							var d={
								estados:1,
								envio:0,
								_method:'patch'
							}
							axios.post(url,d).then(respon=>{
								var url2="anticipos/"+resp.data.id_anticipo
								var da={
									estado:7,
									_method:'patch'
								}
								axios.post(url2,da).then(r=>{

									this.buscarcpp(1,this.cpp_id);
								}).catch(e=>{
								});

							}).catch(er=>{
							});



						}).catch(err=>{
						});

					}else{
						this.buscarcpp(1,this.cpp_id);
					}

				}).catch(err=>{

				});

			}
		})

	},
	cambiarestadoconvenio(id,estado){
		var url="convenioscpp/"+id
		var d={
			estado:estado,
			_method:'patch'
		}
       axios.post(url,d).then(response=>{

       }).catch(err=>{

       });
	},
	updateobservacionanular(text)
	{
		var url='cpphistorial/'+this.idobservacion
		var d={
			observacion:text,
			_method:'patch'
		}
		axios.post(url,d).then(response=>{

		}).catch(err=>{

		});

	},
	firmarcpp()
	{

		if(this.run_quimico == this.id_session){


			Swal.fire({
				title: 'Desea Firmar CPP?',          
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar'
			}).then((result) => {
				if (result.isConfirmed) {

					var d=new FormData()
					d.append('cpp',this.cpp_id)
					d.append('tipo',this.tipos);
					d.append('usuario',this.id_quimico)
					axios.post('firmascpp',d).then(response=>{
						var url='compromiso/'+this.cpp_id
						var d={
							id_f_quimico:response.data,
							_method:'patch',
							tipo:this.tipos
						}

						axios.post(url,d).then(respon=>{
							this.buscarcpp(1,this.cpp_id)

						}).catch(err=>{});

					}).catch(eroor=>{});

				}

			});
		}else{
			this.dulcealert('Debe firmar el encargado ','error')
		}

	},
	facturabpm()
	{

	},
	recepcionbpm()
	{

	},
	addajuste()
	{
		var valorguardado=this.cpp_total_final
		this.totalajuste=parseInt(this.cpp_total_final)+parseInt(this.ajustes);
		this.cpp_total_final=this.totalajuste
		if(parseInt(this.ajustes) > 1){
			this.calcularajuste(this.ajustes)
		}else if(this.ajustes == 1){
			this.calcularunoajuste(this.ajustes)
		}else if(this.ajustes < 0){
			this.productos[this.productos.length-1].pro_costo_unitario_incluye_todo=this.productos[this.productos.length-1].pro_costo_unitario_incluye_todo-Math.round(this.ajustes)
		}else if(this.ajustes == 0){
			this.cpp_total_final=this.recalcularproductos()
			this.totalajuste=this.recalcularproductos()
		}        

	},
	recalcularproductos()
	{
		var valor=0
		for (var i = 0; i < this.productos.length; i++) {
			valor= valor+this.productos[i].t_neto
		}

		return valor

	},
	calcularajuste(valor)
	{
		var numero=valor/this.productos.length;
		if (numero - Math.floor(numero) == 0) {
			this.calculoajusteentero(numero)
		} else {
			this.calculoajustedecimal(numero)
		}

	},
	calculoajustedecimal(valor)
	{
		console.log('valor',valor)
		var num=valor.toString()
		var num=num.split('.');

		console.log(num[1][0])

		var valortotal=num[1][0]

		for (var i = 0; i < this.productos.length; i++) {          	

			if(i == this.productos.length-1){
				if(valortotal >5){
					this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+(Math.round(valor)-1)
				}else{
					this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-(Math.round(valor)+1	)
				}
				console.log(Math.round(valor)-1)
			}else{


				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-Math.round(valor)
				console.log(Math.round(valor))
			}
		}


	},
	calcularunoajuste(numero)
	{                  
		this.productos[this.productos.length-1].pro_costo_unitario_incluye_todo=this.productos[this.productos.length-1].pro_costo_unitario_incluye_todo+Math.round(numero)

	},
	migrarcpp()
	{
		Swal.fire({
			title: 'Desea Migrar Cpp?',          
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.isConfirmed) {

			}

		});

	},
	getdocumentos()
	{
		axios.get('tipodocuemntos').then(response=>{
			this.tiposdoc=response.data
		}).catch(err=>{

		});

	},
	modalenviarp()
	{
		$("#modalenviarapago").modal();
	},
	modalpagarcpp()
	{
		this.id_modal_pagarcpp=this.cpp_id
		$("#modalpagarc").modal();

	},
	verpdfpre(id)
	{
		console.log(id)
		var reader = new FileReader(); 
		reader.readAsDataURL(id)
		reader.onload = function (e) {             
			console.log(e.target.result); 
			var win = window.open();
			win.document.write('<iframe src="' + e.target.result  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');



		};

	},


	subirarchivos()
	{
		this.bloqueo=true;
		if(this.id_estado != 0){
			this.subirocultar=true;

			for (let i = 0; i < this.adjuntos.length; i++) {

				var a=new FormData();
				a.append('tipo',this.tipos);
				a.append('year',this.year2);
				a.append('file',this.adjuntos[i]);
				a.append('id', this.cpp_id);
				axios.post('adjuntosdocu',a).then(response=>{

					var arreglo=JSON.parse(JSON.stringify(this.adjuntos))
					arreglo.splice(i,1);
					arreglo.splice(i,1);

					console.log(arreglo[0]);
					console.log( 'aarray',JSON.parse(JSON.stringify(this.adjuntos)))


					this.bloqueo=false;
					this.buscararchivo(this.cpp_id)
					if(i == this.adjuntos.length-1 ){
						this.adjuntos=[]
					}






				}).catch(err=>{
					this.bloqueo=false;
				});



			}

		}else{
			this.bloqueo=false
			this.subirocultar=true
			for (var i = 0; i < this.adjuntos.length; i++) {
				console.log(this.adjuntos[i])
				this.cpparchivos.push(this.adjuntos[i]);
				this.cpparchivos[i].crud=0
				console.log(this.cpparchivos)
				this.adjuntos.splice(i,1);
			}

		}

            //
			//this.todosarchivos.push(e.target.files[0]);


	},
	buscararchivo(id)
	{ 
		this.bloqueo=true;
		this.archivos=[]
		this.cpparchivo=[]
		axios.get('adjuntosdocu/'+id).then(responseadjuntos=>{
			this.bloqueo=false;
			this.todosarchivos=responseadjuntos.data;
			this.cpparchivos=responseadjuntos.data;
			for (var i = 0; i < this.cpparchivos.length; i++) {
				$("#"+"archivo"+this.cpparchivos[i].id).hide();
				$("#"+"subriarchivoseditar"+this.cpparchivos[i].id).hide();

				this.ocultarimagen[i]=true
				this.ocultarfile[i]=false
			}
		}).catch(err=>{
			this.bloqueo=false;
		});

	},
	modalsubirarchivos()
	{
		this.buscararchivo(this.cpp_id);


		$("#modalsubirar").modal();

	},
	guardarlicitacion(){
		this.licitacionadd=this.numnero_licitacion;
		$("#modaladdlicitacion").modal('hide');
	},
	addlicitacion()
	{
		$("#modaladdlicitacion").modal();
	},
	getarchivos(id)
	{
		axios.get('adjuntosots_bd/'+id).then(response=>{
			this.archivos=response.data;
		}).catch(err=>{

		});
	},
	getrefrendacion(id){
		axios.get('refrendacioncpp/'+id).then(response=>{
			this.encargado_refrendacion=response.data.fecha_encargado;
			this.jefatura_refrendacion=response.data.fecha_jefatura;

		}).catch(err=>{

		});
	},
	buscarprogramas3(id,id2){
		axios.get('cppprogramas2/'+id).then(response=>{
			this.subconvenio=response.data
			this.vistasearchsubconvenio=true
			this.buscartotalsubconvenios(id2);
			this.buscarcppprograma(response.data.programa);
		}).catch(err=>{

		});
	},
	buscartotalsubconvenios(id){
		this.montoprogramael=0
		axios.get('cppprogramas3/'+id).then(response=>{
			this.montoprogramael=response.data
			this.verprogramamonto=true



		}).catch(err=>{

		});

	},
	buscarprogramas2(id){
		axios.get('conveniosprogramas/'+id).then(response=>{
			this.subconvenio=response.data
			this.vistasearchsubconvenio=true
		}).catch(err=>{

		});
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
	buscarprogramasporcpp(id)
	{
		axios.get('conveniosxcpp/'+id).then(response=>{
			this.conveniosxcpp=response.data
		}).catch(err=>{

		});
	},
	verificarestado(estado,id){

		this.cpp_estados=estado
		if(estado > 1){
			this.getrefrendacion(id);
			this.liberarcppshow=false
		}
		if(estado === 2){
			this.disabled_guardar=true
			this.disabled_refrendar=true
			this.disabled_anular=true
			this.disabled_pagar=true
			this.disabled_proveedor=true;
			this.disabled_refrendacion=true
			this.liberarcppshow=false
			this.ocultaraddproductos=false

		}else if(estado === 1){
			this.disabled_guardar=false
			this.disabled_refrendar=false
			this.disabled_anular=false
			this.disabled_pagar=false
			this.disabled_proveedor=false;
			this.disabled_refrendacion=false
			this.disabled_recepcionbpm=false
			this.liberarcppshow=false
			this.disabled_migrar=true


			if(this.id_f_quimico != 0){
				this.disabled_firmacpp=true

			}else{
				this.disabled_firmacpp=false
			}


		}else if(estado == 3){
			this.id_estado=3;
			this.disabled_guardar=false
			this.disabled_refrendar=true
			this.disabled_anular=true
			this.disabled_pagar=false
			this.disabled_proveedor=true;
			this.disabled_refrendacion=true
			this.disabled_migrar=false
			this.disabled_enviarapago=false
			this.agregarprogramas=false;
			this.ocultaraddproductos=false
			this.liberarcppshow=true
			if(this.tipos == 5 || this.tipos ==9){
				this.serviciocon=true
				this.serviciopar=true


			}


		}else if(estado == 5)
		{
			this.ocultaraddproductos=false
			this.disabled_refrendar=false
			this.disabled_guardar=false
			this.disabled_anular=false
			this.liberarcppshow=false

		}else if(estado == 11){
			this.liberarcppshow=false

		}else if(estado == 4){
			this.id_estado=4;
			this.liberarcppshow=false
		}

	},
	limpiararchivos(index,id,crud){
		if(crud == 1){
			this.elimnarelemetoadjunto(id)
			this.cpparchivos.splice(index,1);

		}else if(crud ==0){
			console.log("limiar array solo");
			this.cpparchivos.splice(index,1);

		}


	},
	limpiar(index,id)
	{
		var inx=parseInt(index);
		console.log(this.adjuntos[inx].size)

		if(this.adjuntos[inx].size === undefined){
			this.adjuntos.splice(inx,1);
			this.elimnarelemetoadjunto(id)


		}else{
			var ar_e=this.nuevos_archivos.findIndex(response=>response.name === this.adjuntos[inx].name);
			console.log('eliminar',ar_e);
			this.adjuntos.splice(inx,1);
			this.nuevos_archivos.splice(ar_e,1);
		}

	},
	elimnarelemetoadjunto(id)
	{
		var url='adjuntosdocu/'+id
		axios.post(url,{_method:'delete'}).then(response=>{

		}).catch(err=>{

		});
	},
	sub_documentocomienzo(e){
		console.log("evento change")
     this.todosarchivos.push(e.target.files[0])
	},
	sub_documento(e){
		console.log(this.tipos);
		if(this.id_estado == 0){
           
			this.adjuntos.push(e.target.files[0]);
			

		}
		if(this.id_estado == 1   ||  this.id_estado == 2   ){
			this.adjuntos.push(e.target.files[0]);
		}else{
			return this.dulcealert("No puede Adjuntar documento, debe estar en estado creado",'error')
		}


			//this.nuevos_archivos.push(e.target.files[0]);
			//this.todosarchivos.push(e.target.files[0]);

		console.log(this.adjuntos);

	},

	getFilecomienzo:function(){
		var arch=document.getElementById("upfile_documentoscomienzo").click();

	},
	getFile:function(){
		var arch=document.getElementById("upfile_documentos").click();

	},
	guardarsigfe(id,cuenta,item,subitem)
	{
		if(this.cpp != ''){
			var item_sigfe=subitem.toString().substring(0,2);
			this.productos[this.inx_producto].sigfe_item=item_sigfe
			var url='productos/'+id;
			var d={
				pro_nombre_sigfe:cuenta,
				pro_cuenta_sigfe:item,
				pro_sub_item_sigfe:subitem,
				sigfe_item:item_sigfe,
				_method:'patch'
			}
			this.bloqueo=true;


			axios.post(url,d).then(response=>{
				$("#modalactualizarsigfe").modal('hide');

				this.bloqueo=false;
				this.getproductosporcpp();
			}).catch(err=>{
				this.bloqueo=false;
			});


		}else{
			$("#modalactualizarsigfe").modal('hide');
			this.productos[this.inx_producto].nombre_sigfe=cuenta
			this.productos[this.inx_producto].cuenta_sigfe=item
			this.productos[this.inx_producto].sub_item_sigfe=subitem
			var item_sigfe=subitem.toString().substring(0,2);
			this.productos[this.inx_producto].sigfe_item=item_sigfe
			console.log(item_sigfe);

		}


	},
	seleccionarsigfe(pro,id,nombre,item,subitem)
	{
		this.cuenta_sigfe=nombre;
		this.ocultar_sigfe=false;
		this.elegido_item=item;
		this.elegido_subitem=subitem
		this.ocultar_sigfe2=true

	},
	cuentassigfe(id)
	{
		axios.get('cuentassigfes/'+id).then(response=>{
			this.c_sigfes=response.data;
			this.ocultar_sigfe=true;

		}).catch(err=>{

		});

	},
	cambiarsigfe(id,nombre,index)
	{   
		this.inx_producto=''
		this.inx_producto=index
		this.id_modal_producto=id;
		this.nombre_modal_producto=nombre;
		this.elegido_item=''
		this.elegido_subitem=''
		this.ocultar_sigfe2=false;
		this.cuenta_sigfe=''
		$("#modalactualizarsigfe").modal();

	},
	guadarcpp(id)
	{
		console.log(this.cpp_estados)
		if(this.cpp_estados == 3){
			var url='compromiso/'+this.cpp_id;
			var d={

				id_factura:this.cpp_factura,
				ocportal:this.ocportal,
				_method:'patch'

			}

			this.bloqueo=true;
			axios.post(url,d).then(response=>{
				this.bloqueo=false
				this.buscarcpp(1,this.this.cpp_id)
			}).catch(err=>{

			});

		}else{
			console.log(this.id_conv_cpp )
			console.log(this.checkpro.length)
			console.log(this.estadoconvenios)
			var url='compromiso/'+this.cpp_id;
			if(this.tipos.length ==0){

				this.tipos_=0

			}else{
				this.tipos_=this.tipos

			}
			if(this.cpp_id_convenios != 0){
				if(this.checkpro.length != 0){
					var total=0
					for (var i = 0; i < this.productos.length; i++) {
						total=this.productos[i].precio*this.productos[i].cantidad
					}
					if(total > this.montoprogramael){
						return this.dulcealert("El monto es mayor al programa seleccionado","error")
					}

				}else{
					total=0
					for (var i = 0; i < this.productos.length; i++) {
						total=this.productos[i].precio*this.productos[i].cantidad
					}
					if(total > this.cpp_total_convenio){
						return this.dulcealert("El monto es mayor al convenio seleccionado","error")
					}

				}


			}

			

			console.log(this.tipos)
			var d={
				tipo:this.tipos_,
				id_factura:this.cpp_factura,
				id_proveedor:this.cpp_id_proveedor,
				id_convenios: this.id_conv_cpp== 0?this.cpp_id_convenios:this.id_conv_cpp,
				total_neto:this.cpp_valor_f_neto,
				total:this.cpp_total_final,
				iva:this.cpp_iva,
				despacho:this.cpp_despacho,
				impuesto:this.cpp_impuesto,
				descuento:this.cpp_descuento,
				_method:'patch'

			}

			this.bloqueo=true;
			axios.post(url,d).then(response=>{
				this.updateproductos();
				//this.updatearchivos(this.cpp_id);
				this.updateobservacion(this.cpp_id,this.idobservacion)
				console.log(this.id_conv_cpp);


				if(this.id_conv_cpp != 0){
					if(this.cpp_conv > 0){
						this.updateconv(this.cpp_conv,this.cpp_total_final);
					}else if(this.cpp_id_convenios > 0){
						this.addoconveniosantiguo(this.cpp_id,this.cpp_total_final)

					}

				}else{
					if(this.cpp_conv > 0){
						this.updateconv(this.cpp_conv,this.cpp_total_final);

					}else if(this.cpp_id_convenios > 0){
						this.updateconv2(this.cpp_id,this.cpp_total_final)

					}

				}
				
				//this.addoconvenios(this.cpp_id,this.cpp_total_final);
				this.bloqueo=false
			}).catch(err=>{

			});

		}


	},
	updateconv(id,monto){
		var url="convenioscpp/"+id;
		var d={
			nombre:this.conv_nombre,
			fecha_i:this.conv_fechai,
			fecha_t:this.conv_fechaf,
			monto:monto,
			_method:'patch',

		}
		axios.post(url,d).then(response=>{
			this.dulcealert("cpp guardado","success")

		}).catch(err=>{

		});

	},
	updateconv2(id,monto){
		var url="convenioscpp/"+id;
		var d={
			nombre:this.cpp_convenios,
			fecha_i:this.conveniooldfechai,
			fecha_t:this.conveniooldfechat,
			monto:monto,
			_method:'patch',

		}
		axios.post(url,d).then(response=>{

		}).catch(err=>{

		});

	},
	addoconveniosantiguo(id,monto){
		if(this.id_elegidaconv != 0){
			var fd=new FormData();
			fd.append('cpp',id);
			fd.append('programa',this.id_elegidaconv);
			fd.append('monto',monto);
			axios.post('cppprogramas',fd).then(respo=>{

			}).catch(err=>{}); 
		}
		var d= new FormData();
		d.append('nombre',this.cpp_convenios);
		d.append('fechai',this.conveniooldfechai);
		d.append('fechat',this.conveniooldfechat);	
		d.append('cpp',id);
		d.append('monto',monto);
		d.append('nuevo',0);
		d.append('id_convenio',this.cpp_id_convenios)
		d.append('programa', this.id_elegidaconv != 0 ? this.id_elegidaconv : 0 )
		d.append('usuario',this.id_session)
		d.append('estado',0)
		d.append('cc',this.productos[0].id_cc)
		d.append('proveedor',this.cpp_id_proveedor)

		axios.post('convenioscpp',d).then(response=>{
			var url="compromiso/"+id
			var da={
				id_convenios:response.data,
				_method:'patch'
			}
			axios.post(url,da).then(response=>{

			}).catch(err=>{

			});

		}).catch(err=>{

		});


	},
	addoconvenios(id,monto){
		var d= new FormData();
		d.append('nombre',this.conv_nombre);
		d.append('fechai',this.conv_fechai);
		d.append('fechat',this.conv_fechaf);	
		d.append('cpp',id);
		d.append('monto',monto);
		d.append('nuevo',1);
		d.append('id_convenio',0)
		d.append('programa',0)

		axios.post('convenioscpp',d).then(response=>{
			var url="compromiso/"+id
			var da={
				id_convenios:response.data,
				_method:'patch'
			}
			axios.post(url,da).then(response=>{

			}).catch(err=>{

			});

		}).catch(err=>{

		});

	},
	updateobservacion(cpp,observacion)
	{
		var url='cpphistorial/'+observacion
		var d={
			observacion:this.cpp_observacion,
			_method:'patch'

		}

		axios.post(url,d).then(response=>{

		}).catch(err=>{});

	},
	refrendarcc(id,cpp)
	{
		var d=new FormData();
		d.append('cpp',cpp);
		d.append('refrendacion',id)
		axios.post('montoscc',d).then(response=>{

		}).catch(err=>{});


	},
	evaluarcpprecepcion()
	{
		axios.get('recepcionb/'+this.cpp_id).then(response=>{
			for (var i = 0; i < response.data.length; i++) {

				this.verificarfactura(response.data[i].id_recepcion);
			}
		}).catch(err=>{});

	},
	verificarfactura(id)
	{
		axios.get('facturacion/'+id).then(response=>{

		}).catch(err=>{

		});

	},
	revisarsigfeproductos()
	{
		for (var i = 0; i < this.productos.length; i++) {
			if(this.productos[i].sigfe_item == null){
				return true

			}
		}
	},
	refrendar()
	{
		if(this.tipos == 2){
			this.evaluarcpprecepcion()

		}


		var valor=this.revisarsigfeproductos();
		if(valor === true){
			return this.dulcealert('Debe ingresar los sigfe de los productos','error')
		}
		if(this.cpp_id_convenios != 0){
			if(this.checkpro.length != 0){
				var total=0
				for (var i = 0; i < this.productos.length; i++) {
					total=this.productos[i].precio*this.productos[i].cantidad
				}
				if(total > this.montoprogramael){
					return this.dulcealert("El monto es mayor al programa seleccionado","error")
				}

			}else{
				total=0
				for (var i = 0; i < this.productos.length; i++) {
					total=this.productos[i].precio*this.productos[i].cantidad
				}
				if(total > this.cpp_total_convenio){
					return this.dulcealert("El monto es mayor al convenio seleccionado","error")
				}

			}


		}



		Swal.fire({
			title: 'Desea enviar a refrendacion?',          
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if (result.isConfirmed) {
				var fecha = new Date();
				const dia = fecha.getDate();
				const mes = fecha.getMonth(); 
				const year = fecha.getFullYear();
				const hora=fecha.getHours();
				const minuto=fecha.getMinutes();
				const segundo=fecha.getSeconds();

				const dateString = year + "-" + (mes + 1) + "-" + dia+" "+hora+":"+minuto+":"+segundo ;
				var d=new FormData();
				d.append('monto',this.cpp_total_final);
				d.append('cpp',this.cpp_id);
				d.append('estado',1);
				d.append('usuario',this.id_session);
				d.append('fecha',dateString);
				d.append('year',year);

				this.bloqueo=true;
				this.updateestadoproductos(5);
				axios.post('refrendacion',d).then(response=>{

					this.refrendarcc(response.data,this.cpp_id);
					var url='compromiso/'+this.cpp_id;

					var c={
						estado:2,
						_method:'patch',

					}

					axios.post(url,c).then(res=>{
						this.addobservacion(this.observacionid);
						
						this.buscarcpp(1,this.cpp_id)
						axios.get('convenioscpp4/'+this.cpp_id).then(res=>{
							if(res.data.length == 0){
								this.crearconvenios(this.cpp_id,this.cpp_total_final)
							}

						}).catch(err=>{
						});

						this.bloqueo=false;


						this.dulcealert('CPP enviado a refrendacion','success');

					}).catch(err=>{
						this.bloqueo=false;
					});

				}).catch(erro=>{
					this.bloqueo=false;
				});

			}

		});

	},
	crearconvenios(id,monto){
		if(this.con_new ==1){
			this.addoconvenios(id,monto);

		}
		if(this.cpp_id_convenios != ''){
			this.addoconveniosantiguo(id,monto);
		}

	},
	procesos3()
	{

		if(this.tipos== 7)
		{

			var url='procesos3/'+this.id_proceso

			axios.get(url).then(response=>{
				axios.get('detalleetapas2/'+this.id_proceso).then(responsep=>{

					axios.get('procesos4/'+this.id_proceso).then(r=>{
						var cantidad=100/responsep.data.length;
						this.progress=this.progress+cantidad;
						this.progress=this.progress+parseInt(r.data.proceso)
						if( this.progress >100){
							this.progress=100
						}
						this.calcularDias(response.data.dias);
						var d=new FormData();
						d.append('detalle',this.id_proceso)  					     
						d.append('etapa',response.data.etapa)
						d.append('fecha_i',this.fecha_inicio)
						d.append('detalle_etapa',response.data.id)
						d.append('fecha_t',this.fecha_termino) 
						d.append('comprador',response.data.per_id)  
						d.append('proceso',this.progress)
						d.append('estado',0)  

						axios.post('etapasot',d).then(response2=>{
						}).catch(err=>{

						});

					}).catch(e=>{

					});


				}).catch(err=>{

				});



			}).catch(err=>{

			});
		}

	},
	calcularDias(numero) {



		var TuFecha = new Date();
		var fecha = new Date();
		const dia = fecha.getDate();
          const mes = fecha.getMonth(); // Be careful! January is 0, not 1
          const year = fecha.getFullYear();
          const hora=fecha.getHours();
          const minuto=fecha.getMinutes();
          const segundo=fecha.getSeconds();

          const dateString = year + "-" + (mes + 1) + "-" + dia;


          var dias = parseInt(numero);
          this.fecha_inicio=dateString;

          TuFecha.setDate(TuFecha.getDate() + dias);

          var fechafinal= TuFecha.getDate() + '-' +
          (TuFecha.getMonth() + 1) + '-' + TuFecha.getFullYear();


          var fechafinal2= TuFecha.getFullYear()+ '-' +
          (TuFecha.getMonth() + 1) + '-' + TuFecha.getDate();
          console.log(fechafinal);
          this.fecha_termino=fechafinal2;



      },
      updateestadoproductos(estado){
      	for (var i = 0; i < this.productos.length; i++) {
      		if(this.productos[i].id_proceso != '')
      		{
      			this.id_proceso=this.productos[i].id_proceso

      		}

      		var url='productos/'+this.productos[i].id_producto;
      		var d={
      			pro_nombre:this.productos[i].pro_nombre,
      			pro_cantidad:this.productos[i].pro_cantidad,
      			pro_precio:this.productos[i].pro_precio,
      			pro_id_aba:this.productos[i].pro_id_aba,
      			pro_comprador:this.productos[i].pro_comprador,
      			pro_total:this.productos[i].pro_total,
      			pro_nombre_sigfe:this.productos[i].pro_nombre_sigfe,
      			pro_nombre_producto:this.productos[i].pro_nombre_producto,
      			pro_sub_item_sigfe:this.productos[i].pro_sub_item_sigfe,
      			pro_estado_producto:this.productos[i].pro_estado_producto,
      			pro_costo_unitario_incluye_todo:this.productos[i].pro_costo_unitario_incluye_todo,
      			pro_cc:this.productos[i].id_cc,
      			pro_amio:this.productos[i].pro_amio,
      			pro_convenio:this.productos[i].pro_convenio,
      			pro_cantidad_solicitud:this.productos[i].pro_cantidad_solicitud,
      			pro_precio_unitario:this.productos[i].pro_precio_unitario,
      			pro_cantidad_unitario:this.productos[i].pro_cantidad_unitario,
      			sigfe_item:this.productos[i].sigfe_item,      			
      			pro_estado_producto:estado,
      			_method:'patch'
      		}
      		axios.post(url,d).then(response=>{


      		}).catch(err=>{
      			this.dulcealert('Error de actualizar producto','error');
      			this.bloqueo=false;
      		});



      	}
      	this.procesos3();



      },
      updatearchivos(id)
      {
      	if(this.nuevos_archivos.length != 0)
      	{

      		for (var i = 0; i < this.nuevos_archivos.length; i++) {

      			var a=new FormData();
      			a.append('tipo',1);
      			a.append('year',this.year2);
      			a.append('file',this.nuevos_archivos[i]);
      			a.append('id',id);
      			axios.post('adjuntosdocu',a).then(response=>{
      				this.nuevos_archivos.splice(i,1)
      			}).catch(err=>{

      			});
      		}
      	}
      },
      updateproductos()
      {
      	for (var i = 0; i < this.productos.length; i++) {
      		console.log(this.productos)

      		var url='productos/'+this.productos[i].id_producto;

      		var d={
      			pro_nombre:this.productos[i].pro_nombre,
      			pro_cantidad:this.productos[i].pro_cantidad,
      			pro_precio:this.productos[i].pro_precio,
      			pro_id_aba:this.productos[i].pro_id_aba,
      			pro_comprador:this.productos[i].pro_comprador,
      			pro_total:this.productos[i].pro_total,
      			pro_nombre_sigfe:this.productos[i].pro_nombre_sigfe,
      			pro_nombre_producto:this.productos[i].pro_nombre_producto,
      			pro_sub_item_sigfe:this.productos[i].pro_sub_item_sigfe,
      			pro_estado_producto:this.productos[i].pro_estado_producto,
      			pro_costo_unitario_incluye_todo:this.productos[i].pro_costo_unitario_incluye_todo,
      			pro_cc:this.productos[i].id_cc,
      			pro_amio:this.productos[i].pro_amio,
      			pro_convenio:this.productos[i].pro_convenio,
      			pro_cantidad_solicitud:this.productos[i].pro_cantidad_solicitud,
      			pro_precio_unitario:this.productos[i].pro_precio_unitario,
      			pro_cantidad_unitario:this.productos[i].pro_cantidad_unitario,
      			sigfe_item:this.productos[i].sigfe_item,
      			_method:'patch'

      		}

      		axios.post(url,d).then(response=>{

      		}).catch(err=>{

      		});
      	}



      },
      verpdfcpp()
      {

      	axios.get('encriptar/'+this.cpp_id).then(response=>{
      		window.open('visorpdfcpp/'+response.data);

      	}).catch(errr=>{

      	});


      },
      verpdf(id)
      {
      	axios.get('encriptar/'+id).then(response=>{
      		window.open('visorpdf/'+response.data);

      	}).catch(errr=>{

      	});

      },
      getproductosporcpp()
      {
      	axios.get('productos_comprador_ccpp/'+ this.cpp_id).then(responseproductos=>{
      		this.productos=responseproductos.data;
      		this.bloqueo=false;

      	}).catch(errproductos=>{
      		this.bloqueo=false;
      	});

      },
      buscarcpp(e,cpp)
      {

      	if(this.year2 == '')
      	{
      		return this.dulcealert('Debe ingresar el año ','error');
      	}
      	var d=new FormData();
      	d.append('numero',this.cpp_numero);
      	d.append('year',this.year2);
      	this.cpparchivos=[]
      	this.bloqueo=true;
      	axios.post('compromiso2',d).then(response=>{
      		if(response.data == ''){
      			
      			this.bloqueo=false;
      			return this.dulcealert('Datos No Encontrados','error');
      		}
      		this.licitacionadd=response.data.nombre_licitacion;
      		this.tipos=response.data.tipo == 0 ? 8: response.data.tipo;

      		this.id_conv_cpp=response.data.id_convenios
      		if(response.data.nuevo == 1){
      			this.vistasearchsubconvenio=false;
      			this.conv_nova=true
      			this.con_new=1;
      			this.conv_nombre=response.data.nombre
      			this.conv_fechai=response.data.fecha_i
      			this.conv_fechaf=response.data.fecha_t
      			

      			if(this.cpp_es){

      			}

      		}else if(response.data.id_convenio != null) {
      			this.cpp_convenios=response.data.nombre
      			this.cpp_id_convenios=response.data.id_convenio;
      			this.buscarconvenio(response.data.id_convenio,response.data.estado_conv);
      			this.buscarprogramas3(response.data.id,response.data.id_convenio);



      		}else{
      			this.vistasearchsubconvenio=false;
      		}

      		if(response.data.tipo == 2){
      			this.buscarquimico();

      		}
      		this.id_f_quimico=response.data.id_f_quimico
      		this.oc_cpp=response.data.oc
                this.estado_inicial=false;//ocultar boton de agregar producto
                this.cpp=response.data;
                this.cpp_conv=response.data.id_convenios!= null ? response.data.id_convenios : 0;
                this.cpp_valor_neto=response.data.total_neto;
                this.cpp_valor_f_neto=response.data.total_neto;
                this.cpp_valor_f_neto2=response.data.total_neto;
                this.cpp_iva=response.data.iva;
                this.cpp_total_final=response.data.total;
                this.totalajuste=response.data.total;
                this.control_adjuntos=false;
                this.cpp_id=response.data.id;
                this.cpp_estado=response.data.cpp_estado;
                this.id_estado=response.data.cpp_estado_id;
                this.ocportal=response.data.ocportal
                if(this.id_estado ==5){
                	this.observacionrechazo(this.cpp_id);

                }
                this.verificarestado(response.data.cpp_estado_id,this.cpp_id);
                this.cpp_descuento=response.data.descuento;
                this.cpp_despacho=response.data.despacho
                this.cpp_impuesto=response.data.impuesto
                this.usuario_crea=response.data.usuario;

                axios.get('estadocpp/'+response.data.cpp_estado_id).then(responseestado=>{
                	this.estadocpp=responseestado.data.nombre;
                	axios.get('persona2/'+response.data.usuario).then(res=>{
                		this.persona_nombre=res.data.per_nombre;
                		axios.get('proveedores2/'+response.data.id_proveedor).then(respprovevedor=>{
                			this.cpp_proveedor=respprovevedor.data.nombre;
                			this.cpp_id_proveedor=respprovevedor.data.id;
                			this.run_proveedor=respprovevedor.data.run;
                			this.observacionid=response.data.id_observacion;
                			axios.get('cpphistorial/'+response.data.id_observacion).then(responsehistorial=>{
                				if(responsehistorial.data.observacion === null){
                					this.cpp_observacion=''
                				}else
                				{
                					this.cpp_observacion=responsehistorial.data.observacion;	
                				}
                				
                				this.idobservacion=responsehistorial.data.id;
                				axios.get('adjuntosdocu/'+response.data.id).then(responseadjuntos=>{

                					this.todosarchivos=responseadjuntos.data;
                					this.cpparchivos=responseadjuntos.data;
                					this.cpparchivos=JSON.parse(JSON.stringify(this.cpparchivos));
                					for (var i = 0; i < this.cpparchivos.length; i++) {
                						$("#"+"archivo"+this.cpparchivos[i].id).show();
                						$("#"+"subriarchivoseditar"+this.cpparchivos[i].id).hide();
                					}
                					this.subirocultar=true
                					
                					
                					axios.get('productos_comprador_ccpp/'+response.data.id).then(responseproductos=>{
                						this.productos=responseproductos.data;
                						this.id_paginacion=this.productos.length 
                						if(this.productos.length != 0){             					     

                							if(this.productos[0].pro_id_oc != null){
                								this.ot=this.productos[0].pro_id_oc

                							}else{
                								this.ot=0
                							}

                						}
                						this.bloqueo=false;
                						
                					}).catch(errproductos=>{
                						this.bloqueo=false;
                					});
                				}).catch(erroradjuntos=>{
                					this.bloqueo=false;
                				});


                			}).catch(error=>{
                				this.bloqueo=false;

                			});


                		}).catch(errr=>{
                			this.bloqueo=false;
                		});

                	});
                });


            }).catch(err=>{
            	this.bloqueo=false;

            });
        },
        observacionrechazo(id)
        {
        	axios.get('observacionrechazada/'+id).then(response=>{

        		this.observacionrechazada=response.data.observacion;


        	}).catch(err=>{

        	});

        },
        buscarquimico()
        {
        	axios.get('encargadoq').then(response=>{
        		this.id_quimico=response.data.id;
        		this.run_quimico=response.data.per_rut;
        		this.nombre_quimico=response.data.per_nombre;


        	}).catch(err=>{

        	});

        },
        getestado(id)
        {
        	axios.get('estadocpp/'+id).then(response=>{
        		return response.data.nombre;
        	}).catch(err=>{

        	});
        },
        postcpp(id)
        {
        	axios.get('compromiso/'+id).then(response=>{
        		this.cpp_id=id;
        		this.cpp=response.data;

        		this.cpp_numero=response.data.numero;
        		axios.get('estadocpp/'+response.data.estado).then(responseestado=>{
        			this.estadocpp=responseestado.data.nombre;
        			axios.get('persona2/'+response.data.usuario).then(res=>{
        				this.persona_nombre=res.data.per_nombre;
        				axios.get('productos_comprador_ccpp/'+id).then(response=>{
        					this.productos=response.data
        					axios.get('adjuntosdocu/'+id).then(responseadjuntos=>{
        						this.todosarchivos=[]
        						this.archivos=[]
        						this.todosarchivos=responseadjuntos.data;
        					}).catch(err=>{

        					});


        				});
        			});
        		}).catch(err=>{

        		});

        	}).catch(err=>{

        	});

        },
        gettiposcpp()
        {
        	axios.get('tiposcpp').then(response=>{
        		this.tiposcc=response.data;
        	});
        },
        cambiotipo(id)
        {
        	this.tipo=id;
        },
        crearcpp()
        {
        	console.log(this.tipos)

        	if(this.productos.length <= 0){
        		this.dulcealert('Debe ingresar un producto','error');
        	}
        	if(this.tipos.length <= 0){
        		this.tipoflag=8;

        	}else{
        		this.tipoflag=this.tipos[0];
        	}
        	if(this.cpp_id_convenios != 0){
        		if(this.checkpro.length != 0){
        			var total=0
        			for (var i = 0; i < this.productos.length; i++) {
        				total=this.productos[i].precio*this.productos[i].cantidad
        			}
        			if(total > this.montoprogramael){
        				return this.dulcealert("El monto es mayor al Subconvenio seleccionado","error")
        			}

        		}else{
        			total=0
        			for (var i = 0; i < this.productos.length; i++) {
        				total=this.productos[i].precio*this.productos[i].cantidad
        			}
        			if(total > this.cpp_total_convenio){
        				return this.dulcealert("El monto es mayor al convenio seleccionado","error")
        			}

        		}


        	}


        	Swal.fire({
        		title: 'Desea Crear cpp?',          
        		icon: 'warning',
        		showCancelButton: true,
        		confirmButtonColor: '#3085d6',
        		cancelButtonColor: '#d33',
        		confirmButtonText: 'Aceptar'
        	}).then((result) => {
        		if (result.isConfirmed) {
        			var c=new FormData();
        			c.append('year',this.year2);
        			c.append('proveedor',this.cpp_id_proveedor);
        			c.append('oc',0);
        			c.append('total_neto',this.cpp_valor_f_neto);
        			c.append('iva',this.cpp_iva);
        			c.append('total',this.cpp_total_final);
        			c.append('descuento',this.cpp_descuento);
        			c.append('despacho',this.cpp_despacho);
        			c.append('impuesto',this.cpp_impuesto);
        			c.append('usuario',this.id_session);
        			c.append('observacion',this.cpp_observacion);
        			c.append('tipo',this.tipoflag);
        			axios.post('compromiso',c).then(response=>{
        				if(this.licitacionadd.length != 0){
        					var d=new FormData();
        					d.append('nombre',this.licitacionadd)
        					d.append('fecha',this.fecha_licitacion)
        					d.append('cpp',response.data)
        					d.append('ot',0)
        					axios.post('licitacion',d).then(resli=>{
        						var urlcpp='compromiso/'+response.data;
        						var e={
        							id_licitacion:resli.data,
        							_method:'patch'
        						}
        						axios.post(urlcpp,e).then(upcpp=>{

        						}).catch(err=>{

        						});

        					}).catch(errr=>{

        					});

        				}
        				if(this.con_new == 1){//identificar si es un convenio nuevo
        					this.addoconvenios(response.data,this.cpp_total_final)
        				}else if(this.cpp_id_convenios != 0){// identificar si es convenios antiguo
        					this.addoconveniosantiguo(response.data,this.cpp_total_final)
        				}

        				this.addproductos(response.data);
        				this.addtodosarchivos(response.data,1,this.year2);
        				axios.get('compromiso/'+response.data).then(responsenumero=>{
        					this.dulcealert('CPP Creado N°'+responsenumero.data.numero,'success');
        				}).catch(err=>{

        				});
        				
        				this.postcpp(response.data);

        				this.disabled_guardar=false
        				this.disabled_refrendar=false
        				this.disabled_anular=false
        				this.disabled_pagar=false
        				this.disabled_migrar=false
        				this.estado_inicial=false

        			}).catch(err=>{

        			});
        		}

        	});

        },
        buscarconvenio(id,estado)
        {
        	this.estadoconvenios=estado
        	this.bloqueo=true
        	this.vistatotalconvenio=false
        	axios.get('convenios2/'+id).then(response=>{
        		this.convenios=response.data
        		this.cpp_total_convenio=response.data.cont_monto_actual
        		this.cpp_total_convenio2=response.data.cont_monto_actual
        		this.bloqueo=false
        		this.vistatotalconvenio=true
        	}).catch(err=>{

        	});

        },
        addtodosarchivos(id,tipo,year){
         for (var i = 0; i < this.todosarchivos.length; i++) {

        		var a=new FormData();
        		a.append('tipo',tipo);
        		a.append('year',this.year2);
        		a.append('file',this.todosarchivos[i]);
        		a.append('id',id);
        		axios.post('adjuntosdocu',a).then(response=>{

        		}).catch(err=>{

        		});
        	}
        },
        addarchivos(id,tipo,year)
        {
        	console.log(this.cpparchivos);
        	for (var i = 0; i < this.cpparchivos.length; i++) {

        		var a=new FormData();
        		a.append('tipo',tipo);
        		a.append('year',this.year2);
        		a.append('file',this.cpparchivos[i]);
        		a.append('id',id);
        		axios.post('adjuntosdocu',a).then(response=>{

        		}).catch(err=>{

        		});
        	}

        },

        addproductos(id)
        {

        	console.log('productos',this.productos);
        	for (var i = 0; i < this.productos.length; i++) {
        		var p= new FormData();
        		p.append('oc',0); 
        		p.append('nombre',this.productos[i].nombre);
        		p.append('cantidad',this.productos[i].cantidad);
        		p.append('precio',this.productos[i].precio);
        		p.append('detalle','');
        		p.append('id_pro',this.productos[i].id_pro);
        		p.append('cuenta',this.productos[i].cuenta_sigfe); 
        		p.append('total',this.productos[i].t_neto);
        		p.append('unidad',this.productos[i].unidad);        		
        		p.append('nombre_sigfe',this.productos[i].nombre_sigfe);
        		p.append('nombre_producto',this.productos[i].nombre_producto);
        		p.append('sub_item_sigfe',this.productos[i].sub_item_sigfe);
        		p.append('estado',1);
        		p.append('justificacion','');
        		p.append('cc',this.productos[i].id_cc);
        		p.append('year',this.year2);
        		p.append('convenio',0);
        		p.append('pro_id_cpp',id);
        		p.append('pro_precio_unitario',this.productos[i].precio_unitario)
        		p.append('pro_cantidad_unitario',this.productos[i].cantidad_unitario)
        		p.append('precio_todo',this.productos[i].pro_costo_unitario_incluye_todo)
        		p.append('sigfe_item',this.productos[i].sigfe_item)

        		axios.post('productos',p).then(response=>{
        		}).catch(err=>{

        		});



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
        porcentajeproductos()
        {
        	for (var i = 0; i < this.productos.length; i++) {
        		this.productos[i].porcentaje=parseFloat(this.productos[i].t_neto/this.cpp_total_final);
        		this.productos[i].valorporcentaje=Math.trunc(this.productos[i].porcentaje*this.cpp_descuento);
        		this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-this.productos[i].valorporcentaje;

        	}

        },
        calculartotal(valor)
        {

        	this.cpp_valor_f_neto=parseInt(this.cpp_valor_f_neto)+parseInt(valor);
        	

        	if(this.cpp_iva != 0)
        	{
        		this.cpp_iva=this.cpp_valor_f_neto*0.19;
        		this.cpp_total_final=this.cpp_valor_f_neto+this.cpp_iva;
        	}else{
        		this.cpp_total_final=this.cpp_valor_f_neto
        	}

        	this.calculariva(this.cpp_iva)

        },
        descuentocalculariva(valor)
        {
        	var numero=valor/this.productos.length;

        	if (numero - Math.floor(numero) == 0) {
        		this.descuentoiva(numero)
        	} else {
        		this.calculoivadecimal(numero)
        	}

        },
        calculariva(valor)
        {
        	var numero=valor/this.productos.length;

        	if (numero - Math.floor(numero) == 0) {
        		this.calculoivaentero(numero)
        	} else {
        		this.calculoivadecimal(numero)
        	}

        },
        calculoivaentero(valor)
        {
        	for (var i = 0; i < this.productos.length; i++) {  
        		this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+Math.round(valor)
        	}

        },
        descuentoiva(valor){
        	for (var i = 0; i < this.productos.length; i++) {  
        		this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto
        	}
        },
        calculoivadecimal(valor)
        {
        	console.log('valor',valor)
        	var num=valor.toString()
        	var num=num.split('.');

        	console.log(num[1][0])

        	var valortotal=num[1][0]

        	for (var i = 0; i < this.productos.length; i++) {          	

        		if(i == this.productos.length-1){
        			if(valortotal >5){
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+(Math.round(valor)-1)
        			}else{
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-(Math.round(valor)+1	)
        			}
        			console.log(Math.round(valor)-1)
        		}else{


        			this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-Math.round(valor)
        			console.log(Math.round(valor))
        		}
        	}

        },
        subdescuento(cpp_descuento)
        {
        	
        	this.cpp_valor_f_neto=parseInt(this.cpp_valor_f_neto)-parseInt(cpp_descuento);
        	if(this.cpp_iva != 0)
        	{
        		this.cpp_iva=this.cpp_valor_f_neto*0.19;
        		this.cpp_total_final=this.cpp_valor_f_neto+this.cpp_iva;
        	}else{
        		this.cpp_total_final=this.cpp_valor_f_neto
        	}

        	
        	this.impuesto_final=this.cpp_total_final; 
        	//this.porcentajeproductos();
        	this.calculardescuento(cpp_descuento)
        	
        },
        calculardescuento(valor)
        {
        	
        	var sumativo=parseInt(this.cpp_despacho)+parseInt(this.cpp_impuesto) 
        	var numero=Math.abs(sumativo-valor)

        	if(sumativo > valor){
        		this.calcularimpuestoenvio(numero)
        	}else{
        		this.calculodescuentoenvio(numero)


        	}

        	
        },
        calculodescuentoenvio(numero)
        {
        	var numero=valor/this.productos.length;
        	if (numero - Math.floor(numero) == 0) {
        		this.calculoimpuestoentero(numero)
        	} else {
        		this.calculodescuentodecimal(numero)
        	}

        },
        calculodescuentoentero(valor)
        {
        	for (var i = 0; i < this.productos.length; i++) {  
        		this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-Math.round(valor)
        	}

        },
        calculodescuentodecimal(valor)
        {
        	console.log('valor',valor)
        	var num=valor.toString()
        	var num=num.split('.');

        	console.log(num[1][0])

        	var valortotal=num[1][0]

        	for (var i = 0; i < this.productos.length; i++) {          	

        		if(i == this.productos.length-1){
        			if(valortotal >5){
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+(Math.round(valor)-1)
        			}else{
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-(Math.round(valor)+1	)
        			}
        			console.log(Math.round(valor)-1)
        		}else{


        			this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-Math.round(valor)
        			console.log(Math.round(valor))
        		}
        	}





        },
        addimpuesto(impuesto)
        {
        	this.cpp_total_final=this.impuesto_final+parseInt(impuesto);
        	this.calcularimpuesto(impuesto)


        },
        calcularimpuesto(valor)
        {
        	var sumativo=parseInt(this.cpp_despacho)+parseInt(this.cpp_impuesto) 

        	var numero=Math.abs(sumativo-parseInt(this.cpp_descuento))

        	if(sumativo > parseInt(this.cpp_descuento)){
        		this.calcularimpuestoenvio(numero)
        		this.calculartotal(valor)
        	}else{

        		this.calculodescuentoenvio(numero)


        	}





        },
        calcularimpuestoenvio(valor)
        {

        	var numero=valor/this.productos.length;
        	if (numero - Math.floor(numero) == 0) 
        	{
        		this.calculoimpuestoentero(numero)
        	} else {
        		this.calculodespachodecimal(numero)
        	}

        },
        calculoimpuestoentero(valor)
        {
        	for (var i = 0; i < this.productos.length; i++) {  
        		this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+Math.round(valor)
        	}
        },
        calculoimpuestodecimal(valor)
        {

        	console.log('valor',valor)
        	var num=valor.toString()
        	var num=num.split('.');

        	console.log(num[1][0])

        	var valortotal=num[1][0]
        	for (var i = 0; i < this.productos.length; i++) {          	

        		if(i == this.productos.length-1){
        			if(valortotal >5){
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+(Math.round(valor)-1)
        			}else{
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-(Math.round(valor)+1	)
        			}
        			
        			console.log(Math.round(valor)-1)
        		}else{
        			this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+Math.round(valor)
        			console.log(Math.round(valor))
        		}
        	}


        },
        adddespacho(cpp)
        {


        	this.calculardespacho(cpp) 
        	this.calculartotal(cpp)


        },
        calculardespacho(valor)
        {
        	var sumativo=parseInt(this.cpp_despacho)+parseInt(this.cpp_impuesto) 

        	var numero=Math.abs(sumativo-parseInt(this.cpp_descuento))

        	if(sumativo > parseInt(this.cpp_descuento))
        	{
        		this.calculardespachoenvio(numero)
        	}else{
        		this.calculodescuentoenvio(numero)
        	}
        	

        },
        calculardespachoenvio(valor)
        {
        	var numero=valor/this.productos.length;
        	if (numero - Math.floor(numero) == 0) {
        		this.calculodespachoentero(numero)
        	} else {
        		this.calculodespachodecimal(numero)
        	}
        },
        calculodespachoentero(valor){
        	for (var i = 0; i < this.productos.length; i++) {  
        		this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+Math.round(valor)
        	}

        },
        calculodespachodecimal(valor){


        	console.log('valor',valor)
        	var num=valor.toString()
        	var num=num.split('.');

        	console.log(num[1][0])

        	var valortotal=num[1][0]
        	for (var i = 0; i < this.productos.length; i++) {    
        		console.log(this.productos)      	

        		if(i == this.productos.length-1){
        			console.log('valortotal',valortotal)
        			if(parseInt(valortotal) >5){
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+(Math.round(valor)-1)
        			}else{
        				this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto-(Math.round(valor)+1	)
        			}
        			console.log(Math.round(valor)-1)
        		}else{
        			this.productos[i].pro_costo_unitario_incluye_todo=this.productos[i].t_neto+Math.round(valor)
        			console.log(Math.round(valor))
        		}
        	}

        },
        seleccionarcentro(id,nombre,index)
        {
        	this.productos[index].cc=nombre;
        	this.productos[index].id_cc=id;
        	this.el_centro[index]=false;
        },
        buscarcentro(id,index)
        {
        	axios.get('centros/'+id).then(response=>{
        		this.centros =response.data;
        		this.el_centro[index]=true;

        	}); 
        },
        sacarvalor(precio,cantidad,index)
        {

        	if(this.productos[index])
        	{
        		this.productos[index]['t_neto']=precio*cantidad;
        		this.productos[index]['pro_costo_unitario_incluye_todo']=precio*cantidad;

        	}
        	


        	this.cpp_valor_neto=0;
        	this.cpp_valor_f_neto=0;
        	this.cpp_total_final=0
        	this.cpp_valor_f_neto2=0
        	this.impuesto_final=0

        	for (var i = 0; i < this.productos.length; i++) 
        	{
        		this.cpp_valor_neto=this.cpp_valor_neto+this.productos[i].t_neto;
        		this.cpp_valor_f_neto=this.cpp_valor_f_neto+this.productos[i].t_neto;
        		this.cpp_total_final=this.cpp_total_final+this.productos[i].t_neto; 
        		this.cpp_valor_f_neto2=this.cpp_valor_f_neto2+this.productos[i].t_neto; 
        		this.impuesto_final=this.cpp_total_final;           
        	}
        	this.totalajuste=this.cpp_total_final

        	if(this.valor_check_iva == 1)
        	{
        		this.cpp_iva=this.cpp_valor_f_neto*0.19;
        		this.cpp_total_final=this.cpp_total_final+this.cpp_iva;
        		this.impuesto_final=this.cpp_total_final;  
        	}

        },
        seleccionproveedor(id,nombre)
        {
        	this.cpp_proveedor=nombre;
        	this.cpp_id_proveedor=id;
        	this.el_proveedor=false;
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

        	


        	// if(this.cpp_proveedor.length >5 ){
        	// 	var vali_run=this.cpp_proveedor.split("-");
        	


        	// 	axios.get('proveedores/'+this.cpp_proveedor).then(response=>{
        	// 		this.proveedor=response.data;
        	// 		this.el_proveedor=true;


        	// 	}).catch(err=>{

        	// 	});

        	// }


        },
        invertirfecha(fecha)
        {
        	let fecha_nac =fecha
        	const [dia, mes, ano] = fecha_nac.split("/");
        	let cambiada = `${dia}/${mes}/${ano}`;
        	return cambiada;

        },
        formateofechasbd2(fecha)
        {
        	const d = new Date(fecha);
        	var day = d.getDate()
        	var month = d.getMonth() + 1
        	let year = d.getFullYear()
        	var hora=d.getHours();
        	var  minuto=d.getMinutes();
        	var segundo=d.getSeconds();
        	minuto=minuto > 9 ? minuto : '0' + minuto;
        	segundo=segundo> 9 ? segundo : '0' + segundo;
        	hora=hora > 9 ? hora : '0' + hora;
        	month=month > 9 ? month : '0' + month;
        	day=day > 9 ? day : '0' + day;
        	return `${day}-${month}-${year}`
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

        		axios.get('conveniosprogramas/'+this.cpp_id_convenios).then(response=>{
        			if(response.data.length != 0){
        				this.agregarprogramas=true
        				this.verprogramamonto=true

        				for (var i = 0; i < response.data.length; i++) {
        					this.montoprogramael=this.montoprogramael+response.data[i].monto
        					this.buscarcppprograma(response.data[i].id)

        				}




        			}

        		}).catch(err=>{

        		});

        	}

        },
        buscarcppprograma(id){

        	axios.get('cppprogramas/'+id).then(respon=>{
        		for (var i = 0; i < respon.data.length; i++) {
        			this.montocppprograma=this.montocppprograma+respon.data[i].monto
        		}

        	}).catch(err=>{

        	});

        },
        buscarConvenios()
        {
        	axios.get('convenios/'+this.cpp_convenios).then(response=>{
        		this.convenios=response.data;


        		this.verconvenios=true;
        	}).catch(err=>{

        	});
        },
        agregar(){
        	console.log("largo",this.productos.length)

        	if(this.cantidadfila <=1){


        		this.productos.push({
        			id_index:this.id_paginacion,
        			id_producto:this.id_paginacion,
        			nombre:'',
        			oc:'',
        			cc:'',
        			id_cc:'',
        			sigfe:'',
        			item:'',
        			subitem:'',
        			precio:'',
        			cantidad:'',
        			t_neto:'',
        			sigfe_item:'',
        			pro_id_oc:0



        		})

        		this.id_paginacion=this.cantidadfila+this.id_paginacion;



        	}else{

        		var total=parseInt(this.cantidadfila)+parseInt(this.id_paginacion);

        		for (var i=this.id_paginacion; i < total; i++) {
        			this.productos.push({
        				id_index:this.id_paginacion,
        				id_producto:this.id_paginacion,
        				nombre:'',
        				oc:'',
        				cc:'',
        				sigfe:'',
        				item:'',
        				subitem:'',
        				precio:'',
        				cantidad:'',
        				t_neto:'',
        				sigfe_item:''

        			})

        		}



        	}

        },
        selectResult_producto(id,nombre,index,cuenta_sigfe,sub_item_sigfe,nombre_sigfe,unidad,sigfe_item)
        {

        	this.toggle_producto[index]=false;
        	this.productos[index].nombre=id+'-'+nombre;				
        	this.productos[index].id_pro=id;
        	this.productos[index].cuenta_sigfe=cuenta_sigfe;
        	this.productos[index].sub_item_sigfe=sub_item_sigfe;
        	this.productos[index].nombre_sigfe=nombre_sigfe;
        	this.productos[index].nombre_producto=nombre;
        	this.productos[index].unidad=unidad;
        	this.productos[index].sigfe_item=sigfe_item
        	console.log(index-1);
        	var inx=index-1;




        },
        buscar_producto(value,index)
        {
        	var inx=index-1;
        	console.log(index);
        	if(value.length > 3)
        	{
        		axios.get('productos_base/'+value).then(response=>{

        			this.$set(this.newBooks_producto2,index,response.data);
        			this.$set(this.toggle_producto,index,true);

        		});
        	}
        },
        dulcealert(text,icono)
        {
        	Swal.fire({
        		icon: icono,

        		text: text,

        	})


        },
        onChangeEventHandler(event)
        {
        	if(event.value == true)
        	{
        		this.dulcealert('Se ha marcado el iva','success')
        		this.valor_check_iva=1;
        		if(this.cpp_valor_f_neto >0)
        		{
        			this.cpp_iva=this.cpp_valor_f_neto*0.19;
        			this.calculariva(this.cpp_iva)
        			this.cpp_total_final=this.cpp_total_final+this.cpp_iva;
        			this.totalajuste=this.totalajuste+this.cpp_iva

        		}
        	}else{
        		this.descuentocalculariva(this.cpp_iva)
        		this.valor_check_iva=0;					
        		this.cpp_total_final=this.cpp_total_final-this.cpp_iva;
        		this.totalajuste=this.totalajuste-this.cpp_iva
        		this.cpp_iva=0;
        		t

        	}

        },
        onChange(event) {
        	console.log(event.target);
        	this.filelist.push(event.target.files[0]);
        },
        remove(i) {
        	this.filelist.splice(i, 1);
        },
        dragover(event) {
        	event.preventDefault();
      // Add some visual fluff to show the user can drop its files
        	if (!event.currentTarget.classList.contains('bg-green-300')) {
        		event.currentTarget.classList.remove('bg-gray-100');
        		event.currentTarget.classList.add('bg-green-300');
        	}
        },
        dragleave(event) {
      // Clean up
        	event.currentTarget.classList.add('bg-gray-100');
        	event.currentTarget.classList.remove('bg-green-300');
        },
        drop(event) {
        	event.preventDefault();
        	this.$refs.file.files = event.dataTransfer.files;
      this.onChange(); // Trigger the onChange event manually
      // Clean up
      event.currentTarget.classList.add('bg-gray-100');
      event.currentTarget.classList.remove('bg-green-300');
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
  }

}	

}	      


</script>