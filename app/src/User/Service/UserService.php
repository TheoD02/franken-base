<?php

declare(strict_types=1);

namespace App\User\Service;

use App\Service\AutoMapper;
use App\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Todo\Service\TodoService;
use App\Todo\ValueObject\TodoCollection;
use App\User\Controller\CreateUserController\CreateUserPayload;
use App\User\Controller\GetUserCollectionController\UserFilterQuery;
use App\User\Controller\UpdateUserController\UpdateUserPayload;
use App\User\Entity\UserEntity;
use App\User\Enum\UserRoleEnum;
use App\User\Exception\UserNotFoundException;
use App\User\ValueObject\User;
use App\User\ValueObject\UserCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Module\Api\Dto\PaginationFilterQuery;
use Module\Api\Service\PaginatorService;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly AutoMapper $mapper,
        private readonly PaginatorService $paginatorService,
        private readonly TodoService $todoService,
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
        $userEntity = $this->mapper->mapToObject($createUserPayload, new UserEntity());

        $userEntity->setRoles(new ArrayCollection([UserRoleEnum::USER]));

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

    /**
     * @return UserCollection<array-key, User>
     */
    public function paginate(?UserFilterQuery $userFilterQuery = null, ?PaginationFilterQuery $paginationFilterQuery = null): UserCollection
    {
        $queryBuilder = $this->em->getRepository(UserEntity::class)->createQueryBuilder('entity');

        $items = $this->paginatorService->paginate($queryBuilder, UserCollection::class, User::class, [$userFilterQuery, $paginationFilterQuery]);

        $this->resolveTodosForUsers($items);

        return $items;
    }

    public function delete(int $id): void
    {
        $userEntity = $this->getOneByIdOrFail($id, true);

        $this->em->remove($userEntity);
        $this->em->flush();
    }

    /**
     * @param UserCollection<array-key, User> $items
     */
    public function resolveTodosForUsers(UserCollection $items): void
    {
        $todoIdentifiers = $items->map(static fn (User $user): int => $user->getId() ?? 0)->toArray();

        $todoFilterQuery = new TodoFilterQuery();
        $todoFilterQuery->userIdentifiers = $todoIdentifiers;

        $todos = $this->todoService->getTodos($todoFilterQuery);

        $items->map(static function (User $user) use ($todos): void {
            $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('userId', $user->getId()))
            ;

            $todosForUser = $todos->matching($criteria);

            $user->setTodos(new TodoCollection($todosForUser->getValues()));
        });
    }
}
