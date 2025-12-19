import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',
                '@': '/resources/js',
                'vue': 'vue/dist/vue.esm-bundler.js'
            },
        ],
        // alias: {
        //     '@': '/resources/js',
        //     'vue': 'vue/dist/vue.esm-bundler.js'
        // },
    },
});
