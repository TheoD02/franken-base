<?php

namespace Castor\Utils\Docker;

class CastorDockerContext
{
    public function __construct(
        public string $container,
        public string $serviceName,
        public string $user,
        public string $group,
        public string $workdir,
        public bool $allowRunningInsideContainer = false,
    ) {
    }
}