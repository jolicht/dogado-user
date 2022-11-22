<?php

namespace Jolicht\DogadoUser\Tests;

use Jolicht\DogadoUser\Client;
use Jolicht\DogadoUser\ClientId;
use Jolicht\DogadoUser\Tenant;
use Jolicht\DogadoUser\TenantId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicht\DogadoUser\Client
 */
class ClientTest extends TestCase
{
    private Tenant $tenant;
    private ClientId $clientId;
    private Client $client;

    protected function setUp(): void
    {
        $this->tenant = new Tenant(
            id: TenantId::create(),
            code: 'testCode',
            name: 'testName'
        );
        $this->clientId = ClientId::fromString('fdee7242-aa92-4d7d-bd53-79b3949e6178');
        $this->client = new Client(
            id: $this->clientId,
            code: 'testCode',
            name: 'testName',
            tenant: $this->tenant
        );
    }

    public function testGetId(): void
    {
        $this->assertSame($this->clientId, $this->client->getId());
    }

    public function testGetCode(): void
    {
        $this->assertSame('testCode', $this->client->getCode());
    }

    public function testGetName(): void
    {
        $this->assertSame('testName', $this->client->getName());
    }

    public function testGetTenant(): void
    {
        $this->assertSame($this->tenant, $this->client->getTenant());
    }

    public function testToPayload(): void
    {
        $expected = [
            'id' => 'fdee7242-aa92-4d7d-bd53-79b3949e6178',
            'code' => 'testCode',
            'name' => 'testName',
            'tenant' => $this->tenant->toPayload(),
        ];
        $this->assertSame($expected, $this->client->toPayload());
    }

    public function testFromPayload(): void
    {
        $payload = [
            'id' => 'fdee7242-aa92-4d7d-bd53-79b3949e6178',
            'code' => 'testCode',
            'name' => 'testName',
            'tenant' => $this->tenant->toPayload(),
        ];
        $this->assertEquals($this->client, Client::fromPayload($payload));
    }
}
