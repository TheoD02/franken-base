import {Menu, Button, Text, rem} from '@mantine/core';
import {
    IconDoorExit,
    IconTrash,
} from '@tabler/icons-react';
import {useAuth} from "../../../contexts/auth-context.tsx";

export default function UserMenu() {
    const {user, logout, isInteracting: isUserInteractWithAuth} = useAuth();

    return (
        <Menu shadow="md" width={200}>
            <Menu.Target>
                <Button disabled={isUserInteractWithAuth}>Mon compte</Button>
            </Menu.Target>

            <Menu.Dropdown>
                <Menu.Label>Connecté en tant que {user?.username || 'N/A'}</Menu.Label>
                <Menu.Divider/>
                <Menu.Item
                    color="red"
                    leftSection={<IconDoorExit style={{width: rem(14), height: rem(14)}}/>}
                    onClick={logout}
                >
                    Déconnexion
                </Menu.Item>
            </Menu.Dropdown>
        </Menu>
    );
}