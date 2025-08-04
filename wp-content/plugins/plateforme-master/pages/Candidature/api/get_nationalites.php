<?php
header('Content-Type: application/json');
require_once '../db.php';
require_once '../services/CandidatureService.php';

try {
    $data = CandidatureService::getNationalites($pdo);
    echo json_encode(['status' => 'success', 'data' => $data], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
