const mix = require('laravel-mix');
const webpack = require('webpack');

mix.js('resources/js/app.js', 'public/js')
    .vue({
        version: 3,
        runtimeOnly: false
    })
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
                __VUE_OPTIONS_API__: true,
            })
        ]
    })
    .postCss('resources/css/app.css', 'public/css', []);
