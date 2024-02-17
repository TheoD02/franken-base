import {useState} from 'react';
import {Box, Collapse, Group, rem, ThemeIcon, UnstyledButton} from '@mantine/core';
import {IconCalendarStats, IconChevronRight} from '@tabler/icons-react';
import classes from './CollapsibleLinksGroup.module.css';
import {Link, useNavigate} from "@tanstack/react-router";

interface LinksGroupProps {
    icon: React.FC<any>;
    label: string;
    initiallyOpened?: boolean;
    links?: { label: string; link: string }[];
}

export function LinksGroup({link, icon: Icon, label, initiallyOpened, links}: LinksGroupProps) {
    const hasLinks = Array.isArray(links);
    const [opened, setOpened] = useState(initiallyOpened || false);
    const items = (hasLinks ? links : []).map((link, i) => {
        if (link.links !== undefined) {
            if (link.link !== undefined) {
                throw new Error('Link is not allowed for links with sublinks');
            }
            if (link.icon === undefined) {
                throw new Error('Icon is required for links with sublinks');
            }

            return (
                <Box key={i} pl="20">
                    <LinksGroup icon={link.icon} label={link.label} links={link.links}/>
                </Box>
            )
        }

        return (
            <Link
                className={classes.link}
                to={link.link}
                key={link.label}
            >
                {
                    link.icon ? (
                        <Box style={{display: 'flex', alignItems: 'center'}}>
                            <ThemeIcon variant="light" size={30}>
                                <link.icon style={{width: rem(18), height: rem(18)}}/>
                            </ThemeIcon>
                            <Box ml="md">{link.label}</Box>
                        </Box>
                    ) : (link.label)
                }
            </Link>
        )
    });
    const navigate = useNavigate();

    const handleClick = () => {
        if (link) {
            navigate({ to: link })
        }else{
            setOpened((o) => !o);
        }
    }

    return (
        <>
            <UnstyledButton onClick={handleClick} className={classes.control}>
                <Group justify="space-between" gap={0}>
                    <Box style={{display: 'flex', alignItems: 'center'}}>
                        <ThemeIcon variant="light" size={30}>
                            <Icon style={{width: rem(18), height: rem(18)}}/>
                        </ThemeIcon>
                        <Box ml="md">{label}</Box>
                    </Box>
                    {hasLinks && (
                        <IconChevronRight
                            className={classes.chevron}
                            stroke={1.5}
                            style={{
                                width: rem(16),
                                height: rem(16),
                                transform: opened ? 'rotate(-90deg)' : 'none',
                            }}
                        />
                    )}
                </Group>
            </UnstyledButton>
            {hasLinks ? <Collapse in={opened}>{items}</Collapse> : null}
        </>
    );
}

const mockdata = {
    label: 'Releases',
    icon: IconCalendarStats,
    links: [
        {label: 'Upcoming releases', link: '/'},
        {label: 'Previous releases', link: '/'},
        {label: 'Releases schedule', link: '/'},
    ],
};

export function NavbarLinksGroup() {
    return (
        <Box mih={220} p="md">
            <LinksGroup {...mockdata} />
        </Box>
    );
}