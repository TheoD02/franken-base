<?php

declare(strict_types=1);

namespace App\Todo\ValueObject;

use App\Memoize\Memoize;
use App\Todo\Service\TodoService;
use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\FetcheableInterface;
use Module\Api\ValueObject\GenericCollectionMetadata;

/**
 * @template TKey of array-key
 * @template T of Todo
 *
 * @implements ApiDataCollectionInterface<TKey, T>
 *
 * @extends ArrayCollection<TKey, T>
 */
class TodoCollection extends AbstractLazyCollection implements ApiDataCollectionInterface, FetcheableInterface
{
    use Memoize;

    private static array $globalIdentifiers = [];

    private array $identifiers = [];

    public function __construct(
        private readonly ?TodoService $todoService = null
    ) {
        if (! $this->todoService instanceof TodoService) {
            $this->collection = new ArrayCollection();
            $this->initialized = true;
        }
    }

    #[\Override]
    public function getMeta(): GenericCollectionMetadata
    {
        return new GenericCollectionMetadata(total: $this->count(), page: 1, limit: 10);
    }

    #[\Override]
    public function getPropertyPathForIdentifier(): string
    {
        return 'id';
    }

    #[\Override]
    protected function doInitialize(): void
    {
        if (! $this->todoService instanceof TodoService) {
            return;
        }

        $identifiersHash = md5(json_encode(self::$globalIdentifiers, \JSON_THROW_ON_ERROR));
        $todos = $this->memoize(fn (): array => $this->todoService->fetchTodos(self::$globalIdentifiers), 'todos' . $identifiersHash);

        if ($this->identifiers !== []) {
            $todos = array_filter($todos, fn (Todo $todo): bool => \in_array($todo->getId(), $this->identifiers, true));
        }

        $this->collection = new static();
        foreach ($todos as $todo) {
            $this->collection->add($todo);
        }
    }

    #[\Override]
    public function matching(Criteria $criteria): static
    {
        return $this->collection->matching($criteria);
    }

    public function setIdentifiers(array $identifiers): void
    {
        $this->identifiers = $identifiers;
    }

    #[\Override]
    public function __toString(): string
    {
        return 'TodoCollection';
    }
}
