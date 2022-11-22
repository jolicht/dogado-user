<?php

namespace Jolicht\DogadoUser\Tests;

use Jolicht\DogadoUser\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicht\DogadoUser\UserId
 */
class UserIdTest extends TestCase
{
    public function testCreate(): void
    {
        $this->assertInstanceOf(UserId::class, UserId::create());
    }
}
