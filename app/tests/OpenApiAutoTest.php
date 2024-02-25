<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\HttpClient;

use function Symfony\Component\String\u;
use function Zenstruck\Foundry\faker;

/**
 * @internal
 *
 * @coversNothing
 */
final class OpenApiAutoTest extends WebTestCase
{
    private KernelBrowser $client;
    private static array $openApiSpec;
    private static array $currentEndpoint;

    protected function tearDown(): void
    {
        parent::tearDown();

        restore_exception_handler();
    }

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public static function endpoints(): array
    {
        $httpClient = HttpClient::create();

        $response = $httpClient->request('GET', 'http://localhost/api/doc.json');

        self::$openApiSpec = $response->toArray();

        $endpoint = [];
        foreach (self::$openApiSpec['paths'] as $uri => $paths) {
            if ($uri === '/api/doc.json') {
                continue;
            }
            foreach ($paths as $method => $path) {
                $endpoint[] = [$uri, strtoupper($method), $path];
            }
        }

        return $endpoint;
    }

    #[DataProvider('endpoints')]
    public function testOpenApiAuto(string $uri, string $method, array $spec): void
    {
        self::$currentEndpoint = [
            'uri' => $uri,
            'method' => $method,
            'spec' => $spec,
        ];

        $parameters = $spec['parameters'] ?? [];
        $responses = $spec['responses'] ?? [];
        $requestBody = $spec['requestBody'] ?? null;

        $successResponse = null;
        $successResponseCode = null;
        foreach ($responses as $code => $response) {
            if ($code >= 200 && $code < 300) {
                $successResponse = $response;
                $successResponseCode = $code;
                break;
            }
        }

        if ($successResponse === null) {
            return;
        }

        $requestBody = $this->getRequestBody($requestBody);

        if ($method === 'post' && $requestBody === null) {
            throw new \JsonException('Request body is required for POST method');
        }

        $uri = $this->getUri($uri, $parameters);

        $this->client->request(
            $method,
            $uri,
            server: [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ],
            content: $requestBody
        );

        self::assertResponseIsSuccessful();
        if ($successResponseCode === 204) {
            return;
        }

        $this->assertResponseBodyMatchesSchema($successResponse);
    }

    private function getRequestBody(?array $requestBody): false|string|null
    {
        if ($requestBody === null) {
            return null;
        }

        $content = $requestBody['content'];

        $json = $content['application/json'] ?? null;

        if ($json === null) {
            return null;
        }

        $schemaRef = u($json['schema']['$ref'])->after('#/components/schemas/')->toString();
        $schema = self::$openApiSpec['components']['schemas'][$schemaRef];

        $class = new \stdClass();

        foreach ($schema['properties'] as $propertyName => $property) {
            $class->{$propertyName} = $this->getPropertyValue($property);
        }

        try {
            return json_encode($class, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \JsonException('Failed to encode request body');
        }
    }

    private function getPropertyValue(array $property): true|float|array|int|string|null
    {
        $type = $property['type'] ?? null;
        if ($type === null) {
            return null;
        }

        $format = $property['format'] ?? null;
        if ($format === 'float') {
            return 1.1;
        }

        if ($format === 'int') {
            return 1;
        }

        if ($type === 'string') {
            if ($format === 'email') {
                return faker()->email();
            }

            return 'string';
        }

        if ($type === 'boolean') {
            return true;
        }

        if ($type === 'array') {
            $items = $property['items'] ?? null;

            if ($items === null) {
                return ['CONTENT'];
            }

            $enum = $items['enum'] ?? null;
            if ($enum !== null) {
                $reflection = new \ReflectionClass($enum);
                $cases = $reflection->getConstants();

                return array_values(array_map(static fn ($case) => $case->value, $cases));
            }

            return ['CONTENT'];
        }

        return null;
    }

    private function assertResponseBodyMatchesSchema(array $successResponse): void
    {
        try {
            $response = json_decode($this->client->getResponse()->getContent(), true, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            dd(self::$currentEndpoint);
        }

        $schema = $successResponse['content']['application/json']['schema'] ?? null;

        if ($schema === null) {
            $this->endpointFail('Cannot retrieve schema from response.');
        }

        $properties = $schema['properties'] ?? null;

        if ($properties === null) {
            $this->endpointFail('Cannot retrieve properties from schema.');
        }

        foreach ($properties as $propertyName => $property) {
            self::assertArrayHasKey($propertyName, $response);
        }
    }

    private function endpointFail(string $message): void
    {
        $uri = self::$currentEndpoint['uri'];
        $method = self::$currentEndpoint['method'];
        self::fail("Endpoint {$uri} {$method} failed: {$message}");
    }

    private function getUri(string $uri, array $parameters): string
    {
        $computedUri = u($uri);

        $parameters = array_filter($parameters, static fn ($parameter) => $parameter['in'] === 'path');

        if (\count($parameters) === 0) {
            return $computedUri->toString();
        }

        foreach ($parameters as $parameter) {
            $name = $parameter['name'];
            $value = match ($name) {
                'id' => 1,
                default => 'value',
            };

            $computedUri = $computedUri->replace("{{$name}}", $value);
        }

        return $computedUri->toString();
    }
}
