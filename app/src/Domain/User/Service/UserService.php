<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Domain\Todo\Service\TodoService;
use App\Domain\Todo\ValueObject\TodoCollection;
use App\Domain\User\Controller\CreateUserController\CreateUserPayload;
use App\Domain\User\Controller\GetUserCollectionController\UserFilterQuery;
use App\Domain\User\Controller\UpdateUserController\UpdateUserPayload;
use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Enum\UserRoleEnum;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\ValueObject\User;
use App\Domain\User\ValueObject\UserCollection;
use App\Service\AutoMapper;
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

            $user->setTodos(TodoCollection::fromArray($todosForUser->getValues()));
        });
    }
}
