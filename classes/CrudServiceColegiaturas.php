<?php

declare(strict_types=1);

class CrudServiceColegiaturas
{
    private PDO $connection;
    private PDOStatement $statement;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function update(float $pago, float $cambio, int $semana, string $fecha, string $matricula): bool
    {
        try {
            $this->statement = $this->connection->prepare(
                "SELECT actualizar_colegiatura_por_matricula_semana(:matricula, :semana, :pago, :cambio, :fecha)"
            );
            $this->statement->bindParam(':pago', $pago);
            $this->statement->bindParam(':cambio', $cambio);
            $this->statement->bindParam(':semana', $semana, PDO::PARAM_INT);
            $this->statement->bindParam(':fecha', $fecha);
            $this->statement->bindParam(':matricula', $matricula);
    
            return $this->statement->execute();
        } catch (Exception $th) {
            die('error: '. $th->getMessage());
            return false;
        }
    }

    public function read(string $matricula, int $semana): ?array
    {
        try {
            $this->statement = $this->connection->prepare("SELECT * FROM obtener_colegiatura(:matricula, :semana)");
            $this->statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);
            $this->statement->bindParam(':semana', $semana, PDO::PARAM_INT);
            $this->statement->execute();

            $row = $this->statement->fetch(PDO::FETCH_ASSOC);

            if ($row == null) {
                return null;
            }

            $colegiatura = [
                'status' => 'success',
                'matricula' => $row['matricula'],
                'nombre' => $row['nombre_persona'],
                'pago' => $row['pago'],
                'cambio' => $row['cambio'],
                'semana' => $row['num_semana'],
                'fecha' => $row['fecha_pago'],
            ];

            return $colegiatura;
        } catch (Exception $th) {
            die('Error => ' . $th->getMessage());
            return null;
        }
    }

    public function add(float $pago, float $cambio, int $semana, string $fecha, string $matricula): bool
    {
        try {
            // Preparar la sentencia SQL
            $this->statement = $this->connection->prepare(
                "SELECT agregar_colegiatura(:pago, :cambio, :semana, :fecha, :matricula)"
            );

            // Enlazar los parámetros
            $this->statement->bindParam(':pago', $pago);
            $this->statement->bindParam(':cambio', $cambio);
            $this->statement->bindParam(':semana', $semana, PDO::PARAM_INT);
            $this->statement->bindParam(':fecha', $fecha);
            $this->statement->bindParam(':matricula', $matricula);

            // Ejecutar la sentencia
            return $this->statement->execute();
        } catch (Exception $th) {
            // Manejar errores
            die('Error => ' . $th->getMessage());
        }
    }


    public function delete(string $matricula, int $numSemana): bool
    {
        try {
            $this->statement = $this->connection->prepare("SELECT eliminar_colegiatura(:matricula, :semana)");
            $this->statement->bindParam(':matricula', $matricula);
            $this->statement->bindParam(':semana', $numSemana);
            return $this->statement->execute();
        } catch (Exception $th) {
            die('error: ' . $th->getMessage());
            return false;
        }
    }
}
