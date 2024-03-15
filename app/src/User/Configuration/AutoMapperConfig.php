<?php

declare(strict_types=1);

namespace App\User\Configuration;

use App\User\Controller\CreateUserController\CreateUserPayload;
use App\User\Entity\UserEntity;
use App\User\ValueObject\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapperConfig implements AutoMapperConfiguratorInterface
{
    #[\Override]
    public function configure(AutoMapperConfigInterface $autoMapperConfig): void
    {
        $autoMapperConfig->getOptions()->ignoreNullProperties();
        $autoMapperConfig->registerMapping(UserEntity::class, UserEntity::class);

        $autoMapperConfig->registerMapping(CreateUserPayload::class, UserEntity::class);

        $autoMapperConfig->registerMapping(UserEntity::class, User::class);
    }
}
