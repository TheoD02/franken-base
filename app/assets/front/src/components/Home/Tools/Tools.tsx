import {Image, Text, Container, ThemeIcon, Title, SimpleGrid} from '@mantine/core';
import classes from './Tools.module.css';

const data = [
    {
        image: 'auditors',
        title: 'RekordBox',
        description: '',
    },
    {
        image: 'lawyers',
        title: 'Serato',
        description: '',
    },
    {
        image: 'accountants',
        title: 'Traktor',
        description: '',
    },
    {
        image: 'others',
        title: 'Ableton',
        description: '',
    },
    {
        image: 'others',
        title: 'Virtual DJ',
        description: '',
    },
    {
        image: 'others',
        title: 'And more...',
        description: '',
    }
];

export function Tools() {
    const items = data.map((item) => (
        <div className={classes.item} key={item.image}>
            <ThemeIcon variant="light" className={classes.itemIcon} size={60} radius="md">
                {/*<Image src={IMAGES[item.image]}/>*/}
            </ThemeIcon>

            <div>
                <Text fw={700} fz="lg" className={classes.itemTitle}>
                    {item.title}
                </Text>
                <Text c="dimmed">{item.description}</Text>
            </div>
        </div>
    ));

    return (
        <Container size={1200} className={classes.wrapper}>
            <Text className={classes.supTitle}>Outils supportés</Text>

            <Title className={classes.title} order={2}>
                La plupart des logiciels de DJ sont supportés
            </Title>

            <SimpleGrid cols={{base: 1, xs: 3}} spacing={50} mt={30}>
                {items}
            </SimpleGrid>
        </Container>
    );
}