<?php

namespace Module\Api\Exception;

class MissingTagDescriptionException extends \Exception
{
    public function __construct(string $tag)
    {
        parent::__construct('Please provide a description for this tag: '. $tag);
    }
}