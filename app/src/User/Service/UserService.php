<?php

declare(strict_types=1);

namespace App\User\Service;

use App\Service\AutoMapper;
use App\User\Controller\CreateUserController\CreateUserPayload;
use App\User\Entity\UserEntity;
use App\User\Enum\UserRoleEnum;
use App\User\ValueObject\User;
use Doctrine\ORM\EntityManagerInterface;
use loophp\collection\Collection;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly AutoMapper $mapper,
    ) {
    }

    public function create(CreateUserPayload $createUserPayload): User
    {
        $userEntity = $this->mapper->map($createUserPayload, UserEntity::class);

        $userEntity->setRoles(Collection::fromIterable([UserRoleEnum::USER]));

        $this->em->persist($userEntity);
        $this->em->flush();

        return $this->mapper->map($userEntity, User::class);
    }
}
