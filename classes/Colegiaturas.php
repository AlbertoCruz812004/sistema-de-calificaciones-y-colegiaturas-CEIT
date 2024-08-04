<?php

declare(strict_types=1);

class Colegiaturas
{
    private float $pago;
    private float $cambio;
    private int $num_semana;
    private string $fecha_pago;
    private string $matricula;

    public function __construct(float $pago, float $cambio, int $num_semana, string $fecha_pago, string $matricula)
    {
        $this->pago = $pago;
        $this->cambio = $cambio;
        $this->num_semana = $num_semana;
        $this->fecha_pago = $fecha_pago;
        $this->matricula = $matricula;
    }

    public function getPago(): float
    {
        return $this->pago;
    }

    public function getCambio(): float
    {
        return $this->cambio;
    }

    public function getNumSemana(): int
    {
        return $this->num_semana;
    }

    public function getFechaPago(): string
    {
        return $this->fecha_pago;
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function __toString(): string
    {
        return "Colegiatura Pago: {$this->pago}, Cambio: {$this->cambio}, Semana: {$this->num_semana}, Fecha de Pago: {$this->fecha_pago}, Matricula: {$this->matricula}";
    }

    public function toArray(): array
    {
        return [
            'pago' => $this->pago,
            'cambio' => $this->cambio,
            'num_semana' => $this->num_semana,
            'fecha_pago' => $this->fecha_pago,
            'matricula' => $this->matricula
        ];
    }
}
