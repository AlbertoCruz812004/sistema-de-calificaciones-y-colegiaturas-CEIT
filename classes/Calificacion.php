<?php

declare(strict_types=1);

class Calificacion
{
    private float $calificacion;
    private int $modulo;
    private string $matricula;

    public function __construct(float $calificacion, int $modulo, string $matricula)
    {
        $this->calificacion = $calificacion;
        $this->modulo = $modulo;
        $this->matricula = $matricula;
    }

    public function getCalificacion(): float
    {
        return $this->calificacion;
    }

    public function getModulo(): int
    {
        return $this->modulo;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }
}
