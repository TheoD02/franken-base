<?php

declare(strict_types=1);

namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\ProcessUserController;
use App\User\Exception\UserProcessingException;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(ProcessUserController::class)]
class ProcessUserControllerTest extends ControllerTestCase
{
    public function testInvokeWithUserCreation(): void
    {
        // Act
        $this->requestAction(ProcessUserController::class);

        // Assert
        self::assertResponseStatusCodeSame(422);
        $expected = [
            'type' => 'USER_EXCEPTION',
            'title' => 'Cannot process the user',
            'status' => 422,
            'code' => (new UserProcessingException())->getFormattedErrorCode(),
        ];
        $this->assertJsonArray($expected, onlyKeys: array_keys($expected));
    }
}
