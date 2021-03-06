let mix = require('laravel-mix');

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
    output: {
        path: path.resolve(__dirname, './public/dist'),
        publicPath: '/dist/',
        filename: '[name].js',
        chunkFilename: "chunks/[name].js"
//        chunkFilename: "chunks/[name]-[hash:8].js"
    },
    module: {
        rules:[
            {
                test: /\.(woff2?|ttf|eot|svg|otf)$/,
                loader: 'file-loader',
                options: {
                    name: path => {
                        if (! /node_modules|bower_components/.test(path)) {
                            return 'fonts/[name].[ext]?[hash]';
                        }

                        return 'fonts/vendor/' + path
                            .replace(/\\/g, '/')
                            .replace(
                                /((.*(node_modules|bower_components))|fonts|font|assets)\//g, ''
                            ) + '?[hash]';
                    },
                }
            }
        ]
    },
});

mix.js('resources/assets/js/app.js', 'js')
    .extract(["vue", "element-ui", "vue-router"])
    .copy('resources/assets/library/css','public/dist/css')
    .copy('resources/assets/library/fonts','public/dist/fonts')
    .copy('resources/assets/library/element-theme','public/dist/element-theme')
    .copy('resources/assets/library/img','public/dist/img')
    .copy('resources/assets/library/summernote-master','public/dist/summernote-master')
    .copy('resources/assets/library/bootstrap-3.3.7','public/dist/bootstrap-3.3.7')
    .copy('resources/assets/sass/app.css', 'public/dist/css')
    .copy('resources/assets/library/js/', 'public/dist/js');

