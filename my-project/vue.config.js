const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: '/vuetify',
  pluginOptions: {
    vuetify: {
			// https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vuetify-loader
		}
  },
  chainWebpack: (config) => {
    config.plugin('html').tap((args) => {
      args[0].minify = false;
      return args;
    });
  }
})
