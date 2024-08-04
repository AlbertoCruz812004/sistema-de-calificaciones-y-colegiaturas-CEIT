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

    $matricula = $data['matricula'] ?? null;
    $semana = (int)$data['semana'] ?? null;
    
    $colegiaturas = $colegiaturasService->read($matricula, $semana);

    if ($colegiaturas != null) {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($colegiaturas);
    } else {
        http_response_code(400);
        header('Content-Type: application/json');
        $response = [
            "status" => "error",
            "message" => "Este alumno no cuenta con ningun pago de la semana {$semana}",
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    $db->closeConnection();
    exit();
}
