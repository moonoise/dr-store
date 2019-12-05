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

mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');

mix.js('node_modules/bootstrap-fileinput/js/fileinput.min.js','public/js')
    .sass('node_modules/bootstrap-fileinput/scss/fileinput.scss','public/css')
    .js('node_modules/bootstrap-fileinput/themes/fa/theme.min.js','public/js')
    .js('node_modules/bootstrap-fileinput/js/locales/th.js','public/js')
    .js('node_modules/popper.js/dist/popper.min.js','public/js');

