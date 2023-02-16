const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */



 mix.js('resources/js/app.js', 'public/js')
 .sass('resources/sass/app.scss', 'public/css');
 mix.styles([
 	 'resources/vendor/fontawesome-free/css/all.min.css',     
    'resources/css/admin/sb-admin-2.min.css'     
    ],'public/css/adminlibs.css');


 mix.scripts([
       
    'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'resources/vendor/jquery-easing/jquery.easing.min.js',  
    'resources/js/annyang.min.js',
    'resources/js/admin/sb-admin-2.min.js', 
    ], 'public/js/adminlibs.js');


