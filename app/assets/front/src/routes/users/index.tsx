import {createFileRoute, redirect} from "@tanstack/react-router";
import {Box, Text} from "@mantine/core";
import {useQuery} from "@tanstack/react-query";
import {useMemo} from "react";
import {MantineReactTable, MRT_ColumnDef, useMantineReactTable} from "mantine-react-table";

export const Route = createFileRoute('/users/')({
    component: ResourceList,
})

type User = {
    id: number
    email: string
    roles: string[]
    password: string
    userIdentifier: string
}

function ResourceList() {
    const {isPending, data} = useQuery({
        queryKey: ['users'],
        queryFn: async () => {
            const response = await fetch('/api/users')
            return response.json()
        }
    });

    const columns = useMemo<MRT_ColumnDef<User>[]>(
        () => [
            {
                accessorKey: 'id',
                header: 'ID',
            },
            {
                accessorKey: 'email',
                header: 'Email',
            },
            {
                accessorKey: 'roles',
                header: 'Roles',
            },

        ],
        []
    );

    const resources: User[] = data ? data['hydra:member'] : [];
    console.log(resources);
    const table = useMantineReactTable({
        columns,
        data: resources,
        state: {isLoading: isPending},
    });

    return <MantineReactTable table={table}/>;
}