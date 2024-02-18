<?php

namespace App\Wtb\Security;

use Drenso\OidcBundle\Model\OidcUserData;
use Drenso\OidcBundle\Security\UserProvider\OidcUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return 'user';
    }
}

class KeycloakUserProvider implements OidcUserProviderInterface
{
    public const SCOPES = ['openid', 'profile', 'email'];

    public function ensureUserExists(string $userIdentifier, OidcUserData $userData): void
    {
        // throw when user does not exist
    }

    public function loadOidcUser(string $userIdentifier): UserInterface
    {
        return new User();
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass(string $class)
    {
        return $class === User::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return new User();
    }
}