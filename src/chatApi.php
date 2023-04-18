<?php
require_once __DIR__ . '/chat/Service/ResponsService.php';
use App\chat\Service\ResponsService;
$responsService = new ResponsService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['method']) && $data['method'] === 'returnRespons') {
        $result = $responsService->returnRespons($data['message']);
        echo json_encode(['success' => true, 'result' => $result]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Method not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}