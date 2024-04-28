<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use App\ApiInput\User\CreateUserInputDto;
use App\ApiResource\UserResource;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Rekalogika\ApiLite\State\AbstractProcessor;

/**
 * @extends AbstractProcessor<CreateUserInputDto, UserResource>
 */
class CreateUserProcessor extends AbstractProcessor
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $user = $this->map($data, User::class);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->map($user, UserResource::class);
    }
}
