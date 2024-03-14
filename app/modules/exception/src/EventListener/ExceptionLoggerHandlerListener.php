<?php

declare(strict_types=1);

namespace Module\ExceptionHandlerBundle\EventListener;

use Module\ExceptionHandlerBundle\Exception\AbstractHttpException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::EXCEPTION, priority: \PHP_INT_MAX * -1)]
readonly class ExceptionLoggerHandlerListener
{
    public const string DEFAULT_LOG_LEVEL = LogLevel::ERROR;

    public function __construct(
        private LoggerInterface $logger,
        #[Autowire(param: 'kernel.debug')]
        private bool $debug = false
    ) {
    }

    public function __invoke(ExceptionEvent $exceptionEvent): void
    {
        $throwable = $exceptionEvent->getThrowable();

        if ($throwable instanceof AbstractHttpException) {
            $logLevel = $throwable->getLogLevel();
            if (! \defined(LogLevel::class . '::' . strtoupper($logLevel))) {
                if ($this->debug) {
                    throw new \InvalidArgumentException(sprintf('Invalid log level "%s".', $logLevel));
                }

                $logLevel = self::DEFAULT_LOG_LEVEL;
            }

            $this->logger->log(
                $logLevel,
                $throwable->getMessage(),
                [
                    'context' => $throwable->getContextCode()->value,
                    'type' => $throwable->getParentErrorCode()->value,
                    'code' => $throwable->getFormattedErrorCode(),
                    'http_status_code' => $throwable->getStatusCode(),
                    'debug' => $throwable->getDescribe(),
                ]
            );
        }
    }
}
