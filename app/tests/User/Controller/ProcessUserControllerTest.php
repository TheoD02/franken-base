<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Domain\User\Controller\ProcessUserController;
use App\Domain\User\Exception\AbstractUserProcessingException;
use App\Tests\ControllerTestCase;
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
        $this->requestAction(ProcessUserController::class, '/api/users/{id}/process', uriParameters: [
            'id' => 1,
        ]);

        // Assert
        $this->assertResponseStatusCodeSame(422);

        $userProcessingException = new AbstractUserProcessingException();
        $expected = [
            'context_code' => $userProcessingException->getContextCode()->value,
            'parent_code' => $userProcessingException->getParentErrorCode()->value,
            'error_code' => $userProcessingException->getFormattedErrorCode(),
            'status' => 422,
        ];
        $this->assertJsonArray($expected, onlyKeys: array_keys($expected));
    }
}
