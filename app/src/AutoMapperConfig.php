<?php

declare(strict_types=1);

namespace App;

use App\Entity\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapperConfig implements AutoMapperConfiguratorInterface
{
    #[\Override]
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->getOptions()->ignoreNullProperties();
        $config->registerMapping(User::class, User::class);
    }
}