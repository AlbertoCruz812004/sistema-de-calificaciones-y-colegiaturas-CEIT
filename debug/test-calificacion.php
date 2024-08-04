<?php


require_once '../config/DatabaseConfig.php';
require_once '../classes/CrudServiceCalificaciones.php';
require_once '../classes/Calificacion.php';

$db = new DatabaseConfig();

$conn = $db->openConnection();

$calificacionesService = new CrudServiceCalificaciones($conn);

// $calificacion = $calificacionesService->read("231900", 3);
// echo "{$calificacion["nombre"]}\n";
// echo "{$calificacion["modulo"]}\n";
// echo "{$calificacion["calificacion"]}\n";

// $calificacion = $calificacionesService->readByGroup(1, 1);

// foreach ($calificacion as $calif) {
//     echo "{$calif["nombre"]}: {$calif["calificacion"]}\n";
// }

// $calificacion = $calificacionesService->add("231904", 7, 7,);
// echo $calificacion;

// $calificacion = $calificacionesService->update("231904", 7, 10);

// echo $calificacion;

$calificacion = $calificacionesService->delete("231904", 7);

echo $calificacion;
