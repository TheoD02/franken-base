import {useQuery} from "@tanstack/react-query";

interface User {
    email: string;
    password: string;
    confirmPassword: string;
}

function createUser(user: User) {
    return useQuery({
        queryKey: ['users'],
        queryFn: async () => {
            const response = await fetch('/api/users', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(user),
            });

            if (!response.ok) {
                throw new Error('Failed to create user');
            }

            return response.json();
        },
    });
}


export type {User};
export default createUser;
