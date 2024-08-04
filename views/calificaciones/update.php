<?php


require_once '../../config/DatabaseConfig.php';
require_once '../../classes/CrudServiceCalificaciones.php';
require_once '../../classes/Calificacion.php';

$db = new DatabaseConfig();

$conn = $db->openConnection();

$calificacionesService = new CrudServiceCalificaciones($conn);

$db->closeConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $nombre = $data['nombre'];
    $modulo = (int)$data['modulo'];
    $calificacion = (float)$data['calificacion'];

    $calificacion = $calificacionesService->update($nombre, $modulo, $calificacion);

    if ($calificacion == 1) {
        http_response_code(200);
        $response = [
            "status" => "success",
            "message" => "Calificación Actualizada",
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "No se pudo actualizar la calificación",
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}
