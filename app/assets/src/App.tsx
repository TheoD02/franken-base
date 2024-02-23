import React, {useState} from 'react'
import {AppShell, Burger, Button, Combobox} from "@mantine/core";
import {useDisclosure} from "@mantine/hooks";
import {Header} from "./components/Header/Header";

function App() {
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

            <AppShell.Main>Main</AppShell.Main>
        </AppShell>
    )
}

export default App
