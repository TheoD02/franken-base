import React from 'react';
import {Button, Card, CardBody, CardFooter, CardHeader, Text} from '@chakra-ui/react'
import {useModals} from '@saas-ui/react'

export default function (props) {
    const modals = useModals()

    return (
        <Card>
            <CardHeader>
                <Text>Card Title</Text>
                <Text>Card Description</Text>
            </CardHeader>
            <CardBody>
                <Text>Card Content</Text>
                <Button
                    onClick={() =>
                        modals.open({
                            title: 'Modal',
                            body: 'Body',
                            footer: 'Footer',
                        })
                    }
                >
                    Open modal
                </Button>
            </CardBody>
            <CardFooter>
                <Text>Card Footer</Text>
            </CardFooter>
        </Card>
    )
}
