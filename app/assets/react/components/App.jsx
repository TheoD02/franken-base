import * as React from 'react'
import { SaasProvider, ModalsProvider } from '@saas-ui/react'
import Hello from "./Hello";

function App({ children }) {
    // 2. Use at the root of your app
    return (
        <SaasProvider>
            <ModalsProvider><Hello/></ModalsProvider>
        </SaasProvider>
    )
}

export default App