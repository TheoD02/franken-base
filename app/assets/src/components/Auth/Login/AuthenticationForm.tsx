import {upperFirst, useToggle} from '@mantine/hooks';
import {useForm} from '@mantine/form';
import {
    Anchor,
    Box,
    Button,
    Checkbox,
    Divider,
    Group,
    Paper,
    PaperProps,
    PasswordInput,
    Stack,
    Text,
    TextInput,
} from '@mantine/core';
import {z} from "zod";
import {zodResolver} from "mantine-form-zod-resolver";
import {useQuery} from "@tanstack/react-query";

const validationSchema = z.object({
    username: z.string().email('Invalid email'),
    password: z.string().min(6, 'Password should include at least 6 characters'),
});

export function AuthenticationForm(props: PaperProps) {
    const [type, toggle] = useToggle(['login', 'register']);
    const form = useForm({
        initialValues: {
            username: '',
            name: '',
            password: '',
            terms: true,
        },

        validate: zodResolver(validationSchema)
    });

    const query = useQuery({
        queryKey: ['users'],
        retry: false,
        enabled: false,
        queryFn: async () => {
            const response = await fetch('/api/login_check', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(form.values),
            });

            if (!response.ok) {
                throw new Error('Failed to create user');
            }

            return response.json();
        }
    });

    const handleSubmit = async (values) => {
        console.log(values);
    }

    return (
        <Paper radius="md" p="xl" withBorder {...props}>
            <Text size="lg" fw={500}>
                Welcome to Mantine, {type} with
            </Text>

            <Group grow mb="md" mt="md">
                {/*<GoogleButton radius="xl">Google</GoogleButton>
                <TwitterButton radius="xl">Twitter</TwitterButton>*/}
            </Group>

            <Divider label="Or continue with email" labelPosition="center" my="lg"/>

            <Box
                component="form"
                pos="relative"
                maw={400}
                mx="auto"
                mt={50}
                onSubmit={form.onSubmit(handleSubmit) as any}
            >
                <Stack>
                    {type === 'register' && (
                        <TextInput
                            label="Name"
                            placeholder="Your name"
                            radius="md"
                            {...form.getInputProps('name')}
                        />
                    )}

                    <TextInput
                        label="Email"
                        placeholder="hello@mantine.dev"
                        radius="md"
                        {...form.getInputProps('username')}
                    />

                    <PasswordInput
                        label="Password"
                        placeholder="Your password"
                        radius="md"
                        {...form.getInputProps('password')}
                    />

                    {type === 'register' && (
                        <Checkbox
                            label="I accept terms and conditions"
                            {...form.getCheckboxProps('terms')}
                        />
                    )}
                </Stack>

                <Group justify="space-between" mt="xl">
                    <Anchor component="button" type="button" c="dimmed" onClick={() => toggle()} size="xs">
                        {type === 'register'
                            ? 'Already have an account? Login'
                            : "Don't have an account? Register"}
                    </Anchor>
                    <Button type="submit" radius="xl">
                        {upperFirst(type)}
                    </Button>
                </Group>
            </Box>
        </Paper>
    );
}
