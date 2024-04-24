import React, {Suspense, useEffect, useState} from 'react'
import ReactDOM from 'react-dom/client'
import '@mantine/core/styles.css';
import {Box, Loader, MantineProvider,} from "@mantine/core";
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

function SplashScreen() {
    return (
        <div style={{display: "flex", justifyContent: "center", alignItems: "center", height: "100vh"}}>
            <Loader color="blue"/>
        </div>
    );
}

function RootApp() {
    const [showSplashScreen, setShowSplashScreen] = useState(true);

    useEffect(() => {
        /*
        Since the `useNavigation()` hook is not available outside `<RouterProvider />`,
        this component won't re-render automatically when the navigation state changes.
        So we set up an interval that will keep checking whether the navigation state
        within `router` has changed.
        */
        const splashScreenInterval = setInterval(
            () => {
                /*
                Normally, we'd be able to reference `navigation.state` directly using
                `useNavigation()`. But since we are outside `<RouterProvider />`,
                we only have the `router` object to provide us with the navigation state.
                */
                const navState = router.__store.state.status;

                /*
                When the page loads initially or on reload, navState will be "loading".
                This is when we'll show the Splash Screen.
                Once the `loader()` has completed its processing i.e. once the data is
                fetched from the API, `navState` will change from "loading" to "idle".
                This is when we'll hide the Splash Screen and render the actual page.
                */
                if (navState === "idle" && router.state.isLoading === false && router.state.isTransitioning === false) {
                    // Hide the splash screen.
                    setShowSplashScreen(false);
                    clearInterval(splashScreenInterval)
                }
            }, 100);

        // cleanup in case of component unmount
        () => clearInterval(splashScreenInterval);
    }, []);

    return (
        <React.StrictMode>
            <MantineProvider>
                {showSplashScreen ? <SplashScreen/> : <RouterProvider router={router}/>}
            </MantineProvider>
        </React.StrictMode>
    );
}

ReactDOM.createRoot(document.getElementById('root')!).render(<RootApp/>);
