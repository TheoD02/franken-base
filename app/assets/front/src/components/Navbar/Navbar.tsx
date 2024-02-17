import {Code, Group, ScrollArea} from '@mantine/core';
import {
    IconFlag,
    IconGalaxy,
    IconGauge,
    IconHistory,
    IconPackage,
    IconPlus,
    IconSettings,
    IconShoppingCart,
    IconShoppingCartPlus,
    IconTag,
    IconUser,
} from '@tabler/icons-react';
import classes from './Navbar.module.css';
import {LinksGroup} from "../CollapsibleLinksGroup/CollapsibleLinksGroup.tsx";
import {GiMoneyStack, GiOrganigram, GiTyre} from "react-icons/gi";
import {PiGarageLight, PiWrenchLight} from "react-icons/pi";
import {IoColorPaletteOutline} from "react-icons/io5";
import {TbFileInvoice} from "react-icons/tb";
import {LuPackagePlus} from "react-icons/lu";
import {FaThreads} from "react-icons/fa6";

const mockdata = [
    {label: 'Accueil', icon: IconGauge, link: '/'},
    {
        label: 'Achat',
        icon: IconShoppingCart,
        initiallyOpened: true,
        links: [
            {label: 'Nouvelle commande', link: '/purchase/', icon: IconShoppingCartPlus},
            {label: 'Historique de commande', link: '/purchase/history', icon: IconHistory},
        ],
    },
    {
        label: 'Vente',
        icon: IconPackage,
        links: [
            {label: 'Commande reçues', link: '/orders/received', icon: LuPackagePlus},
            {label: 'Commande traitées', link: '/orders/processed', icon: IconHistory},
        ],
    },
    {
        label: 'Devis',
        icon: TbFileInvoice,
        links: [
            {label: 'Nouveau devis', link: '/quote/new', icon: IconPlus},
            {label: 'Historique de devis', link: '/quote/history', icon: IconHistory},
        ]
    },
    {
        label: 'Paramètre commerciaux',
        icon: GiMoneyStack,
        links: [
            {label: 'Politique tarifaire', link: '/pricing-policy', icon: GiMoneyStack},
            {label: 'Marketing', link: '/marketing', icon: FaThreads},
        ]
    },
    {
        label: 'Administration',
        icon: IconSettings,
        links: [
            {
                label: 'Organisation',
                icon: GiOrganigram,
                links: [
                    {label: 'Points de vente', link: '/point-of-sale', icon: PiGarageLight},
                    {label: 'Utilisateurs', link: '/users', icon: IconUser},
                ]
            },
            {
                label: 'Réglages plateforme',
                icon: IconSettings,
                links: [
                    {label: 'Général', link: '/platform/general', icon: PiWrenchLight},
                    {label: 'Thème', link: '/platform/theme', icon: IoColorPaletteOutline},
                    {label: 'Critères', link: '/platform/criteria', icon: IconTag},
                    {label: 'Fournisseurs', link: '/platform/supplier-templates', icon: IconPackage},
                    {label: 'Marques', link: '/platform/product-brands', icon: GiTyre},
                    {label: 'Univers', link: '/platform/vehicle-groups', icon: IconGalaxy},
                    {label: 'Enseignes', link: '/platform/automakers', icon: IconFlag},
                    {label: 'Pays', link: '/platform/country', icon: IconFlag},
                    {label: 'Wyz Company', link: '/platform/wyz-company', icon: IconFlag},
                ]
            }
        ]
    },
];

export default function Navbar() {
    const links = mockdata.map((item) => <LinksGroup {...item} key={item.label}/>);

    return (
        <nav className={classes.navbar}>
            <div className={classes.header}>
                <Group justify="space-between">
                    <div>Nom de l'entreprise</div>
                    <Code fw={700}>v3.1.2</Code>
                </Group>
            </div>

            <ScrollArea className={classes.links}>
                <div className={classes.linksInner}>{links}</div>
            </ScrollArea>

            <div className={classes.footer}>
            </div>
        </nav>
    );
}