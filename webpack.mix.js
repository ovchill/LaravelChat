const mix = require('laravel-mix');
const webpack = require('webpack');
const {resolve} = require("node:path");

mix.ts('resources/js/app.ts', 'public/js')
    .vue({
        version: 3,
        runtimeOnly: false
    })
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: 'ts-loader',
                    exclude: /node_modules/,
                    options: {
                        appendTsSuffixTo: [/\.vue$/],
                    }
                }
            ]
        },
        resolve: {
            extensions: ['.ts', '.tsx', '.js', '.jsx', '.vue'],
            alias: {
                '@': resolve(__dirname, 'resources/js'),
                'vue$': 'vue/dist/vue.esm-bundler.js'
            }
        },
        plugins: [
            new webpack.DefinePlugin({
                __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
                __VUE_OPTIONS_API__: true,
            })
        ]
    })
    .postCss('resources/css/app.css', 'public/css', []);
