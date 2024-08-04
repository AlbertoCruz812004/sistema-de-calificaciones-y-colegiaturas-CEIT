<?php

declare(strict_types=1);

class CrudServiceCalificaciones
{

    private PDO $connection;
    private PDOStatement $statement;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function read(string $matricula, int $id_modulo): array
    {
        try {
            $this->statement = $this->connection->prepare("SELECT * FROM obtener_calificaciones(:matricula, :id_modulo);");
            $this->statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $this->statement->bindParam(':id_modulo', $id_modulo, PDO::PARAM_INT);
            $this->statement->execute();

            $row = $this->statement->fetch(PDO::FETCH_ASSOC);

            return [
                'nombre' => $row['nombre_persona'],
                'modulo' => $row['nombre_modulo'],
                'calificacion' => $row['calificacion'],
            ];
        } catch (PDOException $e) {
            die($e->getMessage());
            return [];
        }
    }

    public function readByGroup(int $grupo, int $id_modulo): array
    {
        try {
            $this->statement = $this->connection->prepare("SELECT * FROM obtener_calificaciones_grupo(:grupo, :id_modulo)");
            $this->statement->bindParam(':grupo', $grupo, PDO::PARAM_INT);
            $this->statement->bindParam(':id_modulo', $id_modulo, PDO::PARAM_INT);
            $this->statement->execute();

            $calificaciones = [];
            while ($row = $this->statement->fetch(PDO::FETCH_ASSOC)) {
                $calificaciones[] = [
                    'nombre' => $row['nombre_persona'],
                    'modulo' => $row['nombre_modulo'],
                    'calificacion' => $row['calificacion'],
                ];
            }
            return $calificaciones;
        } catch (PDOException $e) {
            die($e->getMessage());
            return [];
        }
    }

    public function add($matricula, int $modulo, float $calificacion): bool
    {
        try {
            $this->statement = $this->connection->prepare("SELECT insertar_calificacion(:calificacion, :modulo, :matricula)");
            $this->statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $this->statement->bindParam(':modulo', $modulo, PDO::PARAM_INT);
            $this->statement->bindParam(':calificacion', $calificacion);
            return $this->statement->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }

    public function delete(string $matricula, int $modulo): bool
    {
        try {
            $this->statement = $this->connection->prepare("SELECT eliminar_calificacion(:matricula, :modulo)");
            $this->statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $this->statement->bindParam(':modulo', $modulo, PDO::PARAM_INT);
            return $this->statement->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }

    public function update($matricula, int $modulo, float $calificacion): bool
    {
        try {
            $this->statement = $this->connection->prepare("SELECT actualizar_calificacion(:matricula, :modulo, :calificacion)");
            $this->statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $this->statement->bindParam(':modulo', $modulo, PDO::PARAM_INT);
            $this->statement->bindParam(':calificacion', $calificacion);
            return $this->statement->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }
}
