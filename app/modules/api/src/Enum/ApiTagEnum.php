<?php

namespace Module\Api\Enum;

use Module\Api\Exception\MissingTagDescriptionException;

enum ApiTagEnum: string
{
    case HEALTH = 'Health';
    case USER = 'User';

    /**
     * @throws MissingTagDescriptionException
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::HEALTH => 'Health operations',
            self::USER => 'User operations',
            default => throw new MissingTagDescriptionException($this->value),
        };
    }
}
