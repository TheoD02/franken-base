<?php

namespace App\Tests;

use App\Api\Attribut\ApiRoute;
use Exception;
use JsonException;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

use Symfony\Component\Serializer\SerializerInterface;

use function current;
use function dd;
use function in_array;
use function is_object;
use function json_encode;
use function sprintf;
use function str_replace;

class ControllerTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->serializer = self::getContainer()->get('serializer');
    }

    /**
     * @throws Exception
     */
    protected function getRouteFromReflectionClass(\ReflectionClass $reflectionClass): TestRouteDescriber
    {
        $route = $reflectionClass->getAttributes(ApiRoute::class);
        if (empty($route)) {
            throw new \Exception('No route found');
        }

        /** @var ApiRoute $routeInstance */
        $routeInstance = $route[0]->newInstance();

        return new TestRouteDescriber(current($routeInstance->getMethods()), $routeInstance->getPath());
    }

    /**
     * @throws ReflectionException
     * @throws Exception
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


        $canHaveBody = in_array($testRouteDescriber->method, ['POST', 'PUT', 'PATCH', 'DELETE'], true);
        $content = null;
        if ($canHaveBody && !empty($requestBody)) {
            $content = $this->serializer->serialize($requestBody, 'json');
        }

        $uri = str_replace(
            array_map(
                static fn($key) => sprintf('{%s}', $key),
                array_keys($uriParameters),
            ),
            array_values($uriParameters),
            $testRouteDescriber->uri,
        );

        if (!empty($queryParameters)) {
            $uri .= '?' . http_build_query($queryParameters);
        }

        return $this->client->request(
            method: $testRouteDescriber->method,
            uri: $uri,
            server: $server,
            content: $content,
            changeHistory: $changeHistory,
        );
    }

    /**
     * @param bool $json
     * @return ($json is true ? array : string)
     * @throws JsonException
     */
    protected function getResponse(bool $json = true): array|string
    {
        $response = $this->client->getResponse();
        $content = $response->getContent();
        if ($json) {
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        }

        return $content;
    }

    protected function assertApiResponseEquals(array|object $data, ?array $meta = null): void
    {
        $response = $this->getResponse();
        self::assertEquals(is_object($data) ? $this->serializer->normalize($data) : $data, $response['data']);
        self::assertEquals($meta, $response['meta']);
    }

    protected function assertJsonArray(array $expected, array $excludeKeys = [], array $onlyKeys = []): void
    {
        if ($excludeKeys !== [] && $onlyKeys !== []) {
            throw new \InvalidArgumentException('You cannot use both $excludeKeys and $onlyKeys');
        }

        $response = $this->getResponse();

        foreach ($response as $key => $value) {
            if ($excludeKeys !== [] && in_array($key, $excludeKeys, true)) {
                unset($response[$key]);
                continue;
            }

            if ($onlyKeys !== [] && !in_array($key, $onlyKeys, true)) {
                unset($response[$key]);
                continue;
            }
        }

        self::assertEquals($expected, $response);
    }
}