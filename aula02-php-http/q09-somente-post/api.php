<?php
header('Content-Type: application/json; charset=utf-8');

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(["erro"], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(200);
echo json_encode(["ok"], JSON_UNESCAPED_UNICODE);