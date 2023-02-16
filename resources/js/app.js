
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'v-markdown-editor/dist/v-markdown-editor.css';
import swal from 'sweetalert2';
import BlockUI from 'vue-blockui';
import ToggleButton from 'vue-js-toggle-button';
import VueCarousel from 'vue-carousel';
import VueScrollTo from 'vue-scrollto';
import VuePaginate from 'vue-paginate'
import Editor from 'v-markdown-editor'
import {ClientTable} from 'vue-tables-2';
import VueHtml2pdf from 'vue-html2pdf';
import vBlur from "v-blur";
import Popover from 'vue-js-popover'
import MaskedInput from 'vue-masked-input'
import VueQRCodeComponent from 'vue-qrcode-component'
import vuescroll from 'vue-scroll'

import {
  // Directives
  VTooltip,
  VClosePopper,
  // Components
  Dropdown,
  Tooltip,
  Menu
} from 'floating-vue'
import 'floating-vue/dist/style.css'
import ProgressBar from 'vuejs-progress-bar'





require('./bootstrap');
window.Vue = require('vue');

window.Swal = swal;
Vue.directive('tooltip', VTooltip)
Vue.directive('close-popper', VClosePopper)
Vue.use(BlockUI);
Vue.use(ToggleButton);
Vue.use(VueCarousel);
Vue.use(VueScrollTo);
Vue.use(VuePaginate)
Vue.use(Editor);
Vue.use(ClientTable);
Vue.use(VueHtml2pdf);
Vue.use(vBlur);
Vue.use(Popover);
Vue.use(ProgressBar)
Vue.use(vuescroll);

Vue.config.productionTip = false;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('viaticos-component', require('./components/ViaticosComponent.vue').default);
Vue.component('s-fondo-component', require('./components/SfondoComponent.vue').default);
Vue.component('r-fonod-component', require('./components/RfondoComponent.vue').default);

Vue.component('pagina-uno', require('./components/Pagina_1Component.vue').default);
Vue.component('subdireccion-component', require('./components/SubdireccionComponent.vue').default);
Vue.component('generar-ordenes-component', require('./components/GenerarOrdenesComponent.vue').default)
Vue.component('bienvenida-home', require('./components/HomeComponent.vue').default)
Vue.component('table-home', require('./components/TableComponent.vue').default)
Vue.component('lista-ordenes', require('./components/ListaOrdenesComponet.vue').default) 
Vue.component('time-line', require('./components/TimeLineComponent.vue').default) 
Vue.component('time-line2', require('./components/TimeLine2Component.vue').default) 
Vue.component('pdf-vista', require('./components/pdfComponent.vue').default) 
Vue.component('asignar-ot', require('./components/AsignarComponent.vue').default) 

Vue.component('gestion-compra', require('./components/GestionCompraComponent.vue').default) 
Vue.component('crear-cpp', require('./components/CppComponent.vue').default)  
Vue.component('visor-pdf', require('./components/VisorPdfsComponent.vue').default)  
Vue.component('cpp-pdf', require('./components/pdfcppComponent.vue').default)
Vue.component('reasignar-ot', require('./components/reasignarComponent.vue').default)
Vue.component('modificar-productos', require('./components/ModificarProductosComponent.vue').default)
Vue.component('buscar-cpp', require('./components/BusquedaCppComponent.vue').default)
Vue.component('buscar-ot', require('./components/BuscarotComponent.vue').default)
Vue.component('listar-procesos', require('./components/ListaProcesosComponent.vue').default)
Vue.component('listar-conformidad', require('./components/ConformidadComponent.vue').default)
Vue.component('listar-mensajes', require('./components/VistamensajesComponent.vue').default)
Vue.component('listar-quimico', require('./components/ListaQuimicoComponent.vue').default)
Vue.component('listar-firmas', require('./components/ListaFirmasComponent.vue').default)
Vue.component('crear-licitacion', require('./components/CrearLicitacionComponent.vue').default)
Vue.component('visorviaticos-doc', require('./components/visorArchivosviaticosComponent.vue').default)
Vue.component('add-productos', require('./components/AddProductosComponent.vue').default)
Vue.component('add-proveedor', require('./components/AddProvveedorComponent.vue').default)
Vue.component('add-cuentas', require('./components/CuentassigfeComponent.vue').default)
Vue.component('liberar-cpp', require('./components/LiberarCppComponent.vue').default)



Vue.component('VDropdown', Dropdown)
Vue.component('VTooltip', Tooltip)
Vue.component('VMenu', Menu)
Vue.component('qr-code', VueQRCodeComponent)




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
  
  
const app = new Vue({
    el: '#app',
    delimiters: ['${', '}']
});
