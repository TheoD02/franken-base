import {createLazyFileRoute} from "@tanstack/react-router";
import {useState} from "react";
import {
    Autocomplete,
    Box,
    Button,
    Divider,
    NumberInput,
    Paper,
    SegmentedControl,
    Select,
    SimpleGrid,
    Switch,
    Title
} from "@mantine/core";

export const Route = createLazyFileRoute('/purchase/')({
    component: Purchase,
})

function Purchase() {
    const [section, setSection] = useState<'account' | 'general'>('account');

    const univers = <Select
        label="Univers"
        placeholder="Sélectionner un univers"
        data={[
            {value: '1', label: 'Tourisme'},
            {value: '2', label: '4x4'},
            {value: '3', label: 'Utilitaire'},
        ]}
    />;

    const seasons = <Autocomplete
        label="Saison"
        placeholder="Sélectionner une saison"
        data={[
            {value: '1', label: 'Été'},
            {value: '2', label: 'Hiver'},
            {value: '3', label: '4 saisons'},
        ]}
    />;

    const buttonList = (buttons) => {
        return (
            <div>
                {buttons.map((button) => {
                    return (
                        <Button
                            key={button.label}
                            color="blue"
                            size="lg"
                            style={{marginRight: 10, marginBottom: 10}}
                        >
                            {button.label}
                        </Button>
                    );
                })}
            </div>
        );
    }

    return (
        <Paper radius={4} p={30} withBorder={true}>
            <Title order={2} ta="center" mt="md" mb={50}>
                Recherche des pneumatiques
            </Title>
            <SegmentedControl
                value={section}
                onChange={setSection}
                data={[
                    {value: 'account', label: 'Recherche rapide'},
                    {value: 'general', label: 'Recherche avancée'},
                ]}
                fullWidth
                size="md"
                mt="md"
                mx={300}
            />

            <Divider mt="xl" mb="md"/>
            {section === 'account' && (
                <div>
                    <Title order={3} mt="xl" mb="md">
                        Recherche rapide
                    </Title>
                    <SimpleGrid cols={4}>
                        {univers}
                        <Autocomplete
                            label="Dimension, EAN, CAI, Référence"
                            placeholder="Saisir une dimension, EAN, CAI, Référence"
                            data={[
                                {group: 'Dimension', items: ['195/65 R15', '205/55 R16', '225/45 R17']},
                                {group: 'EAN', items: ['1234567890123', '1234567890124', '1234567890125']},
                                {group: 'CAI', items: ['9798A', '9798B', '9798C']},
                                {group: 'Référence', items: ['AB1234', 'AB1235', 'AB1236']},
                            ]}
                        />

                        {seasons}
                    </SimpleGrid>
                </div>
            )}

            {section === 'general' && (
                <div>
                    <Title order={3} mt="xl" mb="md">
                        Recherche avancée
                    </Title>
                    <SimpleGrid cols={4}>
                        {univers}
                        {seasons}
                    </SimpleGrid>
                    <SimpleGrid cols={3}>
                        <Box>
                            <Title order={4} mt="xl" mb="md">
                                Largeur
                            </Title>
                            {buttonList([
                                {label: '180'},
                                {label: '190'},
                                {label: '200'},
                                {label: '205'},
                                {label: '210'},
                                {label: '220'},
                                {label: '230'},
                                {label: '240'},
                                {label: '250'},
                                {label: '260'},
                                {label: '270'},
                                {label: '280'},
                                {label: '290'},
                                {label: '300'},
                            ])}
                        </Box>
                        <Box>
                            <Title order={4} mt="xl" mb="md">
                                Hauteur
                            </Title>
                            {buttonList([
                                {label: '30'},
                                {label: '35'},
                                {label: '40'},
                                {label: '45'},
                                {label: '50'},
                                {label: '55'},
                                {label: '60'},
                                {label: '65'},
                                {label: '70'},
                            ])}
                        </Box>
                        <Box>
                            <Title order={4} mt="xl" mb="md">
                                Diamètre
                            </Title>
                            {buttonList([
                                {label: '8'},
                                {label: '10'},
                                {label: '12'},
                                {label: '13'},
                                {label: '14'},
                                {label: '15'},
                                {label: '16'},
                                {label: '17'},
                                {label: '18'},
                                {label: '19'},
                                {label: '20'},
                            ])}
                        </Box>
                    </SimpleGrid>
                </div>
            )}

            <Divider mt="xl" mb="md"/>

            <SimpleGrid mt="xl">
                <Switch label="Intégrer les références de remplacement" />
                <NumberInput
                    label="Quantité"
                    placeholder="Saisir une quantité"
                    min={1}
                    max={100}
                    defaultValue={2}
                />
                <Button color="blue" size="lg">Rechercher</Button>
            </SimpleGrid>

        </Paper>
    )
}