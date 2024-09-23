import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/main.scss','resources/js/app.js', 'resources/js/burger.js', 'resources/js/activity.js', 'resources/js/slider.js'],
            refresh: true,
        }),
    ],
});
