const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.react(__dirname + '/Resources/assets/js/app.js', 'js/inti.js')
    // .sass( __dirname + '/Resources/assets/sass/app.scss', 'css/inti.css');

if (mix.inProduction()) {
    mix.version();
}