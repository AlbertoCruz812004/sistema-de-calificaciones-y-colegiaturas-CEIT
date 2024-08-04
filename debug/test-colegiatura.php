<?php

require_once '../config/DatabaseConfig.php';
require_once '../classes/CrudServiceColegiaturas.php';
require_once '../classes/Colegiaturas.php';

$db = new DatabaseConfig();

$conn = $db->openConnection();

$colegiaturasService = new CrudServiceColegiaturas($conn);

// $colegiatura = $colegiaturasService->read("231900", 25);

// echo "{$colegiatura['matricula']}\n";
// echo "{$colegiatura['nombre']}\n";
// echo "{$colegiatura['pago']}\n";
// echo "{$colegiatura['cambio']}\n";
// echo "{$colegiatura['semana']}\n";
// echo "{$colegiatura['fecha']}\n";

// $cole = new Colegiaturas(
//     120,
//     0,
//     23,
//     "2024-07-12",
//     "231900"
// );

// $colegiaturas = $colegiaturasService->add($cole);

// echo $colegiaturas;

// $colegiaturas = $colegiaturasService->delete("231900", 24);
// echo $colegiaturas;

// $cole = new Colegiaturas(
//     120,
//     0,
//     28,
//     "2024-07-12",
//     "231902"
// );

// $colegiaturas = $colegiaturasService->update($cole);

// echo $colegiaturas;
