
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

mix.webpackConfig({
    resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
        '@': __dirname + '/resources/js'
      },
    },
});

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app/app.scss', 'public/css')
  .sass('resources/sass/store/store.scss', 'public/css');
  mix.options({
    hmrOptions: {
        host: 'localhost',  // site's host name
        port: 8080,
    }
});

// // fix css files 404 issue
mix.webpackConfig({
    // add any webpack dev server config here
    devServer: { 
        proxy: {
            host: '0.0.0.0',  // host machine ip 
            port: 8080,
        },
        watchOptions:{
            aggregateTimeout:200,
            poll:5000
        },

    }
});