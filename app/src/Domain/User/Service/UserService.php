<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use App\ApiServiceProviderTrait;
use App\Domain\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Domain\Todo\Service\TodoService;
use App\Domain\Todo\ValueObject\TodoCollection;
use App\Domain\User\ApiResource\UserDto;
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
use Psr\Container\ContainerInterface;
use Rekalogika\ApiLite\Mapper\ApiCollectionMapperInterface;
use Rekalogika\Mapper\MapperInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class UserService
{
    use ApiServiceProviderTrait;

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly AutoMapper $mapper,
        private readonly PaginatorService $paginatorService,
        private readonly TodoService $todoService,
        private readonly MapperInterface $mapperRekalogika,
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

    public function paginate(Operation $operation): array
    {
        $items = $this->mapCollection(
            collection: $this->em->getRepository(UserEntity::class),
            target: UserDto::class,
            operation: $operation,
        );

        return $this->resolveTodosForUsers($items);
    }

    public function delete(int $id): void
    {
        $userEntity = $this->getOneByIdOrFail($id, true);

        $this->em->remove($userEntity);
        $this->em->flush();
    }

    public function resolveTodosForUsers(PaginatorInterface $items): array
    {
        $users = iterator_to_array($items);
        $todoIdentifiers = array_map(static fn (UserDto $user): int => $user->getId() ?? 0, $users);

        $todoFilterQuery = new TodoFilterQuery();
        $todoFilterQuery->userIdentifiers = $todoIdentifiers;

        $todos = $this->todoService->getTodos($todoFilterQuery);

        return array_map(static function (UserDto $user) use ($todos): UserDto {
            $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('userId', $user->getId()));

            $todosForUser = $todos->matching($criteria);

            $user->setTodos(TodoCollection::fromArray($todosForUser->getValues()));

            return $user;
        }, $users);
    }
}
