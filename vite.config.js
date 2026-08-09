import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { glob } from 'glob'; // Bawaan Node.js untuk mendeteksi pola file

// Otomatis cari semua file .js di dalam resources/js dan sub-foldernya
const jsFiles = glob.sync('resources/js/**/*.js');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Tetap masukkan CSS utama
                ...jsFiles,               // Masukkan semua file JS secara otomatis
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
