import {useToggle, upperFirst} from '@mantine/hooks';
import {useForm} from '@mantine/form';
import {
    TextInput,
    PasswordInput,
    Text,
    Paper,
    Group,
    PaperProps,
    Button,
    Divider,
    Checkbox,
    Anchor,
    Stack,
} from '@mantine/core';
import {useAuth} from "../../../contexts/auth-context.tsx";
import {notifications} from "@mantine/notifications";
import {modals} from "@mantine/modals";

type Props = {
    type?: 'login' | 'register';
} & PaperProps;

export function LoginForm(props: Props) {
    const {isAuthenticated, login, register, isInteracting} = useAuth();
    if (isAuthenticated) {
        modals.closeAll();
        notifications.show({
            title: 'Attention',
            message: 'Vous êtes déjà connecté',
            color: 'orange',
        });
    }

    const types = [];
    if ((props.type || 'login') === 'login') {
        types.push('login', 'register');
    } else {
        types.push('register', 'login');
    }

    const [type, toggle] = useToggle(types);
    const form = useForm({
        initialValues: {
            email: '',
            name: '',
            password: '',
            terms: true,
        },

        validate: {
            email: (val) => (/^\S+@\S+$/.test(val) ? null : 'Invalid email'),
            password: (val) => (val.length <= 4 ? 'Password should include at least 6 characters' : null),
        },
    });

    return (
        <Paper radius="md" p="xl" withBorder {...props}>
            <Text size="lg" fw={500}>
                Welcome to Website
            </Text>

            {/*<Group grow mb="md" mt="md">
                <GoogleButton radius="xl">Google</GoogleButton>
                <TwitterButton radius="xl">Twitter</TwitterButton>
            </Group>*/}

            {/*<Divider label="Or continue with email" labelPosition="center" my="lg"/>*/}

            <form onSubmit={form.onSubmit(() => {
                if (type === 'login') {
                    login(form.values.email, form.values.password);
                } else {
                    register(form.values.email, form.values.password);
                }
            })
            }>
                <Stack>
                    {type === 'register' && (
                        <TextInput
                            label="Name"
                            placeholder="Your name"
                            value={form.values.name}
                            onChange={(event) => form.setFieldValue('name', event.currentTarget.value)}
                            radius="md"
                        />
                    )}

                    <TextInput
                        required
                        label="Email"
                        placeholder="hello@mantine.dev"
                        value={form.values.email}
                        onChange={(event) => form.setFieldValue('email', event.currentTarget.value)}
                        error={form.errors.email && 'Invalid email'}
                        radius="md"
                    />

                    <PasswordInput
                        required
                        label="Password"
                        placeholder="Your password"
                        value={form.values.password}
                        onChange={(event) => form.setFieldValue('password', event.currentTarget.value)}
                        error={form.errors.password && 'Password should include at least 6 characters'}
                        radius="md"
                    />

                    {type === 'register' && (
                        <Checkbox
                            label="I accept terms and conditions"
                            checked={form.values.terms}
                            onChange={(event) => form.setFieldValue('terms', event.currentTarget.checked)}
                        />
                    )}
                </Stack>

                <Group justify="space-between" mt="xl">
                    <Anchor component="button" type="button" c="dimmed" onClick={() => toggle()} size="xs">
                        {type === 'register'
                            ? 'Already have an account? Login'
                            : "Don't have an account? Register"}
                    </Anchor>
                    <Button type="submit" radius="xl" loading={isInteracting}>
                        {upperFirst(type)}
                    </Button>
                </Group>
            </form>
        </Paper>
    );
}