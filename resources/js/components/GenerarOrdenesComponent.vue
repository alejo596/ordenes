<template>
	<div class="">
		
		<div class="container-fluid">
			<div class="card  border-success" v-show="validacierre">
				
				<div class="card-header bg-success text-center text-white"><h5><b>Solicitud de Trabajo / Solicitud de Compra</b></h5></div>
				<div class="card-body">
					<div class="row">
						<div class="col-3 text-right offset-7">
							<label class="fontsmall" >Sigfe :</label>
						</div>

						<div class="col-2">
							<select class="form-control" v-model="sigfe" @change="elegirsigfe()">
								<option v-for="ci in ciclosigfe" :value="ci.FAMILIA_SIG">{{ci.FAMILIA_SIG}}</option>
								
							</select>
							
						</div>
						
					</div>

					<div class="row mt-2">
						<div class="col-12">
							<div class="row">
								<div class="col-sm-1">
									<label class="fontsmall"><b>Usuario:</b></label>
								</div>
								<div class="col-md-2">
									<div class="input-group input-group-sm mb-3" :class="{focused_ot}">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fa  fa-user"></i></span>
										</div>
										<input type="" name="" class="form-control" v-model="n_usuario" readonly="readonly" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
									</div>

								</div>
								<div class="col-md-1">
									<label class="fontsmall"><b>Autorizaciones Anexas:</b></label>

								</div>
								<div class="col-md-2">
									<div class="input-group input-group-sm mb-3" :class="{focused_ot}">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-signature"></i></span>
										</div>
										<input type="text" placeholder="Buscar firma"  class="form-control" v-model="search_firma" @blur="toggle_firma = false" @focus="toggle_firma = true">
									</div>
									<div class="results" v-if="toggle_firma"  style="
									z-index: 2;
									position: absolute;
									background-color: #ffff;
									width: 80%;
									">
									<div class="result" v-for="(book,index) in newBooks_firma" >
										<span @click="selectResult_firma(book.per_nombre,book.per_rut,index)" @mousedown.prevent class="elecciondepersona_">
											{{ book.per_nombre}}
										</span>
									</div>
								</div>

							</div>
							<div class="col-md-1">
								<label class="fontsmall"><b>Centro de Costo:</b></label>

							</div>
							<div class="col-md-2">
								<div class="input-group input-group-sm mb-3" :class="{focused_ot}">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill"></i></span>
									</div>
									<input type="text" placeholder="Buscar Centro Costo"  class="form-control" v-model="search_centro"  @keyup="buscarcentrodecosto(search_centro)"> 
									
								</div>
								<div  v-if="toggle_centro"  style="
								z-index: 1;
								position: absolute;
								background-color: #ffff;
								width: 80%;
								">
								<div  v-for="(book,index) in newBooks_centro" >
									<span @click="selectResult_centro(book.id,book.nombre,book.cr_id,book.cr_nombre,index)" @mousedown.prevent  class="elecciondeproducto">
										{{ book.nombre }}
									</span>
								</div>
							</div> 
							<input type="hidden" name="" v-model="id_personas_centro">
							<input type="hidden" name="" v-model="cr_centros">
						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b><i class="fa fa-plus"></i>  PPTO</b></label>

						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="presupuesto_cc" readonly="readonly">
							</div>
						</div>

					</div>

					<div class="row mt-2">
						<div class="col-md-1">
							<label class="fontsmall"><b>Proyecto:</b></label>

						</div>
						<div class="col-md-2">
							<div class="input-group input-group-sm mb-3" :class="{focused_ot}">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa  fa-folder"></i></span>
								</div>
								<input type="" name=""  v-model="cc_proyecto" class="form-control">
							</div>

						</div>
						<div class="col-md-3">
							<div style="z-index: 1;position: absolute;">

								<div v-for="(firmas,index) in elegirFirma" ref="firmas">{{firmas.nombre}}  <a @click="eliminarfirma(index)"><img :src="'assets/img/delete.png'" width="18" height="18"></a>
									<input type="checkbox" name="" data-toggle="tooltip" data-placement="right" title="Marque si es prioridad" v-model="checkprioridad[index]" :value="index" :checked="tfirmas"@change="cambioprioridad(index,checkprioridad[index],firmas)">
									<img :src="'assets/img/priority.png'" width="40" height="30" v-if="checkprioridad[index]==true">

								</div>

							</div>

						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b>Subdireccion</b></label>

						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="cr" readonly="readonly">
							</div>

						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b> <i class="fa fa-equals"></i>  Gasto Ejecutado</b></label>
						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="g_ejecutado" readonly="readonly">
							</div>
						</div>

					</div>
					<div class="row mt-2">
						<div class="col-md-1">
							<label class="fontsmall"><b>E-Mail:</b></label>

						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3" :class="['input-group', isEmailValid()]">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
								</div>

								<input type="email" name=""  v-model="cc_mail" class="form-control"  >
							</div>


						</div>
						<div class="col-md-3">


						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b><i class="fa fa-plus"></i> Costo OT</b></label>

						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="costo_ot" readonly="readonly">
							</div>
						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b><i class="fa fa-minus"></i> Gasto Refrendado</b></label>
						</div>
						<div class="col-2">
							<div class="input-group  input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="g_refrendado" readonly="readonly">
							</div>
						</div>

					</div>
					<div class="row mt-2">
						<div class="col-md-1">
							<label class="fontsmall"><b>Telefono:</b></label>

						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3" :class="{focused_ot}">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
								</div>
								<input type="number" name=""  v-model="cc_fono" class="form-control">
							</div>

						</div>
						<div class="col-md-3">
							<label>* Obligatorio</label>

						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b> <i class="fa fa-minus"></i> Saldo Actual:</b></label>

						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="saldo_actual" readonly="readonly">
							</div>	
						</div>
						<div class="col-md-1">
							<label class="fontsmall"><b><i class="fa fa-minus"></i> Sin Refrendar:</b></label>
						</div>
						<div class="col-2">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>
								<input type="" name="" class="form-control" v-model="refrendar" readonly="readonly">
							</div>
						</div>

					</div>
					<div class="row mt-3">
						<div class="col-md-2">

							<button class="btn btn-primary"  @click="agregarproducto"><i class="fas fa-arrow-circle-down"></i></button>
						</div>

						<div class="col-md-4 mt-3">
							<label class="fontsmall"><b>Convenios:</b></label>
							<toggle-button @change="onChangeEventHandler($event)" :value="valor_check" :labels="{checked: 'SI', unchecked: 'NO'}" :color="{checked: '#38c172', unchecked: '#FF0000', disabled: '#CCCCCC'}"    />

						</div>




						<div class="col-md-1 mt-3">
							<label class="fontsmall"><b><i class="fa fa-equals"></i> Saldo O.T.:</b></label>

						</div>
						<div class="col-2 mt-3">
							<div   >	
								<div class="input-group mb-3" :class="{focused_ot}">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
									</div>

									<input type="" name="" class="form-control"  ref="saldodeot" v-model="saldo_ot" readonly="readonly" @focus="focused = true"
									@blur="focused = false">
								</div>
							</div>   								
						</div>
						<div class="col-md-1 mt-3">
							<label class="fontsmall"><b><i class="fa fa-equals"></i>  Saldo:</b></label>
						</div>
						<div class="col-2 mt-3">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar-sign"></i></span>
								</div>

								<input type="" name="" class="form-control" v-model="saldo" readonly="readonly">
							</div>
						</div>

					</div>
					<div class="row mt-2">
						<div class="col-12">
							<div class="alert alert-danger text-center" role="alert" style="z-index: 1" v-if="aletrasinpresupuesto">
								No Existe Presupuesto <p v-show="ocultarmensajeonvenio"> {{mensajedeconvenior}}
								</p>
							</div>
							
						</div>
						
					</div>



				</div>

			</div>

		</div>

	</div>
</div>
<div class="container-fluid mt-4" v-show="validacierre">

	<div class="card border-primary">
		<div class="card-header bg-primary text-white text-center"><h5><b>Lista Productos</b></h5></div>
		<div class="card-body">	
			<div class="row">
				<div class="col-md-3">
					<div class="card  mb-3 border border-success" style="max-width: 18rem;">
						<div class="card-header text-white bg-success ">Presupuesto</div>
						<div class="card-body">
							<h5 class="card-title">$ {{formatPrice(presupuesto_cc_table)}}</h5>

						</div>
					</div>

				</div>
				<div class="col-md-3">
					<div class="card  mb-3 border border-warning" style="max-width: 18rem;">
						<div class="card-header text-white  bg-warning">Costo de OT</div>
						<div class="card-body">								
							<h5 class="card-text">$ {{formatPrice(costoot)}}</h5>


						</div>
					</div>

				</div>
				<div class="col-md-3">
					<div class="card  mb-3 border border-info" style="max-width: 18rem;">
						<div class="card-header text-white bg-info">Saldo</div>
						<div class="card-body">
							<div :class="alertmenor==true ? 'alert alert-danger':'alert alert-success'" role="alert" >
								<h5 class="card-text">$ {{formatPrice(saldo_table)}}</h5>
							</div>

						</div>
					</div>

				</div>
				<div class="col-md-3">
					<div class="card  mb-3 border border-primary" style="max-width: 18rem;">
						<div class="card-header text-white bg-primary">Monto Sin Refendar</div>
						<div class="card-body">
							<h5 class="card-text">$ {{refrendar}}</h5>

						</div>
					</div>

				</div>

			</div>			
			<div class="row align-items-center">
				<div class="col-md-auto">
					<a class="btn btn-sm btn-info float-left" @click="agregar()">Agregar Productos <i class="fas fa-plus"></i></a>

				</div>
				<div class="col-md-1 ">
					<input type="number" name="" class="form-control mx-sm-3" v-model="cantidadfila">
				</div>
				<div class="form-group offset-7 col-md-3 mt-3">
					<input type="search" name="" class="form-control" placeholder="Buscar" v-model="buscarentable" @keyup="Buscarentables(buscarentable)">
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-12 table-responsive">



					<table class="table table-hover" style="margin: auto;">
						<thead>
							<tr style="font-size: 12px">
								<th scope="col">id</th>
								<th scope="col">Nombre</th>
								<th scope="col">Precio</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Subtotal</th>
								<th scope="col">Descripción</th>
								<th scope="col">Observación</th>
								<th scope="col">Adjuntos</th>
								<th scope="col">Eliminar</th>
							</tr>
						</thead>

						<tr v-if="productos.length == 0">
							<td scope="col"></td>
							<td scope="col"></td>
							<td scope="col"></td>
							<td scope="col"></td>
							<td width="300px" class="text-center"><b class="text-center">No existen Productos</b></td>
							<td scope="col"></td>
							<td scope="col"></td>
							<td scope="col"></td>
							<td scope="col"></td>
						</tr>

						<paginate name="productos" :list="productos" :per="4" tag="tbody" :key="productos ? productos.length :0">
							<tr  v-for="(pro,index) in paginated('productos')" :key="index" class="table-primary">
								<td  >{{pro.id_producto+1}}



								</td>
								<td width="440px">
									
									<input v-model="pro.nombre" :name="`productos[${pro.id_producto}][nombre]`" type="text" class="form-control fontinput" placeholder="Nombre del producto" @keyup="buscar_producto(pro.nombre,pro.id_producto)" autocomplete="off">
									<div style="z-index: 1;position: absolute;width: 28%;background-color: #ffff;" v-if="toggle_producto[pro.id_producto]">
										<div class="result_producto" v-for="book_producto in newBooks_producto2[pro.id_producto]" >
											<span @click="selectResult_producto(book_producto.codigo,book_producto.nombre,pro.id_producto,book_producto.cuenta_sigfe,book_producto.sub_item_sigfe,book_producto.nombre_sigfe,book_producto.unidad_medida,book_producto.zgen,book_producto.sigfe_item)" class="elecciondeproducto" @mousedown.prevent style="font-size: 12px">
												{{book_producto.codigo}} - {{ book_producto.nombre}}
											</span>
										</div>
									</div>

								</td>
								<td width="250px">
									<input v-model="pro.precio" :name="`productos[${pro.id_producto}][precio]`" type="number" class="form-control fontinput" placeholder="Ingrese precio" @change="sacarvalor2(pro.precio,pro.cantidad,pro.id_producto)" autocomplete="off">

								</td>
								<td width="250px">
									<input v-model="pro.cantidad" :name="`productos[${pro.id_producto}][cantidad]`" type="number" class="form-control fontinput"   placeholder="Ingrese cantidad" @change="sacarvalor(pro.precio,pro.cantidad,pro.id_producto)" autocomplete="off">

								</td>
								<td width="150px"> 
									<input v-model="pro.total" :name="`productos[${pro.id_producto}][total]`" type="number" class="form-control fontinput" disabled="disabled">

								</td>
								<td width="250px">
									Editar
									<input type="checkbox" v-model="checkboxing[pro.id_producto]" @change="check($event,pro.id_producto,pro.descripcion)" >
									<textarea class="form-control"  v-model="pro.descripcion" :name="`productos[${pro.id_producto}][descripcion]`" :maxlength="max">
									</textarea>
								</td>
								<td width="250px">
									Editar
									<input type="checkbox" v-model="checkboxing2[pro.id_producto]" @change="check2($event,pro.id_producto,pro.observacion)" >
									<textarea class="form-control"  v-model="pro.obrsevacion" :name="`productos[${pro.id_producto}][observacion]`" :maxlength="max" >
									</textarea>


								</td>
								<td width="250px"  style="margin: 0 auto;">

									<form method="POST" enctype="multipart/form-data" name="myForm">
										<div class="text-center   btn btn-success btn-sm offset-2" style=" text-align: center;"  @click="getFile_2(pro.id_producto)">
											SUBIR
										</div>

										<input name="MAX_FILE_SIZE" type="hidden" id="imageA"  value="3000000" />
										<div style='height: 0px;width: 0px; overflow:hidden;'><input :name="`productos[${pro.id_producto}][adjunto]`" type="file"  :id="'upfile_documentos'+pro.id_producto" ref="file_documento"  @change="sub_documento($event,pro.id_producto)" multiple="true" accept="application/pdf" /></div>
									</form>

									<div class="container mt-2">
										<carousel>
											<slide v-if="pro.adjunto.length > 0 " v-for="(ad,j) in pro.adjunto" :key="j">

												<img :src="'assets/img/pdf.png'"  width="40" height="35" data-toggle="tooltip" data-placement="top"  :title="ad.name">
												<span ><a @click="limpiar(pro.id_producto,j)"><i class="far fa-trash-alt"></i></a></span>

											</slide>
										</carousel>
									</div>




								</td>

								<td>

									<input v-model="pro.eliminar" :name="`productos[${pro.id_producto}][total]`" type="button" class="btn  btn-sm btn-danger" @click="eliminarfila(pro.id_producto)">
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
							<th scope="col">Total:$ {{formatPrice(totalot)}}</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tfoot>	

					</table>
					<paginate-links for="productos" :classes="{'ul': ['pagination','justify-content-end'], 'li': 'page-item', 'a': 'page-link'}"></paginate-links>
					<button class="btn btn-primary" @click="guardar" v-if="botonguardar">
						<i class="fas fa-save"></i> Guardar
					</button>
				</div>

			</div>
		</div>

	</div>

</div>	


<div class="card" v-show="validacierre_t">
	<div class="card-header text-center"><h5>Ordenes de Compra Restringidas</h5></div>
	<div class="card-body">
		<div class="row">
			<div class="col-12">
				<h3>Se informa cierre del proceso de compra año {{year_cierre}}.</h3></br>
				<h3>Nota:</h3>
				<h3>Para excepciones solicitar autorización a su subdirección pertinente.</h3>

			</div>

		</div>

	</div>
</div>
<BlockUI :message="msg"  v-if="bloqueo">
	<img :src="'assets/img/745.gif'">

</BlockUI>
<div id="tablasproductos" ref="t_productos"> 

</div>
<div class="modal face"  id="modaleditor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editor {{titulo}}</h5>
				<button type="button" class="close"  aria-label="Close" @click="cerrarmodaleditar()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<markdown-editor toolbar="bold italic heading | image link | numlist bullist code quote | preview fullscreen"  v-model="value" @change="evaluarcaracteres(value)"></markdown-editor>
				<div class="input-group-addon" v-text="(max - value.length)">Caracteres</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" @click="Copiar">Copiar {{titulo2}}</button>
				<button type="button" class="btn btn-primary" @click="guardartexto">Guardar</button>
				<button type="button" class="btn btn-secondary" @click="cerrarmodaleditar()">Cerrar</button>

			</div>
		</div>
	</div>
</div>

</div>	
</template>
<style >
	.form-control {
		background-color: #f8f9fa !important;
	}
	.table-responsive, .table {
		overflow-y: visible !important;
	}
	.vuetable th#_nombre
	{
		width: 200px !important;
	}
	.elecciondeproducto:hover{
		cursor: pointer;
		color:#f96332;

	}
	.VueTables__heading {

		font-size: 12px !important;
		font-weight: bold !important;
	}
	.elecciondepersona_:hover{
		cursor: pointer;
		color:#f96332;

	}
	
	.focused_ot {
		border: 1px solid red;
		padding: 10px;
		border-radius: 25px;
	}
	.fontsmall{
		font-size: smaller;
	}
	.fontinput{
		font-family: Arial;
		font-size: 8pt; 
		background-color: #00FF00
	}

</style>
<script >

	
	export default
	{
		
		
		props: ['id_session','nombre'],

		data(){

			return {
				mensajedeconvenior:'',
				ocultarmensajeonvenio:false,
				aletrasinpresupuesto:false,
				botonguardar:true,
				contador:0,
				checkprioridad:[],
				options: { 
					lineNumbers: true
				},
				max:1500,
				nuevos_archivos:[],
				numero_compra:'',
				sigfe:22,
				ciclosigfe:[
					{FAMILIA_SIG:22}
					],
				total_i:0,
				id_paginacion:0,
				flag_ix:'',
				flag:'',
				titulo2:'',
				value: '',
				checkboxing:[],
				checkboxing2:[],
				buscarentable:'',
				paginate: ['productos'],
				presupuesto_cc_table:0,
				productos:[],
				
				archivos:[],
				totalot:0,				
				alertmenor:false,
				saldo_table:0,
				cantidadfila:1,
				file_documento2:[],
				reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
				row_tables:[],
				compra:'',
				cuenta:'',
				familia_sigfe:'',
				sub_item_sigfe:'',
				message:[],
				info_centro_c:[],
				nombre_producto:'',
				flag_contador:0,
				vt_focus:false,
				ve_producto_revision:'',
				ocultar_boton_guardar:false,
				focused_ot:false,
				focused:false,
				year_cierre:0,
				validacierre:true,
				validacierre_t:false,
				presucentros:0,
				presucentros_1:0,			
				gastocentros:0,
				saldo_cr:'',
				porcentaje_gastado_cr:0,				
				presupuesto_cc:0,
				presupuesto_cc_1:0,
				totalcentros:0,
				totalcentros_1:0,
				saldo_cc:0,
				porcentaje_cc:0,
				cr_centros:'',
				elegirFirma:[],
				newBooks_firma:[],
				search_firma:'',
				toggle_firma:false,
				books_firma: [
					{name: 'Liste des livres de Chair de poule'},
					{name: 'Les Cent Meilleurs Romans policiers de tous les temps'},
					{name: 'Liste des livres publiés par Champ libre'}
					],
				boton_menu:true,
				msg: 'Espere un Momento...',
				bloqueo:false,
				flag_index:0,
				productosabas:[],
				input_index:'',
				newBooks_producto2:[],
				id_producto:[],
				search_producto: [],
				toggle_producto:[],
				books_producto: [
					{name: 'Liste des livres de Chair de poule'},
					{name: 'Les Cent Meilleurs Romans policiers de tous les temps'},
					{name: 'Liste des livres publiés par Champ libre'}
					],
				detalle_producto:'',
				justificacion_producto:'',
				vt_producto:0,
				ve_producto:0,
				c_producto:0,	
				
				valor_check:false,
				valor_check_convenio:0,
				saldo:0,
				saldo_ot:0,
				refrendar:0,
				saldo_actual:0,
				cc_fono:0,
				g_refrendado:'',
				costo_ot:0,
				cc_mail:'',
				g_ejecutado:'',
				cr:'',
				cc_proyecto:'',				
				search_centro: '',
				toggle_centro: false,
				id_personas_centro:'',
				newBooks_centro:[],
				newBooks:[],
				n_usuario:this.nombre,
				lista:[],
				archivo:[],
				adjunto:[],
				titulo:'',
				tfirmas:[]

			}
		} ,
		created:function()
		{
			
		},
		
		mounted()
		{	
						axios.get('persona/'+this.id_session).then(response=>{
				console.log(response.data)
				this.cc_mail=response.data[0].per_email
				this.cc_fono=response.data[0].per_telefono
			}).catch(err=>{
				
			});

			
			var today = new Date();
			var year = today.getFullYear();		
			axios.get('cierre/'+year).then(response=>{

				if(response.data.length == 1){
					var v_c=new FormData();
					v_c.append('usuario',this.id_session);
					v_c.append('idcierre',response.data[0].id);

					axios.post('autorizacion',v_c).then(res=>{

						if(res.data.length == 0)
						{
							this.validacierre=false;
							this.validacierre_t=true;
							this.bloqueo=false;
							this.year_cierre=year;

						}else{
							this.validacierre=true;
							this.validacierre_t=false;
							this.bloqueo=false;
							this.calculoResolucion(screen.width,$("#main-panel").width());

						}

					}).catch(err=>{
						this.dulcealert('hubo un error'+err,'error');
						this.bloqueo=false;
					});


				}else{
					this.validacierre=true;
					this.validacierre_t=false;
					this.bloqueo=false;
					this.calculoResolucion(screen.width,$("#main-panel").width());
				}

			}).catch(err=>{
				this.dulcealert('hubo un error'+err,'error');
				this.bloqueo=false;
			});		
			

		},
		computed: 
		{			

			costoot:
			{
				get:function()
				{
					let total=0;

					for (var i = 0; i < this.productos.length; i++) {
						if(this.productos[i].total !='')
						{
							total=total+this.productos[i].total;


						}

					}
					this.totalot=total;
					var total_costoot=total
					this.costo_ot=this.formatPrice(total_costoot)
					var saldo=this.quitarFormatoPrice(this.saldo);
					this.saldo_table=parseInt(saldo)-total;
					var saldo_ot=this.saldo_ot
					var saldoactual=this.saldo_actual
					var valortotal=this.quitarFormatoPrice(saldoactual)-this.quitarFormatoPrice(total_costoot);
					this.saldo_ot=this.formatPrice(valortotal);
					if(this.presupuesto_cc_table < total){
						this.alertmenor=true;
						this.botonguardar=false;

					}else{
						this.alertmenor=false;
						this.botonguardar=true;

					}

					return  total;
				},
				set:function(newValue)
				{

					return newValue

				}
			}


		},
		watch:
		{
			productos(newQuestion, oldQuestion) {
				console.log(oldQuestion);
			},
			'info_centro_c':{
				handler (newValue, oldValue) 
				{
					console.log('ultima cifra',newValue);
				},
				deep:true	
			},
			'elegirFirma':{
				handler (newValue, oldValue) 
				{
					console.log('ultima cifra',newValue);
				},
				deep: true 	
			},		

			


			search_firma(val) {
				console.log(val);
				this.newBooks_firma = []; 

				axios.get('persona/'+val).then(response=>{
					this.newBooks_firma =response.data;


				}); 


			},

		},	
		methods:

		{ 
			cambioprioridad(index,valarboo,array2)
			{
				console.log(this.$refs.firmas)
				var parsedobj = JSON.parse(JSON.stringify(array2));
				
				console.log('valarboo',valarboo)
				console.log(parsedobj)
				if(valarboo== true){
					// var prio={prioridad:1}
					// var a=Object.assign(parsedobj,prio);
					// this.elegirFirma[index]=a
					this.elegirFirma[index]['prioridad']=1;

				}else{
					// delete parsedobj.prioridad
					// this.elegirFirma[index]=parsedobj

					this.elegirFirma[index]['prioridad']=0;
				}
				console.log('elegirFirma',this.elegirFirma[index]);

			},
			evaluarcaracteres(valor)
			{
				console.log(valor.length)
				if(valor.length  == 1500){
					this.dulcealert("debe ser ingresar solo hasta 1500 caracteres")
				}else{

				}
			},
			buscarcentrodecosto(val)
			{
				

				axios.get('centros/'+val).then(response=>{
					this.newBooks_centro =response.data;
					this.toggle_centro=true;

				}); 

			},
			Copiar()
			{

				let i=this.flag_ix;	
				if(this.flag == 0){
					this.productos[i].obrsevacion=this.value;
					this.dulcealert('Observacion copiada','success');
				}else{
					this.productos[i].descripcion=this.value;
					this.dulcealert('Descripcion copiada','success');
				}
			},
			cerrarmodaleditar()
			{
				var  i=this.flag_ix;	


				if(this.flag ==0){
					
					this.$set(this.checkboxing,i,false);
					$("#modaleditor").modal('hide');
				}else{
					this.$set(this.checkboxing2,i,false);
					$("#modaleditor").modal('hide');
				} 

				



			},
			guardartexto()
			{
				

				let i=this.flag_ix;
				if(this.flag ==0){
					this.productos[i].descripcion=this.value;
					this.dulcealert('Descricion guardada','success');

				}else{
					this.productos[i].obrsevacion=this.value;
					this.dulcealert('Observacion guardada','success');

				}

			},
			check(event,inx,value)
			{
				console.log(JSON.parse(this.checkboxing[inx]));
				if(this.checkboxing[inx] == true){
					this.value=value;
					let numero=inx+1;
					this.titulo='Descripcion Producto N°'+numero;
					this.titulo2='Observacion';
					this.flag=0;
					this.flag_ix=inx;
					$("#modaleditor").modal('show');
				}else{
					this.titulo='';
					this.titulo2='';
					$("#modaleditor").modal('hide');
				}


			},
			check2(event,inx,value)
			{
				console.log(JSON.parse(this.checkboxing2[inx]));
				if(this.checkboxing2[inx] == true){
					this.value=value;
					let numero=inx+1;
					this.titulo='Observacion Producto N°'+numero;
					this.titulo2='Descripcion';
					this.flag=1;
					this.flag_ix=inx;
					$("#modaleditor").modal('show');
				}else{
					this.titulo='';
					this.titulo2='';
					$("#modaleditor").modal('hide');
				}


			},
			Buscarentables(value)
			{
				console.log('llegfda',value);
				if(this.productos.length != 0)
				{
					const resultado = JSON.parse(JSON.stringify(this.productos)).filter(function(producto){
						return producto.nombre_producto == value
					} );
					console.log('resultado',resultado);
					console.log('productos',this.productos);
					return resultado;
				}
			},
			eliminarfila(index)
			{
				let ixd=parseInt(index);
				console.log('index eliminar',ixd)
				
				let productos = this.productos.filter(function(pro) {
					return pro.id_producto !== ixd; 
				});
				this.productos=productos;
				this.id_paginacion=this.id_paginacion-1;
				return this.productos



			},
			getverarchivos(index)
			{

				if(this.productos.length > 0){


					console.log('index',index);

					if(this.productos[index].adjunto > 0)
					{
						console.log('veer',this.productos[index].adjunto);
						return this.productos[index].adjunto;
					}


				}
				
			},
			sacarvalor(precio,cantidad,index)
			{
				this.productos[index].total=precio*cantidad;
				let valortotal=precio*cantidad;
				

			},
			sacarvalor2(precio,cantidad,index){
				this.productos[index].total=precio*cantidad;
				let valortotal=precio*cantidad;
			},
			changeFiles()
			{

			},
			guardar(){
				const data = {
					productos: this.productos
				}
				if(this.costoot< 0){
					return this.dulcealert('No puede Crear la OT por que el saldo es menor al costo','error');
				}
				if(this.id_personas_centro == ''){
					return this.dulcealert('Debe ingresar un centro de costo','error');
				}
				if(this.cc_fono == '')
				{
					this.bloqueo=false;
					return this.dulcealert('Debe ingresar un numero de telefono','error');
				}


				Swal.fire({
					title: 'Desea crear un borrador o enviar OT?',
					showDenyButton: true,
					showCancelButton: true,
					confirmButtonText: 'Guardar Borrador',
					denyButtonText: `Enviar`,
				}).then((result) => {
					console.log(result);
					if (result.isConfirmed) {
						var estado_compra=1;
						var estado_producto=15;

					} else if (result.isDenied) {
						var estado_compra=2;
						var estado_producto=0;

					}else if(result.isDismissed){
						return 0;

					}
					
					this.bloqueo=true;
					if(this.cc_mail.length == 0)
					{
						this.bloqueo=false;
						return this.dulcealert('Debe ingresar un mail','error');
					}
					
					var datosusuarios=new FormData();
					datosusuarios.append('usuario',this.id_session);
					datosusuarios.append('proyecto',this.cc_proyecto);
					datosusuarios.append('mail',this.cc_mail);
					datosusuarios.append('telefono',this.cc_fono.length == 0?0:this.cc_fono);
					//datosusuarios.append('firmas',JSON.stringify(this.elegirFirma));
					datosusuarios.append('cc_id',this.id_personas_centro);
					datosusuarios.append('cr_id',this.cr_id);
					datosusuarios.append('convenio',this.valor_check_convenio);
					datosusuarios.append('estado',estado_compra);
					datosusuarios.append('sigfe',this.sigfe);

					axios.post('compras',datosusuarios).then( async response1=>{
						if(estado_compra != 1){
							this.crearhistoria(response1.data,2,6);
							this.postproductos(response1.data,estado_producto);
						}else{
							this.postproductosborrador(response1.data,estado_producto);
							this.bloqueo=false;
						}
						

						
						


					}).catch(err=>{
						this.bloqueo=false;
						
					});
				});

				console.log(this.productos);


			},
			postproductosborrador(id,estado_producto)
			{

				var today = new Date();
				var year = today.getFullYear();	

				for (let i = 0; i < this.productos.length; i++) 
				{				
					let p=new FormData();
					this.productos[i].compra=id;
					this.productos[i].convenio=this.valor_check_convenio;
					this.productos[i].cc=this.id_personas_centro;
					this.productos[i].estado=1;
					p.append('oc',id);
					p.append('nombre',this.productos[i].nombre);
					p.append('cantidad',this.productos[i].cantidad);
					p.append('detalle',this.productos[i].descripcion);
					p.append('precio',this.productos[i].precio);
					p.append('id_pro',this.productos[i].id_pro);
					p.append('estado_refren',1);
					p.append('estado',estado_producto);
					p.append('cuenta',this.productos[i].cuenta);
					p.append('total',this.productos[i].total);
					p.append('unidad',this.productos[i].unidad);
					p.append('nombre_producto',this.productos[i].nombre_producto);
					p.append('sub_item_sigfe',this.productos[i].sub_item_sigfe);
					p.append('justificacion',this.productos[i].obrsevacion);
					p.append('cc',this.productos[i].cc);
					p.append('sigfe_item',this.productos[i].sigfe_item);
					p.append('convenio',this.productos[i].convenio);
					p.append('pro_id_cpp',0);
					p.append('zgen',this.productos[i].zgen);
					axios.post('productos',p).then(response=>{
						console.log(this.productos[i].adjunto.length)
						

						for (var k = 0; k < this.productos[i].adjunto.length;k++) 
						{

							this.postArchivos(i,k,response.data,id,this.productos[i].adjunto.length);	
							if (i == this.productos.length-1 && k==this.productos[i].adjunto.length -1) {

								console.log('productos ',this.productos.length-1);
								console.log('i de productos ',i);
								console.log('adjuntos',this.productos[i].adjunto.length -1);
								console.log('k de adjuntos',k);

								axios.get('compras/'+id).then(respo=>{
									this.numero_compra=respo.data.compra_numero;

									this.dulcealert('OT creada N°'+this.numero_compra,'success');
									this.bloqueo=false;
									this.limpiarformulario();
									this.productos=[];

								}).cacth(err=>{
									this.bloqueo=false;
								});

							}									

						}




					}).catch(err=>{
						this.bloqueo=false;


					});
				}

				console.log('contador',this.contador)
				axios.get('compras/'+id).then(respo=>{
					this.numero_compra=respo.data.compra_numero;
					if(this.contador > 0){
						this.crearsolicitudquimicoborrador(this.id_personas_centro,this.numero_compra,id,year,1,4,0,3);
						this.dulcealert('OT creada N°'+this.numero_compra,'success');
						this.bloqueo=false;
						this.limpiarformulario();
						this.productos=[];
						}else{//cc,numero,id_doc,year,estado,tipo,prioridad
							this.crearsolicitudborrador(this.id_personas_centro,this.numero_compra,id,year,3,1,0,3);
							this.dulcealert('OT creada N°'+this.numero_compra,'success');
							this.bloqueo=false;
							this.limpiarformulario();
							this.productos=[];
						}
						this.updatecomprasestado(id,1);

					}).catch(err=>{

					});
				},
				updatecomprasestado(id,estado){
					var url="compras/"+id;
					var d={
						compra_estado:estado,
						_method:'patch'
					}

					axios.post(url,d).then(response=>{

					}).catch(err=>{

					});
				},
				crearsolicitudquimico(cc,numero,id_doc,year,estado,tipo,prioridad){
					var d=new FormData();
					d.append('tipo',tipo)
					d.append('estado',estado)
					d.append('usuario',this.id_session)
					d.append('year',year)
					d.append('cc',cc)
					d.append('numero',numero)
					d.append('id_doc',id_doc)
					d.append('prioridad',prioridad)
					d.append('activo',0)
					axios.post('solicitudes',d).then(response=>{				

						this.updatecomprasestado(id_doc,6);
						if(this.elegirFirma.length > 0)
						{
							this.elegirFirma=JSON.parse(JSON.stringify(this.elegirFirma))
							for (let e = 0; e < this.elegirFirma.length; e++) {				


								var fir=new FormData();
								fir.append('usuario',this.elegirFirma[e].run);
								fir.append('estado',2);
								fir.append('tipo',5);
								fir.append('year',year);
								fir.append('cc',cc);
								fir.append('numero',numero);
								fir.append('id_doc',id_doc);
								fir.append('prioridad',this.elegirFirma[e].prioridad);
								fir.append('activo',1);

								axios.post('solicitudes',fir).then(firmas=>{
									this.bloqueo=false;
								}).catch(erro=>{
									this.bloqueo=false;
								});

							}
							this.crearhistoria(id_doc,5,0);
						}
						this.bloqueo=false;
					}).catch(err=>{
						this.bloqueo=false;
					});

				},
				crearsolicitudesdefirmas(cc,numero,id_doc,year,estado,tipo,prioridad)
				{

					console.log('length',this.elegirFirma.length);
					if(parseInt(this.elegirFirma.length) > 0)
					{
						this.updatecomprasestado(id_doc,5);
						this.elegirFirma=JSON.parse(JSON.stringify(this.elegirFirma))

						for (var e = 0; e < this.elegirFirma.length; e++) {
							console.log(this.elegirFirma[e]);
							
							var fir=new FormData();
							fir.append('usuario',this.elegirFirma[e].run);
							fir.append('estado',2);
							fir.append('tipo',5);
							fir.append('year',year);
							fir.append('cc',cc);
							fir.append('numero',numero);
							fir.append('id_doc',id_doc);
							fir.append('prioridad',this.elegirFirma[e].prioridad);
							fir.append('activo',0);


							axios.post('solicitudes',fir).then(firmas=>{
								this.bloqueo=false;
							}).catch(erro=>{
								this.bloqueo=false;
							});
							if(e == this.elegirFirma.length -1){
								this.elegirFirma=[]
							}

						}
						this.crearhistoria(id_doc,5,0);
					}else{
						console.log("no entra al if")
					}
				},
				crearsolicitud(cc,numero,id_doc,year,estado,tipo,prioridad)
				{
					console.log('largo de firmas',this.elegirFirma.length)
					console.log('array',this.elegirFirma)

					var d=new FormData();
					d.append('tipo',tipo)
					d.append('estado',estado)
					d.append('usuario',this.id_session)
					d.append('year',year)
					d.append('cc',cc)
					d.append('numero',numero)
					d.append('id_doc',id_doc)
					d.append('prioridad',prioridad)
					d.append('activo',0)
					axios.post('solicitudes',d).then(response=>{
						this.updatecomprasestado(id_doc,3);

						this.crearsolicitudesdefirmas(cc,numero,id_doc,year,estado,tipo,prioridad)
					}).catch(err=>{

					});

				},
				revisarzgenproductos(){
					for (var i = 0; i < this.productos.length; i++) {
						this.productos[i].zgen
					}
				},
				postproductos(id,estado_producto)
				{

					var today = new Date();
					var year = today.getFullYear();	

					for (let i = 0; i < this.productos.length; i++) 
					{				
						let p=new FormData();
						this.productos[i].compra=id;
						this.productos[i].convenio=this.valor_check_convenio;
						this.productos[i].cc=this.id_personas_centro;
						this.productos[i].estado=1;
						p.append('oc',id);
						p.append('nombre',this.productos[i].nombre);
						p.append('cantidad',this.productos[i].cantidad);
						p.append('detalle',this.productos[i].descripcion);
						p.append('precio',this.productos[i].precio);
						p.append('id_pro',this.productos[i].id_pro);
						p.append('estado_refren',1);
						p.append('estado',estado_producto);
						p.append('cuenta',this.productos[i].cuenta);
						p.append('total',this.productos[i].total);
						p.append('unidad',this.productos[i].unidad);
						p.append('nombre_producto',this.productos[i].nombre_producto);
						p.append('sub_item_sigfe',this.productos[i].sub_item_sigfe);
						p.append('justificacion',this.productos[i].obrsevacion);
						p.append('cc',this.productos[i].cc);
						p.append('sigfe_item',this.productos[i].sigfe_item);
						p.append('convenio',this.productos[i].convenio);
						p.append('pro_id_cpp',0);
						p.append('zgen',this.productos[i].zgen);
						axios.post('productos',p).then(response=>{
							console.log(this.productos[i].adjunto.length)


							for (var k = 0; k < this.productos[i].adjunto.length;k++) 
							{

								this.postArchivos(i,k,response.data,id,this.productos[i].adjunto.length);	
								if (i == this.productos.length-1 && k==this.productos[i].adjunto.length -1) {

									console.log('productos ',this.productos.length-1);
									console.log('i de productos ',i);
									console.log('adjuntos',this.productos[i].adjunto.length -1);
									console.log('k de adjuntos',k);

									axios.get('compras/'+id).then(respo=>{
										this.numero_compra=respo.data.compra_numero;

										this.dulcealert('OT creada N°'+this.numero_compra,'success');
										this.bloqueo=false;
										this.limpiarformulario();
										this.productos=[];

									}).cacth(err=>{
										this.bloqueo=false;
									});

								}else if(this.productos[i].adjunto.length == 0){
									axios.get('compras/'+id).then(respo=>{
										this.numero_compra=respo.data.compra_numero;

										this.dulcealert('OT creada N°'+this.numero_compra,'success');
										this.bloqueo=false;
										this.limpiarformulario();
										this.productos=[];

									}).cacth(err=>{
										this.bloqueo=false;
									});

								}										

							}




						}).catch(err=>{
							this.bloqueo=false;


						});
					}
					console.log('contador',this.contador)
					axios.get('compras/'+id).then(respo=>{
						this.numero_compra=respo.data.compra_numero;
						if(this.contador > 0){
							this.crearsolicitudquimico(this.id_personas_centro,this.numero_compra,id,year,1,4,0);
							this.dulcealert('OT creada N°'+this.numero_compra,'success');
							this.bloqueo=false;
							this.limpiarformulario();
							this.productos=[];


						}else{//cc,numero,id_doc,year,estado,tipo,prioridad
							this.crearsolicitud(this.id_personas_centro,this.numero_compra,id,year,3,1,0);
							this.dulcealert('OT creada N°'+this.numero_compra,'success');
							this.bloqueo=false;
							this.limpiarformulario();
							this.productos=[];

						}

					}).catch(err=>{

					});

				},
				postArchivos(p,a,producto,compra,ultima)
				{
					var total_adjunto=this.productos[p].adjunto.length;
					this.total_i=this.total_i+a;


					let f=new FormData();
					f.append('file',this.productos[p].adjunto[a]);
					f.append('id',producto);
					f.append('oc',compra);
					axios.post('adjuntos_ot',f).then(response=>{
						if(total_adjunto == this.total_i){
							this.productos=[];
							this.id_paginacion=1;
						}
						this.bloqueo=false;

					}).catch(err=>{
						this.bloqueo=false;
						this.dulcealert('Error Al crear OT'+err,'error')
					});
				},
				agregar(){
					if(this.cantidadfila <=1){


						this.productos.push({
							id_producto:this.id_paginacion,
							nombre:'',
							precio:0,
							cantidad:1,
							total:0,
							descripcion:'',
							observacion:'',
							adjunto:[],
							id_pro:'',
							cuenta:'',
							familia_sigfe:'',
							sub_item_sigfe:'',
							zgen:0,
							compra:'',
							cc:null,
							convenio:null,
							nombre_producto:null,
							estado:null,
							unidad:null,
							eliminar:'Eliminar'

						})
						this.checkboxing[this.id_paginacion]=false;
						this.checkboxing2[this.id_paginacion]=false;
						this.id_paginacion=this.cantidadfila+this.id_paginacion;


					}else{

						var total=parseInt(this.cantidadfila)+parseInt(this.id_paginacion);

						for (var i=this.id_paginacion; i < total; i++) {
							this.productos.push({
								id_producto:i,
								nombre:'',
								precio:'',
								cantidad:'',
								total:'',
								descripcion:'',
								observacion:'',
								adjunto:[],
								id_pro:'',
								cuenta:'',
								familia_sigfe:'',
								sub_item_sigfe:'',
								compra:'',
								zgen:0,
								cc:null,
								convenio:null,
								nombre_producto:null,
								estado:null,
								unidad:null,
								eliminar:'Eliminar'

							})
							this.checkboxing[i]=false;
							this.checkboxing2[i]=false;
						}



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
				isEmailValid()
				{
					return (this.cc_mail == "")? "" : (this.reg.test(this.cc_mail)) ? 'has-success' : 'has-error';
				},
				limpiar(index,j)
				{

					this.productos[index].adjunto.splice(j,1);
				},
				formato:function (size) {
					if (size > 1024 * 1024 * 1024 * 1024) {
						return (size / 1024 / 1024 / 1024 / 1024).toFixed(2) + ' TB'
					} else if (size > 1024 * 1024 * 1024) {
						return (size / 1024 / 1024 / 1024).toFixed(2) + ' GB'
					} else if (size > 1024 * 1024) {
						return (size / 1024 / 1024).toFixed(2) + ' MB'
					} else if (size > 1024) {
						return (size / 1024).toFixed(2) + ' KB'
					}
					return size.toString() + ' B'
				},


				cambios2(valor,valor1)
				{
					this.costo_ot=valor*valor1;
					this.costo_ot=this.formatPrice(this.costo_ot);
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
				cambios(row,index)
				{
					console.log(index);
					var inx=index-1;
					row.valortotal=row.cantidad*row.valorestimado;
					this.$set(this.data,inx,row);
					var total_v=0
					for (var i = 0; i < this.data.length; i++) {
						total_v=total_v+this.data[i].valortotal
					}
					this.costo_ot=total_v;
					this.costo_ot=this.formatPrice(this.costo_ot);

					this.saldo_ot=parseInt(this.quitarFormatoPrice(this.saldo_actual))-parseInt(this.quitarFormatoPrice(this.costo_ot));
					if(this.saldo_ot <= 0)
					{

						console.log('entro aqui');
						this.focused_ot=true;
						console.log(this.focused_ot);
					}else{
						this.facused_ot=false;
					}
					this.saldo_ot=this.formatPrice(this.saldo_ot);


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

				eliminarfirma(id)
				{
					this.elegirFirma=JSON.parse(JSON.stringify(this.elegirFirma) );

					this.elegirFirma.splice(id,1);
				},
				limpiarformulario()
				{
					this.cc_fono=0;
					this.cc_mail='';
					this.cc_proyecto='';
					this.saldo_actual=0;
					this.refrendar=0;
					this.saldo_ot=0;
					this.saldo=0;
					this.cr_centros=''
					this.search_centro='vacio'
					this.id_personas_centro=''
					this.search_firma='';
					this.costoot=0
					this.saldo_table=0				

					this.cr='';
					this.costo_ot=0;
					this.presupuesto_cc=0
					this.valor_check_convenio=0;				
					this.presupuesto_cc_table=0				
					this.archivos=''
					this.totalot=0
					this.saldo_table=0

					this.costoot=0
					this.saldodeot=0


				},
				selectResult_firma(nombre,run,index)
				{   
					var d=new Array();

					this.search_firma='';
					this.elegirFirma.push({'run':run,'nombre':nombre,'prioridad':0});

				},
				quitarResolucion()
				{

					$("#sidebar").show();
					var side_b=$("#sidebar").width();
					var screen=window.screen.width;
					var calculo=parseInt(screen)-parseInt(side_b);

					$('#main-panel').width(calculo +'px');
					this.boton_menu=false;



				},
				calculoResolucion(screen,panel)
				{
					this.bloqueo=true;
					$("#sidebar").hide();
					var calculo=parseInt(screen)- parseInt(panel);            			
					$('#main-panel').width($('#main-panel').width()+ calculo + 'px');
					this.bloqueo=false;
				},
				getFocus(index)
				{
					var g='nombre_producto'+index;
					console.log(g);
					this.$refs['nombre_producto'+index].focus();
					this.toggle_producto[index]=true;

				},

				calcularprecio(valor,valor1,index)
				{
					console.log(index);
					this.vt_producto=valor*valor1;
					this.costo_ot=this.vt_producto[index];
					this.saldo_ot=this.quitarFormatoPrice(this.saldo_actual)+this.costo_ot;
					if(this.saldo_ot < this.quitarFormatoPrice(this.saldo_actual))
					{
						console.log('entro aqui');
						this.focused_ot=true;
						console.log(this.focused_ot);
					}else{
						this.facused_ot=false;
					}
					this.saldo_ot=this.formatPrice(this.saldo_ot);

					this.$set(this.vt_producto,index,this.vt_producto[index]);
				},
				selectResult_producto(id,nombre,index,cuenta_sigfe,sub_item_sigfe,nombre_sigfe,unidad,zgen,sigfe_item)
				{

					this.toggle_producto[index]=false;
					this.productos[index].nombre=id+'-'+nombre;				
					this.productos[index].id_pro=id;
					this.productos[index].cuenta=cuenta_sigfe;
					this.productos[index].sub_item_sigfe=sub_item_sigfe;
					this.productos[index].nombre_sigfe=nombre_sigfe;
					this.productos[index].nombre_producto=nombre;
					this.productos[index].unidad=unidad;
					this.productos[index].zgen=zgen;           
					this.productos[index].familia_sigfe=sigfe_item;  
					if(zgen != 0){
						this.contador++

					}
					console.log(index-1);
					var inx=index-1;

					console.log('data',this.data);


					this.id_producto[index]=id;

				},
				getProductosarray(data)
				{
					this.data=data;
				},
				eliminarelemento(index)
				{ 
					console.log('index',index);
					this.data=JSON.parse(JSON.stringify(this.data));

					this.data.splice(index,1);
					console.log(this.data)
					if(index !=0)
					{
						this.getProductosarray(this.data);
					}


				},
				scrollToElement() {
					const el = this.$refs.scrollToMe;

					if (el) {

						el.scrollIntoView({behavior: 'smooth'});
					}
				},
				agregarproducto()
				{

					this.$refs.t_productos.scrollIntoView(); 

				},
				dulcealert(text,icono)
				{
					Swal.fire({
						icon: icono,

						text: text,

					})


				},
				quitarFormatoPrice(value)
				{

					var monto=0;

					if(value != 0 ){
						if(value.length >=4){


							monto=value.replace(/[.]/g,'');
						}else{
							monto=value;
						}
					}else{
						monto=value;
					}

					return monto



				},
				formatPrice(value) {
					console.log('valoir',value);

					if(parseInt(value) == 0 || isNaN(value)){

						return 0;
					}else{
						let val = (value/1).toFixed(0).replace('.', '.')
						return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")	
					}

				},
				onChangeEventHandler(event)
				{
					if(event.value == true)
					{
						this.dulcealert('Se ha marcado el convenio','success')
						this.valor_check_convenio=1;
						this.mensajedeconvenior="Ha elegido un convenio";
						this.ocultarmensajeonvenio=true
						if(this.botonguardar== false){
							this.botonguardar=true

						}
						
					}else{
						this.valor_check_convenio=0;
						this.mensajedeconvenior="";
						this.ocultarmensajeonvenio=false
					}

				},
				selectResult_centro(id,nombre,cr_id,cr_nombre,index)
				{ 


					this.info_centro_c.push({'cr':cr_id,'cr_nombre':cr_nombre,'cc_id':id,'cc_nombre':nombre});
					this.search_centro=nombre;
					this.id_personas_centro=id;
					this.cr_id=cr_id;
					this.cr_centros=cr_id;
					this.cr=cr_nombre;
					this.toggle_centro=false;
				//this.buscarpresupuesto();
					this.buscarprespuestos(this.id_personas_centro,this.sigfe);
					this.buscarrefrendacioncc(this.id_personas_centro,this.sigfe);
					this.buscarsinrefrendar(this.id_personas_centro,this.sigfe);
					this.buscarpagado(this.id_personas_centro,this.sigfe);

				},
				elegirsigfe()
				{
					console.log(this.id_personas_centro)
					if(this.id_personas_centro == ''){
						return this.dulcealert('Debe ingresar un centro de costo','error');
					}
					this.buscarprespuestos(this.id_personas_centro,this.sigfe);
					this.buscarrefrendacioncc(this.id_personas_centro);
					this.buscarsinrefrendar(this.id_personas_centro);
					this.buscarpagado(this.id_personas_centro);

				// this.bloqueo=true;
				// var today = new Date();
				// var year = today.getFullYear();		
				// var cc_pre=new FormData();
				// cc_pre.append('cc',this.id_personas_centro);
				// cc_pre.append('sigfe',this.sigfe);
				// axios.post('presupuestoanual',cc_pre).then(response2=>{
				// 	var ins=this;
				// 	console.log('success',response2.data.presupuestocc);
				// 	this.presupuesto_cc=this.formatPrice(response2.data.presupuestocc);
				// 	this.presupuesto_cc_table=response2.data.presupuestocc;
				// 	this.saldo_cc=this.formatPrice(response2.data.saldo_cc)
				// 	this.saldo_actual=this.formatPrice(response2.data.saldo_actual);
				// 	this.g_refrendado=this.formatPrice(response2.data.g_refrendado);
				// 	this.g_ejecutado=this.formatPrice(response2.data.g_ejecutado);
				// 	this.saldo_ot=this.formatPrice(response2.data.saldo_ot);
				// 	this.saldo_table=response2.data.saldo_ot;
				// 	this.saldo=this.formatPrice(response2.data.saldo);
				// 	this.refrendar=this.formatPrice(response2.data.sinrefrendar);
				// 	this.bloqueo=false;
				// }).catch( err => {
    //            this.dulcealert('Error en servidor comuniquese con informatica  '+err,'error');  // NOTE - use "error.response.data` (not "error")

    //            this.bloqueo=false;

    //            console.log(this);
    //        });

				},

				buscarprespuestos(id,sigfe){
					var today = new Date();
					var year = today.getFullYear();	
					var d=new FormData();
					d.append('cc',id);
					d.append('sigfe',sigfe);
					d.append('amio',year)
					axios.post('nuevoprespuesto',d).then(response=>{
						this.presupuesto_cc=this.formatPrice(response.data.monto);
						this.presupuesto_cc_table=response.data.monto;
						this.getsigfe(id,sigfe);
					}).catch(err=>{

					});

				},
				calculartotal()
				{
					this.bloqueo=true
					setTimeout(()=>{
						var prespuesto=this.quitarFormatoPrice(this.presupuesto_cc);
						console.log('prespuesto',prespuesto);
						var refrendar =this.quitarFormatoPrice(this.refrendar)
						console.log('refrendar',refrendar);
						var g_refrendado=this.quitarFormatoPrice(this.g_refrendado)
						console.log('g_refrendado',g_refrendado);
						var saldo=parseInt(prespuesto)-(parseInt(refrendar)+parseInt(g_refrendado))
						console.log(saldo);
						this.saldo=this.formatPrice(parseInt(saldo))				 
						this.saldo_ot=this.saldo
						this.saldo_table=saldo
						this.saldo_actual=this.saldo
						var slado_veri=this.quitarFormatoPrice(this.saldo_actual)

						if(slado_veri <=0){
							this.aletrasinpresupuesto=true
						}else{
							this.aletrasinpresupuesto=false
						}
						this.bloqueo=false
					} , 2000

					);


				},
				getsigfe(id,sigfe)
				{
					var today = new Date();
					var year = today.getFullYear();	
					var d=new FormData();
					d.append('cc',id)
					d.append('sigfe',sigfe)
					d.append('year',year)
					axios.post('sigfe',d).then(response=>{
						this.ciclosigfe=response.data

					}).cath(err=>{})
				},
				buscarpagado(id)
				{
					var today = new Date();
					var year = today.getFullYear();		
					var d=new FormData();
					d.append('cc',id);
					d.append('year',year);
					d.append('sigfe',this.sigfe);
					axios.post('pagado',d).then(response=>{
						this.g_ejecutado=this.formatPrice(response.data);
						this.calculartotal();
					}).catch(err=>{

					});
				},
				buscarsinrefrendar(id)
				{

					var today = new Date();
					var year = today.getFullYear();		
					var d=new FormData();
					d.append('cc',id);
					d.append('year',year);
					d.append('sigfe',this.sigfe);
					axios.post('refrendacionsin',d).then(response=>{
						this.refrendar=this.formatPrice(response.data)
					}).catch(err=>{});

				},
				buscarrefrendacioncc(id)
				{
					var today = new Date();
					var year = today.getFullYear();		
					var d=new FormData();
					d.append('cc',id);
					d.append('year',year);
					d.append('sigfe',this.sigfe);
					axios.post('refrendacionesgasto',d).then(response=>{
						this.g_refrendado=this.formatPrice(response.data);
					}).catch(err=>{

					});

				},
				buscarpresupuesto()
				{


				// this.bloqueo=true;
				// var cr=new FormData();
				// cr.append('cr',this.cr_centros);
				// axios.post('sigfe',cr).then(response12=>{
				// 	this.ciclosigfe=response12.data;
				// }).catch(err=>{});
				// var today = new Date();
				// var year = today.getFullYear();		
				// var cc_pre=new FormData();
				// cc_pre.append('cc',this.id_personas_centro);
				// cc_pre.append('sigfe',this.sigfe); 
				// cc_pre.append('cr',this.cr_centros);
				// axios.post('presupuestoanual',cc_pre).then(response2=>{
				// 	var ins=this;
				// 	console.log('success',response2.data.presupuestocc);
				// 	this.presupuesto_cc=this.formatPrice(response2.data.presupuestocc);
				// 	this.presupuesto_cc_table=response2.data.presupuestocc;
				// 	this.saldo_cc=this.formatPrice(response2.data.saldo_cc)
				// 	this.saldo_actual=this.formatPrice(response2.data.saldo_actual);
				// 	this.g_refrendado=this.formatPrice(response2.data.g_refrendado);
				// 	this.g_ejecutado=this.formatPrice(response2.data.g_ejecutado);
				// 	this.saldo_ot=this.formatPrice(response2.data.saldo_ot);
				// 	this.saldo_table=response2.data.saldo_ot;
				// 	this.saldo=this.formatPrice(response2.data.saldo);
				// 	this.refrendar=this.formatPrice(response2.data.sinrefrendar);
				// 	this.bloqueo=false;
				// }).catch( err => {
    //            this.dulcealert('Error en servidor comuniquese con informatica  '+err,'error');  // NOTE - use "error.response.data` (not "error")

    //            this.bloqueo=false;

    //            console.log(this);
    //        });



				},
				crearsolicitudborrador(cc,numero,id_doc,year,estado,tipo,prioridad,activo)
				{
					console.log('largo de firmas',this.elegirFirma.length)
					console.log('array',this.elegirFirma)

					var d=new FormData();
					d.append('tipo',tipo)
					d.append('estado',estado)
					d.append('usuario',this.id_session)
					d.append('year',year)
					d.append('cc',cc)
					d.append('numero',numero)
					d.append('id_doc',id_doc)
					d.append('prioridad',prioridad)
					d.append('activo',activo)
					axios.post('solicitudes',d).then(response=>{


						this.crearsolicitudesdefirmasborrador(cc,numero,id_doc,year,estado,tipo,prioridad,activo)
					}).catch(err=>{

					});

				},
				crearsolicitudesdefirmasborrador(cc,numero,id_doc,year,estado,tipo,prioridad,activo)
				{

					console.log('length',this.elegirFirma.length);
					if(parseInt(this.elegirFirma.length) > 0)
					{

						this.elegirFirma=JSON.parse(JSON.stringify(this.elegirFirma))

						for (var e = 0; e < this.elegirFirma.length; e++) {
							console.log(this.elegirFirma[e]);

							var fir=new FormData();
							fir.append('usuario',this.elegirFirma[e].run);
							fir.append('estado',2);
							fir.append('tipo',5);
							fir.append('year',year);
							fir.append('cc',cc);
							fir.append('numero',numero);
							fir.append('id_doc',id_doc);
							fir.append('prioridad',this.elegirFirma[e].prioridad);
							fir.append('activo',activo);


							axios.post('solicitudes',fir).then(firmas=>{
								this.bloqueo=false;
							}).catch(erro=>{
								this.bloqueo=false;
							});
							if(e == this.elegirFirma.length -1){
								this.elegirFirma=[]
							}

						}
						this.crearhistoria(id_doc,5,0);
					}else{
						console.log("no entra al if")
					}
				},
				crearsolicitudquimicoborrador(cc,numero,id_doc,year,estado,tipo,prioridad,activo){
					var d=new FormData();
					d.append('tipo',tipo)
					d.append('estado',estado)
					d.append('usuario',this.id_session)
					d.append('year',year)
					d.append('cc',cc)
					d.append('numero',numero)
					d.append('id_doc',id_doc)
					d.append('prioridad',prioridad)
					d.append('activo',activo)
					axios.post('solicitudes',d).then(response=>{				


						if(this.elegirFirma.length > 0)
						{
							this.elegirFirma=JSON.parse(JSON.stringify(this.elegirFirma))
							for (let e = 0; e < this.elegirFirma.length; e++) {				


								var fir=new FormData();
								fir.append('usuario',this.elegirFirma[e].run);
								fir.append('estado',2);
								fir.append('tipo',5);
								fir.append('year',year);
								fir.append('cc',cc);
								fir.append('numero',numero);
								fir.append('id_doc',id_doc);
								fir.append('prioridad',this.elegirFirma[e].prioridad);
								fir.append('activo',1);

								axios.post('solicitudes',fir).then(firmas=>{
									this.bloqueo=false;
								}).catch(erro=>{
									this.bloqueo=false;
								});

							}
							this.crearhistoria(id_doc,5,0);
						}
						this.bloqueo=false;
					}).catch(err=>{
						this.bloqueo=false;
					});

				},
				getCalculo_2(id,id2){
					var cal=(id2/id)*100;



					return cal;

				},


			},
			beforeMount()
			{
				this.bloqueo=true;
			},	

		}	      

	</script>

