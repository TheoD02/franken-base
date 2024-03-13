<?php

declare(strict_types=1);

namespace App;

use App\Entity\User;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapperConfig implements AutoMapperConfiguratorInterface
{
    #[\Override]
    public function configure(AutoMapperConfigInterface $autoMapperConfig): void
    {
        $autoMapperConfig->getOptions()->ignoreNullProperties();
        $autoMapperConfig->registerMapping(User::class, User::class);
    }
}
