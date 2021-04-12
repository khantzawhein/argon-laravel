const mix = require('laravel-mix');
const path = require('path')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/build/js')
    .postCss('resources/css/app.css', 'public/build/css', [
        require('postcss-import'),
    ])
    .sass('resources/scss/argon.scss', 'public/build/css')
    .vue({version: 2})
    .version()
    .extract()
    .disableNotifications();

if (!mix.inProduction()) {
    mix.sourceMaps()
}


mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '~': path.join(__dirname, './resources/js')
        }
    },
})
