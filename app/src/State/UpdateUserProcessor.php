<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use App\ApiInput\User\CreateUserInputDto;
use App\ApiResource\UserResource;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Rekalogika\ApiLite\Exception\NotFoundException;
use Rekalogika\ApiLite\State\AbstractProcessor;

/**
 * @extends AbstractProcessor<CreateUserInputDto, UserResource>
 */
class UpdateUserProcessor extends AbstractProcessor
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $user = $this->userRepository->find($uriVariables['id']) ?? throw new NotFoundException('User not found');

        $user = $this->map($data, $user);

        $this->entityManager->flush();

        return $this->map($user, UserResource::class);
    }
}
