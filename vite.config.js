import { defineConfig } from 'vite'; // Pastikan baris ini ada di paling atas
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/login.css',
                'resources/css/backend-app.css', // Tambahkan ini jika belum ada
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});