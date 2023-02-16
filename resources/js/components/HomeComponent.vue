<template>
<div class="container">
<div class="card">
<div class="card-title text-center"><h5>Bienvenidos Al Sistema de Ordenes Compra Sr(a): {{nombre}}</h5></div>
<div class="card-body">
<img :src="'assets/img/orden-compra.png'" class="mx-auto d-block">

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
       msg: 'Espere un Momento...',
	   bloqueo:false,
      }
} ,
created:function()
{

},
mounted()
{
	// this.bloqueo=true;
// axios.get('productos_aba').then(response=>{
	
// console.log(response.data);
// for (var i = 0; i < response.data.length; i++) {
// var pr=new FormData();
// pr.append('codigo',response.data[i].produCodInt);
// pr.append('usuario',response.data[i].per_rut);
// pr.append('seccion',response.data[i].secciCod);
// pr.append('unidad',response.data[i].umediCod);
// pr.append('precio',response.data[i].produPrecio);
// pr.append('grupo',response.data[i].grupoCod);
// pr.append('nombre',response.data[i].produNombre);
// useEffect(()=>{
// axios.get('productos_base').then(response=>{
       
// }).catch(err=>{
// this.dulcealert('error: '+err,'error');
// this.bloqueo=false;
// });






// }).catch(err=>{
// this.dulcealert('error: '+err,'error');
// this.bloqueo=false;
// });

},
methods:
{
dulcealert(text,icono)
				{
					Swal.fire({
						icon: icono,
						title: 'Oops...',
						text: text,

					})


				},

}	

}	      

</script>