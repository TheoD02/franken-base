<?php

namespace App\ApiResource;

use Symfony\Component\Serializer\Attribute\Groups;

class ErikRessourcePost
{
    #[Groups(['user:create'])]
    private string $coucou;

    public function getCoucou(): string
    {
        return $this->coucou;
    }

    public function setCoucou(string $coucou): ErikRessourcePost
    {
        $this->coucou = $coucou;
        return $this;
    }
}