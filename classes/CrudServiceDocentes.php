<?php

declare(strict_types=1);

class CrudServiceDocentes
{
    private PDO $connection;
    private PDOStatement $statement;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addDocente(
        string $nombre_persona,
        string $apellidos,
        string $password,
        string $email,
        int $id_curso
    ): bool {
        try {
            // Preparar la consulta para llamar a la función agregar_docente
            $this->statement = $this->connection->prepare("
                SELECT agregar_docente(
                    :nombre_persona,
                    :apellidos,
                    :password,
                    :email,
                    :id_curso
                );
            ");
            $this->statement->bindParam(':nombre_persona', $nombre_persona, PDO::PARAM_STR);
            $this->statement->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $this->statement->bindParam(':password', $password, PDO::PARAM_STR);
            $this->statement->bindParam(':email', $email, PDO::PARAM_STR);
            $this->statement->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);

            return $this->statement->execute();
        } catch (PDOException $e) {
            // Manejar excepción y retornar false si ocurre un error
            error_log('Error al agregar docente: ' . $e->getMessage());
            return false;
        }
    }
}
