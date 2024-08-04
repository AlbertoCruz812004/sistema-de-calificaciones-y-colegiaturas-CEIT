<?php

require_once '../config/DatabaseConfig.php';
require_once '../classes/CrudServiceDocentes.php';

// Crear conexión a la base de datos
$db = new DatabaseConfig();
$conn = $db->openConnection();

// Crear instancia del servicio de CRUD para docentes
$docentesService = new CrudServiceDocentes($conn);

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y decodificar el JSON del cuerpo de la solicitud
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Obtener los datos del JSON, utilizando valores predeterminados si no están presentes
    $nombre_persona = $data['nombre_persona'] ?? null;
    $apellidos = $data['apellidos'] ?? null;
    $password = $data['password'] ?? null;
    $email = $data['email'] ?? null;
    $id_curso = $data['id_curso'] ?? null;

    // Llamar al método para agregar el docente
    $result = $docentesService->addDocente(
        $nombre_persona,
        $apellidos,
        $password,
        $email,
        (int)$id_curso // Asegúrate de convertir a entero
    );

    // Preparar la respuesta
    if ($result) {
        http_response_code(200);
        $response = [
            "status" => "success",
            "message" => "Docente agregado exitosamente.",
        ];
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "No se pudo agregar el docente.",
        ];
    }

    // Enviar la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    exit();
}
