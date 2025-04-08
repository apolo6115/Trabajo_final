<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$jsonPath = __DIR__ . '/data-1.json';

if (!file_exists($jsonPath) || !is_readable($jsonPath)) {
    http_response_code(500);
    die(json_encode(['error' => 'El archivo JSON no existe o no se puede leer']));
}

$jsonData = file_get_contents($jsonPath);
if ($jsonData === false) {
    http_response_code(500);
    die(json_encode(['error' => 'Error al leer el archivo JSON']));
}

$data = json_decode($jsonData, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    die(json_encode(['error' => 'Error al decodificar JSON: ' . json_last_error_msg()]));
}

echo json_encode($data);