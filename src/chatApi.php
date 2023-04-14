<?php
require_once __DIR__ . '/chat/Service/ResponsService.php';
use App\chat\Service\ResponsService;

$myClass = new ResponsService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['method']) && $data['method'] === 'myMethod') {
        $result = $myClass->returnRespons('Bonjour');
        echo json_encode(['success' => true, 'result' => $result]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Method not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}