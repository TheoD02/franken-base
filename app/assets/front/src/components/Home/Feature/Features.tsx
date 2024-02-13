import {Title, SimpleGrid, Text, Button, ThemeIcon, Grid, rem, Container} from '@mantine/core';
import {IconReceiptOff, IconFlame, IconCircleDotted, IconFileCode} from '@tabler/icons-react';
import classes from './Features.module.css';

const features = [
    {
        icon: IconReceiptOff,
        title: 'Nouveautés régulières',
        description: 'Découvrez les dernières nouveautés et les tubes du moment',
    },
    {
        icon: IconFileCode,
        title: 'Morceaux de qualité',
        description: 'MP3 320 kbps pour une qualité audio optimale, WAV pour les puristes',
    },
    {
        icon: IconCircleDotted,
        title: 'Pack sur mesure',
        description: 'Télécharger nos packs de musiques pour vos soirées. On s’occupe de tout',
    },
    {
        icon: IconFlame,
        title: 'Téléchargement rapide',
        description: 'Téléchargez vos musiques en quelques secondes.',
    },
];

export function Features() {
    const items = features.map((feature) => (
        <div key={feature.title}>
            <ThemeIcon
                size={44}
                radius="md"
                variant="gradient"
                gradient={{deg: 133, from: 'blue', to: 'cyan'}}
            >
                <feature.icon style={{width: rem(26), height: rem(26)}} stroke={1.5}/>
            </ThemeIcon>
            <Text fz="lg" mt="sm" fw={500}>
                {feature.title}
            </Text>
            <Text c="dimmed" fz="sm">
                {feature.description}
            </Text>
        </div>
    ));

    return (
        <div className={classes.wrapper}>
            <Container size={1800} className={classes.wrapper}>
                <Grid gutter={80}>
                    <Grid.Col span={{base: 12, md: 5}}>
                        <Title className={classes.title} order={2}>
                            VOTRE BIBLIOTHÈQUE MUSICALE À PORTÉE DE MAIN
                        </Title>
                        <Text c="dimmed">
                            Téléchargez et écoutez vos musiques préférées en un clic. Trouvez les dernières
                            nouveautés et les tubes du moment. Profitez de notre catalogue riche et varié.
                        </Text>

                        <Button
                            variant="gradient"
                            gradient={{deg: 133, from: 'blue', to: 'cyan'}}
                            size="lg"
                            radius="md"
                            mt="xl"
                        >
                            Découvrir
                        </Button>
                    </Grid.Col>
                    <Grid.Col span={{base: 12, md: 7}}>
                        <SimpleGrid cols={{base: 1, md: 2}} spacing={30}>
                            {items}
                        </SimpleGrid>
                    </Grid.Col>
                </Grid>
            </Container>
        </div>
    );
}