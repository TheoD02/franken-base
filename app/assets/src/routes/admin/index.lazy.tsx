import {createFileRoute, Outlet} from "@tanstack/react-router";

export const Route = createFileRoute('/admin/')({
    component: () => (
        <div>
            <div>routes/admin/index.lazy.tsx</div>
        </div>
    ),
});