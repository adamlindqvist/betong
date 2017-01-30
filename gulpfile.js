var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Betong application. By default, we are compiling the Sass
 | file for our application, as well as initiate browserify.
 |
 */

// Set assets path
elixir.config.publicPath = 'public/application/themes/betong/assets';

elixir(function (mix) {
    mix.sass('app.scss');
    mix.browserify('app.js');

    // mix.browserSync({
    //     proxy: 'betong.dev'
    // });
});
