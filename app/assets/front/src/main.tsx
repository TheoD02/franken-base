import React, {Suspense} from "react";
import ReactDOM from "react-dom/client";
import '@mantine/core/styles.css';


// Import the generated route tree
import {routeTree} from './routeTree.gen'
import {createRouter, RouterProvider} from "@tanstack/react-router";

// Create a new router instance
const router = createRouter({ routeTree })

// Register the router instance for type safety
declare module '@tanstack/react-router' {
    interface Register {
        router: typeof router
    }
}


const rootElement = document.getElementById("root");

if (!rootElement.innerHTML) {
    const root = ReactDOM.createRoot(rootElement);

    root.render(
        <Suspense fallback={<div>Loading...</div>}>
            <RouterProvider router={router}/>
        </Suspense>
    )
}