import {createFileRoute} from "@tanstack/react-router";
import {AuthenticationForm} from "../../../components/Auth/Login/AuthenticationForm";

export const Route = createFileRoute('/_front/auth/login')({
    component: AuthenticationForm,
});