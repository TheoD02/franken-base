<?php

declare(strict_types=1);

namespace App\Tests;

use loophp\collection\Contract\Collection;
use Module\Api\Attribut\ApiRoute;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @internal
 */
class ControllerTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected SerializerInterface&NormalizerInterface $serializer;

    #[\Override]
    protected function setUp(): void
    {
        $this->client = self::createClient();
        /** @var SerializerInterface&NormalizerInterface $serializer */
        $serializer = self::getContainer()->get('serializer');
        $this->serializer = $serializer;
    }

    /**
     * @template T of object
     *
     * @param \ReflectionClass<T> $reflectionClass
     */
    protected function getRouteFromReflectionClass(\ReflectionClass $reflectionClass): TestRouteDescriber
    {
        $route = $reflectionClass->getAttributes(ApiRoute::class);
        if ($route === []) {
            throw new \Exception('No route found');
        }

        /** @var ApiRoute $routeInstance */
        $routeInstance = $route[0]->newInstance();

        if ($routeInstance->getPath() === null) {
            throw new \Exception('No path found');
        }

        return new TestRouteDescriber(current($routeInstance->getMethods()), $routeInstance->getPath());
    }

    /**
     * @param class-string              $controllerFqcn
     * @param array<string, string|int> $uriParameters
     * @param array<string, mixed>      $queryParameters
     * @param array<mixed>|object       $requestBody
     * @param array<string, string>     $server
     */
    protected function requestAction(
        string $controllerFqcn,
        array $uriParameters = [],
        array $queryParameters = [],
        array|object $requestBody = [],
        array $server = [],
        bool $changeHistory = true,
    ): Crawler {
        $reflectionClass = new \ReflectionClass($controllerFqcn);

        // Check if reflection class if a action controller with only "__invoke" method
        if ($reflectionClass->hasMethod('__invoke') === false) {
            throw new \RuntimeException(sprintf('The class %s is not a action controller', $controllerFqcn));
        }

        $testRouteDescriber = $this->getRouteFromReflectionClass($reflectionClass);

        $server += [
            'HTTP_ACCEPT' => 'application/json',
            'CONTENT_TYPE' => 'application/json',
        ];

        $canHaveBody = \in_array($testRouteDescriber->method, ['POST', 'PUT', 'PATCH', 'DELETE'], true);
        $content = null;
        if ($canHaveBody && ! empty($requestBody)) {
            $content = $this->serializer->serialize($requestBody, 'json');
        }

        $uri = str_replace(
            array_map(static fn ($key) => sprintf('{%s}', $key), array_keys($uriParameters)),
            array_values($uriParameters),
            $testRouteDescriber->uri
        );

        if ($queryParameters !== []) {
            $uri .= '?' . http_build_query($queryParameters);
        }

        return $this->client->request(method: $testRouteDescriber->method, uri: $uri, server: $server, content: $content, changeHistory: $changeHistory);
    }

    /**
     * @return ($json is true ? array<mixed> : string)
     */
    private function getResponse(bool $json = true): array|string
    {
        $response = $this->client->getResponse();
        $content = $response->getContent();

        if ($content === false) {
            throw new \RuntimeException('No response content');
        }

        if ($json) {
            return json_decode($content, true, 512, \JSON_THROW_ON_ERROR);
        }

        return $content;
    }

    /**
     * @param array<mixed>|object $data
     * @param array<mixed>|null   $meta
     */
    protected function assertApiResponseEquals(array|object $data, ?array $meta = null, array $groups = []): void
    {
        $response = $this->getResponse();

        $context = [
            'backed_enum_as_value' => true,
        ];
        if ($groups !== []) {
            $context['groups'] = $groups;
        }

        $expected = $data;
        if ($data instanceof Collection) {
            $expected = $this->serializer->normalize($data->all(false), context: $context);
        } elseif (\is_object($data)) {
            $expected = $this->serializer->normalize($data, context: $context);
        }

        self::assertSame($expected, $response['data']);
        self::assertSame($meta, $response['meta']);
    }

    /**
     * @param array<mixed>  $expected
     * @param array<string> $excludeKeys
     * @param array<string> $onlyKeys
     */
    protected function assertJsonArray(array $expected, array $excludeKeys = [], array $onlyKeys = []): void
    {
        if ($excludeKeys !== [] && $onlyKeys !== []) {
            throw new \InvalidArgumentException('You cannot use both $excludeKeys and $onlyKeys');
        }

        $response = $this->getResponse();

        foreach (array_keys($response) as $key) {
            if ($excludeKeys !== [] && \in_array($key, $excludeKeys, true)) {
                unset($response[$key]);
                continue;
            }

            if ($onlyKeys !== [] && ! \in_array($key, $onlyKeys, true)) {
                unset($response[$key]);
                continue;
            }
        }

        self::assertSame($expected, $response);
    }
}
