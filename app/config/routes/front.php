<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator
        ->add('home', '/{path?}')
        ->controller(TemplateController::class)
        ->defaults(['template' => 'base.html.twig'])
        ->requirements(['path' => '.*']);
};
