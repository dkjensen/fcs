/**
 * Laravel Mix configuration file.
 */

// Import required packages.
const mix = require('laravel-mix');

if (process.env.sync) {
	const bs = require('browser-sync').create();

	bs.init({
		notify: false,
		proxy: process.env.MIX_PROXY,
		port: process.env.MIX_PORT,
		files: [
			'assets/**/.js',
			'assets/**/.css',
			'patterns/*',
			'parts/*',
			'templates/*',
			'functions.php',
			'*.css',
		],
	});
}

/*
 * Sets the development path to assets.
 */
const devPath = 'resources';
const distPath = 'assets';

/*
 * Sets the path to the generated assets.
 */
mix.setPublicPath('./');

mix.version();

mix.ts(`${devPath}/js/main.ts`, `${distPath}/js`);

mix.sass(`${devPath}/scss/main.scss`, `${distPath}/css`);

mix.webpackConfig({
	stats: 'minimal',
	devtool: process.env.NODE_ENV === 'production' ? false : 'eval',
	performance: { hints: false },
});
