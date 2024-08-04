<?php

require_once '../../config/DatabaseConfig.php';
require_once '../../classes/CrudServiceCalificaciones.php';
require_once '../../classes/Calificacion.php';

$db = new DatabaseConfig();

$conn = $db->openConnection();

$calificacionesService = new CrudServiceCalificaciones($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $grupo = $data['grupo'] ?? null;
    $modulo = $data['modulo'] ?? null;
    
    $response = $calificacionesService->readByGroup($grupo, $modulo);

    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
