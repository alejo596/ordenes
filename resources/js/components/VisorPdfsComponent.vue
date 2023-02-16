<template>
	

	<div class="offset-3">

		<div v-show="docpdf">
			<pdf  :src="'../../storage/app/'+cod"></pdf>
		</div>
		

	</div>




</template>
<script>
	import pdf from 'pdfvuer';
	export default {
		props: ['cod','sis'],
		components: {
			pdf
		},
		data(){

			return {

				url:'../..',
				docpdf:true

			}
		},
		

	}
</script>	