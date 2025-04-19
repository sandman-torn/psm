import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import vueDevTools from 'vite-plugin-vue-devtools'
import { resolve } from 'path';


// https://vite.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueJsx(),
    vueDevTools(),
  ],
  resolve: {
    //alias: {
    //  '@': fileURLToPath(new URL('./src', import.meta.url))
    alias: {
      '@': resolve(__dirname, './src'),
    },
  },
  server: {
    host: 'psm-b.test',
  },
})
