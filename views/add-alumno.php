<?php

require_once '../config/DatabaseConfig.php';
require_once '../classes/CrudServiceAlumnos.php';

$db = new DatabaseConfig();
$conn = $db->openConnection();

$alumnosService = new CrudServiceAlumnos($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $nombre_persona = $data['nombre_persona'] ?? null;
    $apellidos = $data['apellidos'] ?? null;
    $matricula = $data['matricula'] ?? null;
    $password = $data['password'] ?? null;
    $id_grupo = $data['id_grupo'] ?? null;

    $result = $alumnosService->addAlumno(
        $nombre_persona,
        $apellidos,
        $matricula,
        $password,
        $id_grupo
    );

    if ($result) {
        http_response_code(200);
        $response = [
            "status" => "success",
            "message" => "Alumno agregado exitosamente",
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "No se pudo agregar el alumno",
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}
