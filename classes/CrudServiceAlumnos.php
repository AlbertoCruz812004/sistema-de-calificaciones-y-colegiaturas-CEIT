<?php

declare(strict_types=1);

class CrudServiceAlumnos
{
    private PDO $connection;
    private PDOStatement $statement;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addAlumno(
        string $nombre_persona,
        string $apellidos,
        string $matricula,
        string $password,
        int $id_grupo
    ): bool {
        try {
            $this->statement = $this->connection->prepare("SELECT agregar_alumno(:nombre_persona, :apellidos, :matricula, :password, :id_grupo)");
            $this->statement->bindParam(':nombre_persona', $nombre_persona, PDO::PARAM_STR);
            $this->statement->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $this->statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $this->statement->bindParam(':password', $password, PDO::PARAM_STR);
            $this->statement->bindParam(':id_grupo', $id_grupo, PDO::PARAM_INT);

            return $this->statement->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }
}
