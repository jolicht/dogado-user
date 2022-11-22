<?php

namespace Jolicht\DogadoUser;

use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

final class User implements UserInterface
{
    public function __construct(
        private readonly UserId $id,
        private readonly string $name,
        private readonly array $roles,
        private readonly Client $client
    ) {
    }

    public static function fromPayload(array $payload): self
    {
        Assert::isArray($payload['client']);
        Assert::isArray($payload['roles']);
        Assert::allString($payload['roles']);

        return new self(
            id: UserId::fromString((string) $payload['id']),
            name: (string) $payload['name'],
            roles: $payload['roles'],
            client: Client::fromPayload($payload['client'])
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id->toString(),
            'name' => $this->name,
            'roles' => $this->roles,
            'client' => $this->client->toPayload(),
        ];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->name;
    }


    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
