import {createFileRoute, createLazyFileRoute} from "@tanstack/react-router";
import {Hero} from "../components/Home/Hero/Hero.tsx";
import {Features} from "../components/Home/Feature/Features.tsx";
import {Tools} from "../components/Home/Tools/Tools.tsx";
import {Stats} from "../components/Home/Stats/Stats.tsx";
import {Box} from "@mantine/core";

export const Route = createFileRoute('/')({
    component: HomeComponent,
})

function HomeComponent() {
    return (
        <Box>
            <Hero/>
            <Features/>
            <Tools/>
            <Stats/>
        </Box>
    )
}