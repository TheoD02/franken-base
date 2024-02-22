<?php


namespace App\Tests\User\Controller;

use App\Tests\ControllerTestCase;
use App\User\Controller\ProcessUserController;
use App\User\Exception\UserExceptionEnum;

class ProcessUserControllerTest extends ControllerTestCase
{
    public function testInvokeWithUserCreation(): void
    {
        // Act
        $this->requestAction(ProcessUserController::class);


        // Assert
        self::assertResponseStatusCodeSame(422);
        $expected = [
            'type' => 'BUSINESS_ERROR',
            'title' => 'Cannot process the user',
            'status' => 422,
            'code' => UserExceptionEnum::USER_PROCESSING_ERROR->value,
            'violations' => [],
        ];
        $this->assertJsonArray($expected, onlyKeys: array_keys($expected));
    }
}