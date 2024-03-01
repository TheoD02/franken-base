<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\ProcessUserController;
use App\User\Exception\UserProcessingException;
use PHPUnit\Framework\Attributes\CoversClass;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(ProcessUserController::class)]
class ProcessUserControllerTest extends ControllerTestCase
{
    use ResetDatabase;

    public function testInvokeWithUserCreation(): void
    {
        // Act
        $this->requestAction(ProcessUserController::class, [
            'id' => 1,
        ]);

        // Assert
        self::assertResponseStatusCodeSame(422);

        $exception = new UserProcessingException();
        $expected = [
            'context_code' => $exception->getContextCode()->value,
            'parent_code' => $exception->getParentErrorCode()->value,
            'error_code' => $exception->getFormattedErrorCode(),
            'status' => 422,
            'message' => $exception->getMessage(),
            'debug_message' => 'It seem that something went wrong while processing the user. Maybe the user provider is down? Is the user still in the database?',
            'context' => [
                'userId' => 1,
            ],
        ];
        $this->assertJsonArray($expected, onlyKeys: array_keys($expected));
    }
}
