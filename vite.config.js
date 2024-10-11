import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',

                'resources/js/bootstrap.js',
                'resources/js/burger.js',
                'resources/js/dashboard.js',
                'resources/js/form.js',

                'resources/js/sliders.js',

            ],
            refresh: true,
        }),
    ],
});
