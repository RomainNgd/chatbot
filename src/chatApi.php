<?php
require_once __DIR__ . '/chat/Service/ResponsService.php';

use App\chat\Service\ResponsService;

$responsService = new ResponsService();
$reponse = $responsService->returnRespons('categorie');
//var_dump($_SESSION['lastkeyword']);
//var_dump($reponse);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['method']) && $data['method'] === 'returnRespons') {zzzzzzzzzzzzzzz zzz z qz DZD QQS
        $result = $responsService->returnRespons($data['message']);
        echo json_encode(['success' => true, 'result' => $result]);
    }elseif (isset($data['method']) && $data['method'] === 'resetChat'){
        $responsService->resetChat();
    } else {
        echo json_encode(['success' => false, 'error' => 'Method not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}