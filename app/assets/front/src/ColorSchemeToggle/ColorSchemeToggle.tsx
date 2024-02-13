import {ActionIcon, Button, Group, rem, useMantineColorScheme} from '@mantine/core';
import {IconMoon, IconSun} from "@tabler/icons-react";

export function ColorSchemeToggle() {
    const {colorScheme, setColorScheme} = useMantineColorScheme();

    return (
        <ActionIcon
            variant="filled"
            size="lg"
            aria-label="Toggle color scheme"
            onClick={() => setColorScheme(colorScheme === 'dark' ? 'light' : 'dark')}
        >
            {colorScheme === 'dark' ? <IconSun style={{width: rem(20), height: rem(20)}}/> : null}
            {colorScheme === 'light' ? <IconMoon style={{width: rem(20), height: rem(20)}}/> : null}
        </ActionIcon>
    );
}
