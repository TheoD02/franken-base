<?php

declare(strict_types=1);

namespace App\Todo\ValueObject;

use App\Todo\Serialization\TodoGroups;
use App\User\Serialization\UserGroups;
use Module\Api\Adapter\ApiDataInterface;
use Symfony\Component\Serializer\Attribute\Groups;

class Todo implements ApiDataInterface
{
    #[Groups([TodoGroups::READ, UserGroups::READ])]
    private int $userId;

    #[Groups([TodoGroups::READ, UserGroups::READ])]
    private int $id;

    #[Groups([TodoGroups::READ, UserGroups::READ])]
    private string $title;

    #[Groups([TodoGroups::READ, UserGroups::READ])]
    private bool $completed;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): Todo
    {
        $this->userId = $userId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Todo
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Todo
    {
        $this->title = $title;
        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): Todo
    {
        $this->completed = $completed;
        return $this;
    }
}
