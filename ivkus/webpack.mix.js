const mix = require('laravel-mix');

	//web
mix.js('resources/js/app.js', 'public/js')
    .js('resources/assets/js/main.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/main.scss', 'public/css')
	//admin
	.js('resources/js/app-admin.js', 'public/js')
    .js('resources/assets/js/main-admin.js', 'public/js')
    .js('resources/assets/js/cms/receipt/receipt.js', 'public/js')
    .js('resources/assets/js/cms/menu/menu.js', 'public/js')
    .js('resources/assets/js/cms/create-filter/create-filter.js', 'public/js')
    .js('resources/assets/js/cms/advice/advice.js', 'public/js')
    .js('resources/assets/js/general.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/mainStyle.scss', 'public/css')
    .sourceMaps();
