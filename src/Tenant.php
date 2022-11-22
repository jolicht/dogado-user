<?php

namespace Jolicht\DogadoUser;

final class Tenant
{
    public function __construct(
        private readonly TenantId $id,
        private readonly string $code,
        private readonly string $name
    ) {
    }

    public static function fromPayload(array $payload): self
    {
        return new self(
            id: TenantId::fromString((string) $payload['id']),
            code: (string) $payload['code'],
            name: (string) $payload['name']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id->toString(),
            'code' => $this->code,
            'name' => $this->name,
        ];
    }

    public function getId(): TenantId
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
