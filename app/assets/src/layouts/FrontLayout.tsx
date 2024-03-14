import {AppShell} from "@mantine/core";
import {Header} from "../components/Header/Header";
import React from "react";
import {Outlet} from "@tanstack/react-router";
import {NotFoundPage} from "../pages/NotFound/NotFoundPage";

export default function FrontLayout({isNotFound}) {
    return (
        <AppShell
            header={{height: 60}}
            padding="md"
        >
            <AppShell.Header>
                <Header/>
            </AppShell.Header>

            <AppShell.Main>
                {isNotFound ? <NotFoundPage/> : <Outlet/>}
            </AppShell.Main>
        </AppShell>
    )
}