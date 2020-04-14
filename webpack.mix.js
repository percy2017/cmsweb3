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
require('laravel-mix-merge-manifest');
mix.mergeManifest();

mix.react('resources/js/app.js', 'public/js')
   .react('resources/js/websocket.js', 'public/js')
   .react('resources/js/inti/inti.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
