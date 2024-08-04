<?php

declare(strict_types=1);

require_once 'UserEntity.php';

class Authentication
{
    private UserEntity $user;
    private PDO $connect;
    private PDOStatement $stmt;

    public function __construct(UserEntity $user, PDO $connect)
    {
        $this->user = $user;
        $this->connect = $connect;
    }

    public function login(): bool
    {
        try {
            $this->stmt = $this->connect->prepare(
                'SELECT persona.nombre_persona, persona.apellidos FROM administrativo 
                INNER JOIN persona ON persona.id = administrativo.id_persona
                WHERE administrativo.email = :username AND administrativo.password = :password'
            );

            $email = $this->user->getEmail();
            $password = $this->user->getPassword();

            $this->stmt->bindParam(":username", $email, PDO::PARAM_STR);
            $this->stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getData(): array
    {
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        $data = [
            "name" => $row["nombre_persona"],
            "lastname" => $row["apellidos"],
        ];

        return $data;
    }
}
