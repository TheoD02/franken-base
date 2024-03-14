import {useDisclosure} from "@mantine/hooks";
import {AppShell} from "@mantine/core";
import {Header} from "../components/Header/Header";
import React from "react";
import {Outlet} from "@tanstack/react-router";
import {NotFoundPage} from "../pages/NotFound/NotFoundPage";

export default function AdminLayout({isNotFound}) {
    const [opened, {toggle}] = useDisclosure();

    return (
        <AppShell
            header={{height: 60}}
            navbar={{
                width: 300,
                breakpoint: 'sm',
                collapsed: {mobile: !opened},
            }}
            padding="md"
        >
            <AppShell.Header>
                <Header/>
            </AppShell.Header>

            <AppShell.Navbar p="md">Navbar</AppShell.Navbar>

            <AppShell.Main>
                {isNotFound ? <NotFoundPage/> : <Outlet/>}
            </AppShell.Main>
        </AppShell>
    )
}