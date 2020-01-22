const pkg = require('./package.json');
const path = require("path")

module.exports = {
	// Project Identity
	appName: 'workanaQualifications', // Unique name of your project
	type: 'plugin', // Plugin or theme
	slug: 'workana-qualifications', // Plugin or Theme slug, basically the directory name under `wp-content/<themes|plugins>`
	// Used to generate banners on top of compiled stuff
	bannerConfig: {
		name: 'workanaQualifications',
		author: 'Douglas Fanucchi',
		license: 'UNLICENSED',
		link: 'UNLICENSED',
		version: pkg.version,
		copyrightText:
			'This software is released under the UNLICENSED License\nhttps://opensource.org/licenses/UNLICENSED',
		credit: true,
	},
	// Files we need to compile, and where to put
	files: [
		{
			name: "fnwq-js",
			entry: {
				app: [path.resolve(__dirname, "src", "js", "app.js")]
			}
		},
		{
			name: "fnwq-admin-js",
			entry: {
				admin: [path.resolve(__dirname, "src", "js", "admin.js")]
			}
		},
		{
			name: "fnwq-css",
			entry: {
				app: [path.resolve(__dirname, "src", "scss", "app.scss")]
			}
		},
		{
			name: "fnwq-admin-css",
			entry: {
				admin: [path.resolve(__dirname, "src", "scss", "admin.scss")]
			}
		}
	],
	// Output path relative to the context directory
	// We need relative path here, else, we can not map to publicPath
	outputPath: 'dist',
	// Project specific config
	// Needs react(jsx)?
	hasReact: true,
	// Needs sass?
	hasSass: true,
	// Needs less?
	hasLess: false,
	// Needs flowtype?
	hasFlow: false,
	// Externals
	// <https://webpack.js.org/configuration/externals/>
	externals: {
		jquery: 'jQuery',
	},
	// Webpack Aliases
	// <https://webpack.js.org/configuration/resolve/#resolve-alias>
	alias: undefined,
	// Show overlay on development
	errorOverlay: true,
	// Auto optimization by webpack
	// Split all common chunks with default config
	// <https://webpack.js.org/plugins/split-chunks-plugin/#optimization-splitchunks>
	// Won't hurt because we use PHP to automate loading
	optimizeSplitChunks: true,
	// Usually PHP and other files to watch and reload when changed
	watch: './inc|includes/**/*.php',
	// Files that you want to copy to your ultimate theme/plugin package
	// Supports glob matching from minimatch
	// @link <https://github.com/isaacs/minimatch#usage>
	packageFiles: [
		'inc/**',
		'vendor/**',
		'dist/**',
		'*.php',
		'*.md',
		'readme.txt',
		'languages/**',
		'layouts/**',
		'LICENSE',
		'*.css',
	],
	// Path to package directory, relative to the root
	packageDirPath: 'package',
};
