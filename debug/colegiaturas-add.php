<?php

require_once '../config/DatabaseConfig.php';


try {

    $db = new DatabaseConfig();

    $conn = $db->openConnection();

    $stmt = $conn->prepare("SELECT agregar_colegiatura(:pago, :cambio, :semana, :fecha, :matricula)");

    $pago = 130;

    $cambio = $pago - 120;

    if ($cambio < 0) {
        throw new Exception("El alumno esta pagando menos de la colegiatura");
    }

    $semana = 31;

    $fecha = '2023-12-31';

    $matricula = '231900';

    $stmt->bindParam(':pago', $pago);

    $stmt->bindParam(':cambio', $cambio);

    $stmt->bindParam(':semana', $semana);

    $stmt->bindParam(':fecha', $fecha);

    $stmt->bindParam(':matricula', $matricula);


    $stmt->execute();

    $db->closeConnection();
} catch (Exception $th) {
    die($th->getMessage());
}
