import {Box, Container, Grid, Group, Paper, SimpleGrid, Text} from '@mantine/core';
import {
    IconUserPlus,
    IconDiscount2,
    IconReceipt2,
    IconCoin,
    IconArrowUpRight,
    IconArrowDownRight,
} from '@tabler/icons-react';
import classes from './Stats.module.css';

const icons = {
    user: IconUserPlus,
    discount: IconDiscount2,
    receipt: IconReceipt2,
    coin: IconCoin,
};

const data = [
    {title: 'Nombre de musiques', icon: 'receipt', value: '1,245', diff: 5},
    {title: 'Nombre de téléchargements', icon: 'coin', value: '3,245', diff: 12},
    {title: 'Nouveaux utilisateurs', icon: 'user', value: '1,245', diff: -5},
] as const;

export function Stats() {
    const stats = data.map((stat) => {
        const Icon = icons[stat.icon];
        const DiffIcon = stat.diff > 0 ? IconArrowUpRight : IconArrowDownRight;

        return (
            <Paper withBorder p="md" radius="md" key={stat.title}>
                <Group justify="space-between">
                    <Text size="xs" c="dimmed" className={classes.title}>
                        {stat.title}
                    </Text>
                    <Icon className={classes.icon} size="1.4rem" stroke={1.5}/>
                </Group>

                <Group align="flex-end" gap="xs" mt={25}>
                    <Text className={classes.value}>{stat.value}</Text>
                    <Text c={stat.diff > 0 ? 'teal' : 'red'} fz="sm" fw={500} className={classes.diff}>
                        <span>{stat.diff}%</span>
                        <DiffIcon size="1rem" stroke={1.5}/>
                    </Text>
                </Group>

                <Text fz="xs" c="dimmed" mt={7}>
                    Compared to previous month
                </Text>
            </Paper>
        );
    });
    return (
        <div className={classes.root}>
            <Container size={1800}>
                <Text align="center" fz="lg" fw={700} mb={20}>
                    Statistiques
                </Text>

                <Grid justify="center" align="flex-start" cols={{base: 1, xs: 2, md: 4}}>
                    {stats.map((item, index) => (
                        <Grid.Col key={index} span={{base: 12, xs: 6, md: 3}}>
                            {item}
                        </Grid.Col>
                    ))}
                </Grid>
            </Container>
        </div>
    );
}