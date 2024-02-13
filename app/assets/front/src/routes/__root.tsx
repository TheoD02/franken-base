import {createRootRoute, Link, Outlet,} from '@tanstack/react-router'
import {TanStackRouterDevtools} from '@tanstack/router-devtools'
import {Navbar} from "../components/Layout/Navbar/Navbar.tsx";
import React from "react";

export const Route = createRootRoute({
    component: RootComponent,
})

function RootComponent() {
    return (
        <>
            <Navbar/>
            <Outlet/>
            <TanStackRouterDevtools/>
        </>
    )
}