import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import react from '@vitejs/plugin-react';
//import react from '@vitejs/plugin-react-swc'

export default defineConfig({
    plugins: [
        react(),
        symfonyPlugin(),
    ],
    build: {
        rollupOptions: {
            input: {
                app: "./assets/src/main.tsx",
            },
        }
    },
    server: {
        watch: {
            usePolling: true,
        },
        host: true,
        port: 3150,
        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 3150,
            clientPort: 3150,
        },
    },
});
