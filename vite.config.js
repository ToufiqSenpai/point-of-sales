import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { globSync } from 'glob'

export default defineConfig({
    plugins: [
        laravel({
            input: [...globSync('resources/ts/script/**/*.ts'), 'resources/css/app.css'],
            refresh: true,
        }),
    ],
});
