<?php

namespace Module\Api\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\String\Inflector\EnglishInflector;
use function Symfony\Component\String\u;

#[AsCommand(
        name: 'api:path-check',
        description: 'Check if the path of routes is valid',
)]
class ApiPathCheckCommand extends Command
{
    // TODO: Make that available in a configuration file
    private const MAX_NESTED_PATH = 3;

    // TODO: Make that available in a configuration file
    private const EXCLUDED_SINGULAR = [
            'nah',
    ];

    public function __construct(private readonly RouterInterface $router)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inflector = new EnglishInflector();
        $io = new SymfonyStyle($input, $output);
        $invalidRoutes = [];

        $ignoreVersionFor = [
                '/ping',
        ];


        // Symfony already check double slashes we can ignore it
        foreach ($this->router->getRouteCollection() as $route) {
            $path = u($route->getPath());
            if ($path->startsWith('/_') || $path->startsWith('/api/doc')) {
                continue;
            }

            $isValid = true;
            $reasons = [];

            if ($path->startsWith('/api')) {
                $isValid = false;
                $reasons[] = 'Path should not start with /api';
            }

            // SHOULD BE VERSIONED
            if (
                    in_array($path->toString(), $ignoreVersionFor, true) === false
                    && $path->match('/^\\/v[0-9](\\.[0-9]){0,2}/') === []
            ) {
                $isValid = false;
                $reasons[] = 'Should be versioned';
            }

            // get only version of the path
            $apiVersion = u($path->match('/^\\/v[0-9](\\.[0-9]){0,2}/')[0] ?? '')->trim('/');

            if ($apiVersion->isEmpty() === false) {
                $name = u($this->router->match($route->getPath())['_route']);
                $versionName = $apiVersion->replace('.', '_');
                if ($name->startsWith($versionName) === false) {
                    $isValid = false;
                    $reasons[] = "Route name MUST start with $versionName";
                }
            }

            $pathWithoutVersion = $path->replaceMatches('/^\\/v[0-9](\\.[0-9]){0,2}/', '');

            $nestedPathCount = 0;
            $pathParts = $pathWithoutVersion->split('/');
            foreach ($pathParts as $pathPart) {
                $pathPart = u($pathPart);
                $isPathVariable = $pathPart->startsWith('{') && $pathPart->endsWith('}');
                if ($pathPart->isEmpty()) {
                    continue;
                }

                $errorMessage = "$pathPart MUST use kebab-case for path parts.";
                if ($isPathVariable) {
                    $pathPart = $pathPart->trim('{}');
                    $errorMessage = "{{$pathPart}} MUST use kebab-case for path parts.";
                } else {
                    $nestedPathCount++;
                }

                // force kebab-case for path parts
                if ($pathPart->match('/[A-Z]/') !== []) {
                    $isValid = false;
                    $reasons[] = $errorMessage;
                }

                if ($isPathVariable === false) {
                    $singular = $inflector->singularize($pathPart)[0];
                    if (in_array($singular, self::EXCLUDED_SINGULAR, true) === false) {
                        if ($singular === $pathPart->toString()) {
                            $isValid = false;
                            $reasons[] = "$pathPart MUST be pluralized. (Recommendation: {$inflector->pluralize($pathPart)[0]})";
                        }
                    }
                }
            }

            if ($nestedPathCount > self::MAX_NESTED_PATH) {
                $isValid = false;
                $reasons[] = "Nested SUB-RESOURCES SHOULD be limited to 3 levels deep. (Current: $nestedPathCount)";
            }

            if ($isValid === false) {
                $invalidRoutes[] = [
                        'route' => $route->getPath(),
                        'reasons' => $reasons,
                ];
            }
        }

        if (count($invalidRoutes) > 0) {
            $io->error('The following routes are invalid:');
            $io->table(['Route', 'Reason'],
                    array_map(fn($route) => [$route['route'], implode(', ', $route['reasons'])], $invalidRoutes));

            return Command::FAILURE;
        }

        // Add check for query parameters should be only snake_case (OpenAPI) https://opensource.zalando.com/restful-api-guidelines/#130

        return Command::SUCCESS;
    }
}