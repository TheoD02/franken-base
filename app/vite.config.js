import {defineConfig} from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import { vanillaExtractPlugin } from "@vanilla-extract/vite-plugin";

/* if you're using React */
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        symfonyPlugin(),
        vanillaExtractPlugin(),
    ],
    build: {
        rollupOptions: {
            input: {
                app: "./assets/front/src/main.tsx"
            },
        }
    },
    server: {
        watch: {
            usePolling: true,
        },
        host: true,
        port: 3030,
        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 3030,
            clientPort: 3030,
        },
    },
});
