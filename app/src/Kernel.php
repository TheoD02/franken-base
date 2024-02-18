<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use function array_merge;
use function is_file;
use function ucfirst;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function __construct(
        string $environment,
        bool $debug,
        private readonly string $appId
    ) {
        parent::__construct($environment, $debug);
    }

    public function getSharedConfigDir(): string
    {
        return $this->getProjectDir() . '/config';
    }

    public function getAppConfigDir(): string
    {
        return $this->getProjectDir() . "/apps/{$this->appId}/config";
    }

    public function registerBundles(): iterable
    {
        $sharedBundles = require $this->getSharedConfigDir() . '/bundles.php';
        $appBundles = require $this->getAppConfigDir() . '/bundles.php';

        // load common bundles, such as the FrameworkBundle, as well as
        // specific bundles required exclusively for the app itself
        foreach (array_merge($sharedBundles, $appBundles) as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class(); // @phpstan-ignore-line
            }
        }
    }

    public function getCacheDir(): string
    {
        // divide cache for each application
        return ($_SERVER['APP_CACHE_DIR'] ?? $this->getProjectDir(
            ) . '/var/cache') . "/{$this->appId}/{$this->environment}";
    }

    public function getLogDir(): string
    {
        // divide logs for each application
        return ($_SERVER['APP_LOG_DIR'] ?? $this->getProjectDir() . '/var/log') . "/{$this->appId}";
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        // load common config files, such as the framework.yaml, as well as
        // specific configs required exclusively for the app itself
        $this->doConfigureContainer($container, $this->getSharedConfigDir());
        $this->doConfigureContainer($container, $this->getAppConfigDir());
        $container->parameters()->set('kernel.domain.project_dir', $this->getProjectDir() . "/apps/{$this->appId}");
        $container->parameters()->set('kernel.namespace', 'App\\' . ucfirst($this->appId));
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // load common routes files, such as the routes/framework.yaml, as well as
        // specific routes required exclusively for the app itself
        $this->doConfigureRoutes($routes, $this->getSharedConfigDir());
        $this->doConfigureRoutes($routes, $this->getAppConfigDir());
    }

    private function doConfigureContainer(ContainerConfigurator $container, string $configDir): void
    {
        $container->import("{$configDir}/{packages}/*.{php,yaml}");
        $container->import("{$configDir}/{packages}/{$this->environment}/*.{php,yaml}");

        if (is_file("{$configDir}/services.yaml")) {
            $container->import("{$configDir}/services.yaml");
            $container->import("{$configDir}/{services}_{$this->environment}.yaml");
        } else {
            $container->import("{$configDir}/{services}.php");
        }
    }

    private function doConfigureRoutes(RoutingConfigurator $routes, string $configDir): void
    {
        $routes->import("{$configDir}/{routes}/{$this->environment}/*.{php,yaml}");
        $routes->import("{$configDir}/{routes}/*.{php,yaml}");

        if (is_file("{$configDir}/routes.yaml")) {
            $routes->import("{$configDir}/routes.yaml");
        } else {
            $routes->import("{$configDir}/{routes}.php");
        }
        $fileName = (new \ReflectionObject($this))->getFileName();
        if ($fileName !== false) {
            $routes->import($fileName, 'annotation');
        }
    }
}
