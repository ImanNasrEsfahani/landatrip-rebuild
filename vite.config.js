import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from '@rollup/plugin-inject';
import react from '@vitejs/plugin-react';

export default defineConfig({
        plugins: [
            inject({
                include: ['**/*.{js,jsx,ts,tsx}'],
                $: 'jquery', jQuery: 'jquery', 'window.jQuery': 'jquery'
            }),
            laravel({
                input: [
                    'resources/js/public.js',
                    'resources/js/react-public.js',
                    'resources/scss/material-public.scss',
                    'resources/js/material-public.js',
                    'resources/scss/public.scss',
                    'resources/js/admin-panel.js',
                    'resources/js/manager-panel.js',
                    'resources/js/teacher-panel.js',
                    'resources/js/agent-panel.js',
                    'resources/js/user-panel.js',
                    'resources/js/app.jsx',
                    'resources/scss/user-panel.scss'
                ],
                ssr: 'resources/js/ssr.jsx',
                refresh: true,
            }),
            react(),
        ],
        build: {},
    }
);

