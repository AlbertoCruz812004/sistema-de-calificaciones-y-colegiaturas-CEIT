<?php

declare(strict_types=1);

class CrudServiceGrupo
{
    private PDO $connection;
    private PDOStatement $statement;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addGrupo(
        string $horario_inicio,
        string $horario_fin,
        int $id_curso,
        string $matricula_grupo,
        string $email_docente
    ): bool {
        try {
            $this->statement = $this->connection->prepare("SELECT agregar_grupo(:horario_inicio, :horario_fin, :id_curso, :matricula_grupo, :email_docente)");
            $this->statement->bindParam(':horario_inicio', $horario_inicio, PDO::PARAM_STR);
            $this->statement->bindParam(':horario_fin', $horario_fin, PDO::PARAM_STR);
            $this->statement->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $this->statement->bindParam(':matricula_grupo', $matricula_grupo, PDO::PARAM_STR);
            $this->statement->bindParam(':email_docente', $email_docente, PDO::PARAM_STR);

            return $this->statement->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Usar error_log para registrar errores
            return false;
        }
    }
}
