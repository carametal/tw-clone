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

mix.react('resources/js/app.js', 'public/js')
    .react('resources/js/userapp.js', 'public/js')
    .react('resources/js/user-profile.js', 'public/js')
    .react('resources/js/userlist.js', 'public/js')
    .react('resources/js/follow-list.js', 'public/js')
    .react('resources/js/follower-list.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
