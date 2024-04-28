import {createLazyFileRoute} from "@tanstack/react-router";
import {CreateUser} from "../../../pages/User/CreateUser";

export const Route = createLazyFileRoute('/_front/users/create')({
    component: () => <CreateUser />
});
