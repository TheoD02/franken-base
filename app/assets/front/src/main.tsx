import React, {Suspense} from "react";
import ReactDOM from "react-dom/client";
import {createRouter, RouterProvider} from "@tanstack/react-router";
import {routeTree} from "./routeTree.gen.ts";
import {theme} from "./theme.ts";
import {QueryClient, QueryClientProvider} from "@tanstack/react-query";
import {LoadingOverlay, MantineProvider} from "@mantine/core";
import {ModalsProvider} from "@mantine/modals";
import '@mantine/core/styles.css';
import '@mantine/notifications/styles.css';
import {Notifications} from "@mantine/notifications";
import {AuthProvider, useAuth} from "./contexts/auth-context.tsx";

// Set up a Router instance
const router = createRouter({
    routeTree,
    defaultPreload: 'intent',
})

// Register things for typesafety
declare module '@tanstack/react-router' {
    interface Register {
        router: typeof router
    }
}

const defaultQueryFn = async ({queryKey}) => {
    const response = await fetch(`/api/${queryKey.join('/')}`);
    return response.json();
}

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            queryFn: defaultQueryFn
        }
    }
});

const rootElement = document.getElementById('root')!

if (!rootElement.innerHTML) {
    const root = ReactDOM.createRoot(rootElement)
    root.render(
        <Suspense fallback={<LoadingOverlay visible={true}/>}>
            <QueryClientProvider client={queryClient}>
                <MantineProvider theme={theme}>
                    <AuthProvider>

                        <ModalsProvider>
                            <Notifications position={'top-center'}/>
                            <RouterProvider router={router}/>
                        </ModalsProvider>
                    </AuthProvider>
                </MantineProvider>
            </QueryClientProvider>
        </Suspense>
    )
}
