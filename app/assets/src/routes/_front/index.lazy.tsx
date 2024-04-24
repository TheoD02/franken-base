import {createLazyFileRoute} from "@tanstack/react-router";
import {useEffect, useState} from "react";

function Home() {
    const [data, setData] = useState(null);

    useEffect(() => {
        fetch('https://jsonplaceholder.typicode.com/todos/1')
            .then(res => res.json())
            .then(data => setData(data));
    }, []);

    return (
        <div>
            <h1>Home</h1>
            {data ? <pre>{JSON.stringify(data, null, 2)}</pre> : <p>Loading...</p>}
        </div>
    );
}

export const Route = createLazyFileRoute('/_front/')({
    component: () => <Home/>,
});
