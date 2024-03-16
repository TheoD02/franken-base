<?php

declare(strict_types=1);

namespace App\User\Service;

use App\Service\AutoMapper;
use App\User\Api\UserFilterQuery;
use App\User\Controller\CreateUserController\CreateUserPayload;
use App\User\Controller\UpdateUserController\UpdateUserPayload;
use App\User\Entity\UserEntity;
use App\User\Enum\UserRoleEnum;
use App\User\Exception\UserNotFoundException;
use App\User\ValueObject\User;
use App\User\ValueObject\UserCollection;
use Doctrine\ORM\EntityManagerInterface;
use loophp\collection\Collection;
use Module\Api\Service\PaginatorService;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly AutoMapper $mapper,
        private readonly PaginatorService $paginatorService
    ) {
    }

    /**
     * @return ($getEntity is true ? UserEntity : User)
     */
    public function getOneByIdOrFail(int $id, bool $getEntity = false): User|UserEntity
    {
        $userEntity = $this->em->find(UserEntity::class, $id);

        if ($userEntity === null) {
            throw new UserNotFoundException();
        }

        if ($getEntity) {
            return $userEntity;
        }

        return $this->mapper->map($userEntity, User::class);
    }

    public function create(CreateUserPayload $createUserPayload): User
    {
        $userEntity = $this->mapper->map($createUserPayload, UserEntity::class);

        $userEntity->setRoles(Collection::fromIterable([UserRoleEnum::USER]));

        $this->em->persist($userEntity);
        $this->em->flush();

        return $this->mapper->map($userEntity, User::class);
    }

    public function update(int $id, UpdateUserPayload $updateUserPayload): User
    {
        $userEntity = $this->getOneByIdOrFail($id, true);

        $userEntity = $this->mapper->mapToObject($updateUserPayload, $userEntity);

        $this->em->flush();

        return $this->mapper->map($userEntity, User::class);
    }

    public function paginate(?UserFilterQuery $userFilterQuery = null): UserCollection
    {
        $queryBuilder = $this->em->getRepository(UserEntity::class)->createQueryBuilder('entity');

        $userFilterQuery?->applyFilter($queryBuilder);

        return $this->paginatorService->paginate($queryBuilder, UserCollection::class);
    }

    public function delete(int $id): void
    {
        $userEntity = $this->getOneByIdOrFail($id, true);

        $this->em->remove($userEntity);
        $this->em->flush();
    }
}
