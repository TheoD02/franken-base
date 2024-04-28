import React from 'react'
import ReactDOM from 'react-dom/client'
import '@mantine/core/styles.css';
import '@mantine/notifications/styles.css';
import {MantineProvider,} from "@mantine/core";
import {createRouter, RouterProvider,} from '@tanstack/react-router'

// Import the generated route tree
import {routeTree} from './routeTree.gen'
import {Notifications} from "@mantine/notifications";
import {QueryClient, QueryClientProvider} from "@tanstack/react-query";

const router = createRouter({routeTree})

// Register the router instance for type safety
declare module '@tanstack/react-router' {
    interface Register {
        router: typeof router
    }
}

const queryClient = new QueryClient();

ReactDOM.createRoot(document.getElementById('root')!).render(
    <React.StrictMode>
        <MantineProvider>
            <QueryClientProvider client={queryClient}>
                <Notifications position="top-center"/>
                <RouterProvider router={router}/>
        </QueryClientProvider>
        </MantineProvider>
    </React.StrictMode>
)
