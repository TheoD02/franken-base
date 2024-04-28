import {createLazyFileRoute} from "@tanstack/react-router";

export const Route = createLazyFileRoute('/_front/')({
    component: () => <div>routes/_front.lazy.tsx</div>,
});