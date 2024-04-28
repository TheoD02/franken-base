import {createFileRoute, createRootRoute} from "@tanstack/react-router";
import React from "react";
import FrontLayout from "../layouts/FrontLayout";

export const Route = createFileRoute('/_front')({
    component: FrontLayout,
})