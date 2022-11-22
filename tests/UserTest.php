<?php

namespace Jolicht\DogadoUser\Tests;

use Jolicht\DogadoUser\Client;
use Jolicht\DogadoUser\ClientId;
use Jolicht\DogadoUser\Tenant;
use Jolicht\DogadoUser\TenantId;
use Jolicht\DogadoUser\User;
use Jolicht\DogadoUser\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicht\DogadoUser\User
 */
class UserTest extends TestCase
{
    private Tenant $tenant;
    private Client $client;
    private UserId $userId;
    private User $user;

    protected function setUp(): void
    {
        $this->tenant = new Tenant(
            id: TenantId::create(),
            code: 'testCode',
            name: 'testName'
        );

        $this->client = new Client(
            id: ClientId::create(),
            code: 'testCode',
            name: 'testName',
            tenant: $this->tenant
        );

        $this->userId = UserId::fromString('699edf30-1a7b-4fc2-b3a4-7ff32e8e85b7');

        $this->user = new User(
            id: $this->userId,
            name: 'testName',
            roles: [
                'ROLE_USER',
            ],
            client: $this->client
        );
    }

    public function testGetId(): void
    {
        $this->assertSame($this->userId, $this->user->getId());
    }

    public function testGetName(): void
    {
        $this->assertSame('testName', $this->user->getName());
    }

    public function testGetUserIdentifier(): void
    {
        $this->assertSame('testName', $this->user->getUserIdentifier());
    }

    public function testEraseCredentialsDoesNothing()
    {
        $this->assertNull($this->user->eraseCredentials());
    }

    public function testGetRoles(): void
    {
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
    }

    public function testGetClient(): void
    {
        $this->assertSame($this->client, $this->user->getClient());
    }

    public function testGetTenant(): void
    {
        $this->assertSame($this->tenant, $this->user->getTenant());
    }

    public function testFromPayload(): void
    {
        $expected = [
            'id' => '699edf30-1a7b-4fc2-b3a4-7ff32e8e85b7',
            'name' => 'testName',
            'roles' => [
                'ROLE_USER',
            ],
            'client' => $this->client->toPayload(),
        ];
        $this->assertSame($expected, $this->user->toPayload());
    }

    public function testToPayload(): void
    {
        $payload = [
            'id' => '699edf30-1a7b-4fc2-b3a4-7ff32e8e85b7',
            'name' => 'testName',
            'roles' => [
                'ROLE_USER',
            ],
            'client' => $this->client->toPayload(),
        ];

        $this->assertEquals($this->user, User::fromPayload($payload));
    }
}
