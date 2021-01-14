let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')  //source-> destination
   .js('resources/assets/js/Appointment/appoint-vue-start.js', 'public/js/Appointment')  //source-> destination
/*  
   .js('resources/assets/js/wpress_blog.js', 'public/js')
   .js('resources/assets/js/test-rest/test-rest.js', 'public/js/test-rest') //test-rest JS
   .sass('resources/assets/sass/app.scss', 'public/css') //SAAS
   .styles([                                      //for pure CSS
        'resources/assets/css/my_css.css',
        //'public/css/vendor/videojs.css'
          ], 'public/css/my_css.css') */;   //final output to folder 
