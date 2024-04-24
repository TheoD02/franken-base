import {CatchNotFound, createRootRoute, notFound, Outlet,} from '@tanstack/react-router'
import React from "react";
import {TanStackRouterDevtools} from "@tanstack/router-devtools";
import AdminLayout from "../layouts/AdminLayout";
import FrontLayout from "../layouts/FrontLayout";

export const Route = createRootRoute({
    component: Outlet,
    notFoundComponent: () => {
        if (window.location.pathname.startsWith('/admin')) {
            return <>
                <AdminLayout isNotFound/>
                <TanStackRouterDevtools />
            </>
        }

        return <>
            <FrontLayout isNotFound/>
            <TanStackRouterDevtools />
        </>
    }
})
