import {defineConfig} from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import react from '@vitejs/plugin-react';
import {vanillaExtractPlugin} from "@vanilla-extract/vite-plugin";
import {TanStackRouterVite} from "@tanstack/router-vite-plugin";

export default defineConfig({
    plugins: [
        react(),
        symfonyPlugin(),
        vanillaExtractPlugin(),
        TanStackRouterVite({
            routesDirectory: "./assets/front/src/routes",
            generatedRouteTree: "./assets/front/src/routeTree.gen.ts",
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                app: './assets/front/src/main.tsx'
            },
        }
    },
    server: {
        watch: {
            usePolling: true,
        },
        host: true,
        port: 3100,
        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 3100,
            clientPort: 3100,
        },
    },
});
