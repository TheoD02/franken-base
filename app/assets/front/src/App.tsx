import "@mantine/core/styles.css";
import {MantineProvider} from "@mantine/core";
import {theme} from "./theme";
import {Welcome} from "./Welcome/Welcome";
import {ColorSchemeToggle} from "./ColorSchemeToggle/ColorSchemeToggle";
import {ModalsProvider} from "@mantine/modals";
import {QueryClient, QueryClientProvider} from "@tanstack/react-query";

const queryClient = new QueryClient();

export default function App() {
    return (
        <QueryClientProvider client={queryClient}>
            <MantineProvider theme={theme}>
                <ModalsProvider>
                    <Welcome/>
                    <ColorSchemeToggle/>
                </ModalsProvider>
            </MantineProvider>
        </QueryClientProvider>
    );
}
