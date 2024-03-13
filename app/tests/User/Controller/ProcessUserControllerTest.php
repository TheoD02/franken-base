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

        $userProcessingException = new UserProcessingException();
        $expected = [
            'context_code' => $userProcessingException->getContextCode()->value,
            'parent_code' => $userProcessingException->getParentErrorCode()->value,
            'error_code' => $userProcessingException->getFormattedErrorCode(),
            'status' => 422,
        ];
        $this->assertJsonArray($expected, onlyKeys: array_keys($expected));
    }
}
