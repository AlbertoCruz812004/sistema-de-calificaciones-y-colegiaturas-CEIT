<?php

class DatabaseConfig
{
    private $host = "aws-0-us-west-1.pooler.supabase.com";
    private $port = "6543";
    private $database = "postgres";
    private $username = "postgres.ontjyfhqgihcyrhskusw";
    private $password = "Febrero2@81";
    private $connect;

    public function getConnect()
    {
        return $this->connect;
    }

    function openConnection()
    {
        try {
            $this->connect = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->database", $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connect;
        } catch (PDOException $th) {
            error_log("Error: {$th->getMessage()}");
            return null;
        }
    }

    function closeConnection()
    {
        $this->connect = null;
    }
}
