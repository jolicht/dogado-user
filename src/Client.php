<?php

namespace Jolicht\DogadoUser;

use Webmozart\Assert\Assert;

final class Client
{
    public function __construct(
        private readonly ClientId $id,
        private readonly string $code,
        private readonly string $name,
        private readonly Tenant $tenant
    ) {
    }

    public static function fromPayload(array $payload): self
    {
        Assert::isArray($payload['tenant']);

        return new self(
            id: ClientId::fromString((string) $payload['id']),
            code: (string) $payload['code'],
            name: (string) $payload['name'],
            tenant: Tenant::fromPayload($payload['tenant'])
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id->toString(),
            'code' => $this->code,
            'name' => $this->name,
            'tenant' => $this->tenant->toPayload(),
        ];
    }

    public function getId(): ClientId
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

    public function getTenant(): Tenant
    {
        return $this->tenant;
    }
}
