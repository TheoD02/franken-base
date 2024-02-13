import {createContext, useContext, useEffect, useState} from "react";
import {notifications} from "@mantine/notifications";
import {useModals} from "@mantine/modals";
import {jwtDecode} from "jwt-decode";

type User = {
    id: number;
    email: string;
    roles: string[];
};

export type AuthContextType = {
    auth: {
        user: User | null;
        token: string | null;
    };
    login: (email: string, password: string) => void;
    logout: () => void;
    register: (email: string, password: string) => void;
    isAuthenticated: boolean;
    isInteracting: boolean;
};


const authContext = createContext<AuthContextType>({
    auth: {
        user: null,
        token: null,
    },
    login: () => {
        console.log('Login method. Please implement');
    },
    logout: () => {
        console.log('Logout method. Please implement');
    },
    register: () => {
        console.log('Register method. Please implement');
    },
    isAuthenticated: false,
    isInteracting: false,
});

const useProvideAuth = () => {
    const [user, setUser] = useState<User | null>(null);
    const [token, setToken] = useState<string | null>(localStorage.getItem('token') || null);
    const [isAuthenticated, setIsAuthenticated] = useState<boolean>(false);
    const [isInteracting, setIsInteracting] = useState<boolean>(false);
    //const modals = useModals();

    useEffect(() => {
        if (token !== null) {
            setUser(jwtDecode(token));
            setIsAuthenticated(true);
        } else {
            setUser(null);
            setIsAuthenticated(false);
        }
    }, [token]);

    const login = async (email: string, password: string) => {
        setIsInteracting(true);
        await fetch('/auth', {
            method: 'POST',
            body: JSON.stringify({email, password}),
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(r => r.json())
            .then(data => {
                setIsInteracting(false);
                if (data.token !== undefined) {
                    localStorage.setItem('token', data.token);
                    setToken(data.token);
                    notifications.show({
                        title: 'Connexion réussie',
                        message: 'Vous êtes maintenant connecté',
                        color: 'green'
                    });
                    //modals.closeModal('login');
                } else {
                    notifications.show({title: 'Erreur', message: 'Erreur lors de la connexion', color: 'red'});
                }
            }).catch(e => {
                notifications.show({title: 'Erreur', message: 'Erreur lors de la connexion', color: 'red'});
            });
    };

    const register = async (email: string, password: string) => {
        throw new Error('Not implemented');
        setIsInteracting(true);
        return await fetch('/register', {
            method: 'POST',
            body: JSON.stringify({email, password}),
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(r => r.json())
            .then(data => {
            }).catch(e => {
                notifications.show({title: 'Erreur', message: 'Erreur lors de l\'inscription', color: 'red'});
            });
    };

    const logout = () => {
        localStorage.removeItem('token');
        setToken(null);
        notifications.show({title: 'Déconnexion', message: 'Vous êtes maintenant déconnecté', color: 'blue'});
    }

    return {
        user,
        token,
        login,
        logout,
        register,
        isAuthenticated,
        isInteracting,
    };
}

export function AuthProvider(props: { children: React.ReactNode }) {
    const auth = useProvideAuth();
    return (
        <authContext.Provider value={auth}>
            {props.children}
        </authContext.Provider>
    );
}

export const useAuth = () => {
    return useContext(authContext)
}