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

    $matricula = $data['matricula'];
    $modulo = $data['modulo'];
    $calificacion = $data['calificacion'];

    $calificacion = $calificacionesService->add($matricula, $modulo, $calificacion);

    if ($calificacion == 1) {
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
