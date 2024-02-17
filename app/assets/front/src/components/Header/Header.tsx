import {
    ActionIcon,
    Avatar,
    Box,
    Burger,
    Button,
    Center,
    Collapse,
    Divider,
    Drawer,
    Group,
    Menu,
    rem,
    ScrollArea,
    Select,
    Text,
    ThemeIcon,
    UnstyledButton,
    useMantineTheme,
} from '@mantine/core';
import {useDisclosure} from '@mantine/hooks';
import {
    IconBook,
    IconChartPie3,
    IconChevronDown,
    IconCode,
    IconCoin,
    IconFingerprint,
    IconLogout,
    IconNotification,
} from '@tabler/icons-react';
import classes from './Header.module.css';
import {MdMenu} from "react-icons/md";
import {useState} from "react";

const mockdata = [
    {
        icon: IconCode,
        title: 'Open source',
        description: 'This Pokémon’s cry is very loud and distracting',
    },
    {
        icon: IconCoin,
        title: 'Free for everyone',
        description: 'The fluid of Smeargle’s tail secretions changes',
    },
    {
        icon: IconBook,
        title: 'Documentation',
        description: 'Yanma is capable of seeing 360 degrees without',
    },
    {
        icon: IconFingerprint,
        title: 'Security',
        description: 'The shell’s rounded shape and the grooves on its.',
    },
    {
        icon: IconChartPie3,
        title: 'Analytics',
        description: 'This Pokémon uses its flying ability to quickly chase',
    },
    {
        icon: IconNotification,
        title: 'Notifications',
        description: 'Combusken battles with the intensely hot flames it spews',
    },
];
const user = {
    name: 'Jane Spoonfighter',
    email: 'janspoon@fighter.dev',
    image: 'https://raw.githubusercontent.com/mantinedev/mantine/master/.demo/avatars/avatar-5.png',
};

export default function Header({toggleCollapsed}) {
    const [drawerOpened, {toggle: toggleDrawer, close: closeDrawer}] = useDisclosure(false);
    const [linksOpened, {toggle: toggleLinks}] = useDisclosure(false);
    const [userMenuOpened, setUserMenuOpened] = useState(false);
    const theme = useMantineTheme();

    const links = mockdata.map((item) => (
        <UnstyledButton className={classes.subLink} key={item.title}>
            <Group wrap="nowrap" align="flex-start">
                <ThemeIcon size={34} variant="default" radius="md">
                    <item.icon style={{width: rem(22), height: rem(22)}} color={theme.colors.blue[6]}/>
                </ThemeIcon>
                <div>
                    <Text size="sm" fw={500}>
                        {item.title}
                    </Text>
                    <Text size="xs" c="dimmed">
                        {item.description}
                    </Text>
                </div>
            </Group>
        </UnstyledButton>
    ));

    return (
        <Box>
            <header className={classes.header}>
                <Group justify="space-between" h="100%">
                    <Group h="100%" gap={0}>
                        <ActionIcon onClick={toggleCollapsed} size="40">
                            <MdMenu/>
                        </ActionIcon>
                    </Group>

                    <Group h="100%" gap={0} visibleFrom="sm">
                        <Select
                            label="Sélectionner un point de vente"
                            placeholder="Sélectionner un point de vente"
                            data={[
                                {value: '1', label: 'Point de vente 1'},
                                {value: '2', label: 'Point de vente 2'},
                                {value: '3', label: 'Point de vente 3'},
                            ]}
                        />
                    </Group>

                    <Group visibleFrom="sm">
                        <Menu
                            width={260}
                            position="bottom-end"
                            transitionProps={{transition: 'pop-top-right'}}
                            onClose={() => setUserMenuOpened(false)}
                            onOpen={() => setUserMenuOpened(true)}
                            withinPortal
                        >
                            <Menu.Target>
                                <UnstyledButton
                                    /*className={cx(classes.user, { [classes.userActive]: userMenuOpened })}*/
                                >
                                    <Group gap={7}>
                                        <Avatar src={user.image} alt={user.name} radius="xl" size={20}/>
                                        <Text fw={500} size="sm" lh={1} mr={3}>
                                            {user.name}
                                        </Text>
                                        <IconChevronDown style={{width: rem(12), height: rem(12)}} stroke={1.5}/>
                                    </Group>
                                </UnstyledButton>
                            </Menu.Target>
                            <Menu.Dropdown>
                                <Menu.Label>Settings</Menu.Label>
                                <Menu.Item
                                    leftSection={
                                        <IconLogout style={{width: rem(16), height: rem(16)}} stroke={1.5}/>
                                    }
                                >
                                    Logout
                                </Menu.Item>
                            </Menu.Dropdown>
                        </Menu>
                    </Group>

                    <Burger opened={drawerOpened} onClick={toggleDrawer} hiddenFrom="sm"/>
                </Group>
            </header>

            <Drawer
                opened={drawerOpened}
                onClose={closeDrawer}
                size="100%"
                padding="md"
                title="Navigation"
                hiddenFrom="sm"
                zIndex={1000000}
            >
                <ScrollArea h={`calc(100vh - ${rem(80)})`} mx="-md">
                    <Divider my="sm"/>

                    <a href="#" className={classes.link}>
                        Home
                    </a>
                    <UnstyledButton className={classes.link} onClick={toggleLinks}>
                        <Center inline>
                            <Box component="span" mr={5}>
                                Features
                            </Box>
                            <IconChevronDown
                                style={{width: rem(16), height: rem(16)}}
                                color={theme.colors.blue[6]}
                            />
                        </Center>
                    </UnstyledButton>
                    <Collapse in={linksOpened}>{links}</Collapse>
                    <a href="#" className={classes.link}>
                        Learn
                    </a>
                    <a href="#" className={classes.link}>
                        Academy
                    </a>

                    <Divider my="sm"/>

                    <Group justify="center" grow pb="xl" px="md">
                        <Button variant="default">Log in</Button>
                        <Button>Sign up</Button>
                    </Group>
                </ScrollArea>
            </Drawer>
        </Box>
    );
}