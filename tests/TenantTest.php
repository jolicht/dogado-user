<?php

namespace Jolicht\DogadoUser\Tests;

use Jolicht\DogadoUser\Tenant;
use Jolicht\DogadoUser\TenantId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicht\DogadoUser\Tenant
 */
class TenantTest extends TestCase
{
    private TenantId $tenantId;
    private Tenant $tenant;

    protected function setUp(): void
    {
        $this->tenantId = TenantId::fromString('0f94a1f5-cf15-4fa3-a82a-a94901cb6f68');
        $this->tenant = new Tenant(
            id: $this->tenantId,
            code: 'testCode',
            name: 'testName'
        );
    }

    public function testGetId(): void
    {
        $this->assertSame($this->tenantId, $this->tenant->getId());
    }

    public function testGetCode(): void
    {
        $this->assertSame('testCode', $this->tenant->getCode());
    }

    public function testGetName(): void
    {
        $this->assertSame('testName', $this->tenant->getName());
    }

    public function testToPayload(): void
    {
        $expected = [
            'id' => '0f94a1f5-cf15-4fa3-a82a-a94901cb6f68',
            'code' => 'testCode',
            'name' => 'testName',
        ];
        $this->assertSame($expected, $this->tenant->toPayload());
    }

    public function testFromPayload(): void
    {
        $payload = [
            'id' => '0f94a1f5-cf15-4fa3-a82a-a94901cb6f68',
            'code' => 'testCode',
            'name' => 'testName',
        ];
        $this->assertEquals($this->tenant, Tenant::fromPayload($payload));
    }
}
