var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // mix.sass('app.scss')
    	// .version('css/app.css'); 
    	// for busting the cache
    	// lets user know everytime the css is modified
        
    mix.styles([
        'style.css',
        'simple-sidebar.css',
        'loading-bar.css',
        'materialize.css',
        'material-icon.css'
    ], 'public/css/site.css')
    .version('public/css/site.css');


    // mix.scripts([
    //     'app.js'
    // ], 'public/js/app/site.js')
    // .version('public/js/app/site.js');
});
