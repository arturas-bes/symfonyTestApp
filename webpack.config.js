var Encore = require('@symfony/webpack-encore');

Encore
 .setOutputPath('public/build/')
 .setPublicPath('/build')
 .addEntry('js/custom', './build/js/custom.js')
 .addStyleEntry('css/custom', ['./build/css/custom.css'])
// we dont have to call jqeary if we use this but this wroks just on binded js files
 .autoProvidejQuery()


;

module.exports = Encore.getWebpackConfig();