<?php

namespace App\Wtb\Controller;

use App\Wtb\Security\KeycloakUserProvider;
use Drenso\OidcBundle\OidcClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class OpenIdController extends AbstractController
{
    #[Route('/login', name: 'login')]
    #[IsGranted('PUBLIC_ACCESS')]
    public function surfconext(OidcClientInterface $oidcClient): RedirectResponse
    {
        // Redirect to authorization @ OIDC provider
        return $oidcClient->generateAuthorizationRedirect(scopes: KeycloakUserProvider::SCOPES);
    }
}