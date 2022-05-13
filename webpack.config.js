/**
 * Webpack configuration file
 *
 * @package
 */

const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CssMinimizerPlugin = require( 'css-minimizer-webpack-plugin' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );

module.exports = {
	entry: {
		style: path.resolve( __dirname, './src/sass/style.sass' ),
		scripts: path.resolve( __dirname, './src/js/scripts.js' ),
	},
	mode: 'production',
	output: {
		path: path.resolve( __dirname, './dist/' ),
		filename: '[name].min.js'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: 'babel-loader'
				}
			},
			{
				test: /\.sass$/,
				use: [
					{
						loader: MiniCssExtractPlugin.loader
					},
					{
						loader: 'css-loader',
					},
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									'postcss-preset-env',
									'cssnano',
									'autoprefixer'
								],
							},
						},
					},
					{
						loader: 'sass-loader',
					}
				]
			},
		]
	},
	resolve: {
		extensions: [
			'.js'
		]
	},
	plugins: [
		new RemoveEmptyScriptsPlugin(),
		new MiniCssExtractPlugin( {
			filename: '[name].css'
		} ),
	],
	optimization: {
		minimizer: [
			`...`,
			new CssMinimizerPlugin(),
		],
	}
};
