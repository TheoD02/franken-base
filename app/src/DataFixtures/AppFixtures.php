<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'admin@domain.tld',
            'password' => '$2y$13$uqmpfwsknuy/gxjjuIHUSufdhl8bltOOX7xBp1Fs1HKFJrKUPNGAi', // admin
        ]);
        UserFactory::createMany(100);
    }
}
