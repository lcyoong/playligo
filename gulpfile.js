var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.publicDir = 'public';

elixir(function(mix) {
    // mix.sass('app.scss');
    // mix.sass('app_teaser.scss');
    mix.sass(['app.scss', 'app_teaser.scss']);
    // mix.sass('app_teaser.scss');
    mix.version('public/css/app.css');
    // mix.sass('app_teaser.scss').version('public/css/app_teaser.css');
});
