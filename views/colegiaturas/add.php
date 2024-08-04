<?php

require_once '../../config/DatabaseConfig.php';
require_once '../../classes/CrudServiceColegiaturas.php';
require_once '../../classes/Colegiaturas.php';

$db = new DatabaseConfig();

$conn = $db->openConnection();

$colegiaturasService = new CrudServiceColegiaturas($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $matricula = $data['matricula'] ?? null; // Usa null como valor predeterminado si la clave no existe
    $pago = $data['pago'] ?? null;
    $cambio = $data['cambio'] ?? null;
    $semana = $data['semana'] ?? null;
    $fecha = $data['fecha'] ?? null;

    $colegiaturas = $colegiaturasService->add(
        $pago,
        $cambio,
        $semana,
        $fecha,
        $matricula
    );

    if ($colegiaturas == 1) {
        http_response_code(200);
        $response = [
            "status" => "success",
            "message" => "Calificación agregada",
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "No se pudo agregar la calificación",
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}
