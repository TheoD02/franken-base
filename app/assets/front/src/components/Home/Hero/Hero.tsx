import cx from 'clsx';
import {Title, Text, Container, Button, Overlay} from '@mantine/core';
import classes from './Hero.module.css';
import {useModals} from "@mantine/modals";
import {LoginForm} from "../../Auth/Form/LoginForm.tsx";

export function Hero() {
    const modals = useModals();

    return (
        <div className={classes.wrapper}>
            <Overlay color="#000" opacity={0.65} zIndex={1}/>

            <div className={classes.inner}>
                <Title className={classes.title}>
                    LE SITE DE RÉFÉRENCE POUR DJS
                </Title>

                <Container size={640}>
                    <Text size="lg" className={classes.description}>
                        Télécharger le meilleur de la musique pour vos soirées
                    </Text>
                </Container>

                <div className={classes.controls}>
                    <Button className={classes.control} variant="white" size="lg" onClick={() => {
                        modals.openModal({
                            modalId: 'login',
                            title: 'Log in',
                            children: <LoginForm type="register"/>
                        });
                    }}>
                        S'inscrire
                    </Button>
                    <Button className={cx(classes.control, classes.secondaryControl)} size="lg">
                        Découvrir
                    </Button>
                </div>
            </div>
        </div>
    );
}