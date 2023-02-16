<template>
	<div>
		<embed :src="'data:application/pdf;base64,'+cod"  type="application/pdf" width="1200px" height="600px"></embed>
	</div>
	
</template>
<script >
	export default {
props: ['id_session','cod'],

data(){

  return {


        }
	}
}	
</script>