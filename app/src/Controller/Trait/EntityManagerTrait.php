<?php

declare(strict_types=1);

namespace App\Controller\Trait;

use Doctrine\ORM\EntityManagerInterface;

trait EntityManagerTrait
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
