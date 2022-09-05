const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts')

const entryBlocks = {}

module.exports = {
  entry: Object.assign({
    app: './src/js/app.js',
    main: './src/scss/app.scss',
  }, entryBlocks),
  output: {
    path: path.resolve(__dirname),
    filename: 'js/[name].min.js',
    pathinfo: false,
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              filename: 'js/[name].min.js',
              exclude: '/node_modules/',
            },
          }],
      },
      {
        test: /\.s?css$/,
        use: [
          MiniCssExtractPlugin.loader, {
            loader: 'css-loader',
            options: {
              url: false,
            },
          }, 'postcss-loader', 'sass-loader'],
      },
      {
        test: /\.(ico|jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2)(\?.*)?$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[path][name].[ext]',
          },
        },
      },

    ],
  },
  plugins: [
    new RemoveEmptyScriptsPlugin({}),
    new MiniCssExtractPlugin({
      filename: 'css/[name].min.css',
    }),
  ],
}