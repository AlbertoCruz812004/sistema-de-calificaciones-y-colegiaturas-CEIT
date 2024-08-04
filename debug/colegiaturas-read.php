<?php

require_once '../config/DatabaseConfig.php';

try {
    $db = new DatabaseConfig();

    $conn = $db->openConnection();


    $matricula = '231900';

    $semana = 29;

    $stmt = $conn->prepare("SELECT * FROM obtener_colegiatura(:matricula, :semana)");

    $stmt->bindParam(':matricula', $matricula);
    $stmt->bindParam(':semana', $semana);

    $stmt->execute();

    $colegiatura = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $colegiatura['matricula'];
    echo $colegiatura['nombre_persona'];
    echo $colegiatura['pago'];
    echo $colegiatura['cambio'];
    echo $colegiatura['num_semana'];
    echo $colegiatura['fecha_pago'];
} catch (Exception $th) {
    die($th->getMessage());
}
