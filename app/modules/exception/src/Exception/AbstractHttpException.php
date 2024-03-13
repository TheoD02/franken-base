<?php

declare(strict_types=1);

namespace Module\ExceptionHandlerBundle\Exception;

use Module\Api\Enum\HttpStatusEnum;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionContextCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionErrorCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionParentCodeInterface;
use Module\ExceptionHandlerBundle\EventListener\ExceptionLoggerHandlerListener;
use Psr\Log\LogLevel;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function Symfony\Component\String\u;

abstract class AbstractHttpException extends HttpException
{
    public function __construct(
        private readonly array $context = [],
        private readonly ?string $describe = null,
    ) {
        parent::__construct(
            statusCode: $this->getHttpStatusCode()->value,
            message: $this->getErrorMessage()
        );
    }

    /**
     * Method to retrieve the HTTP status code for the exception.
     *
     * The HTTP status code indicates the appropriate status to be returned about an API call.
     *
     * @return HttpStatusEnum the HTTP status code corresponding to the specific scenario of this exception
     */
    public function getHttpStatusCode(): HttpStatusEnum
    {
        return HttpStatusEnum::INTERNAL_SERVER_ERROR;
    }

    /**
     * Abstract method to retrieve the context code for the exception.
     *
     * The context code serves as a reference to the specific context of the exception.
     *
     * e.g. "BUSINESS" for business logic exceptions, "DATABASE" for database exceptions, etc.
     *
     * @return ApiExceptionContextCodeInterface&\BackedEnum the context code defining the specific context (prefer string enum)
     */
    abstract public function getContextCode(): ApiExceptionContextCodeInterface;

    /**
     * Abstract method to retrieve the parent error code for the exception.
     *
     * The parent error code serves as a reference to category or context of the exception.
     *
     * e.g. "USER" for user-related exceptions, "ORDER" for order-related exceptions, etc.
     *
     * @return ApiExceptionParentCodeInterface&\BackedEnum the parent error code defining the category of the exception (prefer string enum)
     */
    abstract public function getParentErrorCode(): ApiExceptionParentCodeInterface;

    /**
     * Abstract method to retrieve the error code for the exception.
     *
     * The error code categorizes the specific nature of the exception and may be used for programmatic handling.
     *
     * e.g.
     *
     * @return ApiExceptionErrorCodeInterface&\BackedEnum the error code representing the specific nature of the exception (prefer string enum)
     */
    abstract public function getErrorCode(): ApiExceptionErrorCodeInterface;

    /**
     * Abstract method to retrieve the error message for the exception.
     *
     * The error message provides a concise and human-readable description of the exception.
     *
     * e.g. "The user could not be found." for user not found exceptions, "The order could not be processed." for order processing exceptions, etc.
     *
     * @return string the error message providing information about the exceptional condition
     */
    abstract public function getErrorMessage(): string;

    /**
     * Abstract method to generate a detailed description of the exception, including additional context information.
     *
     * The description aids developers in understanding the specific circumstances that led to the exception.
     *
     * @return string a detailed description of the exception with contextual insights
     */
    abstract protected function describe(): string;

    public function getDescribe(): ?string
    {
        return $this->describe ?? $this->describe();
    }

    /**
     * @return string the concatenated context code and error code
     */
    public function getFormattedErrorCode(): string
    {
        return u($this->getErrorCode()->value)
            ->prepend($this->getParentErrorCode()->value . '_')
            ->toString()
        ;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * The log level for the exception.
     *
     * This log is automatically logged by the ExceptionHandlerListener.
     *
     * @see LogLevel for possible log levels
     * @see ExceptionLoggerHandlerListener for the log level handling
     */
    abstract public function getLogLevel(): string;
}
