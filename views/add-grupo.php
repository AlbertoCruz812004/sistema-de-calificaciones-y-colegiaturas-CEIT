<?php

require_once '../config/DatabaseConfig.php';  // Ajusta la ruta si es necesario
require_once '../classes/CrudServiceGrupo.php';  // Asegúrate de tener esta clase

$db = new DatabaseConfig();
$conn = $db->openConnection();

$grupoService = new CrudServiceGrupo($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $horario_inicio = $data['horario_inicio'] ?? null;
    $horario_fin = $data['horario_fin'] ?? null;
    $id_curso = $data['id_curso'] ?? null;
    $matricula_grupo = $data['matricula_grupo'] ?? null;
    $email_docente = $data['email_docente'] ?? null;

    $result = $grupoService->addGrupo(
        $horario_inicio,
        $horario_fin,
        $id_curso,
        $matricula_grupo,
        $email_docente
    );

    if ($result) {
        http_response_code(200);
        $response = [
            "status" => "success",
            "message" => "Grupo agregado exitosamente",
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "No se pudo agregar el grupo",
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit();
}
