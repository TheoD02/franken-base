import {Box, Button, Group, LoadingOverlay, TextInput} from '@mantine/core';
import {useForm} from "@mantine/form";
import {zodResolver} from 'mantine-form-zod-resolver';

import {z} from 'zod';
import {useMutation} from "@tanstack/react-query";
import {NotificationData, notifications} from "@mantine/notifications";

const validationSchema = z.object({
    email: z.string().email('Invalid email').min(4, 'Too short').max(50, 'Too long'),
    password: z.string().min(8, 'Too short').max(50, 'Too long'),
    confirmPassword: z.string().min(8, 'Too short').max(50, 'Too long')
}).refine(data => data.password === data.confirmPassword, {
    message: 'Passwords do not match',
    path: ['confirmPassword']
});

export function CreateUser() {
    const form = useForm({
        initialValues: {
            email: '',
            password: '',
            confirmPassword: '',
        },
        validateInputOnChange: true,
        validate: zodResolver(validationSchema),
    });

    const mutation = useMutation({
        mutationFn: async () => {
            const response = await fetch('/api/users', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(form.values),
            });

            if (!response.ok) {
                if (response.status === 409) {
                    notifications.show({
                        title: 'Error',
                        message: 'User already exists',
                        color: 'red',
                    } as NotificationData);
                    return;
                }
                notifications.show({
                    title: 'Error',
                    message: 'Failed to create user',
                    color: 'red',
                } as NotificationData);
            } else {
                notifications.show({
                    title: 'Success',
                    message: 'User created',
                    color: 'teal',
                } as NotificationData);
            }

            return response.json();
        },
    });

    const handleSubmit = async (values) => {
        await mutation.mutateAsync(values);
    }

    return (
        <Box
            component="form"
            pos="relative"
            maw={400}
            mx="auto"
            mt={50}
            onSubmit={form.onSubmit(handleSubmit) as any}
        >
            <LoadingOverlay visible={mutation.isPending} zIndex={1000}
                            overlayProps={{radius: "sm", blur: 2, margin: 2}}/>
            <TextInput
                label="Your email"
                placeholder="Your email"
                withAsterisk
                mt="md"
                {...form.getInputProps('email')}
            />

            <TextInput
                label="Password"
                placeholder="Password"
                type="password"
                withAsterisk
                mt="md"
                {...form.getInputProps('password')}
            />

            <TextInput
                label="Confirm password"
                placeholder="Confirm password"
                type="password"
                withAsterisk
                mt="md"
                {...form.getInputProps('confirmPassword')}
            />

            <Group justify="flex-end" mt="md">
                <Button type="submit">Submit</Button>
            </Group>
        </Box>
    );
}
