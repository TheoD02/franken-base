import React from 'react'
import ReactDOM from 'react-dom/client'
import '@mantine/core/styles.css';
import {MantineProvider,} from "@mantine/core";
import {RouterProvider, createRouter, CatchNotFound,} from '@tanstack/react-router'

// Import the generated route tree
import {routeTree} from './routeTree.gen'

const router = createRouter({routeTree})

// Register the router instance for type safety
declare module '@tanstack/react-router' {
    interface Register {
        router: typeof router
    }
}

ReactDOM.createRoot(document.getElementById('root')!).render(
    <React.StrictMode>
        <MantineProvider>
            <RouterProvider router={router}/>
        </MantineProvider>
    </React.StrictMode>
)
