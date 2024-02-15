import {defineConfig} from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import reactPlugin from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        reactPlugin(),
        symfonyPlugin({
            stimulus: true,
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                app: "./assets/app.js"
            },
        }
    }, server: {
        watch: {
            usePolling: true,
        },
        host: true,
        port: 5173,
        strictPort: true,
        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 5173,
            clientPort: 5173,
        },
    },
});
