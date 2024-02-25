<?php

declare(strict_types=1);

namespace Module\Api\Exception;

use Module\Api\Enum\HttpStatus;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function Symfony\Component\String\u;

abstract class AbstractHttpException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: $this->getHttpStatusCode()->value,
            message: $this->getErrorMessage()
        );
    }

    /**
     * Abstract method to retrieve the parent error code for the exception.
     *
     * The parent error code serves as a reference to category or context of the exception.
     *
     * @return \BackedEnum the parent error code defining the overarching context
     */
    abstract public function getParentErrorCode(): \BackedEnum;

    /**
     * Abstract method to retrieve the error message for the exception.
     *
     * The error message provides a concise and human-readable description of the exception.
     *
     * @return string the error message providing information about the exceptional condition
     */
    abstract protected function getErrorMessage(): string;

    /**
     * Abstract method to generate a detailed description of the exception, including additional context information.
     *
     * The description aids developers in understanding the specific circumstances that led to the exception.
     *
     * @param array $context an associative array of additional information to detail the exception
     *
     * @return string a detailed description of the exception with contextual insights
     */
    abstract protected function describe(array $context = []): string;

    /**
     * Abstract method to retrieve the error code for the exception.
     *
     * The error code categorizes the specific nature of the exception and may be used for programmatic handling.
     *
     * @return \BackedEnum the error code representing the specific nature of the exception
     */
    abstract protected function getErrorCode(): \BackedEnum;

    /**
     * Method to retrieve the HTTP status code for the exception.
     *
     * The HTTP status code indicates the appropriate status to be returned about an API call.
     *
     * @return HttpStatus the HTTP status code corresponding to the specific scenario of this exception
     */
    protected function getHttpStatusCode(): HttpStatus
    {
        return HttpStatus::INTERNAL_SERVER_ERROR;
    }

    public function getFormattedErrorCode(): string
    {
        return u($this->getErrorCode()->value)
            ->prepend($this->getParentErrorCode()->value . '_')
            ->toString()
        ;
    }
}
