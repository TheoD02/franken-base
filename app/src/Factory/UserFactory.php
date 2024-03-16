<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\UserRepository;
use App\User\Entity\UserEntity;
use App\User\Enum\UserRoleEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<UserEntity>
 *
 * @method        UserEntity|Proxy               create(array|callable $attributes = [])
 * @method static UserEntity|Proxy               createOne(array $attributes = [])
 * @method static UserEntity|Proxy               find(object|array|mixed $criteria)
 * @method static UserEntity|Proxy               findOrCreate(array $attributes)
 * @method static UserEntity|Proxy               first(string $sortedField = 'id')
 * @method static UserEntity|Proxy               last(string $sortedField = 'id')
 * @method static UserEntity|Proxy               random(array $attributes = [])
 * @method static UserEntity|Proxy               randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static UserEntity[]|Proxy[]           all()
 * @method static UserEntity[]|Proxy[]           createMany(int $number, array|callable $attributes = [])
 * @method static UserEntity[]|Proxy[]           createSequence(iterable|callable $sequence)
 * @method static UserEntity[]|Proxy[]           findBy(array $attributes)
 * @method static UserEntity[]|Proxy[]           randomRange(int $min, int $max, array $attributes = [])
 * @method static UserEntity[]|Proxy[]           randomSet(int $number, array $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    #[\Override]
    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'firstName' => self::faker()->firstName(),
            'lastName' => self::faker()->lastName(),
            'roles' => new ArrayCollection([UserRoleEnum::USER]),
        ];
    }

    #[\Override]
    protected static function getClass(): string
    {
        return UserEntity::class;
    }
}
