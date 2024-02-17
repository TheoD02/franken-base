import React from "react";
import {AppShell, MantineProvider, rem} from "@mantine/core";
import {useDisclosure} from "@mantine/hooks";
import Header from "./components/Header/Header.tsx";
import Navbar from "./components/Navbar/Navbar.tsx";


export default function App({children}) {
    const [openedCollapsed, {toggle: toggleCollapsed}] = useDisclosure(true);

    return (
        <MantineProvider>
            <AppShell
                disabled={false}
                transitionDuration={500}
                header={{height: 70}}
                navbar={{
                    width: 300,
                    breakpoint: "lg",
                    collapsed: {mobile: !openedCollapsed, tablet: !openedCollapsed, desktop: !openedCollapsed},
                }}
            >
                <AppShell.Header>
                    <Header toggleCollapsed={toggleCollapsed}/>
                </AppShell.Header>

                <AppShell.Navbar>
                    <Navbar/>
                    {/*<AppShell.Section>Navbar header</AppShell.Section>
                    <AppShell.Section grow component={ScrollArea}>
                        Navbar main section, it will
                    </AppShell.Section>
                    <AppShell.Section>
                        Navbar footer – always at the bottom
                    </AppShell.Section>*/}
                </AppShell.Navbar>

                <AppShell.Main
                    pt={`calc(${rem(60)} + var(--mantine-spacing-md))`}
                    px={`calc(${rem(300)} + var(--mantine-spacing-md))`}
                    pr={15}
                >
                    {children}
                </AppShell.Main>

                {/*<AppShell.Aside>
                    <div>Aside</div>
                </AppShell.Aside>*/}
            </AppShell>
        </MantineProvider>
    );
}