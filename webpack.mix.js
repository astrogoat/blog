let mix = require('laravel-mix');

mix.postCss('resources/css/blog.css', 'public/css', [require("tailwindcss")])
