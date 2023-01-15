import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/css/nucleo-icons.css',
                'resources/assets/css/blk-design-system.css?v=1.0.0',
                'resources/assets/demo/demo.css',

                'resources/js/app.js',
                'resources/assets/js/core/jquery.min.js',
                'resources/assets/js/core/popper.min.js',
                'resources/assets/js/core/bootstrap.min.js',
                'resources/assets/js/plugins/perfect-scrollbar.jquery.min.js',
                'resources/assets/js/plugins/bootstrap-switch.js',
                'resources/assets/js/plugins/nouislider.min.js',
                'resources/assets/js/plugins/chartjs.min.js',
                'resources/assets/js/plugins/moment.min.js',
                'resources/assets/js/plugins/bootstrap-datetimepicker.js',
                'resources/assets/demo/demo.js',
                'resources/assets/js/blk-design-system.min.js?v=1.0.0'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
