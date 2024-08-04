<?php

declare(strict_types=1);

class Persona
{
    private int $id;
    private string $name;
    private string $lastname;

    public function __construct(int $id, string $name, string $lastname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function __toString(): string
    {
        return sprintf($this->name, $this->lastname);
    }
}
