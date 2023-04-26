"use strict";

module.exports = function (grunt) {

    // We need to include the core Moodle grunt file too, otherwise we can't run tasks like "amd".
    require("grunt-load-gruntfile")(grunt);
    grunt.loadGruntfile("../../Gruntfile.js");

    // Load all grunt tasks.
    grunt.loadNpmTasks("grunt-contrib-less");
    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-contrib-clean");
    grunt.loadNpmTasks("grunt-contrib-uglify");

    grunt.initConfig({
        watch: {
            // If any .less file changes in directory "less" then run the "less" task.
            files: "amd/src/*.js",
            tasks: ["uglify"]
        },
        uglify: {
            options: {
                sourceMap: function(path) { return path.replace(/.js/,".map")} 
            },
            build: {
                files: {
                    'amd/build/vplutil.min.js':'amd/src/vplutil.js'
                }
            },
            vplide: {
                src: 'amd/src/vplide.js',
                dest: 'amd/build/vplide.min.js',
                options: {
                    banner: 'function _typeof(obj){return _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(obj){return typeof obj}:function(obj){return obj&&"function"==typeof Symbol&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj},_typeof(obj)}',
                    sourceMap: function(path) { return path.replace(/.js/,".map")} 
               },
            },
        }
        }
    );
    // The default task (running "grunt" in console).
    grunt.registerTask("default", ["uglify"]);
};