import {flexRender, getCoreRowModel, useReactTable} from "@tanstack/react-table";
import {useQuery} from "@tanstack/react-query";
import {Table} from "@mantine/core";


export function Welcome() {
    const {isPending, error, data} = useQuery({
        queryKey: ['ressources'],
        queryFn: () => {
            return fetch('/api/resources').then((res) => res.json());
        }
    });


    return (
        <Table>
            <Table.Thead>
                <Table.Tr>
                    <Table.Th>
                        ID
                    </Table.Th>
                </Table.Tr>
            </Table.Thead>
            <Table.Tbody>
                {isPending && <Table.Tr>Loading...</Table.Tr>}
                {error && <Table.Tr>Error: {error.message}</Table.Tr>}
                {data && data['hydra:member'].map(
                    (row: any) => (
                        <Table.Tr key={row.id}>
                            <Table.Td>{row.id}</Table.Td>
                        </Table.Tr>
                    ))
                }
            </Table.Tbody>
        </Table>
    );
}
