import {createLazyFileRoute} from "@tanstack/react-router";
import {
    ActionIcon,
    Box,
    Button,
    Container,
    Divider,
    Group,
    Input,
    Paper,
    SimpleGrid,
    TagsInput,
    Text
} from "@mantine/core";
import {useState} from "react";
import {MdClose} from "react-icons/md";
import {PiPen} from "react-icons/pi";
import {BiTrash} from "react-icons/bi";

export const Route = createLazyFileRoute('/platform/criteria/')({
    component: Criteria,
})


const apiData = [
    {
        "id": "65ce99241298375a3b0397d6",
        "name": "Région",
        "isReserved": false,
        "values": [
            {
                "id": "65ce99241298375a3b0397d7",
                "label": "Nord"
            },
            {
                "id": "65ce99241298375a3b0397d8",
                "label": "Sud"
            },
            {
                "id": "65ce99241298375a3b0397d9",
                "label": "Est"
            },
            {
                "id": "65ce99241298375a3b0397da",
                "label": "Ouest"
            }
        ]
    },
    {
        "id": "65ce99241298375a3b0397db",
        "name": "Type",
        "isReserved": false,
        "values": [
            {
                "id": "65ce99241298375a3b0397dc",
                "label": "Agent"
            },
            {
                "id": "65ce99241298375a3b0397dd",
                "label": "Concessionnaire"
            },
            {
                "id": "65ce99241298375a3b0397de",
                "label": "Grossiste"
            },
            {
                "id": "65ce99241298375a3b0397df",
                "label": "MRA"
            }
        ]
    },
    {
        "id": "65ce99241298375a3b0397e0",
        "name": "Enseigne",
        "isReserved": false,
        "values": [
            {
                "id": "65ce99241298375a3b0397e1",
                "label": "Automaker Group 1"
            }
        ]
    }
];

const EditableTextInput = ({value: inputValue, onChange}) => {
    const [isEditing, setIsEditing] = useState(inputValue === '');
    const [canSave, setCanSave] = useState(false);

    return (
        <>
            <SimpleGrid cols={2}>
                <Input
                    value={inputValue}
                    disabled={!isEditing}
                />
                <ActionIcon size="lg" onClick={() => setIsEditing(!isEditing)}>
                    {isEditing ? <MdClose/> : <PiPen/>}
                </ActionIcon>
            </SimpleGrid>
        </>
    );
}

function Criteria() {
    const [data, setData] = useState(apiData);

    const handleAddNewRow = () => {
        setData([...data, {
            id: Math.random().toString(36).substring(7),
            name: '',
            values: []
        }]);
    }

    const handleOnTagChange = (value, item) => {
        setData(data.map((el) => el.id === item.id ? {
            ...el,
            values: value
        } : el));
    }

    return (
        <div>
            <h1>Criteria</h1>
            <Paper p="10" m="5" bg="gray">
                {data.map((item) => (
                    <Box key={item.id} my="20">
                        <Divider mt="xl" mb="md"/>
                        <Group grow>
                            <Container>
                                <Text>
                                    Nom du critère
                                </Text>
                                <EditableTextInput
                                    value={item.name}
                                    onChange={(value) => handleOnTagChange(value, item)}
                                />
                            </Container>
                            <Container>
                                <Text>
                                    Valeurs
                                </Text>
                                <TagsInput
                                    mt="10"
                                    description={""}
                                    placeholder={""}
                                    value={item.values.map((el) => el.label)}
                                    //onChange={(value) => handleOnTagChange(value, item)}
                                />
                            </Container>
                            <Container>
                                <ActionIcon size="lg" color="red" onClick={() => setData(data.filter((el) => el.id !== item.id))}>
                                    <BiTrash />
                                </ActionIcon>
                            </Container>
                        </Group>
                    </Box>
                ))}
                <Button onClick={handleAddNewRow}>Ajouter un critère</Button>
            </Paper>
        </div>
    );
}
