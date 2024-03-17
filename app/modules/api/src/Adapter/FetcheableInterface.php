<?php

namespace Module\Api\Adapter;

use Doctrine\Common\Collections\ArrayCollection;

interface FetcheableInterface
{
    public function getPropertyPathForIdentifier(): string;
}