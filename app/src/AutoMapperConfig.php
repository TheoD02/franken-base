<?php

namespace App;

use App\Entity\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapperConfig implements AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->getOptions()->ignoreNullProperties();
        $config->registerMapping(User::class, User::class);
    }
}